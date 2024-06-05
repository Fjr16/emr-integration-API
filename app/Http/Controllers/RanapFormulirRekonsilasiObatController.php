<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Medicine;
use App\Models\RanapFormRekonsiliasiDetailMedicine;
use App\Models\RanapFormRekonsiliasiDetailVisite;
use App\Models\RanapFormRekonsiliasiMedicine;
use App\Models\RoomDetail;
use Illuminate\Http\Request;
use App\Models\RawatInapPatient;

class RanapFormulirRekonsilasiObatController extends Controller
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
        return view('pages.formulirRekonsiliasiObat.index', [
            "title" => "Formulir Rekonsiliasi Obat",
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
        $data = Medicine::all();
        $rooms = RoomDetail::where('isActive', true)->get();
        return view('pages.formulirRekonsiliasiObat.create', [
            "title" => "Formulir Rekonsiliasi Obat",
            "menu" => "Rawat Inap",
            'item' => $item,
            'data' => $data,
            'rooms' => $rooms,
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
        $rawatInapPatient = RawatInapPatient::find($id);
        $patient_id = $rawatInapPatient->queue->patient->id;

        $isAlergi = $request->input('isAlergiObat');
        $isMinumObat = $request->input('isMinumObat');
        $intruksi = $request->input('intruksi');
        $nm_dokter = $request->input('nama_dokter');
        $ttd_dokter = $request->input('ttd_dokter');
        $nm_apoteker = $request->input('nama_apoteker');
        $ttd_apoteker = $request->input('ttd_apoteker');
        $tgl = $request->input('tgl');
        $mainTb = RanapFormRekonsiliasiMedicine::create([
            'rawat_inap_patient_id' => $rawatInapPatient->id,
            'patient_id' => $patient_id,
            'isAlergi' => $isAlergi,
            'isInUseMedicine' => $isMinumObat,
            'intruksi' => $intruksi,
            'nama_dokter' => $nm_dokter,
            'ttd_dokter' => $ttd_dokter,
            'nama_apoteker' => $nm_apoteker,
            'ttd_apoteker' => $ttd_apoteker,
            'tanggal' => $tgl,
        ]);

        $arrTgl = $request->input('tanggal', []);
        $arrMedicine = $request->input('medicine_id', []);
        $arrFrekuensi = $request->input('frekuensi', []);
        $arrRute = $request->input('rute', []);
        $arrRuangTf1 = $request->input('ruang_tf_1', []);
        $arrRuangTf2 = $request->input('ruang_tf_2', []);
        $arrRuangTf3 = $request->input('ruang_tf_3', []);
        // $arrIsAdmisi = $request->input('', []);

        $data = [];
        foreach ($arrMedicine as $index => $medicineId) {
            $data['tanggal'][] = $arrTgl[$index];
            $data['medicine_id'][] = $medicineId;
            $data['frekuensi'][] = $arrFrekuensi[$index];
            $data['rute'][] = $arrRute[$index];
            $data['ruangTf1'][] = $arrRuangTf1[$index];
            $data['isTransfer1'][] = $request->input('tf1_' . $index);
            $data['ruangTf2'][] = $arrRuangTf2[$index];
            $data['isTransfer2'][] = $request->input('tf2_' . $index);
            $data['ruangTf3'][] = $arrRuangTf3[$index];
            $data['isTransfer3'][] = $request->input('tf3_' . $index);
            $data['isPulang'][] = $request->input('saat_pulang_' . $index);
        }

        foreach ($data['medicine_id'] as $index => $medicineId) {
            RanapFormRekonsiliasiDetailMedicine::create([
                'ranap_form_rekonsiliasi_medicine_id' => $mainTb->id,
                'medicine_id' => $medicineId,
                'frekuensi' => $data['frekuensi'][$index],
                'rute' => $data['rute'][$index],
                // 'isAdmisi' => $data['isAdmisi'][$index] ?? '',
                'ruangTf1' => $data['ruangTf1'][$index],
                'isTransfer1' => $data['isTransfer1'][$index],
                'ruangTf2' => $data['ruangTf2'][$index],
                'isTransfer2' => $data['isTransfer2'][$index],
                'ruangTf3' => $data['ruangTf3'][$index],
                'isTransfer3' => $data['isTransfer3'][$index],
                'isPulang' => $data['isPulang'][$index],
                'tanggal' => $data['tanggal'][$index],
            ]);
        }


        $visiteTanggal = $request->input('tanggal_visite', []);
        $visiteKeterangan = $request->input('ket_visite', []);
        foreach ($visiteTanggal as $key => $tglVisite) {
            RanapFormRekonsiliasiDetailVisite::create([
                'ranap_form_rekonsiliasi_medicine_id' => $mainTb->id,
                'tanggal' => $tglVisite,
                'keterangan' => $visiteKeterangan[$key],
            ]);
        }

        return redirect()->route('formulir/rekonsilasi/obat.index')->with('success', 'Berhasil Ditambahkan');
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
