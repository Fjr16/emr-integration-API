<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\RanapDetailEdukasiPraAnestesiPatient;
use App\Models\RanapEdukasiPraAnestesiPatient;
use Illuminate\Http\Request;
use App\Models\RawatInapPatient;
use DateTime;
use Illuminate\Support\Facades\Auth;

class RanapEdukasiPasienPraAnestesiController extends Controller
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
        return view('pages.informasiPraAnestesi.index', [
            "title" => "Edukasi Pasien Pra Anestesi",
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
        $today = new DateTime();
        $tglLhr = new DateTime($item->queue->patient->tanggal_lhr);
        $umur = $tglLhr->diff($today)->y;
        return view('pages.informasiPraAnestesi.create', [
            "title" => "Edukasi Pasien Pra Anestesi",
            "menu" => "Rawat Inap",
            "item" => $item,
            "umur" => $umur
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

        $arrChecked = $request->input('anestesiCheck', []);
        $tgl = $request->input('tanggal');
        $renc_tind = $request->input('rencana_tindakan');
        $jenis_anestesi = $request->input('jenis_anestesi');

        $mainTb = RanapEdukasiPraAnestesiPatient::create([
            'rawat_inap_patient_id' => $item->id,
            'patient_id' => $item->queue->patient->id,
            'user_id' => Auth::user()->id,
            'tgl' => $tgl,
            'rencana_tindakan' => $renc_tind,
            'jenis_anestesi' => $jenis_anestesi,
        ]);

        foreach ($arrChecked as $name) {
            RanapDetailEdukasiPraAnestesiPatient::create([
                'ranap_edukasi_pra_anestesi_patient_id' => $mainTb->id,
                'name' => $name,
            ]);
        }

        return redirect()->route('edukasi/pasien/pra/anestesi.index')->with('success', 'Berhasil Ditambahkan');
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
