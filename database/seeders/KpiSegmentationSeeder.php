<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kpi;
use App\Models\KpiSegmentation;

class KpiSegmentationSeeder extends Seeder
{
    public function run(): void
    {
        // Define your segmentations grouped by KPI measure_code
        $segmentations = [
            'O1-M1' => [
                [
                    'segmentation' => 'STUDENT SATISFACTION RATE',
                    'code' => 'G1-M1',
                    'owner' => 'HAU',
                ],
                [
                    'segmentation' => 'Student satisfaction on Academic advising',
                    'code' => 'G1-M1.1',
                    'owner' => 'AAO; By department: SAS, SBA, SED, SEA, SHTM, SNAMS, SOC, CCJEF, BED; SSAC:	UGC, CPO',
                ],
                [
                    'segmentation' => 'Student satisfaction on Concern for individual',
                    'code' => 'G1-M1.2',
                    'owner' => 'AAO; By department: SAS, SBA, SED, SEA, SHTM, SNAMS, SOC, CCJEF, BED; SSAC',
                ],
                [
                    'segmentation' => 'Student satisfaction on Student centeredness',
                    'code' => 'G1-M1.3',
                    'owner' => 'AAO; By department: SAS, SBA, SED, SEA, SHTM, SNAMS, SOC, CCJEF, BED; SSAC; OIE',
                ],
                [
                    'segmentation' => 'Student satisfaction on Admission and selection',
                    'code' => 'G1-M1.4',
                    'owner' => 'RSS; ITEC',
                ],
                [
                    'segmentation' => 'Student satisfaction on Registration and enrollment effectiveness',
                    'code' => 'G1-M1.5',
                    'owner' => 'RSS; FRMS-ACO',
                ],
                [
                    'segmentation' => 'Student satisfaction on Value formation',
                    'code' => 'G1-M1.6',
                    'owner' => 'AAO; By department: SAS,SBA, SED, SEA, SHTM, SNAMS, SOC, CCJEF, BED; ICFSI',
                ],
                [
                    'segmentation' => 'Student satisfaction on Campus climate',
                    'code' => 'G1-M1.7',
                    'owner' => 'AAO; By department: SAS,SBA, SED, SEA, SHTM, SNAMS, SOC, CCJEF, BED',
                ],
                [
                    'segmentation' => 'Student satisfaction on Safety and security',
                    'code' => 'G1-M1.8',
                    'owner' => 'CSDO; ITSS',
                ],
                [
                    'segmentation' => 'Student satisfaction on Campus support services',
                    'code' => 'G1-M1.9',
                    'owner' => 'AAO; By department: SAS,SBA, SED, SEA, SHTM, SNAMS, SOC, CCJEF, BED; LIB; SSAC; FRMS',
                ],
                [
                    'segmentation' => 'Student satisfaction on Instructional effectiveness',
                    'code' => 'G1-M1.10',
                    'owner' => 'AAO; By department: SAS,SBA, SED, SEA, SHTM, SNAMS, SOC, CCJEF, BED',
                ],
                [
                    'segmentation' => 'Student satisfaction on Service excellence',
                    'code' => 'G1-M1.11',
                    'owner' => 'LIB; RSS; FRMS; SSAC',
                ],
                [
                    'segmentation' => 'Student satisfaction on Responsiveness to diverse population',
                    'code' => 'G1-M1.12',
                    'owner' => 'AAO; By department: SAS,SBA, SED, SEA, SHTM, SNAMS, SOC, CCJEF, BED; CSDO; SSAC',
                ],
                [
                    'segmentation' => 'Student satisfaction on Scholarship effectiveness',
                    'code' => 'G1-M1.13',
                    'owner' => 'SSAC-USGO',
                ],
            ],
            'O1-M2' => [
                [
                    'segmentation' => 'STUDENT CONTINUATION RATE',
                    'code' => 'G1-M2',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => 'Student Continuation Rate - College',
                    'code' => 'G1-M2.1',
                    'owner' => 'AAO; By department: SAS,SBA, SED, SEA, SHTM, SNAMS, SOC, CCJEF',
                ],
                [
                    'segmentation' => 'Student Continuation Rate - SHS',
                    'code' => 'G1-M2.2',
                    'owner' => 'AAO; BED by Track',
                ],
                [
                    'segmentation' => 'Student Continuation Rate - jHS',
                    'code' => 'G1-M2.3',
                    'owner' => 'AAO; BED',
                ],
            ],
            '-' => [
                [
                    'segmentation' => 'STUDENT CONTINUATION RATE',
                    'code' => 'G1-M2',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => 'Student Continuation Rate - College',
                    'code' => 'G1-M2.1',
                    'owner' => 'AAO; By department: SAS,SBA, SED, SEA, SHTM, SNAMS, SOC, CCJEF',
                ],
                [
                    'segmentation' => 'Student Continuation Rate - SHS',
                    'code' => 'G1-M2.2',
                    'owner' => 'AAO; BED by Track',
                ],
                [
                    'segmentation' => 'Student Continuation Rate - jHS',
                    'code' => 'G1-M2.3',
                    'owner' => 'AAO; BED',
                ],
            ],
            'G11-M1' => [
                [
                    'segmentation' => 'Employee Satisfaction Rate',
                    'code' => 'G11-M1',
                    'owner' => 'CG',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – AAC',
                    'code' => 'G11-M1.1',
                    'owner' => 'AAC, URO, LIB',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – SAS',
                    'code' => 'G11-M1.1.1',
                    'owner' => 'SAS',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – SBA',
                    'code' => 'G11-M1.1.2',
                    'owner' => 'SBA',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – SED',
                    'code' => 'G11-M1.1.3',
                    'owner' => 'SED',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – SEA',
                    'code' => 'G11-M1.1.4',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – SHTM',
                    'code' => 'G11-M1.1.5',
                    'owner' => 'SHTM',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – SNAMS',
                    'code' => 'G11-M1.1.6',
                    'owner' => 'SNAMS',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – SOC',
                    'code' => 'G11-M1.1.7',
                    'owner' => 'CSOC',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – CCJEF',
                    'code' => 'G11-M1.1.8',
                    'owner' => 'CCJEF',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – BED',
                    'code' => 'G11-M1.1.9',
                    'owner' => 'BED',
                ],
                [
                    'segmentation' => "Employee Satisfaction Rate – President's Cluster",
                    'code' => 'G11-M1.2',
                    'owner' => 'OP, OIA, OIE, CKS',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – FRMS',
                    'code' => 'G11-M1.3',
                    'owner' => 'FRMS',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – SSAC',
                    'code' => 'G11-M1.4',
                    'owner' => 'SSAC',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – CSDO',
                    'code' => 'G11-M1.5',
                    'owner' => 'CSDO',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – RSS',
                    'code' => 'G11-M1.6',
                    'owner' => 'RSS',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – HRMO',
                    'code' => 'G11-M1.7',
                    'owner' => 'HRMO',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – ITSS',
                    'code' => 'G11-M1.8',
                    'owner' => 'ITSS',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – MCS',
                    'code' => 'G11-M1.9',
                    'owner' => 'MCS',
                ],
                [
                    'segmentation' => 'Employee Satisfaction Rate – ICFSI',
                    'code' => 'G11-M1.10',
                    'owner' => 'ICFSI',
                ],
            ],
            'O2-M1' => [
                [
                    'segmentation' => 'Professional Licensure Examination Passing Rates',
                    'code' => 'G2-M1',
                    'owner' => 'AAC',
                    'target_level' => 'VERY GOOD',
                ],
                [
                    'segmentation' => 'Licensure passing % – GC - MA Guidance and Counselling',
                    'code' => 'G2-M1.1',
                    'owner' => 'SAS',
                    'target_level' => 'VERY GOOD',
                ],
                [
                    'segmentation' => 'Licensure passing % – PMET - BS Psychology',
                    'code' => 'G2-M1.2',
                    'owner' => 'SAS',
                    'target_level' => 'VERY GOOD',
                ],
                [
                    'segmentation' => 'Licensure passing % – PSYCH - MS Psychology',
                    'code' => 'G2-M1.3',
                    'owner' => 'SAS',
                    'target_level' => 'VERY GOOD',
                ],
                [
                    'segmentation' => 'Licensure passing % – CPA - Accountancy',
                    'code' => 'G2-M1.4',
                    'owner' => 'SBA',
                    'target_level' => 'VERY GOOD',
                ],
                [
                    'segmentation' => 'Licensure passing % – LET-ELEM - Teacher Education',
                    'code' => 'G2-M1.5',
                    'owner' => 'SED',
                    'target_level' => 'EXCELLENT',
                ],
                [
                    'segmentation' => 'Licensure passing % – LET-SEC - Teacher Education',
                    'code' => 'G2-M1.6',
                    'owner' => 'SED',
                    'target_level' => 'VERY GOOD',
                ],
                [
                    'segmentation' => 'Licensure passing % – AR - Architecture',
                    'code' => 'G2-M1.7',
                    'owner' => 'SEA',
                    'target_level' => 'VERY GOOD',
                ],
                [
                    'segmentation' => 'Licensure passing % – AE - Aeronautical Engineering',
                    'code' => 'G2-M1.8',
                    'owner' => 'SEA',
                    'target_level' => 'VERY GOOD',
                ],
                [
                    'segmentation' => 'Licensure passing % – CE - Civil Engineering',
                    'code' => 'G2-M1.9',
                    'owner' => 'SEA',
                    'target_level' => 'EXCELLENT',
                ],
                [
                    'segmentation' => 'Licensure passing % – EE - Electrical Engineering',
                    'code' => 'G2-M1.10',
                    'owner' => 'SEA',
                    'target_level' => 'VERY GOOD',
                ],
                [
                    'segmentation' => 'Licensure passing % – ECE - Electronics Engineering',
                    'code' => 'G2-M1.11',
                    'owner' => 'SEA',
                    'target_level' => 'VERY GOOD',
                ],
                [
                    'segmentation' => 'Licensure passing % – ME - Mechanical Engineering',
                    'code' => 'G2-M1.12',
                    'owner' => 'SEA',
                    'target_level' => 'VERY GOOD',
                ],
                [
                    'segmentation' => 'Licensure passing % – Nurses - Nursing',
                    'code' => 'G2-M1.13',
                    'owner' => 'SNAMS',
                    'target_level' => 'VERY GOOD',
                ],
                [
                    'segmentation' => 'Licensure passing % – MedTech - Medical Technology',
                    'code' => 'G2-M1.14',
                    'owner' => 'SNAMS',
                    'target_level' => 'VERY GOOD',
                ],
                [
                    'segmentation' => 'Licensure passing % – RadTech - Radiologic Technology',
                    'code' => 'G2-M1.15',
                    'owner' => 'SNAMS',
                    'target_level' => 'VERY GOOD',
                ],
                [
                    'segmentation' => 'Licensure passing % – CRIM - Criminology',
                    'code' => 'G2-M1.16',
                    'owner' => 'CCJEF',
                    'target_level' => 'VERY GOOD',
                ],
            ],
        ];

        // Loop through each KPI and insert its segmentations
        foreach ($segmentations as $measureCode => $segmentationList) {
            $kpi = Kpi::where('measure_code', $measureCode)->first();

            if ($kpi) {
                foreach ($segmentationList as $seg) {
                    KpiSegmentation::create([
                        'kpi_id' => $kpi->id,
                        'segmentation' => $seg['segmentation'],
                        'code' => $seg['code'],
                        'owner' => $seg['owner'],
                        'target_level' => $seg['target_level'] ?? null,
                    ]);
                }
            } else {
                echo "No KPI found for measure_code: $measureCode\n";
            }
        }
    }
}
