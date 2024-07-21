<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Exports\MedicineUsedExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportDrugUsageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Patient::all();
        return view('pages.laporanAkhirObat.index', [
            'menu' => 'Laporan',
            'title' => 'Laporan Penggunaan Obat',
            'data' => $data,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Patient::find($id);
        $data = $item->rajalFarmasiObatInvoices;    //diganti menjadi rajalFarmasiPatient
        return view('pages.laporanAkhirObat.show', [
            'menu' => 'Laporan',
            'title' => 'Laporan Penggunaan Obat',
            'item' => $item,
            'data' => $data,
        ]);
    }
    public function exportExcel($id)
    {
        return Excel::download(new MedicineUsedExport($id), 'laporan-penggunaan-obat.xlsx');
    }
}
