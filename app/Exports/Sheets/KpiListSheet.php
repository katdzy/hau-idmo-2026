<?php

namespace App\Exports\Sheets;

use App\Models\Kpi;

use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KpiListSheet implements WithTitle, WithEvents
{
    protected $categories;
    protected $maxRows;
    protected $kpis;

    public function __construct()
    {
        $this->kpis = Kpi::select('category', 'measure_name', 'measure_code')
            ->get()
            ->groupBy('category');

        $this->categories = $this->kpis->keys()->toArray();
        $this->maxRows = $this->kpis->map->count()->max();
    }

    public function registerEvents(): array
    {
        Sheet::macro('styleHeading', function (Sheet $sheet, string $cellRange) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
            ]);
        });

        Sheet::macro('styleContent', function (Sheet $sheet, string $cellRange,) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                'font' => [
                    'color' => ['rgb' => '0563C1'],
                    'underline' => 'single',
                ],
                'alignment' => [
                    'wrapText' => true,
                ],
            ]);
        });
        
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                foreach (range('A', 'C') as $column) {
                    $sheet->getColumnDimension($column)->setWidth(50);
                }

                for ($row = 1; $row <= $this->maxRows; $row++) {
                    $sheet->getRowDimension($row+1)->setRowHeight(50);
                }

                foreach ($this->categories as $i => $category) {
                    $col = Coordinate::stringFromColumnIndex($i + 1);
                    $event->sheet->styleHeading($col . '1');
                    $sheet->setCellValue($col . '1', strtoupper($category));
                }

                foreach ($this->categories as $colIndex => $category) {
                    $row = 2;

                    foreach ($this->kpis[$category] as $kpi) {
                        $col = Coordinate::stringFromColumnIndex($colIndex + 1);
                        $event->sheet->styleContent($col . $row);
                        $sheet->setCellValue($col . $row, $kpi->measure_name);
                        $sheet->getCell($col . $row)->getHyperlink()->setURL("sheet://'{$kpi->measure_code}'!A1")->setTooltip("Click for KPI Details");
                        $row++;
                    }
                }
            }
        ];
    }

    public function title(): string 
    {
        return 'KPI List';
    }
}
