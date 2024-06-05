<?php

namespace App\Http\Controllers;

use App\Models\CpptRanap;
use App\Models\RanapCpptAlihRawatPatient;
use App\Models\RawatInapPatient;
use App\Models\User;
use Illuminate\Http\Request;

class RanapAlihRawatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = RawatInapPatient::find($id);
        $today = date('Y-m-d H:i:s');
        $dokters = User::where('isDokter', true)->get();
        return view('pages.alihRawat.create', [
            'title' => 'Rawat Inap',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'today' => $today,
            'dokters' => $dokters,
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
        $item = RawatInapPatient::find($id);
        $dataCppt = [
            'rawat_inap_patient_id' => $item->id,
            'user_id' => auth()->user()->id,
            'patient_id' => $item->queue->patient->id,
            'soap' => null,
            'intruksi' => null,
            'tipe_cppt' => 'ALIH RAWAT',
            'ttd_user' => $request->input('ttd_user'),
            'tanggal_dpjp' => null,
            'ttd_dpjp' => null,
        ];
        $itemRanap = CpptRanap::create($dataCppt);
        $dataAlihRawat = [
            'cppt_ranap_id' => $itemRanap->id,
            'user_id' => $request->input('user_id'),
            'ttd_user' => null,
            'tanggal' => null,
        ];
        RanapCpptAlihRawatPatient::create($dataAlihRawat);

        return redirect()->route('rawat/inap.show', $item->id)->with([
            'success' => 'Berhasil Diajukan',
            'btn' => 'cppt',
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
