<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employment;
use App\Models\requests;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Storage as AttributesStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 

class EmploymentController extends Controller
{

    protected function generate_id() { 
        do { 
            $gen = Auth::user()->id . Str::random(8); 
        } while(Employment::where('id', $gen)->exists()); 

        
        
        return $gen; 


    }


    public function update($id, Request $request) { 

        $request->validate([ 
            'company'=> 'string', 
            'position'=> 'string', 
            'date_hired'=> 'date', 
            'date_resigned'=> 'date|after_or_equal:data_hired', 
            'reason'=> 'string', 
        ],[
            'date_resigned.after_or_equal'  => 'The date resigned must be later than the date hired.',
        ]);


        $item = Employment::findOrFail($request->id); 

        if($item->status == 'Pending') {
            $req_ticket = requests::findOrFail($item->id);
            $req_ticket->delete();
        }

        $item->update([
            'company'=> $request->company, 
            'position'=> $request->position, 
            'date_hired'=> $request->date_hired, 
            'date_resigned'=> $request->date_resigned, 
            'reason'=> $request->reason,
            'status'=> 'Pending'
        ]);


        $item->save();

        $path = 'employment/' . Auth::user()-> id. '/';
    

        //if there is a file, update the file
        if($request->file('attachment'))  { 

            $item_extension = explode('.', $item->attachment)[1];
            Storage::disk('public')->delete($path . $item->id . '.'. $item_extension);
            $filename = $id . '.' . $request->file('attachment')-> getClientOriginalExtension();  
            $request->file('attachment')->storeAs($path , $filename, 'public'); 
            $item->attachment = $request->file('attachment')-> getClientOriginalName(); 
            $item->save ();
        }


        $approved=  Employment::where([
            'emp_id'=> Auth::user()->id, 
            'status'=> 'Approved' 
        ])->get();

        $pending=  Employment::where([
            'emp_id'=> Auth::user()->id, 
            'status'=> 'Pending' 
        ])->get();

        $toreview=  Employment::where([
            'emp_id'=> Auth::user()->id, 
            'status'=> 'To-review' 
        ])->get();

         // send a request to admin 
         DB::table('requests')->insert([
            'id'=> $request->id, 
            'emp_id'=> Auth::user()-> id, 
            'title'=> $request-> company . ' - ' . $request->position, 
            'type'=> 'Employment', 
            'date_submitted'=> now()
        ]);



        return redirect()->route('portal.employment')->with([
            'msg'=>'Record has been successfully sent for review', 
        ]); 
    }

    public function store( Request $request) { 
       
        $request->validate([
            'company'=> 'string', 
            'position'=> 'string', 
            'date_hired'=> 'date', 
            'date_resigned'=> 'date|after_or_equal:data_hired', 
            'reason'=> 'string',
            'attachment' => 'file'
        ],[
            'date_resigned.after_or_equal'  => 'The date resigned must be later than the date hired.',
        ]);

        $new_id = $this -> generate_id();



        //create the directory
        $path = 'employment/' . Auth::user()->id; 
        if(!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }

        //upload the file 
        $fileName = $new_id . '.' . $request->file('attachment')->getClientOriginalExtension(); 
        $request->file('attachment')-> storeAs($path, $fileName, 'public');



          ///insert to the employment tabl
          Employment::create([
            'id'=> $new_id, 
            'emp_id'=> Auth::user()-> id, 
            'company'=> $request->company, 
            'position'=> $request-> position,
            'date_hired'=> Carbon::parse($request-> date_hired)-> format('Y-m-d'),
            'date_resigned'=> Carbon::parse($request-> date_resigned)-> format('Y-m-d'),
            'position'=> $request-> position,
            'reason'=> $request-> reason, 
            'status'=> 'Pending', 
            'attachment'=>$request->file('attachment')-> getClientOriginalName(),
            'updated_at'=> now(), 
            'created_at'=> now()
        ]); 



        // send a request to admin 
        DB::table('requests')->insert([
            'id'=> $new_id, 
            'emp_id'=> Auth::user()-> id, 
            'title'=> $request-> company . ' - ' . $request->position, 
            'type'=> 'Employment', 
            'date_submitted'=> now()
        ]);



        return redirect()->route('portal.filing.success');


    }


    public function destroy($id) {
        $req = Employment::findOrFail($id);  


        // if pending, we need to delete the request ticket
        if($req->status == 'Pending') {
            $req_ticket = requests::findOrFail($id); 
            $req_ticket->delete(); //delete the request ticket 
        }



       
        //delete the file 
        $fn = $id . '.' . explode('.' , $req->attachment)[1]; 
        $fp = 'employment/' . Auth::user()->id . '/' . $fn; 
        Storage::disk('public')->delete($fp);

        $req->delete (); 


        return redirect()->route('portal.employment')->with([ 
            'msg'=> 'Record has been deleted.'
        ]); 
    }
}
