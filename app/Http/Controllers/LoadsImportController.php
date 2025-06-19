<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\Employee;
use App\Models\Loads;
use App\Models\LoadsImport;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LoadsImportController extends Controller
{
    /**
     * Check if a load import entry already exists.
     *
     * @param int $uid
     * @param int|null $sid
     * @param string $cid
     * @return bool
     */
    protected function duplicate_exists($uid, $sid, $cid)
    { 
        return LoadsImport::where('emp_id', $uid)
                         ->where('subj_id', $sid)
                         ->where('class_code', $cid)
                         ->exists();
    }

    /**
     * Display the import form.
     *
     * @return \Illuminate\View\View
     */
    public function show_import_form()
    {
        return view('manage-emps.loads.import.upload')->with([
            'imported' => false
        ]);
    }

    /**
     * Import teaching loads from an uploaded Excel file.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function import_file(Request $request)
    { 
        // Validate the uploaded file
        $request->validate([ 
            'file' => 'required|mimes:xlsx,xls'
        ]);

        // Clear previous imports
        LoadsImport::truncate();

        if ($request->hasFile('file')) { 
            $file = $request->file('file'); 
            $spreadsheet = IOFactory::load($file->getRealPath()); 
            $sheet = $spreadsheet->getActiveSheet(); 

            // Get the school year and semester 
            $sy_part1 = trim($sheet->getCell('N3')->getValue());
            $sy_part2 = trim($sheet->getCell('O3')->getValue());
            $sy = ($sy_part1 && $sy_part2) ? "{$sy_part1}-{$sy_part2}" : null;
            $sem = trim($sheet->getCell('M3')->getValue());

            $errors = []; // Initialize main errors array
            $data_found = false; // Flag to check if any data rows are found

            $startingRow = 8;
            $highestRow = $sheet->getHighestRow();

            // Validate Semester and School Year
            if (empty($sem) || empty($sy)) {
                if (empty($sem)) {
                    $errors[] = 'Semester (cell M3) is missing.';
                }
                if (empty($sy)) {
                    $errors[] = 'School Year (cells N3 and O3) is missing.';
                }
                // Continue processing data rows to collect their errors
            }

            // Check if starting row is beyond the highest row
            if ($startingRow > $highestRow) {
                $errors[] = 'The uploaded file contains no data starting from the specified row.';
                // Decide whether to process data rows or not
                // For now, proceed to collect header errors only
            }

            // Process data rows regardless of 'sem' and 'sy' presence
            if ($startingRow <= $highestRow) {
                for ($rowNum = $startingRow; $rowNum <= $highestRow; $rowNum++) {
                    $row = $sheet->getRowIterator($rowNum)->current();
                    if (!$row) {
                        continue;
                    }

                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(true);

                    $rowData = [];
                    foreach ($cellIterator as $cell) {
                        $column = $cell->getColumn();
                        $cellValue = trim($cell->getValue());
                        if (!empty($cellValue)) {
                            if (in_array($column, ['A', 'B', 'C', 'D','E'])) {
                                $rowData[$column] = $cellValue;
                            }
                        }
                    }

                    $rowErrors = []; // Initialize per row

                    // Ensure all required columns are present
                    if (isset($rowData['A'], $rowData['B'], $rowData['C'], $rowData['D'], $rowData['E'])) {
                        $data_found = true; // Data row found
                        $uid = $rowData['A'];
                        $scode = $rowData['C'];
                        $ccode = $rowData['D'];
                        $cdept = $rowData['E'];

                        // Check if Subject Code exists
                        $subject = Subjects::where('subj_code', $scode)->first();
                        if (!$subject) {
                            $rowErrors[] = "Row {$rowNum}, Subject Code '{$scode}' does not exist.";
                        }

                        // Check if Department exists
                        $classDept = Departments::where('code', $cdept)->first();
                        if (!$classDept) {
                            $rowErrors[] = "Row {$rowNum}, Department '{$cdept}' does not exist. Please double check if the Department ID matches the registry.";
                        }


                        // Check if Class Code is already in use for the same subject and semester, only if 'sem' and 'sy' are present
                        if (!empty($sem) && !empty($sy) && $subject) {
                            $is_class_code_used = Loads::where('class_code', $ccode)
                                                     ->where('semester', $sem)
                                                     ->where('sy', $sy)
                                                     ->exists();
                            if ($is_class_code_used) {
                                $rowErrors[] = "Row {$rowNum}, Class Code '{$ccode}' already exists.";
                            }
                        } 

                        // Validate Employee ID existence
                        $employee = Employee::where('emp_id', $uid)->first();
                        if (!$employee) {
                            $rowErrors[] = "Row {$rowNum}, Employee ID '{$uid}' does not exist.";
                        }

                        // Check for duplicate load imports
                        if ($subject) { // Ensure $subject is not null before accessing subj_id
                            if (!empty($sem) && !empty($sy)) {
                                if (!$this->duplicate_exists($uid, $subject->subj_id, $ccode)) {
                                    // No duplicate exists, proceed
                                } else {
                                    // Duplicate exists
                                    $subject_id_display = $subject->subj_id ?? 'N/A';
                                    $rowErrors[] = "Row {$rowNum}, Duplicate entry for Employee ID '{$uid}', Subject ID '{$subject_id_display}', and Class Code '{$ccode}'.";
                                }
                            }
                        }

                        // If no errors for this row, save the data, only if 'sy' and 'sem' are present
                        if (empty($rowErrors) && $subject && !empty($sem) && !empty($sy)) {
                            LoadsImport::create([
                                'emp_id'    => $uid,
                                'subj_id'   => $subject->subj_id,
                                'class_code'=> $ccode,
                                'class_dept'=> $cdept,
                                'added_by'  => FacadesAuth::user()->id,
                                'sy'        => $sy,
                                'semester'  => $sem
                            ]);
                        }
                    } else {
                        $rowErrors[] = "Row {$rowNum} is missing required data.";
                    }

                    if (!empty($rowErrors)) {
                        $errors = array_merge($errors, $rowErrors);
                    }
                }
            }

            // After processing, check if there were errors
            if (!empty($errors)) {
                return view('manage-emps.loads.import.upload')->with([
                    'import_errors' => $errors,
                    'imported' => false
                ]);
            }

            // Else, proceed to view with data
            return view('manage-emps.loads.import.upload')->with([ 
                'loads'        => LoadsImport::all(),
                'imported'     => true
            ]); 
        }

    }


    /**
     * Upload the imported loads to the main Loads table.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload_file()
    { 
        $loads = LoadsImport::all(); 

        foreach ($loads as $load) { 
            if (!Loads::where('emp_id', $load->emp_id)
                      ->where('subj_id', $load->subj_id)
                      ->where('class_code', $load->class_code)
                      ->where('class_dept', $load->class_dept)
                      ->where('semester', $load->semester) 
                      ->where('sy', $load->sy)
                      ->exists()) { 
                Loads::create([ 
                    'emp_id'    => $load->emp_id,
                    'subj_id'   => $load->subj_id, 
                    'class_code'=> $load->class_code,
                    'class_dept'=> $load->class_dept,  
                    'sy'        => $load->sy, 
                    'semester'  => $load->semester, 
                    'added_by'  => $load->added_by
                ]); 
            }
        }

        // Clear the import table after uploading
        LoadsImport::truncate();

        return redirect()->route('admin.loads.search')->with('success', 'Teaching loads have been successfully added.');
    }
}