<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Employee; 
use App\Models\provincial_contact;
use App\Models\acc_details;
use App\Models\emergency; 
use App\Models\dependencies; 

class PortalController extends Controller
{
    // Updating personal data 
    public function updatePersonal(Request $request, $id) { 
        $user = Employee::findOrFail($id);

        $validatedData = $request->validate([
            'emp_fname'     => 'required|string', 
            'emp_mname'     => 'nullable|string', 
            'emp_lname'     => 'required|string', 
            'emp_gender'    => 'required|string', 
            'emp_dob'       => 'nullable|date', 
            'emp_pob'       => 'nullable|string', 
            'emp_cStatus'   => 'nullable|string', 
            'emp_religion'  => 'nullable|string', 
            'emp_blood_type'=> 'nullable|string' 
        ]);

        // Optionally format the date if provided
        if (!empty($validatedData['emp_dob'])) {
            $validatedData['emp_dob'] = Carbon::parse($validatedData['emp_dob'])->format('Y-m-d');
        }

        // Update personal data
        $user->update($validatedData);

        return redirect()->route('portal.profile')
                         ->with('success', 'Personal data updated successfully.');
    }

    // Updating Contact Information
    public function updateContact(Request $request, $id) { 
        $request->merge([
            'updated_at'=> now() 
        ]); 

        $validateData = $request->validate([
            'emp_houseno'    => 'string', 
            'street'         => 'string',
            'brgy'           => 'string', 
            'city'           => 'string', 
            'province'       => 'string', 
            'postal_code'    => 'integer', 
            'home_phone'     => 'string', 
            'mobile_phone'   => 'string', 
            'email_address_1'=> 'string',
            'email_address_2'=> 'string'
        ]); 

        $data = Employee::findOrFail($id); 
        $data->update($validateData); 

        return redirect()->route('portal.profile')->with('success','Contact Information data updated successfully.'); 
    }
    
    // Updating Accounting
    public function updateAccounting(Request $request, $id) { 
        $request->validate([
            'sss_no'       => 'nullable|string', 
            'tax_no'       => 'nullable|string', 
            'pagibig_no'   => 'nullable|string', 
            'philhealth_no'=> 'nullable|string', 
        ]); 

        if (!acc_details::where('emp_id', Auth::user()->id)->exists()) { 
            acc_details::create([ 
                'emp_id'        => Auth::user()->id,
                'sss_no'        => $request->sss_no, 
                'tax_no'        => $request->tax_no, 
                'pagibig_no'    => $request->pagibig_no, 
                'philhealth_no' => $request->philhealth_no
            ]);
        } else { 
            $data = acc_details::findOrFail($id); 
            $data->update([ 
                'sss_no'        => $request->sss_no, 
                'tax_no'        => $request->tax_no, 
                'pagibig_no'    => $request->pagibig_no, 
                'philhealth_no' => $request->philhealth_no
            ]);   
        }

        return redirect()->route('portal.profile')->with('success', 'Accounting Details Information successfully updated.'); 
    }

    // Updating Provincial Contact
    public function updateProvincial(Request $request, $id) { 
        $request->validate([
            'pc_emp_houseno'=> 'nullable|string', 
            'pc_street'     => 'nullable|string', 
            'pc_brgy'       => 'nullable|string', 
            'pc_city'       => 'nullable|string', 
            'pc_province'   => 'nullable|string', 
            'pc_postal_code'=> 'nullable|string', 
            'pc_phone'      => 'nullable|string' 
        ]); 

        if (!provincial_contact::where('id', Auth::user()->id)->exists()) { 
            provincial_contact::create([ 
                'id'             => Auth::user()->id,
                'pc_emp_houseno' => $request->pc_emp_houseno, 
                'pc_street'      => $request->pc_street, 
                'pc_brgy'        => $request->pc_brgy, 
                'pc_city'        => $request->pc_city, 
                'pc_province'    => $request->pc_province, 
                'pc_postal_code' => $request->pc_postal_code, 
                'pc_phone'       => $request->pc_phone,
            ]);
        } else { 
            $data = provincial_contact::findOrFail($id); 
            $data->update([ 
                'pc_emp_houseno' => $request->pc_emp_houseno, 
                'pc_street'      => $request->pc_street, 
                'pc_brgy'        => $request->pc_brgy, 
                'pc_city'        => $request->pc_city, 
                'pc_province'    => $request->pc_province, 
                'pc_postal_code' => $request->pc_postal_code, 
                'pc_phone'       => $request->pc_phone,
            ]);   
        }

        return redirect()->route('portal.profile')->with('success', 'Provincial Contact Information successfully updated.'); 
    }

    // Updating Emergency Contact
    public function updateEmergency(Request $request, $id){ 
        $request->validate([
            'cp_fname'      => 'nullable|string', 
            'cp_mname'      => 'nullable|string', 
            'cp_lname'      => 'nullable|string', 
            'cp_relationship'=> 'nullable|string', 
            'cp_house_no'   => 'nullable|string', 
            'cp_street'     => 'nullable|string', 
            'cp_brgy'       => 'nullable|string', 
            'cp_city'       => 'nullable|string', 
            'cp_province'   => 'nullable|string', 
            'cp_postal_code'=> 'nullable|integer', 
            'cp_home_phone' => 'nullable|string', 
            'cp_mobile_no'  => 'nullable|string'
        ]);

        if (!emergency::where('emp_id', Auth::user()->id)->exists()) { 
            emergency::create([ 
                'emp_id'       => Auth::user()->id,
                'cp_fname'     => $request->cp_fname, 
                'cp_mname'     => $request->cp_mname, 
                'cp_lname'     => $request->cp_lname, 
                'cp_relationship'=> $request->cp_relationship, 
                'cp_house_no'  => $request->cp_house_no, 
                'cp_street'    => $request->cp_street, 
                'cp_brgy'      => $request->cp_brgy, 
                'cp_city'      => $request->cp_city, 
                'cp_province'  => $request->cp_province, 
                'cp_postal_code'=> $request->cp_postal_code, 
                'cp_home_phone'=> $request->cp_home_phone, 
                'cp_mobile_no' => $request->cp_mobile_no,
            ]);
        } else { 
            $data = emergency::findOrFail($id); 
            $data->update([ 
                'cp_fname'      => $request->cp_fname, 
                'cp_mname'      => $request->cp_mname, 
                'cp_lname'      => $request->cp_lname, 
                'cp_relationship'=> $request->cp_relationship, 
                'cp_house_no'   => $request->cp_house_no, 
                'cp_street'     => $request->cp_street, 
                'cp_brgy'       => $request->cp_brgy, 
                'cp_city'       => $request->cp_city, 
                'cp_province'   => $request->cp_province, 
                'cp_postal_code'=> $request->cp_postal_code, 
                'cp_home_phone' => $request->cp_home_phone, 
                'cp_mobile_no'  => $request->cp_mobile_no,
            ]);   
        }

        return redirect()->route('portal.profile')->with('success','Emergency Information successfully updated.'); 
    }

    public function searchDependency(Request $request) { 
        $search = $request->input('search');

        $dependencies_search = dependencies::query()
            ->when($search, function($query, $search) {
                return $query->where('fname', 'like', "%{$search}%")
                             ->orWhere('mname', 'like', "%{$search}%")
                             ->orWhere('lname', 'like', "%{$search}%")
                             ->orWhere('relationship','like',"%{$search}%"); 
            })
            ->get();

        session(['dependencies'=>$dependencies_search]); 

        return view('portal.pages.dependencies'); 
    }
}
