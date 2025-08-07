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
            'O2-M2' => [
                [
                    'segmentation' => 'Career Placement Rate',
                    'code' => 'G2-M2',
                    'owner' => 'CPO',
                ],
                [
                    'segmentation' => 'Career Placement % – AB Comm',
                    'code' => 'G2-M2.1',
                    'owner' => 'SAS',
                ],
                [
                    'segmentation' => 'Career Placement % – Psychology',
                    'code' => 'G2-M2.2',
                    'owner' => 'SAS',
                ],
                [
                    'segmentation' => 'Career Placement % – Accountancy',
                    'code' => 'G2-M2.3',
                    'owner' => 'SBA',
                ],
                [
                    'segmentation' => 'Career Placement % – BA',
                    'code' => 'G2-M2.4',
                    'owner' => 'SBA',
                ],
                [
                    'segmentation' => 'Career Placement % – Teacher Education',
                    'code' => 'G2-M2.5',
                    'owner' => 'SED',
                ],
                [
                    'segmentation' => 'Career Placement % – AR',
                    'code' => 'G2-M2.6',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => 'Career Placement % – AE',
                    'code' => 'G2-M2.7',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => 'Career Placement % – CE',
                    'code' => 'G2-M2.8',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => 'Career Placement % – CPE',
                    'code' => 'G2-M2.9',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => 'Career Placement % – EE',
                    'code' => 'G2-M2.10',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => 'Career Placement % – ECE',
                    'code' => 'G2-M2.11',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => 'Career Placement % – IE',
                    'code' => 'G2-M2.12',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => 'Career Placement % – ME',
                    'code' => 'G2-M2.13',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => 'Career Placement % – HRM',
                    'code' => 'G2-M2.14',
                    'owner' => 'SHTM',
                ],
                [
                    'segmentation' => 'Career Placement % – Tourism',
                    'code' => 'G2-M2.15',
                    'owner' => 'SHTM',
                ],
                [
                    'segmentation' => 'Career Placement % – Nursing',
                    'code' => 'G2-M2.16',
                    'owner' => 'SNAMS',
                ],
                [
                    'segmentation' => 'Career Placement % – MedTech',
                    'code' => 'G2-M2.17',
                    'owner' => 'SNAMS',
                ],
                [
                    'segmentation' => 'Career Placement % – RadTech',
                    'code' => 'G2-M2.18',
                    'owner' => 'SNAMS',
                ],
                [
                    'segmentation' => 'Career Placement % – IT',
                    'code' => 'G2-M2.19',
                    'owner' => 'SOC',
                ],
                [
                    'segmentation' => 'Career Placement % – CS',
                    'code' => 'G2-M2.20',
                    'owner' => 'SOC',
                ],
                [
                    'segmentation' => 'Career Placement % – Criminology',
                    'code' => 'G2-M2.21',
                    'owner' => 'CCJEF',
                ],
            ],
            'O3-M1' => [
                [
                    'segmentation' => 'NUMBER OF DEGREE PROGRAMS WITH LOCAL OR INTERNATIONAL ACCREDITATION',
                    'code' => 'G7-M1.1',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => '# locally accredited',
                    'code' => 'G7-M1.1',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => 'Number of degree programs accredited by PAASCU',
                    'code' => 'G7-M1.1.1',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => '# degree programs accredited by PAASCU - Candidate',
                    'code' => 'G7-M1.1.2',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => '# degree programs accredited by PAASCU - Level 1',
                    'code' => 'G7-M1.1.3',
                    'owner' => 'Customer and Stakeholder Perspective',
                ],
                [
                    'segmentation' => '# degree programs accredited by PAASCU - Level 2',
                    'code' => 'G7-M1.1.4',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => '# degree programs accredited by PAASCU - Level 3',
                    'code' => 'G7-M1.1.5',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => '# degree programs accredited by PAASCU - Level 4',
                    'code' => 'G7-M1.1.6',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => 'Number of degree programs accredited by PACUCOA',
                    'code' => 'G7-M1.1.7',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => '# degree programs accredited by PACUCOA - Candidate',
                    'code' => 'G7-M1.1.8',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => '# degree programs accredited by PACUCOA - Level 1',
                    'code' => 'G7-M1.1.9',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => '# degree programs accredited by PACUCOA - Level 2',
                    'code' => 'G7-M1.1.10',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => '# degree programs accredited by PACUCOA - Level 3',
                    'code' => 'G7-M1.1.11',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => '# internationally accredited',
                    'code' => 'G7-M1.2',
                    'owner' => 'AAC',
                ],
            ],
            'G3-M3' => [
                [
                    'segmentation' => 'Percentage of HAU HS Graduates in HAU College Programs',
                    'code' => 'G3-M3',
                    'owner' => 'MCS',
                ],
                [
                    'segmentation' => '%HS Graduates in College – SAS',
                    'code' => 'GE-M3.1',
                    'owner' => 'SAS',
                ],
                [
                    'segmentation' => '%HS Graduates in College – SBA',
                    'code' => 'GE-M3.2',
                    'owner' => 'SBA',
                ],
                [
                    'segmentation' => '%HS Graduates in College – SED',
                    'code' => 'GE-M3.3',
                    'owner' => 'SED',
                ],
                [
                    'segmentation' => '%HS Graduates in College – SEA',
                    'code' => 'GE-M3.4',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => '%HS Graduates in College – SHTM',
                    'code' => 'GE-M3.5',
                    'owner' => 'SHTM',
                ],
                [
                    'segmentation' => '%HS Graduates in College – SNAMS',
                    'code' => 'GE-M3.6',
                    'owner' => 'SNAMS',
                ],
                [
                    'segmentation' => '%HS Graduates in College – SOC',
                    'code' => 'GE-M3.7',
                    'owner' => 'SOC',
                ],
                [
                    'segmentation' => '%HS Graduates in College – CCJEF',
                    'code' => 'GE-M3.8',
                    'owner' => 'CCJEF',
                ],
            ],
            'G5-M1' => [
                [
                    'segmentation' => 'Number of industry partners for career placement and internships',
                    'code' => 'G5-M1',
                    'owner' => 'CPO',
                ],
                [
                    'segmentation' => 'Number of industry partners - SAS',
                    'code' => 'G5-M1.1',
                    'owner' => 'SAS',
                ],
                [
                    'segmentation' => 'Number of industry partners - SBA',
                    'code' => 'G5-M1.2',
                    'owner' => 'SBA',
                ],
                [
                    'segmentation' => 'Number of industry partners - SED',
                    'code' => 'G5-M1.3',
                    'owner' => 'SED',
                ],
                [
                    'segmentation' => 'Number of industry partners - SEA',
                    'code' => 'G5-M1.4',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => 'Number of industry partners - SHTM',
                    'code' => 'G5-M1.5',
                    'owner' => 'SHTM',
                ],
                [
                    'segmentation' => 'Number of industry partners - SNAMS',
                    'code' => 'G5-M1.6',
                    'owner' => 'SNAMS',
                ],
                [
                    'segmentation' => 'Number of industry partners - SOC',
                    'code' => 'G5-M1.7',
                    'owner' => 'SOC',
                ],
                [
                    'segmentation' => 'Number of industry partners - CCJEF',
                    'code' => 'G5-M1.8',
                    'owner' => 'CCJEF',
                ],
            ],
            'G4-M2' => [
                [
                    'segmentation' => 'Workforce Hours in Community Extension Engagement',
                    'code' => 'G4-M2',
                    'owner' => 'OCES, ALL',
                ],
                [
                    'segmentation' => 'Workforce Hours in Community Extension - SAS',
                    'code' => 'G4-M2.1',
                    'owner' => 'SAS',
                ],
                [
                    'segmentation' => 'Workforce Hours in Community Extension - SBA',
                    'code' => 'G4-M2.2',
                    'owner' => 'SBA',
                ],
                [
                    'segmentation' => 'Workforce Hours in Community Extension - SED',
                    'code' => 'G4-M2.3',
                    'owner' => 'SED',
                ],
                [
                    'segmentation' => 'Workforce Hours in Community Extension - SEA',
                    'code' => 'G4-M2.4',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => 'Workforce Hours in Community Extension - SHTM',
                    'code' => 'G4-M2.5',
                    'owner' => 'SHTM',
                ],
                [
                    'segmentation' => 'Workforce Hours in Community Extension - SNAMS',
                    'code' => 'G4-M2.6',
                    'owner' => 'SNAMS',
                ],
                [
                    'segmentation' => 'Workforce Hours in Community Extension - SOC',
                    'code' => 'G4-M2.7',
                    'owner' => 'SOC',
                ],
                [
                    'segmentation' => 'Workforce Hours in Community Extension - CCJEF',
                    'code' => 'G4-M2.8',
                    'owner' => 'CCJEF',
                ],
                [
                    'segmentation' => 'Workforce Hours in Community Extension - BED',
                    'code' => 'G4-M2.9',
                    'owner' => 'BED',
                ],
                [
                    'segmentation' => 'Workforce Hours in Community Extension - NTP',
                    'code' => 'G4-M2.10',
                    'owner' => 'FRMS, SSAC, CSDO, HRMO, RSS, MCS, ITSS, OIA, CKS',
                ],
                [
                    'segmentation' => 'Workforce Hours in Community Extension - OTHER UNITS',
                    'code' => 'G4-M2.11',
                    'owner' => 'CLE, LIB, URO',
                ],
            ],
            'G6-M1' => [
                [
                    'segmentation' => 'Composite Financial Index',
                    'code' => 'G6-M1',
                    'owner' => 'FRMS',
                    'goal' => '>10',
                ],
                [
                    'segmentation' => 'Cost per Student',
                    'code' => 'G6-M1.1',
                    'owner' => 'FRMS',
                    'goal' => '>=previous',
                ],
                [
                    'segmentation' => 'Primary Reserve Ratio',
                    'code' => 'G6-M1.2',
                    'owner' => 'FRMS',
                    'goal' => '>1.3',
                ],
                [
                    'segmentation' => 'Return on Net Assets Ratio',
                    'code' => 'G6-M1.3',
                    'owner' => 'FRMS',
                    'goal' => '>20%',
                ],
                [
                    'segmentation' => 'Net Operating Revenues Ratio',
                    'code' => 'G6-M1.4',
                    'owner' => 'FRMS',
                    'goal' => '>7%',
                ],
            ],
            'G1-M4' => [
                [
                    'segmentation' => 'ENROLLMENT YIELD',
                    'code' => 'G1-M4',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => 'Enrollment Yield - College Freshmen',
                    'code' => 'G1-M4.1',
                    'owner' => 'AAO; By department: SAS,SBA, SED, SEA, SHTM, SNAMS, SOC, CCJEF',
                ],
                [
                    'segmentation' => 'Enrollment Yield - SHS Grade 10',
                    'code' => 'G1-M4.2',
                    'owner' => 'AAO; BED by Track',
                ],
                [
                    'segmentation' => 'Enrollment Yield - JHS Grade 7',
                    'code' => 'G1-M4.3',
                    'owner' => 'AAO; BED',
                ],
            ],
            'G8-M6' => [
                [
                    'segmentation' => 'Incidence of Campus Crime',
                    'code' => 'G8-M6',
                    'owner' => 'CSDO',
                ],
                [
                    'segmentation' => 'Number of Violent Crimes',
                    'code' => 'G8-M6.1',
                    'owner' => 'CSDO',
                ],
                [
                    'segmentation' => 'Number of Arson/Attempted Arson',
                    'code' => 'G8-M6.2',
                    'owner' => 'CSDO',
                ],
                [
                    'segmentation' => 'Number of Burglary',
                    'code' => 'G8-M6.3',
                    'owner' => 'CSDO',
                ],
                [
                    'segmentation' => 'Number of Motor Vehicle Theft',
                    'code' => 'G8-M6.4',
                    'owner' => 'CSDO',
                ],
                [
                    'segmentation' => 'Number of Larceny/Theft',
                    'code' => 'G8-M6.5',
                    'owner' => 'CSDO',
                ],
            ],
            'G9-M2' => [
                [
                    'segmentation' => 'Usage of Library Electronic Resources',
                    'code' => 'G9-M2',
                    'owner' => 'LIB',
                ],
                [
                    'segmentation' => 'Usage of Library Electronic Resources - SAS',
                    'code' => 'G9-M2.1',
                    'owner' => 'SAS',
                ],
                [
                    'segmentation' => 'Usage of Library Electronic Resources - SBA',
                    'code' => 'G9-M2.2',
                    'owner' => 'SBA',
                ],
                [
                    'segmentation' => 'Usage of Library Electronic Resources - SED',
                    'code' => 'G9-M2.3',
                    'owner' => 'SED',
                ],
                [
                    'segmentation' => 'Usage of Library Electronic Resources - SEA',
                    'code' => 'G9-M2.4',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => 'Usage of Library Electronic Resources - SHTM',
                    'code' => 'G9-M2.5',
                    'owner' => 'SHTM',
                ],
                [
                    'segmentation' => 'Usage of Library Electronic Resources - SNAMS',
                    'code' => 'G9-M2.6',
                    'owner' => 'SNAMS',
                ],
                [
                    'segmentation' => 'Usage of Library Electronic Resources - SOC',
                    'code' => 'G9-M2.7',
                    'owner' => 'SOC',
                ],
            ],
            'G3-M1 (B)' => [
                [
                    'segmentation' => 'Student Participation Rate in Evaluation',
                    'code' => 'G3-M1(B)',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => 'Student Participation Rate in Evaluation - SAS',
                    'code' => 'G3-M1(B).1',
                    'owner' => 'SAS',
                ],
                [
                    'segmentation' => 'Student Participation Rate in Evaluation - SBA',
                    'code' => 'G3-M1(B).2',
                    'owner' => 'SBA',
                ],
                [
                    'segmentation' => 'Student Participation Rate in Evaluation - SED',
                    'code' => 'G3-M1(B).3',
                    'owner' => 'SED',
                ],
                [
                    'segmentation' => 'Student Participation Rate in Evaluation - SEA',
                    'code' => 'G3-M1(B).4',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => 'Student Participation Rate in Evaluation - SHTM',
                    'code' => 'G3-M1(B).5',
                    'owner' => 'SHTM',
                ],
                [
                    'segmentation' => 'Student Participation Rate in Evaluation - SNAMS',
                    'code' => 'G3-M1(B).6',
                    'owner' => 'SNAMS',
                ],
                [
                    'segmentation' => 'Student Participation Rate in Evaluation - SOC',
                    'code' => 'G3-M1(B).7',
                    'owner' => 'SOC',
                ],
                [
                    'segmentation' => 'Student Participation Rate in Evaluation - CCJEF',
                    'code' => 'G3-M1(B).8',
                    'owner' => 'CCJEF',
                ],
            ],
            'O12-M1' => [
                [
                    'segmentation' => 'Student Infractions',
                    'code' => 'G10-M1',
                    'owner' => 'SSAC',
                ],
                [
                    'segmentation' => 'Student Infractions - Major',
                    'code' => 'G10-M1.1',
                    'owner' => 'SSAC',
                ],
                [
                    'segmentation' => 'Student Infractions - Minor',
                    'code' => 'G10-M1.2',
                    'owner' => 'SSAC',
                ],
            ],
            'G10-M2' => [
                [
                    'segmentation' => 'Institutional Spirituality Score',
                    'code' => 'G10-M2',
                    'owner' => 'ICFSI',
                ],
                [
                    'segmentation' => 'Spirituality Audit Score - Employees',
                    'code' => 'G10-M2.1',
                    'owner' => 'ICFSI',
                ],
                [
                    'segmentation' => 'Spirituality Audit Score - Students',
                    'code' => 'G10-M2.2',
                    'owner' => 'ICFSI',
                ],
            ],
            'G11-M2' => [
                [
                    'segmentation' => 'Percentage of Faculty with Graduate Degrees',
                    'code' => 'G11-M2',
                    'owner' => 'AAC',
                ],
                [
                    'segmentation' => 'Percentage of Faculty with Graduate Degrees - SAS',
                    'code' => 'G11-M2.1',
                    'owner' => 'SAS',
                ],
                [
                    'segmentation' => 'Percentage of Faculty with Graduate Degrees - SBA',
                    'code' => 'G11-M2.2',
                    'owner' => 'SBA',
                ],
                [
                    'segmentation' => 'Percentage of Faculty with Graduate Degrees - SED',
                    'code' => 'G11-M2.3',
                    'owner' => 'SED',
                ],
                [
                    'segmentation' => 'Percentage of Faculty with Graduate Degrees - SEA',
                    'code' => 'G11-M2.4',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => 'Percentage of Faculty with Graduate Degrees - SHTM',
                    'code' => 'G11-M2.5',
                    'owner' => 'SHTM',
                ],
                [
                    'segmentation' => 'Percentage of Faculty with Graduate Degrees - SNAMS',
                    'code' => 'G11-M2.6',
                    'owner' => 'SNAMS',
                ],
                [
                    'segmentation' => 'Percentage of Faculty with Graduate Degrees - SOC',
                    'code' => 'G11-M2.7',
                    'owner' => 'CSOC',
                ],
                [
                    'segmentation' => 'Percentage of Faculty with Graduate Degrees - CCJEF',
                    'code' => 'G11-M2.8',
                    'owner' => 'CCJEF',
                ],
                [
                    'segmentation' => 'Percentage of Faculty with Graduate Degrees - BED',
                    'code' => 'G11-M2.9',
                    'owner' => 'BED',
                ],
                [
                    'segmentation' => 'Percentage of Faculty with Graduate Degrees - ICFSI',
                    'code' => 'G11-M2.10',
                    'owner' => 'ICFSI',
                ],
                [
                    'segmentation' => 'Percentage of NTP with Graduate Degrees',
                    'code' => 'G11-M2.11',
                    'owner' => 'NTP',
                ],
            ],
            'G12-M1' => [
                [
                    'segmentation' => 'Percentage of FT Faculty with Research or Creative Works',
                    'code' => 'G12-M1',
                    'owner' => 'AAC-URO',
                ],
                [
                    'segmentation' => '%Faculty Research Engagement - SAS',
                    'code' => 'G12-M1.1',
                    'owner' => 'SAS',
                ],
                [
                    'segmentation' => '%Faculty Research Engagement - SBA',
                    'code' => 'G12-M1.2',
                    'owner' => 'SBA',
                ],
                [
                    'segmentation' => '%Faculty Research Engagement - SED',
                    'code' => 'G12-M1.3',
                    'owner' => 'SED',
                ],
                [
                    'segmentation' => '%Faculty Research Engagement - SEA',
                    'code' => 'G12-M1.4',
                    'owner' => 'SEA',
                ],
                [
                    'segmentation' => '%Faculty Research Engagement - SHTM',
                    'code' => 'G12-M1.5',
                    'owner' => 'SHTM',
                ],
                [
                    'segmentation' => '%Faculty Research Engagement - SNAMS',
                    'code' => 'G12-M1.6',
                    'owner' => 'SNAMS',
                ],
                [
                    'segmentation' => '%Faculty Research Engagement - SOC',
                    'code' => 'G12-M1.7',
                    'owner' => 'SOC',
                ],
                [
                    'segmentation' => '%Faculty Research Engagement - CCJEF',
                    'code' => 'G12-M1.8',
                    'owner' => 'CCJEF',
                ],
                [
                    'segmentation' => 'Percentage of Faculty with Presentation',
                    'code' => 'G12-M1.9',
                    'owner' => 'URO',
                ],
                [
                    'segmentation' => 'Percentage of Faculty with Publication',
                    'code' => 'G12-M1.10',
                    'owner' => 'URO',
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
                        'goal' => $seg['goal'] ?? null,
                    ]);
                }
            } else {
                echo "No KPI found for measure_code: $measureCode\n";
            }
        }
    }
}
