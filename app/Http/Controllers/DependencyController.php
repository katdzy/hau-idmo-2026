<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View; 

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str; 



//import models here
use App\Models\dependencies;
use App\Models\dependency_entries;
use App\Models\Employee;
use App\Models\requests; 

class DependencyController extends Controller
{



    protected function generateId() { 
        do { 
            $id = Auth::user()->id . 'ude' . Str::random(8); 
        } while(dependencies::where('id',$id)->exists()); 

        return $id;

    }



    //PAGE LOADERS


    //load the page
    public function loadDependencies(Request $request): View 
    { 

        $userId = Auth::user()->id; 
        $dependencies = dependencies::where(['emp_id'=> $userId]);
        $approved=  dependencies::where([
            'emp_id'=> $userId, 
            'status'=> 'Approved' 
        ])->get();

        $pending=  dependencies::where([
            'emp_id'=> $userId, 
            'status'=> 'Pending' 
        ])->get();

        $toreview=  dependencies::where([
            'emp_id'=> $userId, 
            'status'=> 'To-review' 
        ])->get();

        $user = Employee::where('emp_id', Auth::user()-> id) -> first();


        return view('portal.pages.dependencies.dependencies')-> with([
            'dependencies'=> $dependencies,
            'approved'=> $approved,
            'pending'=> $pending, 
            'toreview'=> $toreview, 
            'user'=> $user
        ]);
    }

    public function loadEdit(Request $request, $id): View { 

        $data = dependencies::where('id', $id)-> get()-> first(); 
       
        return view('portal.pages.dependencies.edit')->with('toedit', $data); 
    }


    public function loadAdd(Request $request): View 
     { 
        return view('portal.pages.dependencies.add'); 
     }




     //search and load the page
    public function searchDependency(Request $request) { 
        $search = $request->input('search');

        $userid = Auth::user()->id; 

        $dependencies_search = dependencies::query()
        ->where('emp_id', $userid)
        ->when($search, function($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('fname', 'like', "%{$search}%")
                      ->orWhere('mname', 'like', "%{$search}%")
                      ->orWhere('lname', 'like', "%{$search}%")
                      ->orWhere('relationship', 'like', "%{$search}%");
            });
        })
        ->get();
        // dd($dependencies_search);
        session(['dependencies'=>$dependencies_search]); 

        return view('portal.pages.dependencies.dependencies'); 
    }


    //add new dependent
    public function addDependent(Request $request) : RedirectResponse  
    {
        $userId = Auth::user()->id; 

        $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'relationship' => 'required|string|max:255',
            'date_of_birth' => ['required', 'date', 'before_or_equal:' . now()->toDateString()], // Prevents future dates
            'attachment' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Adjust allowed file types and size
        ], [
            'date_of_birth.before_or_equal' => 'The date of birth cannot be in the future.',
        ]);

    
        $generatedId = $this->generateId(); 

        $date_of_birth = Carbon::parse($request->date_of_birth)->format('Y-m-d');

        $now = now(); 

         //create the directory
        $path = 'dependents/' . Auth::user()->id; 
         if(!Storage::exists($path)) {
             Storage::makeDirectory($path);
         }
 
         //upload the file 
        $fileName = $generatedId . '.' . $request->file('attachment')->getClientOriginalExtension(); 
        $request->file('attachment')-> storeAs($path, $fileName, 'public');

        dependencies::create([
            'id'=> $generatedId, 
            'emp_id'=> $userId, 
            'fname' => $request -> fname, 
            'mname'=> $request -> mname,
            'lname'=> $request -> lname,
            'relationship'=>$request->relationship, 
            'date_of_birth'=> $date_of_birth,
            'status'=> 'Pending', 
            'attachment'=>$request->file('attachment')-> getClientOriginalName(),
        ]);

        // send a request to admin 
        DB::table('requests')->insert([
            'id'=> $generatedId, 
            'emp_id'=> Auth::user()-> id, 
            'title'=> $userId . ' - ' . $request->relationship, 
            'type'=> 'Dependent', 
            'date_submitted'=> now()
        ]);



        return redirect()->route('portal.dependencies') -> with('msg', 'Dependent was sent for approval.');
      
    }


    public function destroy($dep_id): RedirectResponse { 

      
        $dependency = dependencies::findOrFail($dep_id);

        // if pending, we need to delete the request ticket
        if($dependency->status == 'Pending') {
            $req_ticket = requests::findOrFail($dep_id); 
            $req_ticket->delete(); //delete the request ticket 
        }

        //delete the file 
        $fn = $dep_id . '.' . explode('.' , $dependency->attachment)[1]; 
        $fp = 'dependents/' . Auth::user()->id . '/' . $fn; 
        Storage::disk('public')->delete($fp);

        $dependency->delete();

        return redirect()-> route('portal.dependencies') -> with('msg', 'Dependent was deleted.');
    }

    public function clearAll() : RedirectResponse {

        $userId = Auth::user()->id; 

        DB::table('dependencies') -> where('emp_id', $userId)-> delete(); 
        DB::table('requests') -> where([
            'emp_id'=> $userId,
            'type' => 'Dependent'
            ])-> delete();
        $fp = 'dependents/' . Auth::user()->id; 
        Storage::disk('public')->delete($fp);

        return redirect()->route('portal.dependencies') -> with('msg', 'Dependents cleared.'); 
    }

    public function updateDependent(Request $request, $id): RedirectResponse 
    { 
        $userId = Auth::user()->id; 
        $date_of_birth = Carbon::parse($request->date_of_birth)->format('Y-m-d');

        $request-> merge([
            'date_of_birth'=> $date_of_birth,
            'updated_at'=> now()
        ]);

        $validateData= $request-> validate([
            'fname'=> 'string', 
            'mname'=> 'string|nullable', 
            'lname'=> 'string', 
            'relationship'=> 'string',
            'attachment' => 'file'
        ]);

        $data= dependencies::findOrFail($id); 

        if($data->status == 'Pending') {
            $req_ticket = requests::findOrFail($data->id);
            $req_ticket->delete();
        }

        $data-> update([
            'fname'=> $request-> fname, 
            'mname'=> $request-> mname, 
            'lname'=> $request-> lname, 
            'relationship'=> $request-> relationship,
            'date_of_birth'=> $date_of_birth,
            'status'=> 'Pending'
        ]); 
        
        $data->save();

        $path = 'dependents/' . Auth::user()-> id. '/';
    

        //if there is a file, update the file
        if($request->file('attachment'))  { 

            $item_extension = explode('.', $data->attachment)[1];
            Storage::disk('public')->delete($path . $data->id . '.'. $item_extension);
            $filename = $id . '.' . $request->file('attachment')-> getClientOriginalExtension();  
            $request->file('attachment')->storeAs($path , $filename, 'public'); 
            $data->attachment = $request->file('attachment')-> getClientOriginalName(); 
            $data->save ();
        }

        DB::table('requests')->insert([
            'id'=> $id, 
            'emp_id'=> $userId, 
            'title'=> $userId . ' - ' . $request->relationship, 
            'type'=> 'Dependent', 
            'date_submitted'=> now()
        ]);


        return redirect()-> route('portal.dependencies') -> with('msg', 'Data successfully sent for review.');
    }

    public function viewItem($id) { 
        $viewdata = dependencies::where('id', $id)->get()-> first();
        
        return view('portal.pages.dependencies.view')-> with('viewdata', $viewdata); 
    }


    
}