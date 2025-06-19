<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\requests;

use App\Models\certifications;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Carbon; 
use App\Models\certifications_entries;
use App\Models\Employee;
use Carbon\TranslatorStrongTypeInterface;
use Illuminate\Support\Str; 

class certificationController extends Controller
{   
    


    protected function updateRequest($id,$title) { 
        DB::table('requests')->where('id', $id)->update(['title' => $title]);
        return true;
    }
    //helper methods
    protected function createRequest($id, $emp, $date, $title, $type)
    {
        $send_request = DB::table('requests')->insert([
            'id' => $id,
            'emp_id' => $emp,
            'title' => $title,
            'type' => $type,
            'date_submitted' => $date
        ]);
        if ($send_request) {
            return true;
        }

        return false;
    }

    ///generate a submission ID 
    protected function generateID()
    {
        do{  
            $id = Auth::user()->id . 'cert' . Str::random(8);
        }while(certifications::where('id', $id)->exists()); 

        return $id; 
    }

    //CRUD functions 
    public function create()
    {

        $user= Employee::where('emp_id', Auth::user()-> id)->first (); 
        $data = certifications::where('emp_id', Auth::user()->id)->where('hau_cert',NULL)->orderBy('created_at', 'desc')->get();
        $approved = certifications::where('emp_id', Auth::user()->id)->where('status', 'Approved')->where('hau_cert',NULL)->orderBy('created_at', 'desc')->get(); 

        $pending = certifications::where('emp_id', Auth::user()->id)->where('status', 'Pending')->where('hau_cert',NULL)->orderBy('created_at', 'desc')->get(); 

        $toreview = certifications::where('emp_id', Auth::user()->id)->where('status', 'To-review')->where('hau_cert',NULL)->orderBy('created_at', 'desc')->get(); 

        return view('portal.pages.certifications.certs')->with([
            'items'=>$data,
            'approved'=>$approved, 
            'pending'=> $pending,
            'toreview'=> $toreview,
            'user'=> $user


        ]);
    }

    public function edit($id) { 
        $data= certifications::where('id', $id)-> get()-> first(); 
        return view('portal.pages.certifications.edit')-> with('data',$data); 
    }

    public function update(Request $request, $id) { 

        $date_issued = Carbon::parse($request->date_issued)-> format('Y-m-d'); 
        $validity = Carbon::parse($request-> cert_validity)-> format('Y-m-d'); 

        $request-> merge([ 
            'date_issued'=> $date_issued, 
            'cert_validity'=> $validity 
        ]);

        $validatedData = $request-> validate([ 
            'cert_title'=> 'string',
            'issued_by'=> 'string', 
            'duration'=> 'string', 
            'cert_type'=> 'string', 
            'role'=> 'string',
            'attachment'=> 'file'
        ]);
        
        $data = certifications::findOrFail($id); 

        // If current status is Pending, delete its request ticket
        if ($data->status == 'Pending') {
            $req = requests::find($data->id);
            if ($req) {
                $req->delete();
            }
        }

        $data->update([
            'cert_title' => $request->cert_title,
            'issued_by' => $request->issued_by,
            'duration' => $request->duration,
            'cert_type' => $request->cert_type,
            'role' => $request->role,
            'status' => 'Pending',
            'updated_at' => now(),
        ]);
        
        // Update attachment if a new file is uploaded
        $path = 'certifications/' . Auth::user()->id . '/';
        if($request->file('attachment'))  { 
            // Delete the old file using file_path
            Storage::disk('public')->delete($data->file_path);
            $newExtension = $request->file('attachment')->getClientOriginalExtension();
            $filename = $data->id . '.' . $newExtension;  
            $request->file('attachment')->storeAs($path, $filename, 'public'); 
            $data->attachment = $request->file('attachment')->getClientOriginalName(); 
            $data->file_path = $path . $filename;
            $data->save();
        }
        
        if(!isset($data->hau_cert)){
            $create_request = $this->createRequest($data->id, $data->emp_id, now(), $request->cert_title, 'Certification');
            return redirect()->route('portal.certifications')-> with(['msg'=> 'Certification successfully sent for review.']);
        } 
        else{
            $create_request = $this->createRequest($data->id, $data->emp_id, now(), $request->cert_title, 'HAU Certificate');
            return redirect()->route('portal.training')-> with(['msg'=> 'HAU Certificate successfully sent for review.']);
        }
    }

    public function store(Request $request)
    {


        $userId = Auth::user()->id;

        $now = now();
        $submission_id = $this->generateID();


        //set a path 
        $path = 'certifications/' . $userId;



        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }



        //generate a file name that will be save on the storage disk 
        $file_name = $submission_id . '.' . $request->file('attachment')->getClientOriginalExtension();
        $filePath = $request->file('attachment')->storeAs($path, $file_name, 'public');

        
        if ($filePath) {
            certifications::insert([
                'id' => $submission_id,
                'emp_id' => $userId,
                'attachment' => $request->file('attachment')->getClientOriginalName(),
                'date_issued' => $request->date_issued,
                'file_path' => $path . '/' . $file_name,
                'issued_by'=> $request-> issued_by, 
                'duration' => $request->duration,
                'cert_title' => $request->cert_title,
                'cert_validity' => $request->cert_validity,
                'cert_type' => $request->cert_type,
                'role' => $request->role,
                'status' => 'Pending',
                'created_at' => $now,
                'updated_at' => $now
            ]);

            

         
                $create_request = $this->createRequest($submission_id, $userId, $now, $request->cert_title, 'Certification');

                if ($create_request) {
        
                        return redirect()->route('portal.filing.success');
                   
                }
            
        }
    }

    public function destroy($id)
    {
        // Retrieve the certification by ID
        $cert = certifications::findOrFail($id);

        // Delete the file from storage to free up space
        Storage::disk('public')->delete($cert->file_path);

        // Delete the certification record
        $cert->delete();

        // Delete related request record if it exists
        if (requests::where('id', $id)->exists()) { 
            requests::destroy([$id]); 
        }

        // Check if 'hau_cert' has a value and redirect accordingly
        if ($cert->hau_cert) {
            return redirect()->route('portal.training')->with('msg', 'HAU Certificate was deleted.');
        } else {
            return redirect()->route('portal.certifications')->with('msg', 'Certification was deleted.');
        }
    }
    //page loader

    public function viewItem($id)
    {
        $data = certifications::where('id', $id)->get()->first();
        return view('portal.pages.certifications.view')->with('data', $data);
    }

}
