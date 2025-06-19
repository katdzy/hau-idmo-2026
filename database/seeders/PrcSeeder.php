<?php

namespace Database\Seeders;

use App\Models\PRC;
use App\Models\PrcTakers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PrcSeeder extends Seeder
{
    public function run(): void
    {
        PRC::insert([
            'id' => '1000',
            'title' => 'Civil Engineers Licensure Examination',
            'exam_date' => '2024-11-18',
        ]);

        PrcTakers::insert([
            'id' => '5999',
            'exam_id' => '1000',
            'school' => 'Holy Angel University',
            'first_pass' => 69,
            'first_fail' => 107,
            'first_cond' => 0,
            'repeat_pass' => 14,
            'repeat_fail' => 46,
            'repeat_cond' => 0
        ]);
    }
}