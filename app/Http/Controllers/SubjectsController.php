<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\Employee;
use App\Models\Loads;
use App\Models\Subjects;
use App\Models\temp_subjects;
use App\Models\tags;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SubjectsController extends Controller
{
    public function load($id)
    {
        $subj = Subjects::where('subj_id', $id)->first();
        $semesters = tags::where('category', 'semester')->get();
        return view('manage-emps.subjects.load')->with([
            'subj' => $subj,
            'semesters' => $semesters
        ]);
    }

    public function loadSearch(Request $request, $subj)
    {
        if(Loads::where("subj_id", $subj)->where('emp_id',$request->emp_id)->exists()) {
            $existing = true;
        } else {
            $existing = false;
        }

        $semesters = tags::where('category', 'semester')->get();
        $depts = Departments::orderBy('dept', 'asc')->get();
        $admin_dept = Employee::where('emp_id', Auth::user()->id)->first()->emp_dept;
        $admin_role = Auth::user()->role;

        return view('manage-emps.subjects.load')->with([
            'subj'=> Subjects::where('subj_id' ,$subj)->first(),
            'user'=> Employee::where('emp_id', $request->emp_id)->first(),
            'loads'=> Loads::where('emp_id', $request->emp_id)->get(),
            'status'=> $existing,
            'semesters' => $semesters,
            'depts' => $depts,
            'admin_role' => $admin_role,
            'admin_dept' => $admin_dept
        ]);
    }

    /**
     * Search subjects for AJAX request (delete.blade.php calls this).
     * Return a JSON response so JS can refresh the table.
     */
    public function search(Request $request)
    {
        $query = $request->get('query');

        // We can add ->orderBy('subj_title','ASC') to keep it consistent
        $subj = Subjects::where('subj_title', 'LIKE', "%{$query}%")
                    ->orWhere('subj_code', 'LIKE', "%{$query}%")
                    ->orWhere('subj_id', 'LIKE', "%{$query}%")
                    ->orderBy('subj_title','ASC')
                    ->get();

        return response()->json($subj);
    }

    public function view(Request $request)
    {
        $subj = Subjects::where('subj_code', $request->id)-> first();
        return view('manage-emps.subjects.view')-> with(['subj'=> $subj]);
    }

    public function add()
    {
        do {
            $rand = sprintf('%04d', mt_rand(0, 9999));
            $subj_id= DB::table('subjects')->where('subj_code', $rand)->exists();
        } while ($subj_id);

        $code = $rand;
        return view('manage-emps.subjects.add')-> with(['subj_id'=> $code]);
    }

    public function load_to_user(Request $request)
    {
        $sy = $request->sy_start . '-' . $request->sy_end;

        // Check if the load already exists
        if(Loads::where('emp_id', $request->user)
            ->where('subj_id', $request->subj)
            ->where('sy', $sy)
            ->where('class_code', $request->class_code)
            ->where('class_dept', $request->class_dept)
            ->where('semester', $request->sem)
            ->exists()) {
            return back()->with('error', 'The selected subject is already included in the teaching load of the chosen user.');
        }

        Loads::create([
            'emp_id'=> $request->user,
            'subj_id'=> $request->subj,
            'class_code' => $request->class_code,
            'class_dept' => $request->class_dept,
            'sy' => $sy,
            'semester' => $request->sem,
            'added_by'=> Auth::user()->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $subj_code = Subjects::where('subj_id', $request->subj)->value('subj_code');

        // Redirect back to the subject view with a success message
        return redirect()->route('admin.subjects.view', ['id' => $subj_code])
            ->with('msg', 'Subject has been successfully added to the user.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'subj_id'=> 'string',
            'subj_code'=> 'string',
            'subj_title'=> 'string',
            'subj_sy'=>'string',
            'subj_description'=> 'string|nullable',
        ]);

        $created= Subjects::create([
            'subj_id' => $request->subj_id,
            'subj_code'=> $request-> subj_code,
            'subj_title'=> $request-> subj_title,
            'subj_sy'=> $request-> subj_sy,
            'subj_description'=> $request->subj_description,
            'units'=> $request-> units
        ]);

        if($created) {
            return redirect()-> route('admin.subjects')-> with(['msg'=>'New subject added.']);
        }
    }


    public function destroy($id)
    {
        $subject = Subjects::where('subj_code', $id)->first();

        if (!$subject) {
            return redirect()->route('admin.subjects')->withErrors(['error' => 'Subject not found.']);
        }

        // Delete associated loads
        Loads::where('subj_id', $subject->subj_id)->delete();

        // Delete the subject
        $subject->delete();

        return redirect()->route('admin.subjects')->with('msg', 'Subject deleted successfully.');
    }

    // Batch delete (for multiple checkboxes)
    public function delete(Request $request)
    {
        $items = $request->input('items', []);

        if (empty($items)) {
            return redirect()->route('admin.subjects')->withErrors(['error' => 'No subjects selected for deletion.']);
        }

        foreach ($items as $id) {
            $subject = Subjects::find($id);

            if ($subject) {
                // Delete related loads
                Loads::where('subj_id', $subject->subj_id)->delete();
                $subject->delete();
            }
        }

        return redirect()->route('admin.subjects')->with('msg', 'Selected subjects deleted successfully.');
    }

    public function deletePartial(Request $request)
    {
        $query = $request->query('q', '');    // Search string
        $page  = $request->query('page', 1);  // Page number

        // Base query sorted by subj_title ascending
        $subjectsQuery = Subjects::orderBy('subj_title', 'asc');

        // If there's a search query, filter
        if (!empty($query)) {
            $subjectsQuery->where(function ($qBuilder) use ($query) {
                $qBuilder->where('subj_title', 'LIKE', "%{$query}%")
                        ->orWhere('subj_code', 'LIKE', "%{$query}%")
                        ->orWhere('subj_id', 'LIKE', "%{$query}%");
            });
        }

        // Paginate 10 per page
        // If you want to handle the 'page' param, Laravel does it automatically if you call ->paginate(10)
        $subjects = $subjectsQuery->paginate(10);

        // Render a partial view that ONLY contains the table rows + pagination links
        $html = view('manage-emps.subjects.delete-partial', compact('subjects'))->render();

        // Return as JSON so JavaScript can inject the HTML
        return response()->json([
            'html' => $html
        ]);
    }

    public function update(Request $request, $code)
    {
        $subj = Subjects::where('subj_code', $code)->first();

        $request->validate([
            'subj_code' => 'required|string',
            'subj_title' => 'required|string',
            'subj_description' => 'nullable|string',
            'units' => 'required|integer',
            'subj_sy' => 'required|string',
        ]);

        $subj->subj_code = $request->input('subj_code');
        $subj->subj_title = $request->input('subj_title');
        $subj->subj_description = $request->input('subj_description');
        $subj->units = $request->input('units');
        $subj->subj_sy = $request->input('subj_sy');

        $subj->save();

        return redirect()->route('admin.subjects.view', ['id' => $subj->subj_code])
            ->with('msg', 'Subject updated successfully.');
    }

    public function search_item(Request $request)
    {
        $query = $request->get('query');
        $subjects = Subjects::where('subj_code', 'LIKE', "%{$query}%")
                           ->orWhere('subj_title', 'LIKE', "%{$query}%")
                           ->orWhere('subj_id', 'LIKE', "%{$query}%")
                           ->get();

        return response()->json($subjects);
    }

    public function import_file(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        // Clear temporary subjects
        temp_subjects::truncate();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();

            $seen_subj_codes = [];
            $count = 1;
            $errors = [];
            $validRows = [];

            foreach ($sheet->getRowIterator(8) as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(true);

                $rowData = [];
                foreach ($cellIterator as $cell) {
                    $column = $cell->getColumn();
                    $cellValue = $cell->getValue();

                    if (!empty($cellValue)) {
                        if (in_array($column, ['A', 'B', 'C', 'D'])) {
                            $rowData[$column] = $cellValue;
                        }
                    }
                }

                $currentRow = $row->getRowIndex();
                $rowErrors = [];

                $subj_code = trim($rowData['A'] ?? '');
                if (empty($subj_code)) {
                    $rowErrors[] = "Row {$currentRow}, Column A (subj_code) is required.";
                } else {
                    if (in_array($subj_code, $seen_subj_codes)) {
                        $rowErrors[] = "Row {$currentRow}, Column A (subj_code) '{$subj_code}' is duplicated in the file.";
                    } else {
                        $seen_subj_codes[] = $subj_code;
                    }
                    if (Subjects::where('subj_code', $subj_code)->exists()) {
                        $rowErrors[] = "Row {$currentRow}, Column A (subj_code) '{$subj_code}' already exists in the database.";
                    }
                }

                $subj_title = trim($rowData['B'] ?? '');
                if (empty($subj_title)) {
                    $rowErrors[] = "Row {$currentRow}, Column B (subj_title) is required.";
                }

                $units = trim($rowData['C'] ?? '');
                if (empty($units)) {
                    $rowErrors[] = "Row {$currentRow}, Column C (units) is required.";
                }

                $subj_sy = trim($rowData['D'] ?? '');
                if (empty($subj_sy)) {
                    $rowErrors[] = "Row {$currentRow}, Column D (subj_sy) is required.";
                }

                if (!empty($rowErrors)) {
                    $errors = array_merge($errors, $rowErrors);
                } else {
                    $tempSubjectData = [
                        'subj_code'  => $subj_code,
                        'subj_title' => $subj_title,
                        'units'      => $units,
                        'subj_sy'    => $subj_sy,
                    ];
                    $validRows[] = $tempSubjectData;
                }
                $count++;
            }

            if (!empty($errors)) {
                return view('manage-emps.subjects.upload')->with([
                    'import_errors' => $errors,
                    'imported'=> false
                ]);
            }

            foreach ($validRows as $tempSubjectData) {
                temp_subjects::create($tempSubjectData);
            }
    
            return view('manage-emps.subjects.upload')->with([
                'imported'=> true,
                'subjects'=> temp_subjects::all()
            ]);
        }
        else{
            return back()->withErrors(['error'=> 'No file was uploaded.']);
        }
    }

    public function load_file()
    {
        $data = temp_subjects::all();

        foreach($data as $row) {
            if(!Subjects::where('subj_code', $row->subj_code)->exists()) {

                do {
                    $id = sprintf('%04d', mt_rand(0, 9999));
                } while (Subjects::where('subj_id', $id)->exists());

                Subjects::create([
                    'subj_id'=> $id,
                    'subj_code'=> $row->subj_code,
                    'subj_title'=> $row->subj_title,
                    'subj_description'=>'',
                    'units'=> $row-> units,
                    'subj_sy' => $row->subj_sy
                ]);
            }
        }

        return redirect()->route('admin.subjects')->with('msg', 'Subject/s uploaded successfully.');
    }

    /**
     * Display a listing of the subjects with pagination (10).
     */
    public function index()
    {
        $user = Employee::where('emp_id', Auth::user()->id)->first();
        $data = Subjects::orderBy('subj_title', 'asc')->paginate(10);  // Already sorted by subj_title, 10 per page

        return view('manage-emps.subjects.subj')->with([
            'data' => $data,
            'user' => $user
        ]);
    }
}
