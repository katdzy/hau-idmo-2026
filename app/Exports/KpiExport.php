<?php

namespace App\Exports;

use App\Models\Kpi;
use App\Exports\Sheets\KpiSheet;
use App\Exports\Sheets\KpiListSheet;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class KpiExport implements WithMultipleSheets
{
    protected $kpi;

    public function __construct($kpi = null)
    {
        $this->kpi = $kpi;
    }

    public function sheets(): array
    {
        if ($this->kpi === null) {
            return collect(Kpi::all())
                ->map(fn ($kpi) => new KpiSheet($kpi, true))
                ->prepend(new KpiListSheet)
                ->values()
                ->all();
        }

        return [
            new KpiSheet($this->kpi),
        ];
    }
}

