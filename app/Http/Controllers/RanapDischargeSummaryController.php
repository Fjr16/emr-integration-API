<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\RanapDetailDiganosaUtamaPatient;
use App\Models\RanapDetailKarmobiditasPatient;
use App\Models\RanapDetailObatDirawatPatient;
use App\Models\RanapDetailObatDirumahPatient;
use App\Models\RanapDetailProsedurTerapiPatient;
use App\Models\RanapDischargeSummary;
use App\Models\RawatInapPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RanapDischargeSummaryController extends Controller
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
        $medicines = Medicine::all();
        $arrKondisiPasien = [
            'Sembuh dan meneruskan dengan rawat jalan',
            'Rujuk',
            'Pulang atas permintaan sendiri (APS)',
            'Meninggal',
        ];
        $arrNextPlace = [
            'RSK Bedah Ropanasuri, Poliklinik:',
            'Puskesmas / Klinik Pratama',
            'Dokter Luar',
            'Rumah Sakit Lain',
        ];
        return view('pages.ranapRingkasanCatatanMedis.index', [
            'title' => 'Rawat Inap',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'arrKondisiPasien' => $arrKondisiPasien,
            'arrNextPlace' => $arrNextPlace,
            'medicines' => $medicines,
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
        //discharge Summary
        $data = [
            'rawat_inap_patient_id' => $item->id,
            'patient_id' => $item->queue->patient->id,
            'user_id' => Auth::user()->id,
            'tanggal_masuk' => $request->input('tanggal_masuk', ''),
            'tanggal_keluar' => $request->input('tanggal_keluar', ''),
            'anamnesis' => $request->input('anamnesis', ''),
            'indikasi' => $request->input('indikasi', ''),
            'riwayat_penyakit' => $request->input('riwayat_penyakit', ''),
            'pemeriksaan_fisik' => $request->input('pemeriksaan_fisik', ''),
            'pemeriksaan_diagnostik' => $request->input('pemeriksaan_diagnostik', ''),
            'kondisi_pasien' => $request->input('kondisi', ''),
            'intruksi' => $request->input('intruksi', ''),
            'tindak_lanjut' => $request->input('tindak_lanjut', ''),
            'dokter_pengirim' => $request->input('dokter_pengirim', ''),
        ];

        $discharge = RanapDischargeSummary::create($data);

        //detail diagnosa
        $diagnosaUtama = $request->input('diagnosa_utama');
        $IcdDiagnosaUtama = $request->input('icdD', []);

        //detail kormobiditas
        $karmobiditas = $request->input('karmobiditas');
        $icdKormobiditas = $request->input('icdK', []);

        //detail terapi
        $terapi = $request->input('terapi');
        $icdTerapi = $request->input('icdT', []);

        //obat selama di rs
        $obatRanap = $request->input('medicine_id_ranap', []);
        $jumlahRanap = $request->input('jumlah_ranap', []);
        $aturanPakaiRanap = $request->input('aturan_pakai_ranap', []);
        $keteranganRanap = $request->input('keterangan_ranap', []);
        $otherRanap = $request->input('other_ranap', []);

        //obat  untuk di rumah
        $obatRumah = $request->input('medicine_id', []);
        $jumlahRumah = $request->input('jumlah', []);
        $aturanPakaiRumah = $request->input('aturan_pakai', []);
        $keteranganRumah = $request->input('keterangan', []);
        $otherRumah = $request->input('other', []);


        foreach ($IcdDiagnosaUtama as $index => $icdD) {
            if ($icdD) {
                RanapDetailDiganosaUtamaPatient::create([
                    'ranap_discharge_summary_id' => $discharge->id,
                    'diagnosa_utama' => $diagnosaUtama,
                    'icd' => $icdD,
                ]);
            }
        }
        foreach ($icdKormobiditas as $index => $icdK) {
            if ($icdK) {
                RanapDetailKarmobiditasPatient::create([      
                    'ranap_discharge_summary_id' => $discharge->id,
                    'karmobiditas' => $karmobiditas,
                    'icd' => $icdK,
                ]);
            }
        }
        foreach ($icdTerapi as $index => $icdT) {
            if($icdT){
                RanapDetailProsedurTerapiPatient::create([
                    'ranap_discharge_summary_id' => $discharge->id,
                    'terapi' => $terapi,
                    'icd' => $icdT,
                ]);
            }
        }
        foreach ($obatRanap as $index => $medicine_id) {
            RanapDetailObatDirawatPatient::create([
                'ranap_discharge_summary_id' => $discharge->id,
                'medicine_id' => $medicine_id,
                'jumlah' => $jumlahRanap[$index],
                'aturan_pakai' => $aturanPakaiRanap[$index],
                'keterangan' => $keteranganRanap[$index],
                'other' => $otherRanap[$index],
            ]);
        }
        foreach ($obatRumah as $index => $medicine_id) {
            RanapDetailObatDirumahPatient::create([
                'ranap_discharge_summary_id' => $discharge->id,
                'medicine_id' => $medicine_id,
                'jumlah' => $jumlahRumah[$index],
                'aturan_pakai' => $aturanPakaiRumah[$index],
                'keterangan' => $keteranganRumah[$index],
                'other' => $otherRumah[$index],
            ]);
        }

        return redirect()->route('rawat/inap.show', $item->id)->with('success', 'Berhasil Ditambahkan');
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
