<?php

namespace App\Http\Controllers;

use App\Models\certifications;
use App\Models\HAUCert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class IssueCertController extends Controller
{
    /**
     * Generate a unique certification ID.
     *
     * @return string
     */
    protected function generate_cert_id() { 
        do {  
            $id = Auth::user()->id . 'cert' . Str::random(8);
        } while(certifications::where('id', $id)->exists()); 

        return $id; 
    }

    /**
     * Generate a unique HAU Certification ID.
     *
     * @return string
     */
    protected function generate_id() { 
        do { 
            $id = Auth::user()->id . 'haucert' . Str::random(8); 
        } while(HAUCert::where('id', $id)->exists()); 

        return $id; 
    }

    /**
     * Handle the creation of a new certification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create_certification(Request $request) { 
        $cert_id = $this->generate_id(); 

        // Validate the request data
        $request->validate([
            'date_issued' => 'required|date',
            'duration' => 'required|string|max:255',
            'cert_title' => 'required|string|max:255',
            'cert_validity' => 'required|date',
            'cert_type' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'issued_by' => 'required|string|max:255',
            'attachment' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // Added validation for attachment
        ]);

        // Define the storage path
        $filePath = 'hau_certs/'; 

        // Generate a unique file name
        $fileName = $cert_id . '.' . $request->file('attachment')->getClientOriginalExtension(); 

        // Store the file in the 'public' disk under 'hau_certs/' directory
        $request->file('attachment')->storeAs($filePath, $fileName, 'public');

        // Insert certification data into the HAUCert model
        HAUCert::create([
            'id' => $cert_id, 
            'attachment' => $request->file('attachment')->getClientOriginalName(),
            'date_issued' => $request->date_issued,
            'duration' => $request->duration,
            'cert_title' => $request->cert_title,
            'cert_validity' => $request->cert_validity,
            'cert_type' => $request->cert_type,
            'role' => $request->role,
            'file_path' => $filePath . $fileName,
            'issued_by' => $request->issued_by,
            'created_by'=> Auth::user()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.certs.load', ['id' => $cert_id])->with('success', 'Certification created successfully.');
    }

    /**
     * Load the certification issuance view.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function load_issue($id) { 
        $cert = HAUCert::findOrFail($id);
        return view('manage-emps.certs.send', [ 
            'data' => $cert
        ]); 
    }

    /**
     * Issue the certification to queued users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function issue_cert(Request $request, $id) {
        // Decode the JSON string into an array
        $queuedUsers = json_decode($request->input('queued_users'), true);

        // Retrieve the certification
        $cert = HAUCert::findOrFail($id); 

        // Iterate through the user IDs
        foreach ($queuedUsers as $empId) {
            $cert_id = $this->generate_cert_id(); 

            // Define the destination path for the user's certification
            $path = 'certifications/' . $empId;

            // Ensure the destination directory exists
            if (!Storage::disk('public')->exists($path)) {
                Storage::disk('public')->makeDirectory($path);
            }

            // Retrieve the source file path using Storage facade
            $sourcePath = Storage::disk('public')->path($cert->file_path);

            // Check if the source file exists
            if (!File::exists($sourcePath)) {
                throw new \Exception('Source file does not exist at ' . $sourcePath);
            }

            // Generate a new file name for the copied file
            $extension = pathinfo($cert->file_path, PATHINFO_EXTENSION);
            $newFileName = $cert_id . '.' . $extension; 

            // Define the destination file path
            $destinationPath = $path . '/' . $newFileName;

            // Define the full destination path using Storage facade
            $fullDestinationPath = Storage::disk('public')->path($destinationPath);

            // Copy the file to the new location
            File::copy($sourcePath, $fullDestinationPath);

            // Insert certification data into the certifications table
            certifications::create([
                'id' => $cert_id,
                'emp_id' => $empId,
                'attachment' => $newFileName,
                'date_issued' => $cert->date_issued,
                'file_path' => $destinationPath,
                'issued_by' => $cert->issued_by, 
                'duration' => $cert->duration,
                'cert_title' => $cert->cert_title,
                'cert_validity' => $cert->cert_validity,
                'cert_type' => $cert->cert_type,
                'hau_cert' => $id, 
                'role' => $cert->role,
                'status' => 'Approved',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Flash a success message to the session
        session()->flash('msg', 'Batch issue');

        return redirect()->route('admin.certs')->with('success', 'Certificates issued successfully.');
    }
}
