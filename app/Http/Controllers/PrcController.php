<?php

namespace App\Http\Controllers;

use App\Models\PRC;
use App\Models\PrcTakers;
use App\Models\tags;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Aws\Textract\TextractClient;

class PrcController extends Controller
{
    /**
     * Generates a unique PRC ID.
     */
    protected function generateId()
    {
        do {
            $gen = Auth::user()->id . 'prc' . Str::random(10);
        } while (PRC::where('id', $gen)->exists());
        return $gen;
    }

    /**
     * Display a listing of the PRC examinations.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $examination = $request->input('examination');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = PRC::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('exam_date', 'LIKE', "%{$search}%");
            });
        }

        if (!empty($examination)) {
            $query->where('title', $examination);
        }

        if (!empty($start_date)) {
            $query->whereDate('exam_date', '>=', $start_date);
        }

        if (!empty($end_date)) {
            $query->whereDate('exam_date', '<=', $end_date);
        }

        $data = $query->orderBy('exam_date', 'desc')->paginate(10);

        return view('prc.prc')->with([
            'data'        => $data,
            'search'      => $search,
            'examination' => $examination,
            'start_date'  => $start_date,
            'end_date'    => $end_date,
            'prc_exams'   => tags::where('category', 'prc_exams')->orderBy('item', 'asc')->get()
        ]);
    }

    /**
     * AJAX search for PRC examinations.
     */
    public function search(Request $request)
    {
        $search = $request->get('query', '');
        $examination = $request->get('examination', '');
        $start_date = $request->get('start_date', '');
        $end_date = $request->get('end_date', '');
        $page = $request->get('page', 1);

        $dataQuery = PRC::query();

        if (!empty($search)) {
            $dataQuery->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('exam_date', 'LIKE', "%{$search}%");
            });
        }

        if (!empty($examination)) {
            $dataQuery->where('title', $examination);
        }

        if (!empty($start_date)) {
            $dataQuery->whereDate('exam_date', '>=', $start_date);
        }

        if (!empty($end_date)) {
            $dataQuery->whereDate('exam_date', '<=', $end_date);
        }

        $data = $dataQuery->orderBy('exam_date', 'desc')->paginate(10, ['*'], 'page', $page);

        $links = $data->appends([
            'query'       => $search,
            'examination' => $examination,
            'start_date'  => $start_date,
            'end_date'    => $end_date,
        ])->links()->toHtml();

        return response()->json([
            'data'  => $data->items(),
            'links' => $links,
            'count' => $data->total(),
            'from'  => $data->firstItem(),
            'to'    => $data->lastItem(),
        ]);
    }

    /**
     * Display a single PRC examination record.
     */
    public function view(Request $request)
    {
        $prc = PRC::where('id', $request->id)->firstOrFail();
        // Order takers alphabetically by school and paginate by 10
        $takers = $prc->takers()->orderBy('school', 'asc')->paginate(10);
        $allTakers = $prc->takers()->orderBy('school', 'asc')->get();

        if ($request->ajax()) {
            // Return only the takers table partial if AJAX request
            return view('prc.takers_table', compact('takers'))->render();
        }

        return view('prc.view')->with([
            'prc'       => $prc,
            'allTakers' => $allTakers,
            'takers'    => $takers,
            'prc_exams' => tags::where('category', 'prc_exams')->orderBy('item', 'asc')->get()
        ]);
    }


    /**
     * Return the manual add form view.
     */
    public function add()
    {
        return view('prc.add-prc')->with([
            'prc_exams' => tags::where('category', 'prc_exams')->orderBy('item', 'asc')->get()
        ]);
    }

    /**
     * Return the initial add view.
     */
    public function addInitial()
    {
        return view('prc.add-initial');
    }

    /**
     * Return the upload view for OCR.
     */
    public function addUpload()
    {
        return view('prc.add-upload');
    }

    /**
     * Process OCR using Amazon Textract.
     *
     * This method accepts one or more image uploads, sends each image to Amazon Textract to
     * extract table data, and maps the first detected table into your expected data format.
     */
    public function processOCR(Request $request)
    {
        $request->validate([
            'ocr_images'   => 'required|array|min:1',
            'ocr_images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $allSchoolsData = [];

        // Initialize AWS Textract client.
        $textract = new TextractClient([
            'version'     => 'latest',
            'region'      => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        foreach ($request->file('ocr_images') as $file) {
            // Store the image temporarily.
            $filePath = $file->store('ocr_uploads', 'public');
            $imagePath = public_path("storage/$filePath");

            // Read the raw image bytes (no preprocessing needed).
            $imageBytes = file_get_contents($imagePath);

            try {
                $result = $textract->analyzeDocument([
                    'Document'     => ['Bytes' => $imageBytes],
                    'FeatureTypes' => ['TABLES']
                ]);
            } catch (\Exception $e) {
                Log::error('Amazon Textract Error: ' . $e->getMessage());
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                continue;
            }

            // Remove the temporary image file.
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Extract table data from Textract's response.
            $tables = $this->extractTablesFromTextractResult($result);
            if (count($tables) > 0) {
                // Assume the first table is the one you need.
                $table = $tables[0];

                // If your table contains a header row, you may choose to skip it.
                $dataRows = $table;

                // Map each row into your expected keys if it has at least 7 columns.
                foreach ($dataRows as $row) {
                    if (count($row) == 11) {
                        $allSchoolsData[] = [
                            'school'      => $row[0],
                            'first_pass'  => (int)$row[1],
                            'first_fail'  => (int)$row[2],
                            'first_cond'  => (int)$row[3],
                            'repeat_pass' => (int)$row[6],
                            'repeat_fail' => (int)$row[7],
                            'repeat_cond' => (int)$row[8],
                        ];
                    }
                    elseif (count($row) == 9) {
                        $allSchoolsData[] = [
                            'school'      => $row[0],
                            'first_pass'  => (int)$row[1],
                            'first_fail'  => (int)$row[2],
                            'first_cond'  => 0,
                            'repeat_pass' => (int)$row[5],
                            'repeat_fail' => (int)$row[6],
                            'repeat_cond' => 0,
                        ];
                    }
                }
            }
        }

        return view('prc.add-prc-ocr-preview')->with([
            'exam_title'  => 'Unknown Examination',
            'exam_date'   => date('Y-m-d'),
            'schoolsData' => $allSchoolsData,
            'prc_exams'   => tags::where('category', 'prc_exams')->orderBy('item', 'asc')->get()
        ]);
    }

    /**
     * Helper method to extract tables from Textract's result.
     *
     * @param array $result The response from Textract.
     * @return array An array of tables; each table is an array of rows (which are arrays of cell texts).
     */
    protected function extractTablesFromTextractResult($result)
    {
        $tables = [];
        $blocks = $result['Blocks'];
        $blockMap = [];

        // Build a lookup table for all blocks by their Id.
        foreach ($blocks as $block) {
            $blockMap[$block['Id']] = $block;
        }

        // Loop over all blocks to find TABLE blocks.
        foreach ($blocks as $block) {
            if (isset($block['BlockType']) && $block['BlockType'] === 'TABLE') {
                $table = [];

                if (isset($block['Relationships'])) {
                    foreach ($block['Relationships'] as $relationship) {
                        if ($relationship['Type'] === 'CHILD') {
                            foreach ($relationship['Ids'] as $childId) {
                                $cell = $blockMap[$childId];
                                if ($cell['BlockType'] === 'CELL') {
                                    $rowIndex = $cell['RowIndex'];
                                    $colIndex = $cell['ColumnIndex'];
                                    $cellText = '';

                                    if (isset($cell['Relationships'])) {
                                        foreach ($cell['Relationships'] as $childRel) {
                                            if ($childRel['Type'] === 'CHILD') {
                                                foreach ($childRel['Ids'] as $childTextId) {
                                                    $textBlock = $blockMap[$childTextId];
                                                    if ($textBlock['BlockType'] === 'WORD') {
                                                        $cellText .= $textBlock['Text'] . ' ';
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    $cellText = trim($cellText);
                                    $table[$rowIndex][$colIndex] = $cellText;
                                }
                            }
                        }
                    }
                }

                // Sort the rows and columns so that the table is in proper order.
                if (!empty($table)) {
                    ksort($table);
                    $sortedTable = [];
                    foreach ($table as $row) {
                        ksort($row);
                        $sortedTable[] = array_values($row);
                    }
                    $tables[] = $sortedTable;
                }
            }
        }

        return $tables;
    }

    /**
     * Store a new PRC examination.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'              => 'required|string|max:255',
            'exam_date'          => 'required|date',
            'schoolsData'        => 'required|array|min:1',
            'schoolsData.*.school'       => 'required|string|max:255',
            'schoolsData.*.first_pass'   => 'required|integer|min:0',
            'schoolsData.*.first_fail'   => 'required|integer|min:0',
            'schoolsData.*.repeat_pass'  => 'required|integer|min:0',
            'schoolsData.*.repeat_fail'  => 'required|integer|min:0',
            'schoolsData.*.first_cond'   => 'nullable|integer|min:0',
            'schoolsData.*.repeat_cond'  => 'nullable|integer|min:0',
        ]);

        $prcId = $this->generateId();
        $prc = PRC::create([
            'id'        => $prcId,
            'title'     => $request->title,
            'exam_date' => $request->exam_date,
        ]);

        $schoolsData = $request->input('schoolsData', []);

        foreach ($schoolsData as $data) {
            PrcTakers::create([
                'id'           => Str::uuid()->toString(),
                'exam_id'      => $prcId,
                'school'       => $data['school'],
                'first_pass'   => (int)$data['first_pass'],
                'first_fail'   => (int)$data['first_fail'],
                'first_cond'   => isset($data['first_cond']) ? (int)$data['first_cond'] : 0,
                'repeat_pass'  => (int)$data['repeat_pass'],
                'repeat_fail'  => (int)$data['repeat_fail'],
                'repeat_cond'  => isset($data['repeat_cond']) ? (int)$data['repeat_cond'] : 0,
            ]);
        }

        return redirect()->route('admin.prc')->with('success', 'PRC examination added successfully.');
    }

    /**
     * Update an existing PRC examination.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'              => 'required|string|max:255',
            'exam_date'          => 'required|date',
            'schoolsData'        => 'required|array|min:1',
            'schoolsData.*.school'       => 'required|string|max:255',
            'schoolsData.*.first_pass'   => 'required|integer|min:0',
            'schoolsData.*.first_fail'   => 'required|integer|min:0',
            'schoolsData.*.repeat_pass'  => 'required|integer|min:0',
            'schoolsData.*.repeat_fail'  => 'required|integer|min:0',
            'schoolsData.*.first_cond'   => 'nullable|integer|min:0',
            'schoolsData.*.repeat_cond'  => 'nullable|integer|min:0',
        ]);

        $prc = PRC::findOrFail($id);
        $prc->title = $request->title;
        $prc->exam_date = $request->exam_date;
        $prc->save();

        $prc->takers()->delete();
        $schoolsData = $request->input('schoolsData', []);

        foreach ($schoolsData as $data) {
            PrcTakers::create([
                'id'           => Str::uuid()->toString(),
                'exam_id'      => $prc->id,
                'school'       => $data['school'],
                'first_pass'   => (int)$data['first_pass'],
                'first_fail'   => (int)$data['first_fail'],
                'first_cond'   => isset($data['first_cond']) ? (int)$data['first_cond'] : 0,
                'repeat_pass'  => (int)$data['repeat_pass'],
                'repeat_fail'  => (int)$data['repeat_fail'],
                'repeat_cond'  => isset($data['repeat_cond']) ? (int)$data['repeat_cond'] : 0,
            ]);
        }

        return redirect()->route('admin.prc.view', ['id' => $id])->with('success', 'PRC examination updated successfully.');
    }

    /**
     * Delete a PRC examination.
     */
    public function destroy($id)
    {
        $prc = PRC::findOrFail($id);
        $prc->takers()->delete();
        $prc->delete();

        return redirect()->route('admin.prc')->with('success', 'PRC examination deleted successfully.');
    }

    /**
     * Export a PRC examination to CSV.
     */
    public function exportExcel($id)
    {
        $prc = PRC::with('takers')->findOrFail($id);
        $filename = 'PRC_Results_' . $prc->title . '_' . Carbon::parse($prc->exam_date)->format('Ymd') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\""
        ];

        $callback = function () use ($prc) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Examination: ' . $prc->title]);
            fputcsv($handle, ['Date: ' . Carbon::parse($prc->exam_date)->format('F d, Y')]);
            fputcsv($handle, []); // Blank line

            fputcsv($handle, [
                'School',
                'F. Passed', 'F. Fail', 'F. Cond', 'F. Total', 'F. % Passed',
                'R. Passed', 'R. Fail', 'R. Cond', 'R. Total', 'R. % Passed',
                'O. Passed', 'O. Fail', 'O. Cond', 'O. Total', 'O. % Passed'
            ]);

            $takers = $prc->takers()->orderBy('school', 'asc')->get();

            // Initialize totals for first and repeat sections
            $total_first_pass = 0;
            $total_first_fail = 0;
            $total_first_cond = 0;
            $total_repeat_pass = 0;
            $total_repeat_fail = 0;
            $total_repeat_cond = 0;

            foreach ($takers as $taker) {
                $first_total = $taker->first_pass + $taker->first_fail + $taker->first_cond;
                $first_percentage = $first_total > 0 ? number_format(($taker->first_pass / $first_total) * 100, 2) . '%' : '0%';

                $repeat_total = $taker->repeat_pass + $taker->repeat_fail + $taker->repeat_cond;
                $repeat_percentage = $repeat_total > 0 ? number_format(($taker->repeat_pass / $repeat_total) * 100, 2) . '%' : '0%';

                $overall_pass = $taker->first_pass + $taker->repeat_pass;
                $overall_fail = $taker->first_fail + $taker->repeat_fail;
                $overall_cond = $taker->first_cond + $taker->repeat_cond;
                $overall_total = $overall_pass + $overall_fail + $overall_cond;
                $overall_percentage = $overall_total > 0 ? number_format(($overall_pass / $overall_total) * 100, 2) . '%' : '0%';

                fputcsv($handle, [
                    $taker->school,
                    $taker->first_pass,
                    $taker->first_fail,
                    $taker->first_cond,
                    $first_total,
                    $first_percentage,
                    $taker->repeat_pass,
                    $taker->repeat_fail,
                    $taker->repeat_cond,
                    $repeat_total,
                    $repeat_percentage,
                    $overall_pass,
                    $overall_fail,
                    $overall_cond,
                    $overall_total,
                    $overall_percentage
                ]);

                // Sum the totals for each column
                $total_first_pass += $taker->first_pass;
                $total_first_fail += $taker->first_fail;
                $total_first_cond += $taker->first_cond;
                $total_repeat_pass += $taker->repeat_pass;
                $total_repeat_fail += $taker->repeat_fail;
                $total_repeat_cond += $taker->repeat_cond;
            }

            // Calculate totals for each section
            $total_first_total = $total_first_pass + $total_first_fail + $total_first_cond;
            $total_repeat_total = $total_repeat_pass + $total_repeat_fail + $total_repeat_cond;
            $total_overall_pass = $total_first_pass + $total_repeat_pass;
            $total_overall_fail = $total_first_fail + $total_repeat_fail;
            $total_overall_cond = $total_first_cond + $total_repeat_cond;
            $total_overall_total = $total_overall_pass + $total_overall_fail + $total_overall_cond;

            // Compute overall percentages from the totals
            $total_first_percentage = $total_first_total > 0 ? number_format(($total_first_pass / $total_first_total) * 100, 2) . '%' : '0%';
            $total_repeat_percentage = $total_repeat_total > 0 ? number_format(($total_repeat_pass / $total_repeat_total) * 100, 2) . '%' : '0%';
            $total_overall_percentage = $total_overall_total > 0 ? number_format(($total_overall_pass / $total_overall_total) * 100, 2) . '%' : '0%';

            // Add a blank line then the Overall Total row
            fputcsv($handle, []);
            fputcsv($handle, [
                'Overall Total',
                $total_first_pass,
                $total_first_fail,
                $total_first_cond,
                $total_first_total,
                $total_first_percentage,
                $total_repeat_pass,
                $total_repeat_fail,
                $total_repeat_cond,
                $total_repeat_total,
                $total_repeat_percentage,
                $total_overall_pass,
                $total_overall_fail,
                $total_overall_cond,
                $total_overall_total,
                $total_overall_percentage
            ]);

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, $headers);
    }

}
