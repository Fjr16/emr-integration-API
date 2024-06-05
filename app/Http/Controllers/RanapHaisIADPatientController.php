<?php

namespace App\Http\Controllers;

use App\Models\RanapDetailHaisPatient;
use App\Models\RanapHaisPatient;
use App\Models\RawatInapPatient;
use App\Models\RoomDetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RanapHaisIADPatientController extends Controller
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
        $today = new DateTime();
        $roomDetails = RoomDetail::where('isActive', true)->get();

        $kategoris = [
            'Kebersihan tangan',
            'Kelengkapan APD: Satung tangan bersih, apron (k/p), Pelindung wajah (k/p)',
            'Teknik aseptik (peralatan/instrumen steril',
            'Perlak+Pengalas',
            'Antiseptik kulit chlorhexidine 2% - 4%/povidone iodine/alkohol 70%',
            'Slang infus ganti/24 jam (terapi Lipid, Protein)',
            'Slang infus ganti/24 jam (terapi Cairan/Elektrolit)',
            'Observasi rutin area insersi (transparant dressing)',
            'Ganti tempat insersi bila >= 3 hari',
            'Alat suntuk steril sekali pakai (1 obat 1 syringe)',
            'Injeksi via Needle Port',
            'Alkoholisasi Needle Port'
        ];

        return view('pages.ranapPencegahaInfeksiAliranDarah.create', [
            "title" => "Pencegahan HAIs",
            "menu" => "Rawat Inap",
            "item" => $item,
            "today" => $today,
            "roomDetails" => $roomDetails,
            "kategoris" => $kategoris,
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
        $data['user_id'] = Auth::user()->id;
        RanapHaisPatient::create($data);

        $item = RanapHaisPatient::all()->last();
        $kategoris = $request->input('kategori', []);
        $namas = $request->input('nama', []);
        $statuss = $request->input('status', []);
        $kets = $request->input('ket', []);

        for ($i = 0; $i < count($kategoris); $i++) {
            RanapDetailHaisPatient::create([
                'ranap_hais_patient_id' => $item->id,
                'kategori' => $kategoris[$i],
                'nama' => $namas[$i],
                'status' => $statuss[$i],
                'ket' => $kets[$i],
            ]);
        }

        return redirect()->route('hais.detail', $item->rawatInapPatient->queue->patient_id)->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'hais',
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
        $data = RanapHaisPatient::find($id);
        $details = RanapDetailHaisPatient::where('ranap_hais_patient_id', $id)->get();

        return view('pages.ranapPencegahaInfeksiAliranDarah.show', [
            "title" => "HAIs IAD",
            "menu" => "Rawat Inap",
            'data' => $data,
            'details' => $details
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
        $data = RanapHaisPatient::find($id);
        $details = RanapDetailHaisPatient::where('ranap_hais_patient_id', $id)->get();
        $roomDetails = RoomDetail::where('isActive', true)->get();

        return view('pages.ranapPencegahaInfeksiAliranDarah.edit', [
            "title" => "Pencegahan HAIs",
            "menu" => "Rawat Inap",
            'data' => $data,
            'details' => $details,
            'roomDetails' => $roomDetails,
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
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        RanapHaisPatient::find($id)->update($data);
        $item = RanapHaisPatient::find($id);

        $kategoris = $request->input('kategori', []);
        $ids = $request->input('id', []);
        $namas = $request->input('nama', []);
        $statuss = $request->input('status', []);
        $kets = $request->input('ket', []);

        $total = $request->id_akhir - count($kategoris) + 1;

        for ($i = $total; $i < $request->id_akhir; $i++) {
            RanapDetailHaisPatient::find($ids[$i])->update([
                'kategori' => $kategoris[$i],
                'nama' => $namas[$i],
                'status' => $statuss[$i],
                'ket' => $kets[$i],
            ]);
        }

        return redirect()->route('hais.detail', $item->rawatInapPatient->queue->patient_id)->with([
            'success' => 'Berhasil Diedit',
            'btn' => 'hais',
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
        $data = RanapHaisPatient::find($id);
        RanapDetailHaisPatient::where('ranap_hais_patient_id', $data->id)->delete();
        RanapHaisPatient::find($id)->delete();
        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'hais',
        ]);
    }
}
