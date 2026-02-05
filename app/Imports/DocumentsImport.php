<?php

namespace App\Imports;

use App\Models\IsoMasterDocument;
use App\Helpers\IsoManagement\OfficeMapper;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class DocumentsImport implements ToCollection, WithHeadingRow
{
    protected $imported = 0;
    protected $errors = [];

    public function collection(Collection $rows){
        // Import all originals first
        foreach ($rows as $index => $row){
            $rowNumber = $index + 2; //+2 becuase: 0-indexed + header row

            if ((int)$row['current_revision'] === 0){
                try{
                    $this->importRow($row, $rowNumber);
                    $this->imported++;
                } catch (\Exception $e){
                    $this->errors[] = "Row {$rowNumber}: " . $e->getMessage();
                }
            }
        }

        // Import all revisions
        foreach ($rows as $index => $row){
            $rowNumber = $index + 2;

            if((int)$row['current_revision'] > 0){
                try{
                    $this->importRow($row, $rowNumber);
                    $this->imported++;
                }catch (\Exception $e){
                    $this->errors[] = "Row {$rowNumber}: " . $e->getMessage();
                }
            }
        }

        // Import all Deletions
        foreach($rows as $index => $row){
            $rowNumber = $index + 2;
            if($row['status'] === 'Deleted'){
                try {
                    $this->importDeletion($row, $rowNumber);
                    $this->imported++;
                } catch (\Exception $e){
                    $this->errors[] = "Row {$rowNumber}: " . $e->getMessage();
                }
            }
        }

        if(!empty($this->errors)) {
            throw new \Exception(implode("\n", $this->errors));
        }
    }

    protected function importRow($row, $rowNumber){
        $isOriginal = (int)$row['current_revision'] === 0;
        $originalDocId = null;

        if(!$isOriginal){
            $original = IsoMasterDocument::where('document_code', $row['document_code'])
                                        ->where('current_revision', 0)
                                        ->first();
            if (!$original){
                throw new \Exception("Revision requires original document with code {$row['document_code']} to exist first.");
            }
            $originalDocId = $original->id;
        }
        $originatingSection = OfficeMapper::map($row['originating_section']);

        $registeredAt = !empty($row['registered_at'])
                        ? Carbon::parse($row['registered_at'])
                        : now();
        $supersededAt = !empty($row['superseded_at'])
                        ? Carbon::parse($row['superseded_at'])
                        : null;
        $deletedAt = !empty($row['deleted_at'])
                    ?Carbon::parse($row['deleted_at'])
                    : null;
        IsoMasterDocument::create([
            'document_code' => $row['document_code'],
            'document_title' => $row['document_title'],
            'source_type' => $row['source_type'],
            'specific_type' => $row['specific_type'] ?? null,
            'originating_section' => $originatingSection,
            'current_revision' => (int)$row['current_revision'],
            'is_original' => $isOriginal,
            'original_document_id' => $originalDocId,
            'status' => $row['status'] ?? 'Active',
            'registered_at' => $registeredAt,
            'superseded_at' => $supersededAt,
            'deleted_at' => $deletedAt,
            'source' => 'excel',
            'ticket_id' => null,
            'ticket_document_id' => null,
        ]);
    }

    public function importDeletion($row, $rowNumber){
        // Find the document to delete
        $docToDelete = IsoMasterDocument::where('document_code', $row['document_code'])
                                        ->where('current_revision', (int)$row['current_revision'])
                                        ->first();
        if(!$docToDelete){
            throw new \Exception("Cannot delete document {$row['document_code']} rev: {$row['current_revision']} - document doesn't exit or is already deleted.");
        }

        // Mark original as superseded
        $docToDelete->update([
            'status' => 'Superseded',
            'superseded_at' => now()
        ]);
        // Map originating section
        $originatingSection = OfficeMapper::map($row['originating_section']);

        // Create deletion record audit
        $deletedAt = !empty($row['deleted_at'])
                ? Carbon:: parse($row['deleted_at'])
                : now();
        IsoMasterDocument::create([
            'document_code' => $docToDelete->document_code,
            'document_title' => $docToDelete->document_title . ' (DELETED)',
            'source_type' => $docToDelete->source_type,
            'specific_type' => $docToDelete->specific_type,
            'originating_section' => $originatingSection,
            'current_revision' => $docToDelete->current_revision,
            'is_original' => false,
            'original_document_id' => $docToDelete->original_document_id ?? $docToDelete->id,
            'status' => 'Deleted',
            'registered_at' => $docToDelete->registered_at,
            'deleted_at' => $deletedAt,
            'source' => 'excel',
            'ticket_id' => null,
            'ticket_document_id' => null,
        ]);
    }

    public function getImportedCount(){
        return $this->imported;
    }

}
