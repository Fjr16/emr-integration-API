<?php

namespace App\Http\Controllers;

use App\Models\AsuransiDetailPatient;
use App\Models\AsuransiPatient;
use Illuminate\Http\Request;

class AsuransiDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $item = AsuransiPatient::find($id);
        $data = AsuransiDetailPatient::where('asuransi_patient_id', $id)->get();
        return view('pages.asuransi.detail.index', [
            'data' => $data,
            'item' => $item,
            'title' => 'ASURANSI',
            'menu' => 'KEUANGAN',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = AsuransiPatient::find($id);
        return view('pages.asuransi.detail.create', [
            'item' => $item,
            'title' => 'ASURANSI',
            'menu' => 'KEUANGAN',
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
        $data = $request->all();
        $data['asuransi_patient_id'] = $id;
        AsuransiDetailPatient::create($data);
        return redirect()->route('asuransi/detail.index', $id)->with('success', 'SUKSESSS');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = AsuransiPatient::find($id);
        $rawatInap = AsuransiDetailPatient::where('asuransi_patient_id', $id)->where('category', 'Rawat Inap')->get();
        $rawatJalan = AsuransiDetailPatient::where('asuransi_patient_id', $id)->where('category', 'Rawat Jalan')->get();
        return view('pages.asuransi.lampiran', [
            'rawatInap' => $rawatInap,
            'rawatJalan' => $rawatJalan,
            'item' => $item,
            'title' => 'ASURANSI',
            'menu' => 'KEUANGAN',
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
