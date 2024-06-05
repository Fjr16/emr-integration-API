<?php

namespace App\Http\Controllers;

use App\Models\RanapEwsAnakPatient;
use Illuminate\Http\Request;
use App\Models\RawatInapPatient;
use DateTime;
use Illuminate\Support\Facades\Auth;

class RanapEwsAnakPatientController extends Controller
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
        return view('pages.ranapEwsAnak.create', [
            "title" => "EWS",
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
        $item = RawatInapPatient::find($id);
        $data = $request->all();
        $data['rawat_inap_patient_id'] = $item->id;
        $data['patient_id'] = $item->queue->patient->id;
        $data['user_id'] = Auth::user()->id;
        RanapEwsAnakPatient::create($data);

        return redirect()->route('rawat/inap.show', $item->id)->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'ews'
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
        $item = RawatInapPatient::find($id);
        return view('pages.ranapEwsAnak.show', [
            "title" => "EWS",
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
        $item = RanapEwsAnakPatient::find($id);
        $jam = new DateTime($item->jam);
        $arrOpt = [
            '0',
            '1',
            '2',
            '3',
        ];
        return view('pages.ranapEwsAnak.edit', [
            "title" => "EWS",
            "menu" => "Rawat Inap",
            "item" => $item,
            "jam" => $jam,
            "arrOpt" => $arrOpt,
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
        $item = RanapEwsAnakPatient::find($id);
        $data = $request->all();
        $item->update($data);

        return redirect()->route('rawat/inap.show', $item->rawatInapPatient->id)->with([
            'success' => 'Berhasil Diperbarui',
            'btn' => 'ews'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = RanapEwsAnakPatient::find($id);
        $item->delete();

        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'ews'
        ]);
    }
}
