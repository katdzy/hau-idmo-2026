<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\orgs;
use App\Models\requests;
use Carbon\Carbon;

class OrgController extends Controller
{
    protected function generate_id() { 
        do { 
            $gen = Auth::user()->id . Str::random(8); 
        } while(orgs::where('id', $gen)->exists()); 
        return $gen; 
    }
    public function create() { 
        $uid = Auth::user()-> id; 
        $user = Employee::where('emp_id',$uid)-> get()-> first(); 
        $count = orgs::where('emp_id', $uid)->count();
        $approved=  orgs::where([
            'emp_id'=> Auth::user()->id, 
            'status'=> 'Approved' 
        ])->get();

        $pending=  orgs::where([
            'emp_id'=> Auth::user()->id, 
            'status'=> 'Pending' 
        ])->get();

        $toreview=  orgs::where([
            'emp_id'=> Auth::user()->id, 
            'status'=> 'To-review' 
        ])->get();

        return view('portal.pages.org.orgs')->with([
            'user'=> $user, 
            'approved'=> $approved,
            'pending'=> $pending,
            'toreview'=> $toreview,
            'count' => $count
        ]);
    }

    public function create_add(){
        $userinfo = Employee::where('emp_id', Auth::user()->id)->first();
        return view('portal.pages.org.add');  with(['user'=> $userinfo]);
    }

    public function create_edit($user, $id) {
        $data = orgs::where('id', $id)->first(); 

        return view('portal.pages.org.edit')-> with(['org'=>$data ]); 
        
    }

    public function store(Request $request) { 

    
        $data = $request->validate([
            'org'=> 'string',
            'position'=> 'string', 
            'date_joined'=> 'date|nullable',
            'attachment'=> 'file'
        ]); 

        $new_id = $this -> generate_id();

        //create the directory
        $path = 'orgs/' . Auth::user()->id; 
        if(!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }

        //upload the file 
        $fileName = $new_id . '.' . $request->file('attachment')->getClientOriginalExtension(); 
        $request->file('attachment')-> storeAs($path, $fileName, 'public');

        $insert = orgs::create([
            'id' => $new_id,
            'emp_id'=> Auth::user()-> id,  
            'org'=> $request-> org, 
            'position'=> $request->position, 
            'date_joined'=> Carbon::parse($request->date_joined)-> format('Y-m-d'),
            'added_by'=> Auth::user()-> id,
            'status'=> 'Pending',
            'attachment'=>$request->file('attachment')-> getClientOriginalName(),
            'updated_at'=> now(), 
            'created_at'=> now()
        ]); 

        // send a request to admin 
        DB::table('requests')->insert([
            'id'=> $new_id, 
            'emp_id'=> Auth::user()-> id, 
            'title'=> $request-> org . ' - ' . $request->position, 
            'type'=> 'Organization', 
            'date_submitted'=> now()
        ]);

        
        if(isset($insert)) { 
            return redirect()-> route('portal.filing.success');  
        }

        }


        public function destroy(Request $request)
        {
            $item = orgs::findOrFail($request->id);

            // If it is pending, remove the request ticket in 'requests'
            if($item->status == 'Pending') {
                $req_ticket = requests::findOrFail($item->id);
                $req_ticket->delete();
            }

            // Delete the file from storage
            $ext = pathinfo($item->attachment, PATHINFO_EXTENSION);
            $fp  = 'orgs/' . Auth::user()->id . '/' . $request->id . '.' . $ext;
            Storage::disk('public')->delete($fp);

            // Delete the db record
            $item->delete();

            return redirect()
                ->route('portal.org')
                ->with(['msg' => 'Data deleted.']);
        }

        public function update(Request $request, $id) { 

            $data = orgs::where('id', $id)->first(); 
        
            if($data->status == 'Pending') {
                $req_ticket = requests::findOrFail($data->id);
                $req_ticket->delete();
            }

            $update = $data->update([ 
                'org'=> $request->org, 
                'position'=> $request->position, 
                'date_joined'=> $request-> date_joined,
                'status'=> 'Pending', 
                'updated_at'=> now()
            ]); 

            $path = 'orgs/' . Auth::user()-> id. '/';

            //if there is a file, update the file
            if($request->file('attachment'))  { 
                $item_extension = explode('.', $data->attachment)[1];
                Storage::disk('public')->delete($path . $data->id . '.'. $item_extension);
                $filename = $id . '.' . $request->file('attachment')-> getClientOriginalExtension();  
                $request->file('attachment')->storeAs($path , $filename, 'public'); 
                $data->attachment = $request->file('attachment')-> getClientOriginalName(); 
                $data->save();
            }

            DB::table('requests')->insert([
                'id'=> $id, 
                'emp_id'=> Auth::user()-> id, 
                'title'=> $request-> org . ' - ' . $request->position, 
                'type'=> 'Organization', 
                'date_submitted'=> now()
            ]);
    
            if(isset($update)) { 
                return redirect()-> route('portal.org')-> with(['msg'=> 'Data successfully updated.']);
            }



            //else return to the edit page, with the same subj + error 

            

            

            

        }


     

        



}
