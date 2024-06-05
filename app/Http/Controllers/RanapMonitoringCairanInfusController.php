<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\RanapMonitoringCairanInfusPatient;
use Illuminate\Http\Request;
use App\Models\RawatInapPatient;
use Illuminate\Support\Facades\Auth;

class RanapMonitoringCairanInfusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient', function($query){
            $query->whereNot('status', 'WAITING')->whereNot('status', 'BATAL');
        })->get();
        return view('pages.mentoringCairanInfus.index', [
            "title" => "Monitoring Cairan Infus",
            "menu" => "Rawat Inap",
            "data" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = RawatInapPatient::find($id);
        return view('pages.mentoringCairanInfus.create', [
            "title" => "Monitoring Cairan Infus",
            "menu" => "Rawat Inap",
            "item" => $item,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $tanggal = $request->input('tanggal', []);
        $orderDokter = $request->input('order_dokter', []);
        $jenis = $request->input('jenis', []);
        $botol = $request->input('botol_ke', []);
        $tetes = $request->input('tetes', []);
        $mulai = $request->input('mulai', []);
        $habis = $request->input('habis', []);
        $keterangan = $request->input('keterangan', []);
        
        $item = RawatInapPatient::find($id);
        foreach ($tanggal as $key => $tgl) {
            RanapMonitoringCairanInfusPatient::create([ 
                'rawat_inap_patient_id' => $item->id,
                'patient_id' => $item->queue->patient->id,
                'user_id' => Auth::user()->id,
                'tanggal' => $tgl,
                'order_dokter' => $orderDokter[$key],
                'jenis' => $jenis[$key],
                'botol_ke' => $botol[$key],
                'tetes' => $tetes[$key],
                'mulai' => $mulai[$key],
                'habis' => $habis[$key],
                'keterangan' => $keterangan[$key],
            ]);
        }

        return redirect()->route('monitoring/cairan/infus.index')->with('success', 'Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = RawatInapPatient::find($id);
        return view('pages.mentoringCairanInfus.show', [
            "title" => "Monitoring Cairan Infus",
            "menu" => "Rawat Inap",
            "item" => $item,
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
        $item = RawatInapPatient::find($id);
        return view('pages.mentoringCairanInfus.edit', [
            "title" => "Monitoring Cairan Infus",
            "menu" => "Rawat Inap",
            "item" => $item,
        ]);
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
        $moniIds = $request->input('monitoring_infus_id', []);
        $tanggal = $request->input('tanggal', []);
        $orderDokter = $request->input('order_dokter', []);
        $jenis = $request->input('jenis', []);
        $botol = $request->input('botol_ke', []);
        $tetes = $request->input('tetes', []);
        $mulai = $request->input('mulai', []);
        $habis = $request->input('habis', []);
        $keterangan = $request->input('keterangan', []);
        
        foreach ($moniIds as $key => $moni_id) {
            RanapMonitoringCairanInfusPatient::where('id', $moni_id)->update([ 
                'tanggal' => $tanggal[$key],
                'order_dokter' => $orderDokter[$key],
                'jenis' => $jenis[$key],
                'botol_ke' => $botol[$key],
                'tetes' => $tetes[$key],
                'mulai' => $mulai[$key],
                'habis' => $habis[$key],
                'keterangan' => $keterangan[$key],
            ]);
        }

        return redirect()->route('monitoring/cairan/infus.index')->with('success', 'Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = RanapMonitoringCairanInfusPatient::find($id);
        $item->delete();
        return back()->with('success', 'Berhasil Dihapus');
    }
}
