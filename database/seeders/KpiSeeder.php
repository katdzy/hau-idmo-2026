<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kpi;

class KpiSeeder extends Seeder
{
    public function run(): void
    {
        Kpi::create([
            'measure_code' => 'O1-M1',
            'measure_owner' => 'CG',
            'measure_name' => 'STUDENT SATISFACTION RATE',
            'description' => 'Student satisfaction rate is the percentage of ⁠average student satisfaction scores based on a 7-point scale and 13 dimensions on: Academic advising; Concern for individual; Student centeredness; Admission and selection effectiveness; Registration and enrollment effectiveness; Values formation; Campus climate; Safety and security; Campus support services; Instructional effectiveness; Service excellence; Responsiveness to diverse population; and Scholarship effectiveness',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'Total mean score divided by 7 for all 13 dimensions;
                            dimension score: D1(13) = SUM score / n ; n =number of respondents
                            satisfaction rate: SSR = [(D1 + D2 + D3 + ... + D13 ) /13] / 7 X100%',
            'unit_type' => '%',
            'polarity' => '>',
            'data_provider' => 'OIE',
            'data_source' => 'STUDENT SATISFACTION SURVEY (SSS)',
            'collection_frequency' => 'ANNUAL',
            'reporting_frequency' => 'ANNUAL',
            'verified_by' => 'Internal Auditor',
            'validated_by' => 'IPRPO HEAD',
            'baseline' => '2022: 85%',
            'target' => '>=85%',
            'threshold_low' => '85',
            'threshold_high' => '88',
            'target_rationale' => 'Achieving student satisfaction is critical to enrollment and	retention strategy.	We are targeting results which are higher in previous years.',

            // Strategy Info
            'perspective' => 'CUSTOMER & STAKEHOLDER',
            'strategic_theme' => 'ACADEMIC QUALITY	& ORGANIZATIONAL RESILIENCY',
            'objective' => 'O1: IMPROVE CUSTOMER & STAKEHOLDER SATISFACTION',
            'objective_owner' => 'CG',
            'intended_results' => 'HAU becomes known for its memorable student and stakeholder experience and increased satisfaction through the effective teaching and learning strategies, rendered by motivated employees.',
            'strategic_initiatives' => '- Memorable Student Experience
                                        - Effective teaching & learning program
                                        - Digital Satisfaction & engagement surveys',

            // Comparator & Meta
           'comparator' => 'The external comparator comprises of the scores for four-year private HEIs in the United States on similar scales of the Noel-Levitz Student Satisfaction Survey.',
           'item_author' => 'ANNE MARIE MANGILIMAN',
            'date' => '04-Mar-21',
        ]);

        Kpi::create([
            'measure_code' => 'O1-M2',
            'measure_owner' => 'AAC, RSS',
            'measure_name' => 'STUDENT RETENTION RATE',
            'description' => 'Opposite of attrition rate; measures the percentage of students who return to the same institution the following term (second semester to first semester)s',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'calculated by dividing the number of currently enrolled students by the number of expected students (students enrolled in the previous term less the number of graduates/completers)',
            'unit_type' => '%',
            'polarity' => '>',
            'data_provider' => 'RSS',
            'data_source' => 'REGISTRAR RETENTION REPORT',
            'collection_frequency' => 'SEMI-ANNUAL',
            'reporting_frequency' => 'SEMI-ANNUAL',
            'verified_by' => 'REGISTRAR',
            'validated_by' => 'VP AA',
            'baseline' => '2022: 96%',
            'target' => '>=98.5% (Year 5)',
            'threshold_low' => '96',
            'threshold_high' => '98',
            'target_rationale' => '',

            // Strategy Info
            'perspective' => 'STUDENT & STAKEHOLDER',
            'strategy' => 'ACADEMIC QUALITY	& ORGANIZATIONAL EXCELLENCE',
            'goal_code' => 'G1',
            'goal' => 'IMPROVE STUDENT PROGRESSION AND SATISFACTION',
            'goal_owner' => 'AAC; SSAC; RSS; CSDO; ICFSI; SSAC; FRMS; OIE',
            'intended_results' => 'IMPROVEMENT OF STUDENT DEVELOPMENT EXPERIENCE. More students enroll and are satisfied.',
            'strategic_initiatives' => '',
    
            // Comparator & Meta
           'comparator' => 'US National Center for Education Statistics (NCES) for full-time students in four-year private nonprofit institutions, limited to one year lag of published data',
           'item_author' => 'ANNE MARIE MANGILIMAN',
            'date' => '',
        ]);

        Kpi::create([
            'measure_code' => '-',
            'measure_owner' => 'AAC, RSS',
            'measure_name' => 'STUDENT CONTINUATION RATE',
            'description' => 'Percent of students enrolling in consecutive terms; measures the percentage of undergraduate students who return to the same institution the following term (first semester to second semester)',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'calculated by dividing the number of currently enrolled students by the number of expected students (students enrolled in previous term less Goal Owner the number of graduates/completers)',
            'unit_type' => '%',
            'polarity' => '>',
            'data_provider' => 'RSS',
            'data_source' => 'REGISTRAR RETENTION REPORT',
            'collection_frequency' => 'SEMI-ANNUAL',
            'reporting_frequency' => 'SEMI-ANNUAL',
            'verified_by' => 'REGISTRAR',
            'validated_by' => 'VP AA',
            'baseline' => '',
            'target' => '>=98%',
            'threshold_low' => '93',
            'threshold_high' => '98',
            'target_rationale' => '',

            // Strategy Info
            'perspective' => 'STUDENT & STAKEHOLDER',
            'strategy' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'goal_code' => 'G1',
            'goal' => 'IMPROVE STUDENT PROGRESSION AND SATISFACTION',
            'goal_owner' => 'AAC; SSAC; RSS; CSDO; ICFSI; SSAC; FRMS; OIE',
            'intended_results' => 'IMPROVEMENT OF STUDENT DEVELOPMENT EXPERIENCE. More students enroll and are satisfied.',
            'strategic_initiatives' => '',

            // Comparator & Meta
           'comparator' => 'US National Center for Education Statistics (NCES) for full-time students in four-year private nonprofit institutions, limited to one year lag of published data',
           'item_author' => 'ANNE MARIE MANGILIMAN',
            'date' => '',
        ]);

        Kpi::create([
            'measure_code' => 'G11-M1',
            'measure_owner' => 'OIE',
            'measure_name' => 'EMPLOYEE SATISFACTION RATE',
            'description' => 'Indicator of workforce engagement and satisfaction, based on dimensions in the Great Colleges to Work For Survey of the Chronicle of Higher Education by ModernThink, segmented by department',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'average score ratings on 15 dimensions (JOB SATISFACTION/SUPPORT; TEACHING ENVIRONMENT; PROFESSIONAL DEVELOPMENT; COMPENSATION, BENEFITS & WORK/LIFE BALANCE; FACILITIES; POLICIES, RESOURCES & EFFICIENCY; SHARED GOVERNANCE; PRIDE; SUPERVISORS/ DEPARTMENT CHAIRS; SENIOR LEADERSHIP; FACULTY,; ADMINISTRATION & STAFF RELATIONS; COMMUNICATION; COLLABORATION; FAIRNESS; RESPECT & APPRECIATION; HOLY ANGEL CUSTOM STATEMENTS)',
            'unit_type' => '%',
            'polarity' => '>',
            'data_provider' => 'OIE',
            'data_source' => 'MODERNTHINK SURVEY RESULT',
            'collection_frequency' => 'ANNUAL',
            'reporting_frequency' => 'ANNUAL',
            'verified_by' => 'QA DIRECTOR',
            'validated_by' => 'OIE',
            'baseline' => '2022: 87%',
            'target' => '>=87 or ≥ USA Honor roll',
            'threshold_low' => '75',
            'threshold_high' => '',
            'target_rationale' => 'HAU aims to have engaged employees as reflected by having a percent positive result in the category of Very Good to Excellent (75%+) and to be at par with US colleges and universities included in the roster of Great University to Work For',

            // Strategy Info
            'perspective' => 'CUSTOMER & STAKEHOLDER',
            'strategic_theme' => 'ACADEMIC QUALITY	& ORGANIZATIONAL RESILIENCY',
            'objective' => 'O1: IMPROVE CUSTOMER & STAKEHOLDER SATISFACTION',
            'objective_owner' => 'CG',
            'intended_results' => 'HAU becomes known for its memorable student and stakeholder experience and increased satisfaction through the effective teaching and learning strategies, rendered by motivated employees.',
            'strategic_initiatives' => '• Employee Engagement & Welfare
                                        • Satisfaction & engagement surveys',

            // Comparator & Meta
           'comparator' => 'USA comparable Catholics Schools and HEIs on the Honor Roll of the US Great University to Work For.',
        ]);

        Kpi::create([
            'measure_code' => 'O2-M1',
            'measure_owner' => 'AAC',
            'measure_name' => 'PROFESSIONAL LICENSURE EXAMINATION PASSING RATES',
            'description' => 'graduates\' passing performance in licensure examinations',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'number of passers over total number of
                          examinees in 16 HAU Board programs of SAS,
                          SBA, SED, SEA, SNAMS, & CCJEF',
            'unit_type' => '%',
            'polarity' => '>',
            'data_provider' => 'OIE',
            'data_source' => 'PRC BOARD EXAM RESULT - PERFORMANCE OF SCHOOLS',
            'collection_frequency' => 'MONTHLY',
            'reporting_frequency' => 'QUARTERLY',
            'verified_by' => 'IPRPO',
            'validated_by' => 'OIE',
            'baseline' => '2016: 62.7% 2017: 64.2% 2018: 64.7% 2019: 60.9% 2020: _%',
            'target' => '>=75%',
            'threshold_low' => 'NAT\'L PASSING',
            'threshold_high' => '75',
            'target_rationale' => 'We assert that HAU\'s levels are GOOD if they are above national average and approaching the national top quartile or 75th percentile, VERY GOOD if they meet or exceed the national top quartile (75th), POTENTIAL BENCHMARK LEVELS if they are above the 75th percentile and approaching the 90th percentile, and EXCELLENT if they exceed the top decile or 90th percentile.',

            // Strategy Info
            'perspective' => 'STUDENT & STAKEHOLDER',
            'strategy' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'goal_code' => 'G2',
            'goal' => 'ENHANCE GRADUATES\' COMPETITIVENESS',
            'goal_owner' => 'AAC, CPO',
            'intended_results' => 'ACHIEVEMENT OF GRADUATE ATTRIBUTES . Better performance in licensure examination, career placement, and employer satisfaction.',
            'strategic_initiatives' => 'SI1: STUDENT SERVICES BOARD REVIEW, MOCK BOARD',

            // Comparator & Meta
           'comparator' => 'HAU\'s peer institutions include other schools offering the same program',
           'item_author' => 'ANNE MARIE MANGILIMAN',
            'date' => 'MAR. 25, 2021',
        ]);

        Kpi::create([
            'measure_code' => 'O2-M2',
            'measure_owner' => 'CPO',
            'measure_name' => ' CAREER PLACEMENT RATE',
            'description' => 'Percentage of graduates employed/self-employed in 3/6/12 months after graduation/passing of board examination',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'number of employed in 3/6/12 months over total number of graduates in a batch',
            'unit_type' => '%',
            'polarity' => '>',
            'data_provider' => 'CPO, COLLEGE LINKAGE UNITS',
            'data_source' => 'TRACER STUDIES',
            'collection_frequency' => 'SEMI-ANNUAL',
            'reporting_frequency' => 'SEMI-ANNUAL',
            'verified_by' => 'CPO',
            'validated_by' => 'CPO',
            'baseline' => '2016: __% 2017: _% 2018: _% 2019:_% 2020: _%',
            'target' => '>50% (3 MONTHS); >70% (6 MONTHS); >90% (12 MONTHS)',
            'threshold_low' => '',
            'threshold_high' => '',
            'target_rationale' => '',

            // Strategy Info
            'perspective' => 'STUDENT & STAKEHOLDER',
            'strategy' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'goal_code' => 'G2',
            'goal' => 'ENHANCE GRADUATES\' COMPETITIVENESS',
            'goal_owner' => 'AAC, CPO',
            'intended_results' => 'ACHIEVEMENT OF GRADUATE ATTRIBUTES . Better performance in licensure examination, career placement, and employer satisfaction.',
            'strategic_initiatives' => 'SI1: STUDENT SERVICES JOB FAIR, MOCK INTERVIEW',
        ]);
    }
}