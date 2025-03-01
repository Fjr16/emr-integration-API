<?php

namespace App\Http\Controllers;

use App\Exports\KasirExport;
use App\Models\Patient;
use App\Models\KasirPatient;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportCashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Patient::all();
        return view('pages.laporanKasir.index', [
            'menu' => 'Laporan',
            'title' => 'Laporan Kunjungan',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $item = Patient::find($id);
        return view('pages.laporanKasir.detail', [
            "title" => "Laporan Kunjungan",
            "menu" => "Laporan",
            "item" => $item,
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
        $item = KasirPatient::find($id);
        return view('pages.laporanKasir.show', [
            "title" => "Laporan Kunjungan",
            "menu" => "Laporan",
            "item" => $item,
        ]);
    }

    public function exportExcel($id)
    {
        return Excel::download(new KasirExport($id), 'riwayat-kunjungan-pasien.xlsx');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
