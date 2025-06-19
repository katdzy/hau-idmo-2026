<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Employee_Login;
use App\Models\HiringInfo;
use App\Models\provincial_contact;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Employee::insert([
            'emp_id' => 99999,
            'emp_fname' => 'Admin',
            'emp_mname' => '',
            'emp_lname' => 'Super',
            'emp_dept' => 'OIE', 
            'emp_gender' => 'Other',
            'emp_maiden_name' => '',
            'emp_dob' => now()->subYears(25)->toDateString(),
            'emp_pob' => 'Angeles City',
            'emp_cStatus' => 'Single',
            'emp_religion' => 'None',
            'emp_blood_type' => 'O+',
            'emp_houseno' => '1256',
            'street' => 'House Street',
            'brgy' => 'Brgy',
            'city' => 'City',
            'province' => 'Pampanga',
            'postal_code' => '2010',
            'profile_picture' => '',
           
            'info_status' => 'Active',
            'home_phone' => '09333',
            'mobile_phone' => '09333',
            'email_address_1' => 'idmo_oie@hau.edu.ph',
            'email_address_2' => null,
            

            'created_at' => now(),
            'updated_at' => now(),

        ]);

        Employee_Login::insert([
            'id' => 99999,
            'email' => 'idmo_oie@hau.edu.ph',
            'password' => Hash::make('superadminpass'),
            'role' => 'SuperAdmin',
            'terminated'=>null, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        provincial_contact::insert([ 
        'id'=> 99999, 
        'pc_emp_houseno' => '', 
        'pc_street' => '', 
        'pc_brgy' => '',  
        'pc_city' => 'Angeles City', 
        'pc_province' => 'Pampanga',  
        'pc_postal_code'=>'2010',
        'pc_phone'=> '09333',
        
        'created_at'=> now(), 
        'updated_at'=> now(), 
        ]); 


        DB::table('tbl_emergency')->insert([ 
            'emp_id'=> 99999, 
            'cp_fname'=> 'fname', 
            'cp_mname'=> 'mname', 
            'cp_lname'=> 'lname', 
            'cp_relationship'=> 'rel',
            'cp_house_no' => '',
            'cp_street'=> 'House Street', 
            'cp_city'=> ' City', 
            'cp_province'=>'Pampanga', 
            'cp_postal_code'=> '2010',
            'cp_home_phone'=> '09333', 
            'cp_mobile_no'=> '09333',
            'created_at'=> now(), 
            'updated_at' => now()
        ]); 


        DB::table('tbl_accounting_details')->insert([ 
            'emp_id' => 99999, 
            'sss_no' => '1234-5678-9021',
            'tax_no' => '1234-5678-9021', 
            'pagibig_no' => '1234-5678-9021',  
            'philhealth_no' => '1234-5678-9021', 
            'updated_at' => now(),
            'created_at'=> now()
        ]); 

        HiringInfo::create([ 
            'emp_id'=> 99999,
            'emp_position' => 'Faculty', 
            'emp_nature' => 'Full-time', 
            'emp_tenure' => 'Permanent',
            'license' => true,
        ]); 

    }
}












Employee::insert([
    'emp_id' => 01234,
    'emp_fname' => 'Employee',
    'emp_mname' => '',
    'emp_lname' => 'HAU',
    'emp_dept' => 'OIE', 
    'emp_gender' => 'Other',
    'emp_maiden_name' => '',
    'emp_dob' => now()->subYears(25)->toDateString(),
    'emp_pob' => 'Angeles City',
    'emp_cStatus' => 'Single',
    'emp_religion' => 'None',
    'emp_blood_type' => 'O+',
    'emp_houseno' => '1256',
    'street' => 'House Street',
    'brgy' => 'Brgy',
    'city' => 'City',
    'province' => 'Pampanga',
    'postal_code' => '2010',
    'profile_picture' => '',
   
    'info_status' => 'Active',
    'home_phone' => '09333',
    'mobile_phone' => '09333',
    'email_address_1' => 'employee@hau.edu.ph',
    'email_address_2' => null,
    

    'created_at' => now(),
    'updated_at' => now(),

]);

