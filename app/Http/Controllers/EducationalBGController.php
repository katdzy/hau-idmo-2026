<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Education;
use App\Models\requests;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Storage as AttributesStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 

class EducationalBGController extends Controller
{

    protected function generate_id() { 
        do { 
            $gen = Auth::user()->id . Str::random(8); 
        } while(Education::where('id', $gen)->exists()); 

        
        
        return $gen; 


    }


    public function update($id, Request $request) { 

        $request->validate([
            'school_name'=> 'string',
            'start_date'=> 'date', 
            'end_date'=> 'date|after_or_equal:start_date',
            'education_type'=> 'string',
            'school_address'=> 'string',  
            'awards'=> 'string', 
            'grad_date'=> 'date',
            'last_sem'=> 'string',
            'so_num'=> 'string', 
            'level'=> 'string', 
            'degree'=> 'string',
            'attachment' => 'file'
        ],[
            'end_date.after_or_equal'  => 'The end date must be later than the start date.',
        ]);



        $item = Education::findOrFail($request->id); 

        if($item->status == 'Pending') {
            $req_ticket = requests::findOrFail($item->id);
            $req_ticket->delete();
        }

        $item->update([
            'school_name'=> $request->school_name, 
            'start_date'=> $request->start_date, 
            'end_date'=> $request->end_date,
            'education_type'=> $request->education_type, 
            'school_address'=> $request->school_address, 
            'awards'=> $request->awards,
            'grad_date'=> $request->grad_date,
            'last_sem'=> $request->last_sem,
            'so_num'=> $request->so_num,
            'level'=> $request->level,
            'degree'=> $request->degree,
            'status'=>'Pending'
        ]);


        $item->save();



     
        $path = 'edu-bg/' . Auth::user()-> id. '/';
    

        //if there is a file, update the file
        if($request->file('attachment'))  { 

            $item_extension = explode('.', $item->attachment)[1];
            Storage::disk('public')->delete($path . $item->id . '.'. $item_extension);
            $filename = $id . '.' . $request->file('attachment')-> getClientOriginalExtension();  
            $request->file('attachment')->storeAs($path , $filename, 'public'); 
            $item->attachment = $request->file('attachment')-> getClientOriginalName(); 
            $item->save ();
        }


        $approved=  Education::where([
            'emp_id'=> Auth::user()->id, 
            'status'=> 'Approved' 
        ])->get();

        $pending=  Education::where([
            'emp_id'=> Auth::user()->id, 
            'status'=> 'Pending' 
        ])->get();

        $toreview=  Education::where([
            'emp_id'=> Auth::user()->id, 
            'status'=> 'To-review' 
        ])->get();

        // send a request to admin 
        DB::table('requests')->insert([
            'id'=> $request-> id, 
            'emp_id'=> Auth::user()-> id, 
            'title'=> $request-> education_type . ' - ' . $request->degree, 
            'type'=> 'Education', 
            'date_submitted'=> now()
        ]);

        return redirect()->route('portal.edu-bg')->with([
            'msg'=>'Record has been successfully sent for review', 
        ]); 
    }

    public function store( Request $request) { 
       
        $request->validate([
            'school_name'=> 'string',
            'start_date'=> 'date', 
            'end_date'=> 'date|after_or_equal:start_date',
            'education_type'=> 'string',
            'school_address'=> 'string',  
            'awards'=> 'string', 
            'grad_date'=> 'date',
            'last_sem'=> 'string',
            'so_num'=> 'string', 
            'level'=> 'string', 
            'degree'=> 'string',
            'attachment' => 'file'
        ],[
            'end_date.after_or_equal'  => 'The end date must be later than the start date.',
        ]);

        $new_id = $this -> generate_id();



        //create the directory
        $path = 'edu-bg/' . Auth::user()->id; 
        if(!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }

        //upload the file 
        $fileName = $new_id . '.' . $request->file('attachment')->getClientOriginalExtension(); 
        $request->file('attachment')-> storeAs($path, $fileName, 'public');



          ///insert to the edu-bg tabl
          Education::create([
            'id'=> $new_id, 
            'emp_id'=> Auth::user()-> id, 
            'school_name'=> $request->school_name, 
            'start_date'=> Carbon::parse($request-> start_date)-> format('Y-m-d'),
            'end_date'=> Carbon::parse($request-> end_date)-> format('Y-m-d'),
            'education_type'=> $request-> education_type,
            'school_address'=> $request-> school_address,
            'awards'=> $request-> awards,
            'grad_date'=> Carbon::parse($request-> grad_date)-> format('Y-m-d'),
            'last_sem'=> $request-> last_sem,
            'so_num'=> $request-> so_num,
            'level'=> $request-> level,
            'degree'=> $request-> degree,
            'status'=> 'Pending', 
            'attachment'=>$request->file('attachment')-> getClientOriginalName(),
            'updated_at'=> now(), 
            'created_at'=> now()
        ]); 



        // send a request to admin 
        DB::table('requests')->insert([
            'id'=> $new_id, 
            'emp_id'=> Auth::user()-> id, 
            'title'=> $request-> education_type . ' - ' . $request->degree, 
            'type'=> 'Education', 
            'date_submitted'=> now()
        ]);



        return redirect()->route('portal.filing.success');


    }


    public function destroy($id) {
        $req = Education::findOrFail($id);  


        // if pending, we need to delete the request ticket
        if($req->status == 'Pending') {
            $req_ticket = requests::findOrFail($id); 
            $req_ticket->delete(); //delete the request ticket 
        }



       
        //delete the file 
        $fn = $id . '.' . explode('.' , $req->attachment)[1]; 
        $fp = 'edu-bg/' . Auth::user()->id . '/' . $fn; 
        Storage::disk('public')->delete($fp);

        $req->delete (); 


        return redirect()->route('portal.edu-bg')->with([ 
            'msg'=> 'Record has been deleted.'
        ]); 
    }
}
