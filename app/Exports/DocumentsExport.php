<?php

namespace App\Exports;

use App\Models\IsoMasterDocument;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DocumentsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $filters;
    
    public function __construct($filters = []){
        $this->filters = $filters;
    }

    public function collection(){
        $query = IsoMasterDocument::query();

        if(!empty($this->filters['source_type'])){
            $query->whereIn('source_type', $this->filters['source_type']);
        }

        if(!empty($this->filters['originating_section'])){
            $query->whereIn('originating_section', $this->filters['originating_section']); // There are a lot of originating_sections
        }

        if(!empty($this->filters['revision_status'])){
            if($this->filters['revision_status'] === 'original_only'){
                $query->where('is_original', true);
            } elseif ($this->filters['revision_status'] === 'has_revisions'){
                $query->where('is_original', false);
            }
        }

        // Apply status filter if present
        if(!empty($this->filters['status'])){
            $query->whereIn('status', $this->filters['status']);
        }
        return $query->orderBy('document_code')->get();
    }

    public function headings(): array{
        return[
            'document_code',
            'document_title',
            'source_type',
            'specific_type',
            'originating_section',
            'current_revision',
            'registered_at',
            'status',
            'superseded_at',
            'deleted_at',
        ];
    }

    public function map($document): array{
        return[
            $document->document_code,
            $document->document_title,
            $document->source_type,
            $document->specific_type,
            $document->originating_section,
            $document->current_revision,
            $document->registered_at ? $document->registered_at->format('Y-m-d') : '',
            $document->status,
            $document->superseded_at ? $document->superseded_at->format('Y-m-d') : '',
            $document->deleted_at ? $document->deleted_at->format('Y-m-d') : '',
        ];
    }

    public function styles(Worksheet $sheet){
        return[
            1 => ['font' => ['bold' => true, 'size' => 12]]
        ];
    }
}
