<?php

namespace Database\Seeders;

use App\Models\dependencies;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class depSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for($x = 0; $x < 12; $x++)  {
            dependencies::create([
                'id'=> '20421990-'. $x +  1,
                'emp_id'=> "20421990",
                'fname'=> 'User' . $x+1, 
                'mname'=> 'Salo',
                'lname'=> 'Bedania', 
                'date_of_birth'=> now()->subYears(22)->toDateString(),
                'relationship' => 'Child', 
            ]); 
        }

        
    }
}
