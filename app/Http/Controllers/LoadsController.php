<?php

namespace App\Http\Controllers;

use App\Models\batch_queue;
use App\Models\Departments;
use App\Models\Employee;
use App\Models\Employee_Login;
use App\Models\Loads;
use App\Models\Subjects;
use App\Models\tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoadsController extends Controller
{
    public function loadshow() { 
        $subjects = Subjects::with(['loads' => function($query) {
            if (Auth::user()->role !== 'SuperAdmin' && Auth::user()->role !== 'HR Admin') {
                $emp_dept = Auth::user()->user->emp_dept;
                $query->whereHas('user', function($q) use ($emp_dept) { 
                    $q->where('emp_dept', $emp_dept); 
                });
            }
        }])->orderBy('subj_title', 'asc')->paginate(10);

        return view('manage-emps.loads.sub.main')->with([ 
            'subjects' => $subjects,
            'semesters' => tags::where('category', 'semester')->get()
        ]);
    }

    public function loadlbs($id) { 
        // Attempt to retrieve the subject
        $subj = Subjects::where('subj_id', $id)->first();
    
        // If the subject doesn't exist, redirect with an error message
        if (!$subj) {
            return redirect()->route('admin.loads')->with('msg', 'Subject not found.');
        }
    
        // Fetch loads based on user role
        switch(Auth::user()->role){ 
            case 'SuperAdmin': 
            case 'HR Admin': 
                $loads = Loads::where('subj_id', $id)->get(); 
                break; 
            default: 
                $loads = Loads::where('subj_id', $id)
                    ->whereHas('user', function($q) { 
                        $q->where('emp_dept', Auth::user()->user->emp_dept); 
                    })->get(); 
        }
    
        // Pass data to the view
        return view('manage-emps.loads.sub.view')->with([ 
            'subj' => $subj, 
            'loads' => $loads,
            'semesters' => tags::where('category', 'semester')->get()
        ]);
    }

    public function loaduser(Request $request) { 
        $userinfo = Employee::where('emp_id', $request->id)->first(); 

        if(!$userinfo) {
            return redirect()->route('admin.loads')->with('msg', 'User not found...');
        }

        $admin_dept = Employee::where('emp_id', Auth::user()->id)->first()->emp_dept;
        $admin_role = Auth::user()->role;
        $userRole = Employee_Login::where('id', $request->id)->first()->role;

        if(Auth::user()->role != 'SuperAdmin' && Auth::user()->role != 'HR Admin') {
            if($userRole != "Employee") { 
                return redirect()->route('admin.loads')->with('msg', 'You do not have permission to view or modify this record.');
            }
        }

        $depts = Departments::orderBy('dept', 'asc')->get();

        $loads = Loads::where('emp_id', $request->id)->get();

        return view('manage-emps.loads.loads')->with([
            'userinfo' => $userinfo,
            'loads' => $loads,
            'depts' => $depts,
            'admin_role' => $admin_role,
            'admin_dept' => $admin_dept,
            'semesters' => tags::where('category', 'semester')->get() // Added semesters
        ]);
    }

    public function add(Request $request) { 
        $userinfo = Employee::where('emp_id', $request->id)->first(); 
        if(!$userinfo){
            return redirect()->route('admin.loads')->with('msg', 'User not found...');
        }
        return view('manage-emps.loads.loads')->with([
            'userinfo' => $userinfo, 
            'loads' => Loads::where('emp_id', $request->id)->get(),
            'semesters' => tags::where('category', 'semester')->get() // Added semesters
        ]);
    }

    // For individual loading
    public function loadsubj(Request $request) { 
        $userinfo = Employee::where('emp_id', $request->emp_id)->first(); 
        if(!$userinfo){
            return redirect()->route('admin.loads')->with('msg', 'User not found...');
        }

        $subj = Subjects::where('subj_code', $request->id)
            ->orWhere('subj_id', $request->id)->first(); 

        $admin_dept = Employee::where('emp_id', Auth::user()->id)->first()->emp_dept;
        $admin_role = Auth::user()->role;
        $depts = Departments::orderBy('dept', 'asc')->get();

        if($subj) { 
            $loads = Loads::where('emp_id', $request->emp_id)->get();
            return view('manage-emps.loads.loads')->with([
                'userinfo' => $userinfo, 
                'loads' => $loads,
                'subj' => $subj,
                'depts' => $depts,
                'admin_role' => $admin_role,
                'admin_dept' => $admin_dept,
                'semesters' => tags::where('category', 'semester')->get() // Added semesters
            ]);
        }

        $loads = Loads::where('emp_id', $request->emp_id)->get();
        return view('manage-emps.loads.loads')->with([
            'userinfo' => $userinfo, 
            'loads' => $loads, 
            'msg' => 'Subject not found...',
            'semesters' => tags::where('category', 'semester')->get() // Added semesters
        ]);
    }

    public function store(Request $request) { 
        $uid = $request->id; 
        $subj_id = $request->subj_id; // Assuming 'subj_id' is the field used
        $sy_start = $request->sy_start;
        $sy_end = $request->sy_end;
        $semester = $request->sem;
        $class_code = $request->class_code;
        $class_dept = $request->class_dept;
        $depts = Departments::orderBy('dept', 'asc')->get();  
        $admin_dept = Employee::where('emp_id', Auth::user()->id)->first()->emp_dept;
        $admin_role = Auth::user()->role;
    
        // Validate inputs
        $request->validate([
            'sy_start' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'sy_end' => [
                'required',
                'digits:4',
                'integer',
                'min:1900',
                'max:' . (date('Y') + 10),
                function ($attribute, $value, $fail) use ($request) {
                    if (($value - $request->sy_start) !== 1) {
                        $fail('The school years must be consecutive (e.g., 2024-2025).');
                    }
                }
            ],
            'sem' => 'required|string',
            'class_code' => 'required|string|max:10',
            'class_dept' => 'required|string',
        ], [
            'sy_start.required' => 'Start year is required.',
            'sy_start.digits' => 'Start year must be 4 digits.',
            'sy_start.integer' => 'Start year must be a valid year.',
            'sy_start.min' => 'Start year must be at least 1900.',
            'sy_start.max' => 'Start year cannot exceed the current year.',
            'sy_end.required' => 'End year is required.',
            'sy_end.digits' => 'End year must be 4 digits.',
            'sy_end.integer' => 'End year must be a valid year.',
            'sy_end.different' => 'End year must be different from start year.',
            'sy_end.min' => 'End year must be at least 1900.',
            'sy_end.max' => 'End year cannot exceed '.(date('Y') + 10).'.',
            'sem.required' => 'Semester is required.',
            'class_code.required' => 'Class Code is required.',
            'class_code.max' => 'Class Code must not exceed 10 characters.',
            'class_dept.required' => 'Class Dept is required.',
        ]);
    
        $sy = $sy_start . '-' . $sy_end;
    
        // Check if the load already exists
        if(Loads::where('emp_id', $uid)
                ->where('subj_id', $subj_id)
                ->where('sy', $sy)
                ->where('semester', $semester)
                ->where('class_code', $class_code)
                ->where('class_dept', $class_dept)
                ->exists()) {
            $userinfo = Employee::where('emp_id', $uid)->first(); 
            $subject = Subjects::where('subj_id', $subj_id)->first(); 
    
            $loads = Loads::where('emp_id', $uid)->get();
    
            return view('manage-emps.loads.loads')->with([
                'userinfo' => $userinfo,
                'loads' => $loads,
                'msg' => "The selected unit/subject is already loaded for this teacher for the specified School Year, Semester, and Class Code. Please choose another one or review the current load.", 
                'subj' => $subject,
                'admin_dept' => $admin_dept,
                'admin_role' => $admin_role,
                'depts' => $depts,
                'semesters' => tags::where('category', 'semester')->get()
            ]);
        }
        
        // Create new load
        $newload = Loads::create([
            'emp_id' => $uid, 
            'subj_id' => $subj_id, 
            'sy' => $sy,
            'semester' => $semester,
            'class_code' => $class_code,
            'class_dept' => $class_dept,
            'added_by' => Auth::user()->id,
            'created_at' => now(), 
            'updated_at' => now()
        ]); 
    
        if($newload) { 
            $userinfo = Employee::where('emp_id', $uid)->first(); 
            $loads = Loads::where('emp_id', $uid)->get();
            $subject = Subjects::where('subj_id', $subj_id)->first();

            return view('manage-emps.loads.loads')->with([
                'userinfo' => $userinfo,
                'loads' => $loads,
                'msg' => 'Subject was successfully loaded to user.',
                'subj' => $subject,
                'depts'     => $depts, 
                'admin_dept' => $admin_dept,
                'admin_role' => $admin_role,
                'semesters' => tags::where('category', 'semester')->get()
            ]);
        }
    
        return redirect()->route('admin.loads')->with('msg', 'Failed to load the subject. Please try again.');
    }

    public function destroySearch(Request $request, $id)
    { 
        // Find the load by ID
        $load = Loads::find($id);  
        
        if ($load) {
            $emp_id = $load->emp_id;
            $load->delete(); 

            if ($request->input('redirect') === 'view') {
                return redirect()->route('admin.lbs.view', ['id' => $request->input('subj_id')])
                                ->with('msg', 'Subject/Unit was successfully removed from the user.');
            } else {
                return redirect()->route('admin.loads.user.search', ['id' => $emp_id])
                                ->with('msg', 'Subject/Unit was successfully removed from the user.');
            }
        }

        return redirect()->back()->with('msg', 'Load not found.');
    }

    public function destroy(Request $request, $id) { 
        $data = Loads::where('id', $id)->first();  
        if($data){
            $data->delete(); 
        }
        $loads = Loads::where('emp_id', $request->emp_id)->get();
        $user = Employee::where('emp_id', $request->emp_id)->first(); 

        return view('manage-emps.loads.loads')->with([
            'loads' => $loads, 
            'userinfo' => $user, 
            'msg' => 'Subject/Unit was removed from the user.',
            'semesters' => tags::where('category', 'semester')->get()
        ]);
    }

    // For batch loading
    public function load_subject(Request $request) { 
        $data = Subjects::where('subj_code', $request->subj_code)
            ->orWhere('subj_id', $request->subj_code)
            ->first(); 
        $admin_dept = Employee::where('emp_id', Auth::user()->id)->first()->emp_dept;
        $admin_role = Auth::user()->role;

        if ($data) { 
            return view('manage-emps.loads.batch')->with([
                'subj' => $data,
                'semesters' => tags::where('category', 'semester')->get(),
                'depts' => Departments::orderBy('dept', 'asc')->get(),
                'admin_dept' => $admin_dept,
                'admin_role' => $admin_role
            ]); 
        } 

        return view('manage-emps.loads.batch')->with([
            'subj' => null,
            'msg' => 'Subject not found..',
            'semesters' => tags::where('category', 'semester')->get(),
            'depts' => Departments::orderBy('dept', 'asc')->get(),
            'admin_dept' => $admin_dept,
            'admin_role' => $admin_role
        ]); 
    }

    public function load_add(Request $request) { 
        $subj = Subjects::where('subj_code', $request->id)->first(); 
        $sems = tags::where('category', 'semester')->get(); 

        $admin_dept = Employee::where('emp_id', Auth::user()->id)->first()->emp_dept;
        $admin_role = Auth::user()->role;
        $depts = Departments::orderBy('dept', 'asc')->get();

        return view('manage-emps.loads.batch')->with([
            'subj' => $subj, 
            'msg' => '', 
            'depts' => $depts,
            'admin_role' => $admin_role,
            'admin_dept' => $admin_dept,
            'semesters' => $sems 
        ]);
    }

    public function addToQueue(Request $request) { 
        $uid = $request->emp_id; 

        // Load the current subject
        $subj = Subjects::where('subj_code', $request->subj_code)->first(); 

        // Validate if the user exists
        if(!Employee::where('emp_id', $uid)->exists()) { 
            $queue = batch_queue::all();  
            return view('manage-emps.loads.batch')->with([
                'msg'=> 'User not found...', 
                'subj' => $subj, 
                'queue' => $queue,
                'semesters' => tags::where('category', 'semester')->get()
            ]);
        }

        // Check if the user is already in the queue
        if(batch_queue::where('emp_id', $uid)->exists()) { 
            $queue = batch_queue::all(); 
            return view('manage-emps.loads.batch')->with([
                'msg'=> 'User already in the list.', 
                'subj' => $subj, 
                'queue' => $queue,
                'semesters' => tags::where('category', 'semester')->get()
            ]);
        }

        batch_queue::create([
            'emp_id'=> $uid, 
            'updated_at'=> now(), 
            'created_at'=> now()
        ]); 

        $queue = batch_queue::all();

        return view('manage-emps.loads.batch')->with([
            'msg'=> '', 
            'subj' => $subj, 
            'queue' => $queue,
            'semesters' => tags::where('category', 'semester')->get()
        ]); 
    }

    public function removeQueue(Request $request) { 
        $data = batch_queue::where('emp_id', $request->id)->first(); 
        
        if($data){
            $data->delete(); 
        }
                   
        $subj = Subjects::where('subj_code', $request->subj_code)->first(); 
        $queue = batch_queue::all(); 

        return view('manage-emps.loads.batch')->with([
            'msg'=> '', 
            'subj' => $subj, 
            'queue' => $queue,
            'semesters' => tags::where('category', 'semester')->get()
        ]); 
    }

    public function batchUpload(Request $request) {
        // Create a validator for both school year/semester and queued users.
        $validator = Validator::make($request->all(), [
            'sy_start' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'sy_end' => [
                'required',
                'digits:4',
                'integer',
                'min:1900',
                'max:' . (date('Y') + 10),
                function ($attribute, $value, $fail) use ($request) {
                    if (isset($request->sy_start) && ($value - $request->sy_start) !== 1) {
                        $fail('The school years must be consecutive (e.g., '.$request->sy_start.'-'.($request->sy_start+1).').');
                    }
                }
            ],
            'sem' => 'required|string',
            'queued_users' => ['required', function ($attribute, $value, $fail) use ($request) {
                $queued = json_decode($value, true);
                if (!is_array($queued)) {
                    $fail('Queued users data is invalid.');
                } else {
                    // Only attempt to build the full school year if sy_start and sy_end are present.
                    $sy = isset($request->sy_start, $request->sy_end)
                        ? $request->sy_start . '-' . $request->sy_end
                        : '';
                    foreach ($queued as $index => $item) {
                        if (!isset($item['emp_id'], $item['subject_code'], $item['class_code'], $item['class_dept'])) {
                            $fail("Incomplete data for queued user at row " . ($index + 1) . ".");
                            continue;
                        }
                        $subject = Subjects::where('subj_code', $item['subject_code'])
                                    ->orWhere('subj_id', $item['subject_code'])
                                    ->first();
                        if (!$subject) {
                            $fail("Subject '{$item['subject_code']}' not found for employee '{$item['emp_id']}' at row " . ($index + 1) . ".");
                            continue;
                        }
                        $loadExists = Loads::where('emp_id', $item['emp_id'])
                            ->where('subj_id', $subject->subj_id)
                            ->where('class_code', $item['class_code'])
                            ->where('class_dept', $item['class_dept'])
                            ->where('sy', $sy)
                            ->where('semester', $request->sem)
                            ->exists();
                        if ($loadExists) {
                            $fail("Load for subject '{$item['subject_code']}' with class code '{$item['class_code']}' already exists for employee '{$item['emp_id']}' in school year '{$sy}' and semester '{$request->sem}'.");
                        }
                    }
                }
            }]
        ]);

        if ($validator->fails()) {
            // Redirect back with errors and with the old input so that user entries are preserved.
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $sy = $request->sy_start . '-' . $request->sy_end;
        $queuedUsers = json_decode($request->input('queued_users'), true);
    
        DB::beginTransaction();
        try {
            foreach ($queuedUsers as $item) {
                $subject = Subjects::where('subj_code', $item['subject_code'])
                            ->orWhere('subj_id', $item['subject_code'])
                            ->first();
    
                Loads::create([
                    'emp_id'      => $item['emp_id'],
                    'subj_id'     => $subject->subj_id,
                    'class_code'  => $item['class_code'],
                    'class_dept'  => $item['class_dept'],
                    'added_by'    => Auth::user()->id,
                    'sy'          => $sy,
                    'semester'    => $request->sem,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ]);
            }
    
            DB::commit();
            batch_queue::truncate();
            return redirect()->route('admin.loads.db')->with('msg','Batch upload successful.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Batch Upload Error: ' . $e->getMessage());
            return redirect()->back()->with('msg','Batch upload failed. Please try again.')->withInput();
        }
    }

    public function load_search(Request $request) { 
        if(!Employee::where('emp_id', $request->id )->exists()){ 
            $loads = Loads::latest()->where('added_by', Auth::user()->id)->take(10)->get();
            return view('manage-emps.loads.search')
                ->with([
                    'errormsg' => 'User not found..',
                    'loads' => $loads
                ]);
        }
        $uid = $request->id; 
        switch(Auth::user()->role) { 
            case 'SuperAdmin': 
                $result = Employee::where('emp_id', $uid)->first(); 
                break; 
            case 'HR Admin':
            case 'Dean':     
                $search_role = Employee_Login::where('id', $uid)->first()->role; 
                $loads = Loads::latest()->where('added_by', Auth::user()->id)->take(10)->get();
                if($search_role !== "Employee") { 
                    return view('manage-emps.loads.search')->with([
                        'errormsg'=> 'You do not have permission to view or modify this record.',
                        'loads' => $loads]);
                }
                $result = Employee::where('emp_id', $uid)->first(); 
                break;
        }
            
        $loads = Loads::where('emp_id', $uid)->get(); 
        return view('manage-emps.loads.search')->with([
            'userinfo'=> $result, 
            'loads'=> $loads,
            'semesters' => tags::where('category', 'semester')->get()
        ]);  
    }

    public function loadsBySubject() {
        $emp_dept = Auth::user()->user->emp_dept;
        $subjects = Subjects::with(['loads' => function($query) use ($emp_dept) {
            if (Auth::user()->role !== 'SuperAdmin' && Auth::user()->role !== 'HR Admin') {
                $query->whereHas('user', function($q) use ($emp_dept) { 
                    $q->where('emp_dept', $emp_dept); 
                });
            }
        }])->orderBy('subj_title', 'asc')->paginate(10);
    
        return view('manage-emps.loads.sub.main')->with([ 
            'subjects' => $subjects,
            'semesters' => tags::where('category', 'semester')->get()
        ]);
    }
}