Employee_Login::insert([
    'id' => 01234,
    'email' => 'employee@hau.edu.ph',
    'password' => Hash::make('empass'),
    'role' => 'Employee',
    'terminated'=>null, 
    'created_at' => now(),
    'updated_at' => now(),
]);


provincial_contact::insert([ 
'id'=> 01234, 
'pc_emp_houseno' => '', 
'pc_street' => '', 
'pc_brgy' => '',  
'pc_city' => 'Angeles City', 
'pc_province' => 'Pampanga',  
'pc_postal_code'=>'2010',
'pc_phone'=> '09333',

'created_at'=> now(), 
'updated_at'=> now(), 
]); 


DB::table('tbl_emergency')->insert([ 
    'emp_id'=> 01234, 
    'cp_fname'=> 'fname', 
    'cp_mname'=> 'mname', 
    'cp_lname'=> 'lname', 
    'cp_relationship'=> 'rel',
    'cp_house_no' => '',
    'cp_street'=> 'House Street', 
    'cp_city'=> ' City', 
    'cp_province'=>'Pampanga', 
    'cp_postal_code'=> '2010',
    'cp_home_phone'=> '09333', 
    'cp_mobile_no'=> '09333',
    'created_at'=> now(), 
    'updated_at' => now()
]); 


DB::table('tbl_accounting_details')->insert([ 
    'emp_id' => 01234, 
    'sss_no' => '1234-5678-9021',
    'tax_no' => '1234-5678-9021', 
    'pagibig_no' => '1234-5678-9021',  
    'philhealth_no' => '1234-5678-9021', 
    'updated_at' => now(),
    'created_at'=> now()
]); 

HiringInfo::create([ 
    'emp_id'=> 01234,
    'emp_position' => 'Faculty', 
    'emp_nature' => 'Full-time', 
    'emp_tenure' => 'Permanent',
    'license' => true,
]); 


Employee::insert([
    'emp_id' => 12345,
    'emp_fname' => 'Dean',
    'emp_mname' => '',
    'emp_lname' => 'SOC',
    'emp_dept' => 'SOC', 
    'emp_gender' => 'Other',
    'emp_maiden_name' => '',
    'emp_dob' => now()->subYears(25)->toDateString(),
    'emp_pob' => 'Angeles City',
    'emp_cStatus' => 'Single',
    'emp_religion' => 'None',
    'emp_blood_type' => 'O+',
    'emp_houseno' => '1256',
    'street' => 'House Street',
    'brgy' => 'Brgy',
    'city' => 'City',
    'province' => 'Pampanga',
    'postal_code' => '2010',
    'profile_picture' => '',
   
    'info_status' => 'Active',
    'home_phone' => '09333',
    'mobile_phone' => '09333',
    'email_address_1' => 'socdean@hau.edu.ph',
    'email_address_2' => null,
    

    'created_at' => now(),
    'updated_at' => now(),

]);

Employee_Login::insert([
    'id' => 12345,
    'email' => 'socdean@hau.edu.ph',
    'password' => Hash::make('deanadminpass'),
    'role' => 'Dean',
    'terminated'=>null, 
    'created_at' => now(),
    'updated_at' => now(),
]);


provincial_contact::insert([ 
'id'=> 12345, 
'pc_emp_houseno' => '', 
'pc_street' => '', 
'pc_brgy' => '',  
'pc_city' => 'Angeles City', 
'pc_province' => 'Pampanga',  
'pc_postal_code'=>'2010',
'pc_phone'=> '09333',

'created_at'=> now(), 
'updated_at'=> now(), 
]); 


