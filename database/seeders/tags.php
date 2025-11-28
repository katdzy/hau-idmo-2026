<?php

namespace Database\Seeders;

use App\Models\semconfig;
use Illuminate\Database\Seeder;
use App\Models\tags as tagmodel; 

class tags extends Seeder { 

   



    public function run(): void { 

        $gender = ['Male', 'Female'];
        $civil_status = ['Single', 'Married', 'Widowed', 'Separated'];
        $license_types = [
            'Professional Regulation Commission (PRC) License',
            'Civil Service Commission (CSC) Eligibility',
            'TESDA National Certificate',
            'Teaching License',
            'Board Exam Certifications',
            'Driver’s License',
            'Medical License',
            'Engineering License',
            'Legal Bar License',
            'Real Estate Broker License'
        ];
        $training_types = [
            'Professional Development',
            'Technical Skills',
            'Leadership and Management',
            'Research and Development',
            'Soft Skills',
            'Compliance Training',
            'Community Engagement',
            'Digital Literacy'
        ];

        $prc_exams = [
            'Aeronautical Engineer Licensure Examination',
            'Architects Licensure Examination',
            'Certified Public Accountant Examination',
            'Civil Engineers Licensure Examination',
            'Criminologists Licensure Examination',
            'Electronics Engineer Licensure Examination',
            'Guidance Counselors Licensure Examination',
            'L.E.P.T. - Elementary Level',
            'L.E.P.T. - Secondary Level',
            'Mechanical Engineers Licensure Examination',
            'Medical Technologists Licensure Examination',
            'Nurses Licensure Examination',
            'Psychologists Licensure Examination',
            'Psychometricians Licensure Examination',
            'Radiologic Technologists Licensure Examination',
            'Registered Electrical Engineers Licensure Examination'
        ];


        $emp_category = [
            'Faculty', 
            'NTP'
        ]; 

        $emp_status = [ 
            'Full-time', 
            'Part-time'
        ]; 

        $tenure = [ 
            'Permanent',
            'Probationary',
            'Non-tenured'
        ]; 

        $non_tenured = [ 
            'Fixed Term',
            'GL',
            'Contractual',
            'Substitution'
        ];


        $semesters = [ 
            '1ST SEMESTER', 
            '2ND SEMESTER', 
            '1ST TRIMESTER', 
            '2ND TRIMESTER', 
            '3RD TRIMESTER', 

        ]; 

        $roles = ['Employee', 'SuperAdmin', 'HR Admin', 'Dean', 'IDC Admin', 'IDC Document Handler'];

        foreach ($roles as $role) {
            tagmodel::create([
                'category' => 'roles',
                'item' => $role,
            ]);
        }


        //seeder for gender tags 
        foreach($gender as $item) { 
            tagmodel::create([ 
                'category'=> 'gender', 
                'item'=> $item
            ]); 
        }

        //seeder for civil status tags
        foreach($civil_status as $item){
            tagmodel::create([
                'category' => 'civil_status',
                'item' => $item
            ]);
        }

        //seeder for license types
        foreach($license_types as $item) { 
            tagmodel::create([ 
                'category'=> 'license_type', 
                'item'=> $item 
            ]); 
        }

        //seeder for training types
        foreach($training_types as $item) { 
            tagmodel::create([ 
                'category'=> 'training_type', 
                'item'=> $item 
            ]); 
        }

        foreach($emp_category as $item) { 
            tagmodel::create([ 
                'category'=> 'emp_category',
                'item'=> $item
            ]); 
        }

        foreach($emp_status as $item) { 
            tagmodel::create([ 
                'category'=> 'emp_status', 
                'item'=> $item
            ]); 
        }

        foreach($tenure as $item)  { 
            tagmodel::create([ 
                'category'=> 'tenure',
                'item'=> $item
            ]); 
        }

        foreach($non_tenured as $item) { 
            tagmodel::create([ 
                'category'=> 'non_tenured', 
                'item'=> $item
            ]);
        }


        foreach($semesters as $item) { 
            tagmodel::create([ 
                 'category'=> 'semester', 
                 'item'=> $item
            ]); 
        }

        foreach($prc_exams as $item){
            tagmodel::create([
                'category' => 'prc_exams',
                'item'=> $item
            ]);
        }



        semconfig::create([ 
            'category'=> 'reg',
            'current_sy'=> '2024-2025', 
            'current_sem'=> '1ST SEMESTER' 
        ]); 

        semconfig::create([ 
            'category'=> 'tri',
            'current_sy'=> '2024-2025', 
            'current_sem'=> '1ST TRIMESTER' 
        ]); 



    }
}

?> 