<?php

namespace App\Exports;

use App\Models\KasirPatient;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KasirExport implements FromView, WithColumnWidths, WithStyles
{
    use Exportable;
    private $id;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function view(): View
    {
        $item = KasirPatient::find($this->id);
        return view('pages.laporanKasir.exportExcel', [
            "title" => "Laporan Kasir",
            "menu" => "Laporan",
            "item" => $item,
        ]);
    }
    public function columnWidths(): array
    {
        return [
            'A' => 25,  // Lebar untuk kolom 'Tanggungan Obat'
            'B' => 25,  // Lebar untuk kolom 'Nama Obat'
            'C' => 25,  // Lebar untuk kolom 'No Batch'
            'D' => 20,  // Lebar untuk kolom 'Harga Satuan'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $title = 'A1:G1';
        $headerSheets =[
            'A3:A4',
            'C3:C4',
        ]; 
        $rowCount = $sheet->getHighestRow();
        $bodyTable = 'A6:D'. $rowCount;
        // $footerTable = 'A' . $rowCount . ':G' . $rowCount;

        $sheet->getStyle($title)->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'font' => [
                'bold' => true,
                'size' => 14
            ]
        ]);
        foreach ($headerSheets as $headerSheet) {
            $sheet->getStyle($headerSheet)->applyFromArray([
                'font' => [
                    'italic' => true,
                    'bold' => true,
                ]
            ]);
        }
        // $sheet->getStyle($headerTable)->applyFromArray([
        //     'borders' => [
        //         'allBorders' => [
        //             'borderStyle' => Border::BORDER_MEDIUM,
        //             'color' => ['rgb' => '808080'],
        //         ],
        //     ],
        //     'alignment' => [
        //         'horizontal' => Alignment::HORIZONTAL_CENTER,
        //         'vertical' => Alignment::VERTICAL_CENTER,
        //     ],
        //     'font' => ['bold' => true],
        //     'fill' => [
        //         'fillType' => Fill::FILL_SOLID,
        //         'startColor' => ['rgb' => 'FFFF00']
        //     ],
        // ]);
        $sheet->getStyle($bodyTable)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '808080'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        return [
            'B4'=> [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
            ],
        ];
    }
}