DB::table('tbl_emergency')->insert([ 
    'emp_id'=> 12345, 
    'cp_fname'=> 'fname', 
    'cp_mname'=> 'mname', 
    'cp_lname'=> 'lname', 
    'cp_relationship'=> 'rel',
    'cp_house_no' => '',
    'cp_street'=> 'House Street', 
    'cp_city'=> ' City', 
    'cp_province'=>'Pampanga', 
    'cp_postal_code'=> '2010',
    'cp_home_phone'=> '09333', 
    'cp_mobile_no'=> '09333',
    'created_at'=> now(), 
    'updated_at' => now()
]); 


DB::table('tbl_accounting_details')->insert([ 
    'emp_id' => 12345, 
    'sss_no' => '1234-5678-9021',
    'tax_no' => '1234-5678-9021', 
    'pagibig_no' => '1234-5678-9021',  
    'philhealth_no' => '1234-5678-9021', 
    'updated_at' => now(),
    'created_at'=> now()
]); 

HiringInfo::create([ 
    'emp_id'=> 12345,
    'emp_position' => 'Faculty', 
    'emp_nature' => 'Full-time', 
    'emp_tenure' => 'Permanent',
    'license' => true,
]); 

Employee::insert([
    'emp_id' => 23456,
    'emp_fname' => 'Admin',
    'emp_mname' => '',
    'emp_lname' => 'HR',
    'emp_dept' => 'HRO', 
    'emp_gender' => 'Other',
    'emp_maiden_name' => '',
    'emp_dob' => now()->subYears(25)->toDateString(),
    'emp_pob' => 'Angeles City',
    'emp_cStatus' => 'Single',
    'emp_religion' => 'None',
    'emp_blood_type' => 'O+',
    'emp_houseno' => '1256',
    'street' => 'House Street',
    'brgy' => 'Brgy',
    'city' => 'City',
    'province' => 'Pampanga',
    'postal_code' => '2010',
    'profile_picture' => '',
   
    'info_status' => 'Active',
    'home_phone' => '09333',
    'mobile_phone' => '09333',
    'email_address_1' => 'hradmin@hau.edu.ph',
    'email_address_2' => null,
    

    'created_at' => now(),
    'updated_at' => now(),

]);

Employee_Login::insert([
    'id' => 23456,
    'email' => 'hradmin@hau.edu.ph',
    'password' => Hash::make('hradminpass'),
    'role' => 'HR Admin',
    'terminated'=>null, 
    'created_at' => now(),
    'updated_at' => now(),
]);


provincial_contact::insert([ 
'id'=> 23456, 
'pc_emp_houseno' => '', 
'pc_street' => '', 
'pc_brgy' => '',  
'pc_city' => 'Angeles City', 
'pc_province' => 'Pampanga',  
'pc_postal_code'=>'2010',
'pc_phone'=> '09333',

'created_at'=> now(), 
'updated_at'=> now(), 
]); 


DB::table('tbl_emergency')->insert([ 
    'emp_id'=> 23456, 
    'cp_fname'=> 'fname', 
    'cp_mname'=> 'mname', 
    'cp_lname'=> 'lname', 
    'cp_relationship'=> 'rel',
    'cp_house_no' => '',
    'cp_street'=> 'House Street', 
    'cp_city'=> ' City', 
    'cp_province'=>'Pampanga', 
    'cp_postal_code'=> '2010',
    'cp_home_phone'=> '09333', 
    'cp_mobile_no'=> '09333',
    'created_at'=> now(), 
    'updated_at' => now()
]); 


DB::table('tbl_accounting_details')->insert([ 
    'emp_id' => 23456, 
    'sss_no' => '1234-5678-9021',
    'tax_no' => '1234-5678-9021', 
    'pagibig_no' => '1234-5678-9021',  
    'philhealth_no' => '1234-5678-9021', 
    'updated_at' => now(),
    'created_at'=> now()
]); 

HiringInfo::create([ 
    'emp_id'=> 23456,
    'emp_position' => 'Faculty', 
    'emp_nature' => 'Full-time', 
    'emp_tenure' => 'Permanent',
    'license' => true,
]); 
