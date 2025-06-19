<?php

namespace App\Http\Controllers;

use App\Models\requests;
use App\Models\Trainings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 

class TrainingsController extends Controller
{
    protected function generateId(){  
        do{  
            $id = Auth::user()->id . 'trn' . Str::Random(9); 
        } while (Trainings::where('id', $id)->exists());

        return $id; 
    }

    protected function generateRequest($id, $title) { 
        requests::insert([ 
            "id"=> $id, 
            'emp_id' => Auth::user()->id, 
            'title'=> $title, 
            'type'=> 'Training', 
            'date_submitted'=> now() 
            
        ]);
    }

    public function store(Request $request){ 
        $request ->validate([
            'title' => 'string', 
            'type' => 'string', 
            'organization'=> 'string', 
            'start_date'=> 'date', 
            'end_date'=> 'date|after_or_equal:start_date', 
            'certification_number'=> 'string', 
            'attachment'=> 'file|required'  
        ],[
            'end_date.after_or_equal'  => 'The end date must be later than the start date.',
        ]); 



        //generate an unique id
        $id = $this-> generateId();

        $path = 'trainings/' . Auth::user()-> id; 
        if(!Storage::exists($path)) { 
            Storage::makeDirectory($path); 
        }

        $filename = $id . '.' . $request->file('attachment')->getClientOriginalExtension();
        $request->file('attachment')->storeAs($path, $filename, 'public'); 

        Trainings::insert([
            'id'=> $id, 
            'emp_id'=> Auth::user()->id, 
            'title'=> $request->title, 
            'type'=> $request->type,
            'organization'=> $request->organization, 
            'start_date'=>Carbon::parse(
                $request->start_date,    
            ) ->format('Y-m-d'), 
            'end_date'=> Carbon::parse($request->expiration_date)->format('Y-m-d'),  
            'hours'=> $request->hours,
            'skills'=> $request->skills, 
            'attachment'=> $request->file('attachment')->getClientOriginalName(), 
            'status'=> 'Pending', 
            'updated_at'=> now(), 
            'created_at'=> now()
            
            ]);

        $this-> generateRequest($id, $request->title); 


        return redirect()-> route('portal.filing.success'); 
        
    }


    public function update($id, Request $req) { 

        $item = Trainings::findOrFail($id); 

        if ($item->status == 'Pending') {
            $request = requests::find($item->id);
            if ($request) {
                $request->delete();
            }
        }

        $req->validate([ 
            'title'=> 'string', 
            'type'=> 'string', 
            'organization'=> 'string', 
            'start_date'=> 'date', 
            'end_date'=> 'date|after_or_equal:start_date', 
            'hours'=> 'string' , 
            'attachment'=> 'file'     
        ],[
            'end_date.after_or_equal'  => 'The end date must be later than the start date.',
        ]);



        //if there is a file change 
        if($req->file('attachment')) { 
             $path = 'trainings/' . Auth::user()-> id; 
             $filename = $id . '.' . $req->file('attachment')-> getClientOriginalExtension(); 
             $req->file('attachment')-> storeAs($path, $filename, 'public'); 

             $item->update([
                'attachment'=> $req->file('attachment')->getClientOriginalName()
             ]); 
        }

        $item->update([
            'title'=> $req-> title, 
            'type'=> $req-> type, 
            'organization'=> $req->organization, 
            'start_date'=> $req-> start_date, 
            'end_date'=> $req->end_date, 
            'hours'=> $req-> hours,
            'status'=> 'Pending' 
        ]);

        $this-> generateRequest($id, $req->title); 

        return redirect()-> route('portal.training')-> with([
            'msg'=> 'Training successfully sent for review.'
        ]); 


    }


    public function destroy($id) { 
        if(requests::where('id', $id)-> exists()) { 
            $req= requests::destroy([$id]);
        }


        $item = Trainings::where('id', $id)->first(); 
        $fn = $id . '.' . explode('.' , $item->attachment)[1]; 
        //delete the file 
        $fp = 'trainings/' . Auth::user()->id . '/' . $fn; 
        Storage::disk('public')->delete($fp);


        Trainings::destroy([$id] ); 

        return redirect()->route('portal.training')-> with([ 
            'msg'=> "The record was successfully deleted."
        ]);
        
    }


    public function resubmit($id) { 
        $item = Trainings::findOrFail($id); 
        $item->update([ 
            'status'=> 'Pending'
        ]);
        
        return redirect()-> route('portal.training')->with([ 
            'msg'=> 'The record has been successfully resubmitted and is now back in the pending requests. Thank you for your attention to this matter.'
        ]);
    }


}
