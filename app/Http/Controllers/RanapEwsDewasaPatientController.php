<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\RanapAsesMoniStatusFungsionalPatient;
use App\Models\RanapEwsDewasaPatient;
use App\Models\RawatInapPatient;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RanapEwsDewasaPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient')->get();
        return view('pages.ranapEwsDewasa.index', [
            "title" => "EWS",
            "menu" => "Rawat Inap",
            'data' => $data,
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
        return view('pages.ranapEwsDewasa.create', [
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
        RanapEwsDewasaPatient::create($data);

        return redirect()->route('ews/dewasa.detail', $item->id)->with([
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
        return view('pages.ranapEwsDewasa.show', [
            "title" => "EWS",
            "menu" => "Rawat Inap",
            "item" => $item,
        ]);
    }

    public function detail($id)
    {
        $item = RawatInapPatient::find($id);
        $data = RanapEwsDewasaPatient::where('rawat_inap_patient_id', $id)->get();
        return view('pages.ranapEwsDewasa.detail', [
            "title" => "EWS",
            "menu" => "Rawat Inap",
            "item" => $item,
            "data" => $data,
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
        $item = RanapEwsDewasaPatient::find($id);
        $jam = new DateTime($item->jam);
        return view('pages.ranapEwsDewasa.edit', [
            "title" => "EWS",
            "menu" => "Rawat Inap",
            "item" => $item,
            "jam" => $jam,
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
        $item = RanapEwsDewasaPatient::find($id);
        $data = $request->all();
        $item->update($data);

        return redirect()->route('ews/dewasa.detail', $item->rawatInapPatient->id)->with([
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
        $item = RanapEwsDewasaPatient::find($id);
        $item->delete();

        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'ews'
        ]);
    }
}
