<?php

namespace App\Exports;

use App\Models\Patient;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class MedicineUsedExport implements FromView,  WithColumnWidths, WithStyles
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
        $item = Patient::find($this->id);
        $data = $item->rajalFarmasiObatInvoices; //rajalInvoiceObatDigantiMenjadi rajalFarmasiPatient
        return view('pages.laporanAkhirObat.exportExcel', [
            'menu' => 'Laporan',
            'title' => 'Laporan Penggunaan Obat',
            'item' => $item,
            'data' => $data,
        ]);
    }
    public function columnWidths(): array
    {
        return [
            'A' => 20,  // Lebar untuk kolom 'Tanggungan Obat'
            'B' => 20,  // Lebar untuk kolom 'Nama Obat'
            'C' => 15,  // Lebar untuk kolom 'No Batch'
            'D' => 15,  // Lebar untuk kolom 'Harga Satuan'
            'E' => 15,  // Lebar untuk kolom 'Jumlah'
            'F' => 15,  // Lebar untuk kolom 'Total Harga'
            'G' => 15,  // Lebar untuk kolom 'Total Faktur'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $title = 'A1:G1';
        $headerSheets =[
            'A3:A4',
            'E3:E4',
        ]; 
        $rowCount = $sheet->getHighestRow();
        $headerTable = 'A6:G6';
        $bodyTable = 'A7:G'. $rowCount - 1;
        $footerTable = 'A' . $rowCount . ':G' . $rowCount;

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
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
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
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '808080'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        $sheet->getStyle($footerTable)->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFFF99']  // Contoh warna kuning
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '808080'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
     
        // tambahan
        return [
            // css untuk sel-sel tertentu
            'B4:D4' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
            ],
        ];
    }
}
