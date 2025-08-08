<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kpi;
use App\Models\KpiAccreditation;

class KpiAccreditationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accreditations = [
            'O3-M1' => [                
                [
                    'accrediting_body_id'   => 'PAASCU',
                    'accrediting_body_name' => 'Philippine Accrediting Association of Schools, Colleges and Universities',
                    'program_unit'          => 'BED, SAS, SBA, SED, SEA, SHTM, SNAMS, SOC',
                ],
                [
                    'accrediting_body_id'   => 'PACUCOA',
                    'accrediting_body_name' => 'Philippine Association of Colleges and Universities Commission on Accreditation',
                    'program_unit'          => 'CCJEF, SAS, SBA, SED, SEA, SHTM, SNAMS, SOC',
                ],
                [
                    'accrediting_body_id'   => 'ACEJMC (SAS)',
                    'accrediting_body_name' => 'Accrediting Council on Education in Journalism and Mass Communications',
                    'program_unit'          => 'SAS - ABCOMM',
                ],
                [
                    'accrediting_body_id'   => 'IACBE (SBA)',
                    'accrediting_body_name' => 'International Accreditation Council for Business Education',
                    'program_unit'          => 'SBA',
                ],
                [
                    'accrediting_body_id'   => 'AACSB (SBA)',
                    'accrediting_body_name' => 'Association to Advance Collegiate Schools of Business',
                    'program_unit'          => 'SBA',
                ],
                [
                    'accrediting_body_id'   => 'ABET (SEA)',
                    'accrediting_body_name' => 'Accreditation Board for Engineering and Technology',
                    'program_unit'          => 'SEA - ENGG',
                ],
                [
                    'accrediting_body_id'   => 'NAAB (SEA)',
                    'accrediting_body_name' => 'National Architectural Accrediting Board',
                    'program_unit'          => 'SEA-ARCH',
                ],
                [
                    'accrediting_body_id'   => 'ACPHA (SHTM)',
                    'accrediting_body_name' => 'Accreditation Commission for Programs in Hospitality Administration',
                    'program_unit'          => 'SHTM',
                ],
                [
                    'accrediting_body_id'   => 'ACEN (SNAMS)',
                    'accrediting_body_name' => 'Accreditation Commission for Education in Nursing',
                    'program_unit'          => 'SNAMS - NURSING',
                ],
                [
                    'accrediting_body_id'   => 'ACJS (CCJEF)',
                    'accrediting_body_name' => 'Academy of Criminal Justice Sciences',
                    'program_unit'          => 'CCJEF',
                ],
                [
                    'accrediting_body_id'   => 'NAACLS (SNAMS)',
                    'accrediting_body_name' => 'National Accreditation Agency for Clinical Laboratory Sciences',
                    'program_unit'          => 'SNAMS',
                ],
                [
                    'accrediting_body_id'   => 'PICAB (SOC)',
                    'accrediting_body_name' => 'Philippine Computer Society (PCS) Information and Computing Accreditation Board',
                    'program_unit'          => 'SOC',
                ],
                [
                    'accrediting_body_id'   => 'AUN-QA  (SAS, SED, SEA, SNAMS, CCJEF)',
                    'accrediting_body_name' => 'ASEAN University Network - Quality Assurance',
                    'program_unit'          => 'SAS, SED, SEA, SNAMS, CCJEF',
                ],
            ],
        ];

        // Loop through each KPI and insert its accreditations
        foreach ($accreditations as $measureCode => $accreditationList) {
            $kpi = Kpi::where('measure_code', $measureCode)->first();

            if ($kpi) {
                foreach ($accreditationList as $acc) {
                    KpiAccreditation::create([
                        'kpi_id' => $kpi->id,
                        'accrediting_body_id' => $acc['accrediting_body_id'] ?? null,
                        'accrediting_body_name' => $acc['accrediting_body_name'] ?? null,
                        'program_unit' => $acc['program_unit'] ?? null,
                    ]);
                }
            } else {
                echo "No KPI found for measure_code: $measureCode\n";
            }
        }
    }
}
