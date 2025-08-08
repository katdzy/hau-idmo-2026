<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kpi;

class KpiSeeder extends Seeder
{
    public function run(): void
    {
        Kpi::create([ // O1-M1
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
           'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-03-04',
        ]);

        Kpi::create([ // O1-M2
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
            'strategic_theme' => 'ACADEMIC QUALITY	& ORGANIZATIONAL EXCELLENCE',
            'objective' => 'G1: IMPROVE STUDENT PROGRESSION AND SATISFACTION',
            'objective_owner' => 'AAC; SSAC; RSS; CSDO; ICFSI; SSAC; FRMS; OIE',
            'intended_results' => 'IMPROVEMENT OF STUDENT DEVELOPMENT EXPERIENCE. More students enroll and are satisfied.',
            'strategic_initiatives' => '',
    
            // Comparator & Meta
           'comparator' => 'US National Center for Education Statistics (NCES) for full-time students in four-year private nonprofit institutions, limited to one year lag of published data',
           'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => null,
        ]);

        Kpi::create([ // O1-M2 -2
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
            'strategic_theme' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'objective' => 'G1: IMPROVE STUDENT PROGRESSION AND SATISFACTION',
            'objective_owner' => 'AAC; SSAC; RSS; CSDO; ICFSI; SSAC; FRMS; OIE',
            'intended_results' => 'IMPROVEMENT OF STUDENT DEVELOPMENT EXPERIENCE. More students enroll and are satisfied.',
            'strategic_initiatives' => '',

            // Comparator & Meta
           'comparator' => 'US National Center for Education Statistics (NCES) for full-time students in four-year private nonprofit institutions, limited to one year lag of published data',
           'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => null,
        ]);

        Kpi::create([ // G11-M1
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

        Kpi::create([ // O2-M1
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
            'strategic_theme' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'objective' => 'G2: ENHANCE GRADUATES\' COMPETITIVENESS',
            'objective_owner' => 'AAC, CPO',
            'intended_results' => 'ACHIEVEMENT OF GRADUATE ATTRIBUTES . Better performance in licensure examination, career placement, and employer satisfaction.',
            'strategic_initiatives' => 'SI1: STUDENT SERVICES BOARD REVIEW, MOCK BOARD',

            // Comparator & Meta
            'comparator' => 'HAU\'s peer institutions include other schools offering the same program',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-03-25',
        ]);

        Kpi::create([ // O2-M2
            'measure_code' => 'O2-M2',
            'measure_owner' => 'CPO',
            'measure_name' => 'CAREER PLACEMENT RATE',
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
            'strategic_theme' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'objective' => 'G2: ENHANCE GRADUATES\' COMPETITIVENESS',
            'objective_owner' => 'AAC, CPO',
            'intended_results' => 'ACHIEVEMENT OF GRADUATE ATTRIBUTES . Better performance in licensure examination, career placement, and employer satisfaction.',
            'strategic_initiatives' => 'SI1: STUDENT SERVICES JOB FAIR, MOCK INTERVIEW',
        ]);

        Kpi::create([ // O3-M1
            'measure_code' => 'O3-M1',
            'measure_owner' => 'AAC, OIE',
            'measure_name' => 'NUMBER OF DEGREE PROGRAMS WITH LOCAL OR INTERNATIONAL ACCREDITATION',
            'description' => 'HAU\'s program offering meeting the standards established by a nationally or internationally recognized accrediting association for membership in the association',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'total count of accredited programs, classified by local/international and by level, segmentized by unit',
            'unit_type' => '#',
            'polarity' => '>',
            'data_provider' => 'OIE',
            'data_source' => 'ACCREDITATION CERTIFICATION REPORT',
            'collection_frequency' => 'SEMI-ANNUAL',
            'reporting_frequency' => 'ANNUAL',
            'verified_by' => 'QAO DIRECTOR',
            'validated_by' => 'OIE',
            'baseline' => '2015-16: 2016-17: 2017-18: 2018-19: 2019-20:',
            'target' => '>=35 programs',
            'threshold_low' => '22',
            'threshold_high' => '35',
            'target_rationale' => 'In 2016, HAU has 22-degree programs offered by various academic units that have undergone voluntary, peer-reviewed-based accreditation. HAU aims to have all accreditable degree programs to be recognized by accreditation agencies.',

            // Strategy Info
            'perspective' => 'INTERNAL PROCESS',
            'strategic_theme' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'objective' => 'G7: IMPROVE ACADEMIC QUALITY',
            'objective_owner' => 'AAC',
            'intended_results' => 'Increased recognition of HAU\'s programs as meeting the academic standards for excellence',
            'strategic_initiatives' => '',

            // Comparator & Meta
            'comparator' => 'HAU\'s peer institutions include other schools offering the same program',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-03-16',
        ]);

        Kpi::create([ // G3-M3
            'measure_code' => 'G3-M3',
            'measure_owner' => 'MCS, AAC COLLEGES',
            'measure_name' => 'PERCENTAGE OF HAU HS GRADUATES IN HAU COLLEGE PROGRAMS',
            'description' => 'College participation rate of high school graduates; indicator of customer advocacy and repurchase for HAU’s brand and product offerings',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'Grand total of HAU High School graduates enrolled in HAU college as freshmen over total HAU HS graduates, segmented by college unit',
            'unit_type' => '%',
            'polarity' => '>',
            'data_provider' => 'RSS-ADMISSIONS',
            'data_source' => 'ADMISSIONS RECORD, CAMPUS++',
            'collection_frequency' => 'ANNUAL',
            'reporting_frequency' => 'ANNUAL',
            'verified_by' => 'RSS-ADMISSIONS',
            'validated_by' => 'AAC',
            'baseline' => '2011-12	= 80.2%,	2012-13	= 84.6%,	2013-14	= 82.3%,	2014-15	= 80.9%,	2015-16	= 89.5%',
            'target' => '>= 90%',
            'threshold_low' => '>=previous',
            'threshold_high' => '90',
            'target_rationale' => 'HAU aims for a favorable performance level in customer engagement, as measured by customer repurchase.',

            // Strategy Info
            'perspective' => 'INTERNAL PROCESS',
            'strategic_theme' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'objective' => 'G7: IMPROVE ACADEMIC QUALITY',
            'objective_owner' => 'AAC',
            'intended_results' => 'Increased recognition of HAU\'s programs as meeting the academic standards for excellence',
            'strategic_initiatives' => '',

            // Comparator & Meta
            'comparator' => 'In the absence of publicly available local comparative data in higher education, a Baldrige Award recipient in the service industry serves as comparator, with its 73% customer retention rate over the seven-year period prior the Baldrige Award.',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-03-29',
        ]);

        Kpi::create([ // G3-M4
            'measure_code' => 'G3-M4',
            'measure_owner' => 'AAC, MCS',
            'measure_name' => 'HAU RELATIVE MARKET SHARE',
            'description' => 'A comparative measure of competitive strength; HAU\'s market share (%) relative to the market share (%) of its leading competitor among the private HEIs in Central Luzon',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'Relative market share ratio = %HAU market share / ( 100% - %HAU market share); HAUmarket share = #HAU enrolled / #total private HEI Region3',
            'unit_type' => '#',
            'polarity' => '>',
            'data_provider' => 'OIE',
            'data_source' => 'CHED ENROLLMENT STATISTICS',
            'collection_frequency' => 'ANNUAL',
            'reporting_frequency' => 'ANNUAL',
            'verified_by' => 'OIE',
            'validated_by' => 'OIE',
            'baseline' => '2012-13 = 2.11, 2013-14 = 2.31, 2014-15 = 2.3',
            'target' => '>1',
            'threshold_low' => '',
            'threshold_high' => '',
            'target_rationale' => '',

            // Strategy Info
            'perspective' => 'STUDENT & STAKEHOLDER',
            'strategic_theme' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'objective' => 'G3: IMPROVE STUDENT ENGAGEMENT',
            'objective_owner' => 'AAC, MCS',
            'intended_results' => 'Increased recognition of HAU\'s programs as meeting the academic standards for excellence',
            'strategic_initiatives' => 'STRENGTHENED STUDENT ENGAGEMENT AND HAU\'S POSITION AS FIRST CHOICE AMONG HEIs. More engaged students in the learning environment; increased relative market share.',

            // Comparator & Meta
            'comparator' => '',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-03-29',
        ]);

        Kpi::create([ // G5-M1
            'measure_code' => 'G5-M1',
            'measure_owner' => 'AAC, CPO',
            'measure_name' => 'NUMBER OF INDUSTRY PARTNERS FOR CAREER PLACEMENT AND INTERNSHIPS',
            'description' => 'Number of industry partners, both local and international, with MOU/MOA for career placement and internship opportunities for HAU graduates and students, segmented by organizational unit.',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LEAD',
            'formula' => 'total count of industry partners segmented by college unit',
            'unit_type' => '#',
            'polarity' => '>',
            'data_provider' => 'COLLEGE LINKAGE COORS, CPO',
            'data_source' => 'MOU/MOA RECORDS',
            'collection_frequency' => 'SEMI-ANNUAL',
            'reporting_frequency' => 'SEMI-ANNUAL',
            'verified_by' => 'CPO',
            'validated_by' => 'AAC',
            'baseline' => '',
            'target' => '',
            'threshold_low' => '',
            'threshold_high' => '',
            'target_rationale' => '',

            // Strategy Info
            'perspective' => 'STUDENT & STAKEHOLDER',
            'strategic_theme' => 'AUTHENTIC INSTRUMENT FOR COUNTRYSIDE DEVELOPMENT',
            'objective' => 'G5: EXPAND STRATEGIC PARTNERSHIPS',
            'objective_owner' => 'AAC, CPO, OIE',
            'intended_results' => 'Increase in the number of relevant local and international partnerships for maximized strategic alliances and full implementation of MOU and MOA intents',
            'strategic_initiatives' => 'STRENGTHENED STUDENT ENGAGEMENT AND HAU\'S POSITION AS FIRST CHOICE AMONG HEIs. More engaged students in the learning environment; increased relative market share.',

            // Comparator & Meta
            'comparator' => '',
           'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => null,
        ]);

        Kpi::create([ // G4-M2
            'measure_code' => 'G4-M2',
            'measure_owner' => 'ICFSI-OCES',
            'measure_name' => 'WORKFORCE HOURS IN COMMUNITY EXTENSION ENGAGEMENT',
            'description' => 'Number of volunteer person-hours per year of employees in support of local communities in adherence to its social responsibility, segmented by organizational unit.',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'total number of volunteer person-hours of workforce per year, segmented by unit',
            'unit_type' => '#',
            'polarity' => '>',
            'data_provider' => 'OCES',
            'data_source' => 'OCES COMMUNITY EXTENSION RECORDS',
            'collection_frequency' => 'SEASONAL',
            'reporting_frequency' => 'SEMI-ANNUAL',
            'verified_by' => 'OCES',
            'validated_by' => 'OIE',
            'baseline' => '2011-12 = 27,748 person-hours or 6,937 hours per year',
            'target' => '>= previous',
            'threshold_low' => '= previous',
            'threshold_high' => '> previous',
            'target_rationale' => 'HAU aims to maintain, if not increase, the contributed total of person-hours per year attributed to community extension activities.',

            // Strategy Info
            'perspective' => 'STUDENT & STAKEHOLDER',
            'strategic_theme' => 'AUTHENTIC INSTRUMENT FOR COUNTRYSIDE DEVELOPMENT',
            'objective' => 'G4: INCREASE COMMUNITY ENGAGEMENT',
            'objective_owner' => 'ICFSI, SSAC',
            'intended_results' => 'CULTIVATE A CULTURE OF ENGAGEMENT. Increased scholarship grants; Increased community extension engagement of workforce and students',
            'strategic_initiatives' => '',

            // Comparator & Meta
            'comparator' => '',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-03-30',
        ]);

        Kpi::create([ // G4-M1
            'measure_code' => 'G4-M1',
            'measure_owner' => 'ICFSI, SSAC',
            'measure_name' => 'PERCENTAGE OF STUDENTS RECEIVING FINANCIAL AID',
            'description' => 'Percentage of college students (primarily children of farmers, OFWs, and other socio-economically disadvantaged families) receiving financial aid.',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LEAD',
            'formula' => 'number of scholarship recipients over total population',
            'unit_type' => '%',
            'polarity' => '>',
            'data_provider' => 'SSAC-USGO',
            'data_source' => 'USGO SCHOLARSHIP RECORDS',
            'collection_frequency' => 'SEMI-ANNUAL',
            'reporting_frequency' => 'SEMI-ANNUAL',
            'verified_by' => 'USGO',
            'validated_by' => 'OIE',
            'baseline' => '',
            'target' => '>= 20%',
            'threshold_low' => '5',
            'threshold_high' => '20',
            'target_rationale' => 'HAU aims to exceed the 5% minimum mandated by CHED on the percentage of college students receiving institutional financial aid. A high percentage represents a sustained improvement in HAU\'s budgetary commitment to making Catholic college education accessible to students who are primarily children of farmers, overseas Filipino workers, and other families from socio-economically disadvantaged populations.',

            // Strategy Info
            'perspective' => 'STUDENT & STAKEHOLDER',
            'strategic_theme' => 'AUTHENTIC INSTRUMENT FOR COUNTRYSIDE DEVELOPMENT',
            'objective' => 'G4: INCREASE COMMUNITY ENGAGEMENT',
            'objective_owner' => 'ICFSI, SSAC',
            'intended_results' => 'CULTIVATE A CULTURE OF ENGAGEMENT. Increased scholarship grants; Increased community extension engagement of workforce and students',
            'strategic_initiatives' => '',

            // Comparator & Meta
            'comparator' => '',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-03-30',
        ]);

        Kpi::create([ // G6-M1
            'measure_code' => 'G6-M1',
            'measure_owner' => 'FRMS',
            'measure_name' => 'COMPOSITE FINANCIAL INDEX',
            'description' => 'CFI, a NACUBO developed index that shows the relative financial health of the institution; derived using four ratios: Primary Reserve Ratio, Viability Ratio, Return on Net Assets Ratio and Net Operating Revenue Ratio.',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'number of scholarship recipients over total population',
            'unit_type' => '#',
            'polarity' => '>',
            'data_provider' => 'ACCTG',
            'data_source' => 'ACCOUNTING RECORDS',
            'collection_frequency' => 'SEMI-ANNUAL',
            'reporting_frequency' => 'SEMI-ANNUAL',
            'verified_by' => 'ACCOUNTING HEAD',
            'validated_by' => 'VP-FRMS',
            'baseline' => '2014-15 = 14.4',
            'target' => '> 10%',
            'threshold_low' => '3',
            'threshold_high' => '10',
            'target_rationale' => 'The CFI allows a more holistic approach to understanding HAU\'s total financial health by allowing a strength or weakness in a specific ratio to be offset by another ratio result. High CFI indicates that expenses are retained in expendables resources; the net operating revenues generated are sufficient to keep pace with, and will continue to exceed growth of, moderate expense levels; the return on net assets is reasonable for HAU\'s overall investment activity; and HAU has expendable financial resources that are unencumbered by debt.',

            // Strategy Info
            'perspective' => 'FINANCIAL/STEWARDSHIP',
            'strategic_theme' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'objective' => 'G6: OPTIMIZE ORGANIZATIONAL HEALTH',
            'objective_owner' => 'FRMS',
            'intended_results' => 'Continual improvement of processes on financial management. Maintained financial index above NACUBO threshold. Improved budget performance.',
            'strategic_initiatives' => '',

            // Comparator & Meta
            'comparator' => 'The industry benchmark for the CFI is 10. The comparative sources are the US National Association of College and University Business Officers (NACUBO) standards (minimum threshold and benchmark) and PQA Level II higher education recipient (private, publicly traded corporation).',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-03-30',
        ]);

        Kpi::create([ // G1-M4
            'measure_code' => 'G1-M4',
            'measure_owner' => 'AAC, RSS',
            'measure_name' => 'ENROLLMENT YIELD',
            'description' => 'Percentage of students who enroll	after being admitted',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LEAD',
            'formula' => 'grand total of enrolled students over total of admitted students',
            'unit_type' => '%',
            'polarity' => '>',
            'data_provider' => 'RSS',
            'data_source' => 'RSS ENROLLMENT RECORD, CAMPUS++',
            'collection_frequency' => 'SEMI-ANNUAL',
            'reporting_frequency' => 'SEMI-ANNUAL',
            'verified_by' => 'REGISTRAR',
            'validated_by' => 'OIE',
            'baseline' => '2015-16: _% 2016-17: _% 2017-18: _% 2018-19: _% 2019-20: _%',
            'target' => '>=98%',
            'threshold_low' => '50',
            'threshold_high' => '98',
            'target_rationale' => 'HAU aims to achieve a high enrollment yield from those who qualified in the admissions process.',

            // Strategy Info
            'perspective' => 'STUDENT & STAKEHOLDER',
            'strategic_theme' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'objective' => 'G1: IMPROVE STUDENT PROGRESSION AND SATISFACTION',
            'objective_owner' => 'AAC; SSAC; RSS; CSDO; ICFSI; SSAC; FRMS; OIE',
            'intended_results' => 'IMPROVEMENT OF STUDENT DEVELOPMENT EXPERIENCE. More students enroll and are satisfied.',
            'strategic_initiatives' => '',

            // Comparator & Meta
            'comparator' => 'The industry benchmark for the CFI is 10. The comparative sources are the US National Association of College and University Business Officers (NACUBO) standards (minimum threshold and benchmark) and PQA Level II higher education recipient (private, publicly traded corporation).',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-03-30',
        ]);

        Kpi::create([ // G3-M2
            'measure_code' => 'G3-M2',
            'measure_owner' => 'MCS',
            'measure_name' => 'PERCENTAGE OF INCOMING STUDENTS WHO IDENTIFIED HAU AS THEIR FIRST CHOICE',
            'description' => 'Indicator of HAU\'s market performance as leading choice of incoming students',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'number of enrolled students who identified HAU as first-choice over total freshmen applicants',
            'unit_type' => '%',
            'polarity' => '>',
            'data_provider' => 'RSS-ADMISSIONS',
            'data_source' => 'ADMISSIONS RECORD, CAMPUS++',
            'collection_frequency' => 'ANNUAL',
            'reporting_frequency' => 'ANNUAL',
            'verified_by' => 'RSS-ADMISSIONS',
            'validated_by' => 'AAC',
            'baseline' => '2011-12 = 72.7%, 2012-13 = 76.7%, 2013-14 = 90.6%, 2014-15 = 89.9%, 2015-16 = 88.2%',
            'target' => '>=	88%',
            'threshold_low' => '>=previous',
            'threshold_high' => '88',
            'target_rationale' => 'Students and parents are becoming savvier shoppers, and the rising cost of college is top of mind particularly for students in HAU\'s demographic segments. A favorable performance level in this indicator reflects HAU\'s efforts to simultaneously constrain costs and craft financial aid packages that adequately address students\' financial needs.',

            // Strategy Info
            'perspective' => 'STUDENT & STAKEHOLDER',
            'strategic_theme' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'objective' => 'G3: IMPROVE STUDENT ENGAGEMENT',
            'objective_owner' => 'AAC, MCS',
            'intended_results' => 'STRENGHTENED STUDENT ENGAGEMENT AND HAU\'S POSITION AS FIRST CHOICE AMONG HEIs. More engaged students in the learning environment; increased relative market share.',
            'strategic_initiatives' => '',

            // Comparator & Meta
            'comparator' => 'In the absence of publicly available local comparisons, HAU compares its market performance to US colleges and universities (2016). The American Freshman.',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-03-29',
        ]);

        Kpi::create([ // G9-M1
            'measure_code' => 'G9-M1',
            'measure_owner' => 'CSDO',
            'measure_name' => 'AGE OF FACILITIES',
            'description' => 'Measures the average age of total plant facilities in years as a measure of relationship of current depreciation to total depreciation; This ratio is important because it estimates the age of the facilities and the potential need for considerable future resources to be invested inplant to cover deferred maintenance. Deferred maintenance is not recorded as an unfunded liability in the financial statements, thus, a low ratio is better.',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LEAD',
            'formula' => 'Accumulated depreciation at year-end divided by your annual depreciation expense',
            'unit_type' => '#',
            'polarity' => '<',
            'data_provider' => 'CSDO',
            'data_source' => 'CSDO DEPRECIATION RECORDS',
            'collection_frequency' => 'ANNUAL',
            'reporting_frequency' => 'ANNUAL',
            'verified_by' => 'CSDO Director',
            'validated_by' => 'OIE',
            'baseline' => '2011-12 = 8.5; 2012-13 = 8.8, 2013-14 = 9.9; 2014-15 = 9.0',
            'target' => '<10',
            'threshold_low' => '14',
            'threshold_high' => '10',
            'target_rationale' => 'HAU aims to achieve a low ratio since it indicates that an institution has made recent investments in its plant facilities. The international standard for this ratio is 10 years or less for research institutions and 14 years or less for predominantly undergraduate institutions.',

            // Strategy Info
            'perspective' => 'INTERNAL PROCESS',
            'strategic_theme' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'objective' => 'G9: UPGRADE CAMPUS FACILITIES & RESOURCES',
            'objective_owner' => 'AAC, CSDO',
            'intended_results' => 'Continual upkeep and development of campus facilities and resources. Reduced age of facilities, increased usage of electronic resources, and completion of campus development projects.',
            'strategic_initiatives' => 'SI4: Process Management and Quality Assurance',

            // Comparator & Meta
            'comparator' => 'PQA benchmark institution',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-05-11',
        ]);

        Kpi::create([ // G8-M5
            'measure_code' => 'G8-M5',
            'measure_owner' => 'HRMO',
            'measure_name' => 'DART RATE',
            'description' => 'Days Away Restricted or Transferred Rate; cases on OSHA recordable injuries or illness that resulted in days away from work, restricted duty, or transfer of duties per 100 full-time-equivalent (FTE) employees; indicator of workplace health and safety policies.',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'Number of OSHA Recordable injuries and illnesses that resulted in Days Away; Restricted; Transferred X 200,000) / Employee hours worked',
            'unit_type' => '#',
            'polarity' => '<',
            'data_provider' => 'HRMO',
            'data_source' => 'HR INCIDENT LOG RECORDS',
            'collection_frequency' => 'ANNUAL',
            'reporting_frequency' => 'ANNUAL',
            'verified_by' => 'HR Director',
            'validated_by' => 'HR Director',
            'baseline' => '2012 = 0.28, 2013 = 0.13, 2014 = 0.14, 2015 = 0.13',
            'target' => '<2',
            'threshold_low' => '2',
            'threshold_high' => '0.13',
            'target_rationale' => 'HAU aims to have low ratio of DART cases. A low value indicates the effective deployment of HAU\'s workplace health and safety policies.',

            // Strategy Info
            'perspective' => 'INTERNAL PROCESS',
            'strategic_theme' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'objective' => 'G8: ENHANCE PROCESS AND WORK ENVIRONMENT',
            'objective_owner' => 'ALL',
            'intended_results' => 'Recognition for HAU as benchmark for its best practices in operational excellence, continuous improvement, and quality delivery innovative teaching and learning strategies, and technology-enabled student services.',
            'strategic_initiatives' => 'SI4: Process Management and Quality Assurance',

            // Comparator & Meta
            'comparator' => 'In the absence of publicly available local comparator, the most appropriate comparison is the US Bureau of Labor Statistics, which reports an average of 2 cases per 100 FTE employees in the private education services sector.',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-05-06',
        ]);

        Kpi::create([ // G8-M6
            'measure_code' => 'G8-M6',
            'measure_owner' => 'CSDO',
            'measure_name' => 'INCIDENCE OF CAMPUS CRIME',
            'description' => 'A measure of HAU\'s security and safety processes aimed at providing an environment where the workforce and students can feel safe and protected from harm; includes number of incidences on violent crimes, arson, burglary, theft occurring on campus grounds.',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'Total count of campus crime incidences, per category.',
            'unit_type' => '#',
            'polarity' => '<',
            'data_provider' => 'CSDO',
            'data_source' => '',
            'collection_frequency' => 'ANNUAL',
            'reporting_frequency' => 'ANNUAL',
            'verified_by' => 'CSDO Director',
            'validated_by' => 'CSDO Director',
            'baseline' => '2012-13 = 4, 2013-14 = 5; 2014-15 = 2, 2015-16 = 0',
            'target' => '0',
            'threshold_low' => '2',
            'threshold_high' => '0',
            'target_rationale' => 'HAU aims to maintain a safe and secure workplace with zero campus crime occurrences.',

            // Strategy Info
            'perspective' => 'INTERNAL PROCESS',
            'strategic_theme' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'objective' => 'G8: ENHANCE PROCESS AND WORK ENVIRONMENT',
            'objective_owner' => 'ALL',
            'intended_results' => 'Recognition for HAU as benchmark for its best practices in operational excellence, continuous improvement, and quality delivery innovative teaching and learning strategies, and technology-enabled student services.',
            'strategic_initiatives' => 'SI4: Process Management and Quality Assurance',

            // Comparator & Meta
            'comparator' => '',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-05-07',
        ]);

        Kpi::create([ // G9-M2
            'measure_code' => 'G9-M2',
            'measure_owner' => 'LIB',
            'measure_name' => 'USAGE OF LIBRARY ELECTRONIC RESOURCES',
            'description' => 'Comparative annual usage of electronic databases in the University Library; number of access hits to e-databases from in-campus and remote access platforms.',
            'measure_type' => 'OPERATIONAL MEASURE',
            'lead_lag' => 'LEAD',
            'formula' => 'Total number of access hits to electronic databases, segmented per organization unit',
            'unit_type' => '#',
            'polarity' => '>',
            'data_provider' => 'LIB',
            'data_source' => 'UNIV LIB RECORD',
            'collection_frequency' => 'SEMI-ANNUAL',
            'reporting_frequency' => 'SEMI-ANNUAL',
            'verified_by' => 'LIB Director',
            'validated_by' => 'OIE',
            'baseline' => '2013-14 = 22923; 2014-15 = 75840; 2015-16 = 85202',
            'target' => '> PREVIOUS NUMBER OF ACCESS HITS',
            'threshold_low' => '= PREVIOUS',
            'threshold_high' => '> PREVIOUS',
            'target_rationale' => 'HAU aims to provide flexible access to its electronic databases. Allowing for remote access to the e-databases results to higher usage. This can be seen in the number of access hits.',

            // Strategy Info
            'perspective' => 'INTERNAL PROCESS',
            'strategic_theme' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'objective' => 'G9: UPGRADE CAMPUS FACILITIES & RESOURCES',
            'objective_owner' => 'AAC, CSDO',
            'intended_results' => 'Continual upkeep and development of campus facilities and resources. Reduced age of facilities, increased usage of electronic resources, and completion of campus development projects.',
            'strategic_initiatives' => 'SI4: Process Management and Quality Assurance',

            // Comparator & Meta
            'comparator' => '',
           'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => null,
        ]);

        Kpi::create([ // G3-M1 (B)
            'measure_code' => 'G3-M1 (B)',
            'measure_owner' => 'AAC',
            'measure_name' => 'STUDENT ENGAGEMENT IN THE LEARNING PROCESS: Student Participation Rate in Evaluations',
            'description' => 'Student participation in voluntary, online-administered student evaluation of teaching.',
            'measure_type' => 'OPERATIONAL MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'Number of students who participated in the online faculty evaluation over total enrolled students in the unit',
            'unit_type' => '%',
            'polarity' => '>',
            'data_provider' => 'ITEC',
            'data_source' => 'FACULTY EVALUATION BY STUDENTS',
            'collection_frequency' => 'SEMI-ANNUAL',
            'reporting_frequency' => 'ANNUAL',
            'verified_by' => 'ITEC',
            'validated_by' => 'AAC',
            'baseline' => '',
            'target' => '>= 80%',
            'threshold_low' => '50',
            'threshold_high' => '80',
            'target_rationale' => 'HAU tracks student engagement in the learning process through participation of students on evaluation on teaching, and aims to achieve at least 80% online average participation.',

            // Strategy Info
            'perspective' => 'STUDENT & STAKEHOLDER',
            'strategic_theme' => 'ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE',
            'objective' => 'G3: IMPROVE STUDENT ENGAGEMENT',
            'objective_owner' => 'AAC, MCS',
            'intended_results' => 'STRENGTHENED STUDENT ENGAGEMENT AND HAU\'S POSITION AS FIRST CHOICE AMONG HEIs. More engaged students in the learning environment; increased relative market share.',
            'strategic_initiatives' => '',

            // Comparator & Meta
            'comparator' => '50% average participation rate reported in the education literature.',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-03-25',
        ]);

        Kpi::create([ // O12-M1
            'measure_code' => 'O12-M1',
            'measure_owner' => 'OSA',
            'measure_name' => 'STUDENT INFRACTIONS',
            'description' => 'Number of student discipline issues, categorized as major and minor student infractions segmentized per department.',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => 'total count of students with disciplinary case',
            'unit_type' => '#',
            'polarity' => '<',
            'data_provider' => 'OSA',
            'data_source' => 'OSA INFRACTION RECORDS',
            'collection_frequency' => 'SEMI-ANNUAL',
            'reporting_frequency' => 'SEMI-ANNUAL',
            'verified_by' => 'OSA Head',
            'validated_by' => 'OSA Head',
            'baseline' => '2017: 3 major, 15% minor',
            'target' => '<1% (major)',
            'threshold_low' => '3',
            'threshold_high' => '0',
            'target_rationale' => 'HAU advocates to be a School of Life and Character. As a Catholic School, HAU instills the Angelite values of compassion and conscience. Breaches of ethical behavior are dealt with using the provisions of the HAU’s Code of Behavior and Discipline, applying such disciplinary measures that vary in severity depending on the gravity of infraction. The goal in ethical behavior is not more than one (1) percent of all students committing ethical/disciplinary breaches per year.',

            // Strategy Info
            'perspective' => 'LEARNING & GROWTH',
            'strategic_theme' => 'FAITHFUL CATHOLIC EDUCATION',
            'objective' => 'G10: CULTIVATE CHARACTER FORMATION',
            'objective_owner' => 'AAC, ICFSI, HRMO, SSAC',
            'intended_results' => 'Inculcated charisms of angels and archangels, and values of the Founders. Reduced infractions and ethical breaches. Increased spirituality audit results.',
            'strategic_initiatives' => 'SI1: Student Services; SI3: Workforce and Leadership Development; Formation Programs, Character Building campaigns',

            // Comparator & Meta
            'comparator' => '',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-05-11',
        ]);

        Kpi::create([ // G10-M2
            'measure_code' => 'G10-M2',
            'measure_owner' => 'ICFSI',
            'measure_name' => 'INSTITUTIONAL SPIRITUALITY AUDIT RESULTS',
            'description' => 'Unbiased examination and evaluation of HAU Community\'s spirituality using the Institutional Core Values as indices. A survey tool was crafted and subjected to item analysis and validation. Using 5-point likert scale, descriptive rating ranging from Strongly Agree to Strongly Disagree and with an equivalent numerical rating of 1 to 5. Results were interpreted using the following:
                                • 4.20 – 5.00 Strongly Agree
                                • 3.40 – 4.19 Agree
                                • 2.60 – 3.39 Undecided
                                • 1.80 – 2.59 Disagree
                                • 1.00 – 1.79 Strongly Disagree',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LAG',
            'formula' => '',
            'unit_type' => '#',
            'polarity' => '>',
            'data_provider' => 'ICFSI',
            'data_source' => 'CEP Report on the HAU Spirituality Scale',
            'collection_frequency' => 'ANNUAL',
            'reporting_frequency' => 'ANNUAL',
            'verified_by' => 'ICFSI DIRECTOR',
            'validated_by' => 'ICFSI DIRECTOR',
            'baseline' => 'SY 2020-21: 4.37 (Strongly Agree)',
            'target' => '>= 4.2 (strongly agree)',
            'threshold_low' => '3.4',
            'threshold_high' => '4.2',
            'target_rationale' => '',

            // Strategy Info
            'perspective' => 'LEARNING & GROWTH',
            'strategic_theme' => 'FAITHFUL CATHOLIC EDUCATION',
            'objective' => 'G10: CULTIVATE CHARACTER FORMATION',
            'objective_owner' => 'AAC, ICFSI, HRMO, SSAC',
            'intended_results' => 'Inculcated charisms of angels and archangels, and values of the Founders. Reduced infractions and ethical breaches. Increased spirituality audit results.',
            'strategic_initiatives' => 'SI1: Student Services; SI3: Workforce and Leadership Development; Formation Programs, Character Building campaigns',

            // Comparator & Meta
            'comparator' => '',
            'item_author' => 'LORNA TYSON',
            'date' => '2020-07-12',
        ]);

        Kpi::create([ // G11-M2
            'measure_code' => 'G11-M2',
            'measure_owner' => 'HRMO',
            'measure_name' => 'PERCENTAGE OF FACULTY WITH GRADUATE DEGREES',
            'description' => 'Workforce capability measure on academic qualification, with master\'s degree prescribed as minimum CHED requirement',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LEAD',
            'formula' => 'number of FT faculty with graduate degrees over total number of FT faculty',
            'unit_type' => '%',
            'polarity' => '>',
            'data_provider' => 'HRMO',
            'data_source' => 'HR 201 RECORDS',
            'collection_frequency' => 'SEMI-ANNUAL',
            'reporting_frequency' => 'SEMI-ANNUAL',
            'verified_by' => 'HR DIRECTOR',
            'validated_by' => 'OIE',
            'baseline' => '2015-16: Doctorate = 14%, Master\'s = 72%',
            'target' => '>= 90%',
            'threshold_low' => '49 (NATL)',
            'threshold_high' => '90',
            'target_rationale' => 'The long-term goal for faculty development is to have 90% academically qualified faculty members through the graduate degrees majority possessing doctoral degrees and with the remaining 10% having substantial professional practice to compensate their academic qualifications. HAU aims to surpass the 49% national average for private HEIs in the country.',

            // Strategy Info
            'perspective' => 'LEARNING & GROWTH',
            'strategic_theme' => 'GREAT UNIVERSITY TO WORK FOR',
            'objective' => 'G11: IMPROVE EMPLOYEE PROFESSIONAL DEVELOPMENT',
            'objective_owner' => 'CORE GROUP (CG)',
            'intended_results' => 'Development of people into
                                    conscientious, competent, and
                                    compassionate workforce and
                                    leaders. Increased employee
                                    satisfaction, improved academic and
                                    professional qualification.',
            'strategic_initiatives' => 'SI3: Workforce and Leadership Development',

            // Comparator & Meta
            'comparator' => '',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-05-12',
        ]);

        Kpi::create([ // G12-M1
            'measure_code' => 'G12-M1',
            'measure_owner' => 'URO',
            'measure_name' => 'PERCENTAGE OF FT FACULTY WITH RESEARCH OR CREATIVE WORKS',
            'description' => 'Indicator of faculty engagement in local or international research and creative works, both internally and externally funded, paper presentation, and journal publication of full-time faculty members.',
            'measure_type' => 'STRATEGIC MEASURE',
            'lead_lag' => 'LEAD',
            'formula' => '% FT faculty research engagement = #FT faculty with research/#total faculty
                            % FT faculty -research presentation/ publication = number of FT faculty with presentation/publication over total FT faculty',
            'unit_type' => '%',
            'polarity' => '>',
            'data_provider' => 'URO',
            'data_source' => 'URO RESEARCH RECORDS',
            'collection_frequency' => 'SEMI-ANNUAL',
            'reporting_frequency' => 'SEMI-ANNUAL',
            'verified_by' => 'URO DIRECTOR',
            'validated_by' => 'OIE',
            'baseline' => '',
            'target' => '>= 90%',
            'threshold_low' => '10',
            'threshold_high' => '90',
            'target_rationale' => 'HAU promotes and invests in research development programs, where higher faculty engagement in research results in better and advance learning of our students. HAU aims to involve 90% of faculty members who strive for excellence in research and scholarly publications.',

            // Strategy Info
            'perspective' => 'LEARNING & GROWTH',
            'strategic_theme' => 'AUTHENTIC INSTRUMENT FOR COUNTRYSIDE DEVELOPMENT',
            'objective' => 'G12: PROMOTE RESEARCH & COMMERCIALIZATION OF TECHNOLOGY',
            'objective_owner' => 'AAC',
            'intended_results' => 'Enriched creation, development and
                                    dissemination of knowledge and
                                    scholarly achievement, and transfer of
                                    technology; Increased research and
                                    creative works engagement and output.',
            'strategic_initiatives' => 'SI5: Research Development and Commercialization of Technology',

            // Comparator & Meta
            'comparator' => '',
            'item_author' => 'ENGR. ANNE MARIE MANGILIMAN',
            'date' => '2021-05-12',
        ]);
    }
}