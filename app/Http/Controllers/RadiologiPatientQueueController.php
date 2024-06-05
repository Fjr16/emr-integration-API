<?php

namespace App\Http\Controllers;

use App\Models\DetailKasirPatient;
use App\Models\KasirPatient;
use App\Models\RadiologiFormRequestMasterRate;
use Illuminate\Http\Request;
use App\Models\RadiologiPatient;
use Illuminate\Support\Facades\Auth;
use App\Models\RadiologiPatientRequestDetail;

class RadiologiPatientQueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date('Y-m-d');
        $filter = request('filter', $today);
        $data = RadiologiPatient::whereDate('tanggal_periksa', $filter)->get();
        return view('pages.pasienRadiologiList.index', [
            "title" => "Antrian Radiologi",
            "menu" => "Radiologi",
            'data' => $data,
            'filter' => $filter,
            'today' => $today,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $today = date('Y-m-d');
        $item = RadiologiPatient::find($id);
        return view('pages.pasienRadiologiList.create', [
            "title" => "Antrian Radiologi",
            "menu" => "Radiologi",
            'item' => $item,
            'today' => $today
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
        $item = RadiologiPatient::find($id);
        $tanggal = $request->input('tanggal');
        $lastQueue = RadiologiPatient::whereDate('tanggal_periksa', $tanggal)->orderBy('no_antrian', 'desc')->first();
        $nextQueue = $lastQueue ? $lastQueue->no_antrian + 1 : 1;
        $item->update([
            'no_antrian' => $nextQueue,
            'tanggal_periksa' => $tanggal,
        ]);

        $patientCategoryId = $item->queue->patientCategory->id ?? '';
        if($patientCategoryId){
            $kasirPatient = KasirPatient::where('rawat_jalan_patient_id', $item->queue->rawatJalanPatient->id)->first();
            if($kasirPatient){
                $total = $kasirPatient->total;
                foreach ($item->radiologiPatientRequestDetails as $detail) {
                    $tarif = RadiologiFormRequestMasterRate::where('radiologi_form_request_master_id', $detail->radiologiFormRequestDetail->radiologiFormRequestMaster->id)->where('patient_category_id', $patientCategoryId)->first();
                    DetailKasirPatient::create([
                        'kasir_patient_id' => $kasirPatient->id,
                        'name' => $detail->radiologiFormRequestDetail->radiologiFormRequestMaster->name,
                        'tanggal' => date('Y-m-d H:i:s'),
                        'category' => 'Pemeriksaan Radiologi',
                        'jumlah' => 1,
                        'tarif' => $tarif->tarif_umum ?? 0,
                    ]);
                    $total += $tarif->tarif_umum ?? 0;
                }
                $kasirPatient->update([
                    'total' => $total,
                ]);
            }else{
                $total = 0;
                $itemKasirPatient =  KasirPatient::create([
                    'rawat_jalan_patient_id' => $item->queue->rawatJalanPatient->id,
                    'total' => $total,
                    'status' => 'PENDING',
                ]);
                foreach ($item->radiologiPatientRequestDetails as $detail) {
                    $tarif = RadiologiFormRequestMasterRate::where('radiologi_form_request_master_id', $detail->radiologiFormRequestDetail->radiologiFormRequestMaster->id)->where('patient_category_id', $patientCategoryId)->first();
                    DetailKasirPatient::create([
                        'kasir_patient_id' => $itemKasirPatient->id,
                        'name' => $detail->radiologiFormRequestDetail->radiologiFormRequestMaster->name,
                        'tanggal' => date('Y-m-d H:i:s'),
                        'category' => 'Pemeriksaan Radiologi',
                        'jumlah' => 1,
                        'tarif' => $tarif->tarif_umum ?? 0,
                    ]);
                    $total += $tarif->tarif_umum ?? 0; 
                }
                $itemKasirPatient->update([
                    'total' => $total,
                ]);
            }
        }

        return back()->with('success', 'Berhasil Memperbarui Antrian');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $item = RadiologiPatient::find($id);
        $checkRequestStatus = RadiologiPatientRequestDetail::where('radiologi_patient_id', $item->id)
                                ->where('status', 'WAITING')->get();

        if($checkRequestStatus->isEmpty()){
            $item->update([
                'status' => 'VALIDATED',
                'user_id' => Auth::user()->id,
            ]); 
            return back()->with('success', 'Berhasil divalidasi');
        }
        return back()->with('error', 'Gagal !! Mohon Lengkapi Data Hasil Pemeriksaan');
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
