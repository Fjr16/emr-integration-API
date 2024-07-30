<?php

namespace App\Http\Controllers;

use App\Exports\LabPatologiKlinikExport;
use App\Models\LaboratoriumRequest;
use App\Models\Patient;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportPenunjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPk()
    {
        $data = Patient::all();
        return view('pages.laporanPenunjangPK.index', [
            'menu' => 'Laporan',
            'title' => 'Laporan Lab Pk',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPk($id)
    {
        $item = Patient::find($id);
        $data = LaboratoriumRequest::where('patient_id', $item->id)->where('status', 'VALIDATED')->get();
        return view('pages.laporanPenunjangPK.show', [
            'title' => 'Laporan Lab Pk',
            'menu' => 'Laporan',
            'item' => $item,
            'data' => $data
        ]);
    }

    public function exportExcelPk($id)
    {
        return Excel::download(new LabPatologiKlinikExport($id), 'riwayat-pemeriksaan-PK.xlsx');
    }
}
