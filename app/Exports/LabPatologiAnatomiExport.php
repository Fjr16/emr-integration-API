<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\PermintaanLaboratoriumPatologiAnatomikPatient;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LabPatologiAnatomiExport implements FromView, WithColumnWidths, WithStyles
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
        $item = PermintaanLaboratoriumPatologiAnatomikPatient::find($this->id);
        return view('pages.laporanPenunjangPA.exportExcel', [
            'title' => 'Laporan Lab PA',
            'menu' => 'Laporan',
            'item' => $item,
        ]);
    }
    public function columnWidths(): array
    {
        return [
            'A' => 20,  // Lebar untuk kolom 'Tanggungan Obat'
            'B' => 20,  // Lebar untuk kolom 'Nama Obat'
            'C' => 15,  // Lebar untuk kolom 'No Batch'
            'D' => 23,  // Lebar untuk kolom 'Harga Satuan'
            'E' => 15,  // Lebar untuk kolom 'Jumlah'
            'F' => 25,  // Lebar untuk kolom 'Total Harga'
            'G' => 15,  // Lebar untuk kolom 'Total Harga'
            'H' => 20,  // Lebar untuk kolom 'Total Harga'
            'I' => 15,  // Lebar untuk kolom 'Total Harga'
            // 'J' => 15,  
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $title = 'A1:G1';
        $headerSheets =[
            'A3:A4',
            'D3:D4',
            'H3:H4',
        ]; 
        $rowCount = $sheet->getHighestRow();
        $headerTable = 'A6:I6';
        $bodyTable = 'A7:I'. $rowCount;
        // // $footerTable = 'A' . $rowCount . ':G' . $rowCount;

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
        $sheet->getStyle($headerTable)->applyFromArray([
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
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFFF00']
            ],
        ]);
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
        // $sheet->getStyle($footerTable)->applyFromArray([
        //     'font' => ['bold' => true],
        //     'fill' => [
        //         'fillType' => Fill::FILL_SOLID,
        //         'startColor' => ['rgb' => 'FFFF99']  // Contoh warna kuning
        //     ],
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
        // ]);
        return [
            'E4' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
            ],
        ];
    }
}
