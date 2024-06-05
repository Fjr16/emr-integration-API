<?php

namespace App\Http\Controllers;

use App\Models\AdministrasiCacatanPerjalananRanapPatient;
use App\Models\CatatanPerjalanRanapPatient;
use App\Models\DetailAdministrasiCacatanPerjalananRanapPatient;
use App\Models\Patient;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class CatatanPerjalananRanapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CatatanPerjalanRanapPatient::all();
        return view('pages.perjalananAdministrasiRanap.index', [
            'data' => $data,
            "title" => "Catatan Perjalanan Ranap",
            'menu' => 'Perjalanan Ranap',

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Patient::all();
        return view('pages.PerjalananAdministrasiRanap.create', [
            'data' => $data,
            "title" => "Catatan Perjalanan Ranap",
            'menu' => 'Perjalanan Ranap',
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
        $data = CatatanPerjalanRanapPatient::find($id);

        $kategori = [
            'REKAM MEDIS',
            'ASURANSI LAIN',
            'PERAWAT : REGISTRASI/RANAP', // Corrected typo here
            'PERAWAT : RANAP/KAMAR BEDAH/PACU',
            'LABORATORIUM',
            'RANAP/FARMASI/KASIR',
        ];

        $rekamMedis = [
            'Rujukan',
            'Kartu BPJS',
            'KTP/KARTU KELUARGA',
            'SUDI MERAWAT',
            'CLINICAL PATHWAY',
            'ANGKET',
            'NAME TAG',
            'PRIVATE/RPS',
            'PINDAH RUANGAN',
        ];

        $asuransiLain = [
            'JASA RAHARJA',
            'BPJS KETENAGAKERJAAN',
            'BLANKO KRONOLOGIS',
        ];

        $perawatRegistrasi = [
            'KELENGKAPAN STATUS',
            'RONTGEN',
            'LABOR',
            'ECG',
            'USG/CT SCAN',
            'PASANG GELANG',
            'IDENTITAS/RISIKO JATUH/ALERGI',
            'KONFIRMASI OPERASI DPJP/OK',
            'PUASA MULAI JAM',
            'KONSULTASI',
            'HASIL BACAAN PA/BAJAH',
            'FOTO PRE OPERASI'
        ];

        $kamarbedah = [
            'INFORMED CONSENT PASIEN',
            'KONSUL INTERNE',
            'VISITE ANESTESI',
            'SITE MARKING',
            'SP DARAH',
            'FOEBRIDING',
            'GIGI PALSU/PERHIASAN',
            'KLISMA',
            'PASIEN MANDI',
            'PEMBERIAN ANTIBIOTIKA',
            'KELENGKAPAN STATUS OLEH DPJP & ANESTESI',
            'RESEP OBAT POST OP',
            'PLATE/SCREWIK/K-WIRE',
            'ANTIBIOTIKA',
            'ANALGETIK',
        ];

        $laboratorium = [
            'SEDIAAN PA',
        ];

        $farmasiKasir = [
            'JAM VISITE DOKTER',
            'JAM PENYERAHAN STATUS',
            'RESEP PULANG',
            'JAM PENYERAHAN STATUS',
            'OBAT PULANG',
            'COST SHARING',
        ];

        foreach ($kategori as $item) {
            $save = AdministrasiCacatanPerjalananRanapPatient::create([
                'catatan_perjalan_ranap_patient_id' => $data->id,
                'category' => $item,
                'user_id' => 1,
            ]);

            $recordId = $save->id;

            if ($item === 'REKAM MEDIS') {
                foreach ($rekamMedis as $medis) {
                    DetailAdministrasiCacatanPerjalananRanapPatient::create([
                        'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
                        'name' => $medis,
                        'value' => 'tidak',
                    ]);
                }
            } elseif ($item === 'ASURANSI LAIN') {
                foreach ($asuransiLain as $asuransi) {
                    DetailAdministrasiCacatanPerjalananRanapPatient::create([
                        'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
                        'name' => $asuransi,
                        'value' => 'tidak',
                    ]);
                }
            } elseif ($item === 'PERAWAT : REGISTRASI/RANAP') {
                foreach ($perawatRegistrasi as $perawat) {
                    DetailAdministrasiCacatanPerjalananRanapPatient::create([
                        'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
                        'name' => $perawat,
                        'value' => 'tidak',
                    ]);
                }
            } elseif ($item === 'PERAWAT : RANAP/KAMAR BEDAH/PACU') {
                foreach ($kamarbedah as $kamar) {
                    DetailAdministrasiCacatanPerjalananRanapPatient::create([
                        'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
                        'name' => $kamar,
                        'value' => 'tidak',
                    ]);
                }
            } elseif ($item === 'LABORATORIUM') {
                foreach ($laboratorium as $lab) {
                    DetailAdministrasiCacatanPerjalananRanapPatient::create([
                        'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
                        'name' => $lab,
                        'value' => 'tidak',
                    ]);
                }
            } elseif ($item === 'RANAP/FARMASI/KASIR') {
                foreach ($farmasiKasir as $farmasi) {
                    DetailAdministrasiCacatanPerjalananRanapPatient::create([
                        'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
                        'name' => $farmasi,
                        'value' => 'tidak',
                    ]);
                }
            }
        }

        return redirect()->route('rawat/inap.show', $data->rawatInapPatient->id);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = CatatanPerjalanRanapPatient::find($id);
        return view('pages.perjalananAdministrasiRanap.edit', [
            'title' => "Catatan Perjalanan Ranap",
            'menu' => 'Perjalanan Ranap',
            'data' => $data,
        ]);
    }
    public function rekamMedis($id)
    {
        $data = CatatanPerjalanRanapPatient::find($id);
        $data2 = AdministrasiCacatanPerjalananRanapPatient::where('catatan_perjalan_ranap_patient_id', $id)->where('category', 'REKAM MEDIS')->first();
        $data3 = DetailAdministrasiCacatanPerjalananRanapPatient::where('administrasi_cacatan_perjalanan_ranap_patient_id', $data2->id)->get();

        return view('pages.perjalananAdministrasiRanap.rekam-medis', [
            "title" => "Catatan Perjalanan Ranap",
            'menu' => 'Perjalanan Ranap',
            'data' => $data,
            'data2' => $data2,
            'data3' => $data3,

        ]);
    }
    public function asuransi($id)
    {
        $data = CatatanPerjalanRanapPatient::find($id);
        $data2 = AdministrasiCacatanPerjalananRanapPatient::where('catatan_perjalan_ranap_patient_id', $id)->where('category', 'ASURANSI LAIN')->first();
        $data3 = DetailAdministrasiCacatanPerjalananRanapPatient::where('administrasi_cacatan_perjalanan_ranap_patient_id', $data2->id)->get();

        return view('pages.perjalananAdministrasiRanap.asuransi', [
            "title" => "Catatan Perjalanan Ranap",
            'menu' => 'Perjalanan Ranap',
            'data' => $data,
            'data2' => $data2,
            'data3' => $data3,
        ]);
    }
    public function registrasi($id)
    {
        $data = CatatanPerjalanRanapPatient::find($id);
        $data2 = AdministrasiCacatanPerjalananRanapPatient::where('catatan_perjalan_ranap_patient_id', $id)->where('category', 'PERAWAT : REGISTRASI/RANAP')->first();
        $data3 = DetailAdministrasiCacatanPerjalananRanapPatient::where('administrasi_cacatan_perjalanan_ranap_patient_id', $data2->id)->get();
        return view('pages.perjalananAdministrasiRanap.registrasi', [
            "title" => "Catatan Perjalanan Ranap",
            'menu' => 'Perjalanan Ranap',
            'data' => $data,
            'data2' => $data2,
            'data3' => $data3,
        ]);
    }
    public function bedah($id)
    {
        $data = CatatanPerjalanRanapPatient::find($id);
        $data2 = AdministrasiCacatanPerjalananRanapPatient::where('catatan_perjalan_ranap_patient_id', $id)->where('category', 'PERAWAT : RANAP/KAMAR BEDAH/PACU')->first();
        $data3 = DetailAdministrasiCacatanPerjalananRanapPatient::where('administrasi_cacatan_perjalanan_ranap_patient_id', $data2->id)->get();
        return view('pages.perjalananAdministrasiRanap.kamar-bedah', [
            "title" => "Catatan Perjalanan Ranap",
            'menu' => 'Perjalanan Ranap',
            'data' => $data,
            'data2' => $data2,
            'data3' => $data3,
        ]);
    }
    public function laboratorium($id)
    {
        $data = CatatanPerjalanRanapPatient::find($id);
        $data2 = AdministrasiCacatanPerjalananRanapPatient::where('catatan_perjalan_ranap_patient_id', $id)->where('category', 'LABORATORIUM')->first();
        $data3 = DetailAdministrasiCacatanPerjalananRanapPatient::where('administrasi_cacatan_perjalanan_ranap_patient_id', $data2->id)->get();

        return view('pages.perjalananAdministrasiRanap.laboratorium', [
            "title" => "Catatan Perjalanan Ranap",
            'menu' => 'Perjalanan Ranap',
            'data' => $data,
            'data2' => $data2,
            'data3' => $data3,
        ]);
    }
    public function farmasikasir($id)
    {
        $data = CatatanPerjalanRanapPatient::find($id);
        $data2 = AdministrasiCacatanPerjalananRanapPatient::where('catatan_perjalan_ranap_patient_id', $data->id)->where('category', 'RANAP/FARMASI/KASIR')->first();
        $data3 = DetailAdministrasiCacatanPerjalananRanapPatient::where('administrasi_cacatan_perjalanan_ranap_patient_id', $data2->id)->get();

        return view('pages.perjalananAdministrasiRanap.farmasi-kasir', [
            "title" => "Catatan Perjalanan Ranap",
            'menu' => 'Perjalanan Ranap',
            'data' => $data,
            'data2' => $data2,
            'data3' => $data3,
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

        // catatan rekam medis
        if ($request->medis) {
            $data2 = AdministrasiCacatanPerjalananRanapPatient::where('catatan_perjalan_ranap_patient_id', $id)->where('category', 'REKAM MEDIS')->first();
            $medis = $request->rekamMedis;
            foreach ($medis as $medis1 => $medis2) {
                DetailAdministrasiCacatanPerjalananRanapPatient::where('administrasi_cacatan_perjalanan_ranap_patient_id', $data2->id)->where('name', $medis1)->update([
                    'administrasi_cacatan_perjalanan_ranap_patient_id' => $data2->id,
                    'name' => $medis1,
                    'value' => $medis2,
                ]);
            }
            return redirect()->route('perjalananadministrasi-ranap.rekam-medis', ['id' => $id])->with('success', 'Disimpan!');;
        }

        // catatan asuransi 
        if ($request->asuransi) {
            $data2 = AdministrasiCacatanPerjalananRanapPatient::where('catatan_perjalan_ranap_patient_id', $id)->where('category', 'ASURANSI LAIN')->first();
            $asuransi = $request->rekamMedis;
            foreach ($asuransi as $asuransi1 => $asuransi2) {
                DetailAdministrasiCacatanPerjalananRanapPatient::where('administrasi_cacatan_perjalanan_ranap_patient_id', $data2->id)->where('name', $asuransi1)->update([
                    'administrasi_cacatan_perjalanan_ranap_patient_id' => $data2->id,
                    'name' => $asuransi1,
                    'value' => $asuransi2,
                ]);
            }
            return redirect()->route('perjalananadministrasi-ranap.asuransi', ['id' => $id])->with('success', 'Disimpan!');;
        }

        // catatan registrasi
        if ($request->registrasi) {
            $data2 = AdministrasiCacatanPerjalananRanapPatient::where('catatan_perjalan_ranap_patient_id', $id)->where('category', 'PERAWAT : REGISTRASI/RANAP')->first();
            $registrasi = $request->rekamMedis;
            foreach ($registrasi as $registrasi1 => $registrasi2) {
                DetailAdministrasiCacatanPerjalananRanapPatient::where('administrasi_cacatan_perjalanan_ranap_patient_id', $data2->id)->where('name', $registrasi1)->update([
                    'administrasi_cacatan_perjalanan_ranap_patient_id' => $data2->id,
                    'name' => $registrasi1,
                    'value' => $registrasi2,
                ]);
            }
            return redirect()->route('perjalananadministrasi-ranap.registrasi', ['id' => $id])->with('success', 'Disimpan!');
        }
        // kamar bedah
        if ($request->bedah) {
            $data2 = AdministrasiCacatanPerjalananRanapPatient::where('catatan_perjalan_ranap_patient_id', $id)->where('category', 'PERAWAT : RANAP/KAMAR BEDAH/PACU')->first();
            $kamarBedah = $request->rekamMedis;
            foreach ($kamarBedah as $kamarBedah1 => $kamarBedah2) {
                DetailAdministrasiCacatanPerjalananRanapPatient::where('administrasi_cacatan_perjalanan_ranap_patient_id', $data2->id)->where('name', $kamarBedah1)->update([
                    'administrasi_cacatan_perjalanan_ranap_patient_id' => $data2->id,
                    'name' => $kamarBedah1,
                    'value' => $kamarBedah2,
                ]);
            }
            return redirect()->route('perjalananadministrasi-ranap.kamar-bedah', ['id' => $id])->with('success', 'Disimpan!');
        }

        // laboratorium
        if ($request->labor) {
            $data2 = AdministrasiCacatanPerjalananRanapPatient::where('catatan_perjalan_ranap_patient_id', $id)->where('category', 'LABORATORIUM')->first();
            $labor = $request->rekamMedis;
            foreach ($labor as $labor1 => $labor2) {
                DetailAdministrasiCacatanPerjalananRanapPatient::where('administrasi_cacatan_perjalanan_ranap_patient_id', $data2->id)->where('name', $labor1)->update([
                    'administrasi_cacatan_perjalanan_ranap_patient_id' => $data2->id,
                    'name' => $labor1,
                    'value' => $labor2,
                ]);
            }
            return redirect()->route('perjalananadministrasi-ranap.laboratorium', ['id' => $id])->with('success', 'Disimpan!');
        }

        // Farmasi kasir
        if ($request->farmasiKasir) {
            $data2 = AdministrasiCacatanPerjalananRanapPatient::where('catatan_perjalan_ranap_patient_id', $id)->where('category', 'RANAP/FARMASI/KASIR')->first();
            $farmasi = $request->rekamMedis;
            foreach ($farmasi as $farmasi1 => $farmasi2) {
                DetailAdministrasiCacatanPerjalananRanapPatient::where('administrasi_cacatan_perjalanan_ranap_patient_id', $data2->id)->where('name', $farmasi1)->update([
                    'administrasi_cacatan_perjalanan_ranap_patient_id' => $data2->id,
                    'name' => $farmasi1,
                    'value' => $farmasi2,
                ]);
            }
            return redirect()->route('perjalananadministrasi-ranap.farmasi-kasir', ['id' => $id])->with('success', 'Disimpan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CatatanPerjalanRanapPatient::find($id);
        $data->delete();
        return redirect()->route('perjalananadministrasi-ranap.index',);
    }
}
