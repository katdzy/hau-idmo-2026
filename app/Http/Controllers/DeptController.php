<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\excelfile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\ImageException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DeptController extends Controller
{

    public function extractDeptLogo($drawing) {
        $imageData = null;
        
        if ($drawing instanceof Drawing) {
            $zipReader = fopen($drawing->getPath(), 'r');
            if ($zipReader) {
                $imageData = stream_get_contents($zipReader);
                fclose($zipReader);
            }
        } elseif ($drawing instanceof MemoryDrawing) {
            ob_start();
            call_user_func($drawing->getRenderingFunction(), $drawing->getImageResource());
            $imageData = ob_get_contents();
            ob_end_clean();
        }
        return ['imageData' => $imageData, 'imageExtension' => pathinfo($drawing->getPath(), PATHINFO_EXTENSION)];
    }

    public function load_all_file(Request $request) {
    
        excelfile::truncate();     
        $request->validate([
            'file' => 'required|file|mimes:xlsx'
        ]);

        $file = $request->file('file'); 
        $spreadsheet = IOFactory::load($file->getRealPath());
        $path = 'sheets/temp'; 
        if(!Storage::disk('public')->exists($path)) { 
            Storage::disk('public')->makeDirectory($path, 0755, true);
        }
        $filename = 'masterlist_temp.' . $file->getClientOriginalExtension();
        $file->storeAs($path, $filename, 'public') ;


        $count = 1 ; 
        
        $sheet = $spreadsheet->getActiveSheet(); 
        foreach ($sheet->getRowIterator(8) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // Set to TRUE to iterate only existing cells

            $rowData = [];
            foreach ($cellIterator as $cell) {
                $column = $cell->getColumn();
                // Check if the column is A or B (i.e., column 1 or 2)
                if ($column === 'A' || $column === 'B') {
                    $rowData[$column] = $cell->getValue();
                }
            }

            if (isset($rowData['A']) && isset($rowData['B'])) {
                $item_dept = Departments::where('code', $rowData['A'])->first();

                if ($item_dept) {
                    // If the department exists, check for the logo
                    $logo = $item_dept->logo ? $item_dept->logo : '';
                } else {
                    // If the department does not exist, set logo to blank
                    $logo = '';
                }
                
             
                // Create the record in the excelfile
                excelfile::create([
                    'code' => $rowData['A'], // Data from column A
                    'department' => $rowData['B'], // Data from column B
                    'logo' => $logo, 
                    'updated_at' => now(), 
                    'created_at' => now()
                ]);
            } else { 
                if($count == 1) {
                    return view( 'admin.config.dept.update-all')->with(['msg' => 'There was an error processing the data. Please double check the file.']); 

                }
            }

            $count++; 
            
        }
    
        $data = excelfile::orderBy('department' , 'asc')->get(); 
    
        return view('admin.config.dept.update-all')->with(['excel_data' => $data]);
    }


    /// loading batch file
    public function load_batch_file() { 
        //truncate the current queue list on the excel sheet
        excelfile::truncate(); 
    }

    public function update_all() { 
        // Truncate the current dept list
        Departments::truncate(); 

        $data = excelfile::all(); 
        foreach($data as $item) { 

            Departments::create([
                'code'=> $item->code, 
                'dept'=> $item->department,
                'logo'=> $item->logo, 
                'created_at'=>now(),
                'updated_at'=> now()
            ]);
        }

        // Get the latest updated_at date
        $last_updated_record = Departments::orderBy('updated_at', 'desc')->first();
        if($last_updated_record) {
            $last_updated = explode(' ', $last_updated_record->updated_at)[0];
        } else {
            $last_updated = date('Y-m-d');
        }

        // Define the file extension
        $extension = 'xlsx'; // Since we are dealing with .xlsx files

        // Define the new filename
        $filename = 'HAU-IDMO_Departments_MasterList-' .$last_updated . '.' . $extension ;

        // Define source and destination paths
        $sourcePath  = 'sheets/temp/masterlist_temp.xlsx'; 
        $destinationPath = 'sheets/app/' . $filename;

        // Ensure the destination directory exists
        if(!Storage::disk('public')->exists('sheets/app')) { 
            Storage::disk('public')->makeDirectory('sheets/app', 0755, true);
        }

        // Move the file using the Storage facade
        try {
            Storage::disk('public')->move($sourcePath, $destinationPath); 
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('File move failed: ' . $e->getMessage());

            // Optionally, you can redirect back with an error message
            return redirect()->back()->with(['msg' => 'Departments updated, but failed to move the master list file. Please check the server logs.']);
        }

        // Truncate the excelfile table after moving the file
        excelfile::truncate(); 

        return redirect()->route('admin.registry.dept')->with([ 
            'msg'=> 'Departments updated successfully. Your changes have been saved.'
        ]);
    }


    public function search(Request $request)
    {
        $query = $request->get('query');

        // If query is empty, return paginated results; otherwise, filter and paginate.
        if (empty($query)) {
            $dept = Departments::orderBy('dept', 'asc')->paginate(10);
        } else {
            $dept = Departments::where('code', 'LIKE', "%{$query}%")
                ->orWhere('dept', 'LIKE', "%{$query}%")
                ->orderBy('dept', 'asc')
                ->paginate(10);
        }

        // If the request is AJAX, return the rendered HTML partial.
        if ($request->ajax()) {
            $view = view('admin.config.dept.departments-data', compact('dept'))->render();
            return response()->json(['html' => $view]);
        }
    }

    

    public function update_dept(Request $request, $id) { 
        $request->validate([ 
            'code'=> 'string',
            'dept'=> 'string' 
        ]); 

        $dept = Departments::findOrFail($id); 

        if($request->file('logo')){ 

            $path = 'dept/logo';
            //if the incoming request has a file upload, then this will be executed 
            if(!Storage::disk('public')->exists($path)){ 
                Storage::disk('public')->makeDirectory($path, 0755, true); 
            }
        

            //set the filename
            $fn = $dept->code . '_logo.' . $request->file('logo')->getClientOriginalExtension();

            $dept->update([ 
                'logo'=> $fn 
            ]); 

            $request->file('logo')->storeAs($path, $fn, 'public'); 
        }

        $dept->update([ 
            'code'=> $request->code, 
            'dept'=> $request->dept
        ]); 

        return redirect()->route('admin.registry.dept')->with([ 
            'msg'=> 'The department record was updated.'
        ]); 

    }

    public function view_department($id) { 
        return view('admin.config.dept.view')->with([ 
            'dept'=> Departments::where('id', $id)->first() 
        ]); 
    }

    public function destroy($id) { 
        Departments::destroy([$id]); 
        return redirect()->route('admin.registry.dept')->with([
            'msg'=> "Item successfully deleted. The record has been removed from the system."
        ]); 
    }

    public function load_list() { 
        // Define the paths to the directories
        $directoryPath = storage_path('app/public/sheets/app');
        $templateDirectoryPath = storage_path('app/public/sheets/temp');
    
        // Check if the main directory exists
        if (is_dir($directoryPath)) {
            $files = scandir($directoryPath);
            $files = array_diff($files, ['.', '..']);
    
            $fileData = [];
            foreach ($files as $file) {
                // Get the full file path
                $filePath = $directoryPath . '/' . $file;
                $size = filesize($filePath);
    
                // Extract the date from the file name
                preg_match('/(\d{4}-\d{2}-\d{2})/', $file, $matches);
                $date = isset($matches[1]) ? $matches[1] : null;
    
                // Create file object
                $fileData[] = (object)[
                    'id' => $file,
                    'name' => $file,
                    'size' => $size,
                    'date' => $date, 
                ];
            }
    
            // Sort the files by date in descending order
            usort($fileData, function($a, $b) {
                return strcmp($b->date, $a->date);
            });
    
            $mostRecentFile = !empty($fileData) ? $fileData[0] : null;
    
            // Check if the template directory exists and fetch the template files
            $templateFiles = [];
            if (is_dir($templateDirectoryPath)) {
                $templateFilesList = scandir($templateDirectoryPath);
                $templateFilesList = array_diff($templateFilesList, ['.', '..']);
                
                foreach ($templateFilesList as $file) {
                    $templateFiles[] = $file; // You can customize this if you need more file details
                }
            }
    
            return view('admin.config.dept.lists')->with([
                'files' => $fileData,
                'mostRecentFile' => $mostRecentFile,
                'template_files' => $templateFiles
            ]);
        } else {
            return response()->json(['error' => 'Directory does not exist.'], 404);
        }
    }
    

    public function download_sheet($filename)
    {
        // Specify the directory where your files are stored
        $path = storage_path("app/public/sheets/app/{$filename}");

        // Check if the file exists
        if (!file_exists($path)) {
            return response()->json(['message' => 'File not found.'], 404);
        }

        // Return the file as a download response
        return response()->download($path);
    }

    public function download_template($filename)
    {
        // Specify the directory where your files are stored
        $path = storage_path("app/public/sheets/temp/{$filename}");

        // Check if the file exists
        if (!file_exists($path)) {
            return response()->json(['message' => 'File not found.'], 404);
        }

        // Return the file as a download response
        return response()->download($path);
    }

    public function store_dept(Request $request) { 
        $request->validate([ 
            'code'=> 'required|string|unique:departments,code',
            'dept'=> 'required|string' 
        ]); 

        $logoFileName = '';
        if($request->file('logo')){ 
            $path = 'dept/logo';
            if(!Storage::disk('public')->exists($path)){ 
                Storage::disk('public')->makeDirectory($path, 0755, true); 
            }
        
            $logoFileName = $request->code . '_logo.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs($path, $logoFileName, 'public'); 
        }

        Departments::create([ 
            'code'=> $request->code, 
            'dept'=> $request->dept,
            'logo'=> $logoFileName
        ]); 

        return redirect()->route('admin.registry.dept')->with([ 
            'msg'=> 'Department record created successfully.'
        ]); 
    }

}
