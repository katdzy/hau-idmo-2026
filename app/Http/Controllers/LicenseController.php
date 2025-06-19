<?php

namespace App\Http\Controllers;

use App\Models\Licenses;
use App\Models\requests;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PharIo\Manifest\License;

class LicenseController extends Controller
{

    protected function generateId(){ 

        do { 
            $id = Auth::user()->id . 'lcs' . Str::random(8); 


        } while(Licenses::where('id', $id)->exists()); 

        return $id; 

        
    }

    protected function generateRequest($id, $title) { 
        requests::insert([
            'id'=> $id, 
            'emp_id'=> Auth::user()->id, 
            'title'=> 'License - ' . $title,
            'type'=> 'License', 
            'date_submitted'=> Carbon::parse(now())->format('Y-m-d') 
        ]); 
    }

public function store(Request $request){ 


        $request->validate([ 
            'title'=> 'string', 
            'type'=> 'string', 
            'date_obtained'=> 'date', 
            'attachment'=> 'file|required'
        ]); 

        //generate a unique id 
        $id = $this->generateId(); 

        //check if directory for saving exists
        $path = 'licenses/' . Auth::user()->id; 
        If(!Storage::exists($path)) { 
            Storage::makeDirectory($path); 
        }


        //save the file 
        $filename = $id . '.'.  $request->file('attachment')-> getClientOriginalExtension(); 
        $request->file('attachment')-> storeAs($path, $filename, 'public');


        //insert to database
        Licenses::insert([ 
            'id'=> $id, 
            'emp_id'=> Auth::user()->id,
            'title'=> $request->title, 
            'type'=> $request->type, 
            'date_obtained'=> $request->date_obtained, 
            'attachment'=> $request->file('attachment')->getClientOriginalName(), 
            'status'=> 'Pending',
            'updated_at'=> now(), 
            'created_at'=> now()
        ]); 


        //generate the request for the pending request
        $this-> generateRequest($id, $request->title); 

        //return here
        return redirect()->route('portal.filing.success'); 
        


    }

    public function update($id, Request $request) { 
        $request->validate([
            'type'=> 'string', 
            'title'=> 'string', 
            'date_obtained'=> 'date', 
            'attachment'=> 'file'
        ]);

        $item = Licenses::findOrFail($id); 

        if ($item->status == 'Pending') {
            $req = requests::find($item->id);
            if ($req) {
                $req->delete();
            }
        }


        $path = 'licenses/' . Auth::user()->id; 
        if($request->file('attachment')){ 
            $filename = $id . '.'.  $request->file('attachment')-> getClientOriginalExtension(); 
            $request->file('attachment')->storeAs($path, $filename, 'public');
            $item->update([ 
                 'attachment'=> $request->file('attachment')->getClientOriginalName()
            ]);

        }
    
        $item->update([ 
            'title'=> $request->title,
            'type'=> $request->type, 
            'date_obtained'=> $request->date_obtained, 
            'status'=> "Pending"
        ]); 

        $item->save(); 

        //generate the request for the pending request
        $this-> generateRequest($id, $request->title); 

        return redirect()->route('portal.license')->with([ 
            'msg'=> 'License details was successfully sent for review'
        ]); 



    }

    public function destroy($id) { 
        $item = Licenses::findOrFail($id); 


        //if a pending request exist, it will automatically delete it 
        if(requests::where('id',$id)->exists()){ 
            requests::destroy([$id]);
        }

        $fn = $id . '.' . explode('.' , $item->attachment)[1]; 
        //delete the file 
        $fp = 'licenses/' . Auth::user()->id . '/' . $fn; 
        Storage::disk('public')->delete($fp);


        $item->delete(); 

        //return to route

        return redirect() ->route('portal.license')->with([ 
            'msg'=> 'License was successfully deleted.' 
        ]); 

    
    }
}