<?php

namespace App\Http\Controllers;

use App\Exports\LabPatologiAnatomiExport;
use App\Exports\LabPatologiKlinikExport;
use App\Exports\RadiologiExport;
use App\Models\LaboratoriumPatientResult;
use App\Models\Patient;
use App\Models\PermintaanLaboratoriumPatologiAnatomikPatient;
use App\Models\RadiologiPatient;
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
        $data = LaboratoriumPatientResult::where('patient_id', $item->id)->where('status', 'VALIDATED')->get();
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexPa()
    {
        $data = Patient::all();
        return view('pages.laporanPenunjangPA.index', [
            'menu' => 'Laporan',
            'title' => 'Laporan Lab PA',
            'data' => $data,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPa($id)
    {
        $item = Patient::find($id);
        $data = PermintaanLaboratoriumPatologiAnatomikPatient::where('patient_id', $item->id)->whereHas('antrianLaboratoriumPatologiAnatomiPatient', function ($query){
            $query->whereHas('detailAntrianLaboratoriumPatologiAnatomiPatient', function ($query2){
                $query2->where('status', 'validated');
            });
        })->get();
        return view('pages.laporanPenunjangPA.show', [
            'title' => 'Laporan Lab PA',
            'menu' => 'Laporan',
            'item' => $item,
            'data' => $data
        ]);
    }

    public function exportExcelPa($id)
    {
        return Excel::download(new LabPatologiAnatomiExport($id), 'riwayat-pemeriksaan-PA.xlsx');
    }
}
