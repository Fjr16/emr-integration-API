<?php

namespace App\Http\Controllers;

use App\Models\RanapJawabanKonsulDetailLainnyaPatient;
use App\Models\RanapJawabanKonsulDetailPenemuanPatient;
use App\Models\RanapJawabanKonsulDetailSkriningCovidPatient;
use App\Models\RanapJawabanKonsulPenyakitDalamPatient;
use Illuminate\Http\Request;

class RanapJawabanKonsultasiPenyakitDalamPatientController extends Controller
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
        $arrO = [
            'Keadaan Umum',
            'Kesadaran',
            'Tekanan Darah',
            'Frekuensi Nadi',
            'Frekuensi Napas',
            'suhu',
            'SPO',
        ];
        $arrLainnya = [
            'EKG',
            'LABOR',
            'RO THORAX',
        ];
        $arrSkrining = [
            'Pneunomia',
            'Demam',
            'Suhu',
            'Gender',
            'Usia',
            'Kontak',
            'Simton',
            'NLR',
        ];
        $item = RanapJawabanKonsulPenyakitDalamPatient::find($id);
        return view('pages.ranapJawabanKonsulPenyakitDalam.create', [
            'title' => 'Konsultasi Penyakit Dalam',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'arrO' => $arrO,
            'arrLainnya' => $arrLainnya,
            'arrSkrining' => $arrSkrining,
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
        $item = RanapJawabanKonsulPenyakitDalamPatient::find($id);

        //penemuan
        $dataPenemuanName = $request->input('name_penemuan', []);
        $dataPenemuanValue = $request->input('value_penemuan', []);

        //lainnya
        $dataLainnyaName = $request->input('name_lainnya');
        $dataLainnyaValue = $request->input('value_lainnya');

        //skrining covid
        $dataSkrinName = $request->input('name_skrin');
        $dataSkrinValue = $request->input('value_skrin');

        //jawaban konsul
        $ketPasien = $request->input('ket_pasien');
        $kesimpulan = $request->input('kesimpulan');
        $anjuran = $request->input('anjuran');

        foreach ($dataPenemuanName as $index => $name) {
            RanapJawabanKonsulDetailPenemuanPatient::create([
                'ranap_jawaban_konsul_penyakit_dalam_patient_id' => $item->id,
                'name' => $name,
                'value' => $dataPenemuanValue[$index] ?? '',
                // 'satuan' => $request->input('satuan'),
            ]);
        }

        foreach ($dataLainnyaName as $index => $lainnya) {
            RanapJawabanKonsulDetailLainnyaPatient::create([
                'ranap_jawaban_konsul_penyakit_dalam_patient_id' => $item->id,
                'name' => $lainnya,
                'value' => $dataLainnyaValue[$index] ?? 0,
                // 'satuan' => $request->input('satuan'),
            ]);
        }

        foreach ($dataSkrinName as $index => $skrin) {
            RanapJawabanKonsulDetailSkriningCovidPatient::create([
                'ranap_jawaban_konsul_penyakit_dalam_patient_id' => $item->id,
                'name' => $skrin,
                'value' => $dataSkrinValue[$index] ?? 0,
                // 'satuan' => $request->input('satuan'),
            ]);
        }

        $item->update([
            'ket_pasien' => $ketPasien,
            'kesimpulan' => $kesimpulan,
            'anjuran' => $anjuran,
            'tanggal' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('lembar/konsultasi/penyakit/dalam.detail', $item->ranapPermintaanKonsulPenyakitDalamPatient->rawat_inap_patient_id)->with([
            'title' => 'Konsultasi Penyakit Dalam',
            'menu' => 'Rawat Inap',
            'success' => 'Data Berhasil Ditambahkan',
            'btn' => 'lembar-konsul',
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
