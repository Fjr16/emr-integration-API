<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Queue;
use Illuminate\Http\Request;
use App\Models\CpptKemoterapi;
use App\Models\KemoterapiDiagnosisKeperawatanPatient;
use App\Models\KemoterapiPatient;
use App\Models\KemoterapiPersetujuan;
use App\Models\KemoterapiSbpkPatient;
use App\Models\KemoterapiDischargeSummary;
use App\Models\KemoterapiTindakanPelayananPatient;
use App\Models\KemoterapiMonitoringResikoJatuhPatient;

class KemoterapiPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KemoterapiPatient::where('status', 'WAITING')->get();
        return view('pages.kemoterapiPatient.index', [
            'menu' => 'Kemoterapi',
            'title' => 'Pasien Kemo',
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
    public function show($id)
    {
        $item = KemoterapiPatient::find($id);
        $tanggal_lhr = new DateTime($item->queue->patient->tanggal_lhr);
        $today = new DateTime();
        $usia = $tanggal_lhr->diff($today)->y;
        $kemoterapiSbpk = KemoterapiSbpkPatient::where('patient_id',$item->queue->patient->id)->get();
        $kemoterapiPersetujuan = KemoterapiPersetujuan::where('patient_id',$item->queue->patient->id)->get();
        $kemoterapiMonitoringResikoJatuh = KemoterapiMonitoringResikoJatuhPatient::where('patient_id', $item->queue->patient->id)->get();
        $discharges = KemoterapiDischargeSummary::where('patient_id', $item->queue->patient->id)->get();
        $cpptKemoterapi = CpptKemoterapi::where('patient_id', $item->queue->patient->id)->get();
       $data = KemoterapiDiagnosisKeperawatanPatient::where('patient_id', $item->queue->patient->id)->get();
        // $dataass =
        return view('pages.kemoterapiPatient.show', [
            'menu' => 'Kemoterapi',
            'title' => 'Pasien Kemo',
            'item' => $item,
            "usia" => $usia,
            'kemoterapiSbpk' => $kemoterapiSbpk,
            'kemoterapiPersetujuan' => $kemoterapiPersetujuan,
            'kemoterapiMonitoringResikoJatuh' => $kemoterapiMonitoringResikoJatuh,
            'discharges' => $discharges,
            'cpptKemoterapi' => $cpptKemoterapi,
            'data' => $data
          
        ]);
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
