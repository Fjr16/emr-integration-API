<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\IgdPatient;
use Illuminate\Http\Request;
use App\Models\IgdAseKepPatient;
use Illuminate\Support\Facades\Auth;
use App\Models\IgdSkriningResikoAssKepPatient;
use App\Models\IgdStatusFungsionalAssKepPatient;
use App\Models\IgdResikoNutrisionalAssKepPatient;
use App\Models\IgdDetailSkriningResikoAssKepPatient;

class IgdAsesmentKeperawatanSkriningResikoJatuhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $currentIgdPatientId = session('current_id', '');
        $item = IgdPatient::find($id);
        $tanggal_lahir = new DateTime($item->queue->patient->tanggal_lhr);
        $sekarang = new DateTime();
        $usia = $sekarang->diff($tanggal_lahir)->y;
        $kriteriaNames = [
            'Makan',
            'Aktifitas/Toilet',
            'Berpindah dari kursi roda ke tempat',
            'Kebersihan diri, mencuci muka, menyisir rambut, menggosok gigi',
            'Mandi',
            'Berjalan di permukaan datar',
            'Naik Turun Tangga',
            'Berpakaian',
            'Mengontrol defekasi',
            'Mengontrol berkemih',
        ];
        $komponenPenilaian1 = [
            'Tidak berisiko (tidak ditemukan a dan b)', 
            'Resiko Rendah (ditemukan a atau b)', 
            'Resiko Tinggi (ditemukan a dan b)'
            ];
        $komponenPenilaian2 = [
            'Tidak ada tindakan', 
            'Bila resiko rendah ; pasien diberi edukasi pencegahan resiko jatuh',
            'Bila resiko tinggi ; pasien dipasan kalung resiko jatuh warna kuning dan diberi edukasi pencegahan resiko jatuh'
        ];

        return view('pages.igdAssKepPatient.skriningResikoJatuh.index', [
            "title" => "IGD",
            "menu" => "IGD",
            "kriteriaNames" => $kriteriaNames,
            "komponenPenilaian1" => $komponenPenilaian1,
            "komponenPenilaian2" => $komponenPenilaian2,
            "item" => $item,
            "usia" => $usia,
            "currentIgdPatientId" => $currentIgdPatientId,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $item = IgdPatient::find($id);
        //input skrining dan asesmen risiko jatuh
        $kategoriSkriningRajal = $request->input('kategori-skrining-rajal', []);
        $a = $request->input('a');
        $b = $request->input('b');

        //input asesmen status fungsional
        $kriteriaStatusFungsional = $request->input('kriteria', []);
        $anakSatu = $request->input('anak-satu');
        $anakDua = $request->input('anak-dua');
        $anakTiga = $request->input('anak-tiga');
        $anakEmpat = $request->input('anak-empat');
        $dewasaSatu = $request->input('dewasa-satu');
        $dewasaDua = $request->input('dewasa-dua');

        $askepIgd = IgdAseKepPatient::where('igd_patient_id', $item->id)->first();
        if ($askepIgd == null) {
            $askepIgd = IgdAseKepPatient::create([
                'igd_patient_id' => $item->id,
                'patient_id' => $item->queue->patient->id,
                'user_id' => Auth::user()->id,
            ]);
        }

        if ($askepIgd->igdSkriningResikoAssKepPatient) {
            $askepIgd->igdSkriningResikoAssKepPatient->igdDetailSkriningResikoAssKepPatients()->delete();
            $askepIgd->igdSkriningResikoAssKepPatient->delete();
        }
        if ($askepIgd->igdStatusFungsionalAssKepPatients) {
            $askepIgd->igdStatusFungsionalAssKepPatients()->delete();
        }
        if ($askepIgd->igdResikoNutrisionalAssKepPatients) {
            $askepIgd->igdResikoNutrisionalAssKepPatients()->delete();
        }

        $igdSkriningResikoAssKepPatient = IgdSkriningResikoAssKepPatient::create([
            'igd_ase_kep_patient_id' => $askepIgd->id,
            'a' => $a,
            'b' => $b,
        ]);
        foreach ($kategoriSkriningRajal as $kategoriRajal) {
            IgdDetailSkriningResikoAssKepPatient::create([
                'igd_skrining_resiko_ass_kep_patient_id' => $igdSkriningResikoAssKepPatient->id,
                'name' => $kategoriRajal,
            ]);
        }

        $kriteriaNames = [
            'Makan',
            'Aktifitas/Toilet',
            'Berpindah dari kursi roda ke tempat',
            'Kebersihan diri, mencuci muka, menyisir rambut, menggosok gigi',
            'Mandi',
            'Berjalan di permukaan datar',
            'Naik Turun Tangga',
            'Berpakaian',
            'Mengontrol defekasi',
            'Mengontrol berkemih',
        ];

        $totalAsesment = 0;
        foreach ($kriteriaStatusFungsional as $key => $kriteria) {
            $name = isset($kriteriaNames[$key]) ? $kriteriaNames[$key] : 'Unknown';
            IgdStatusFungsionalAssKepPatient::create([
                'igd_ase_kep_patient_id' => $askepIgd->id,
                'name' => $name,
                'nilai' => $kriteria,
            ]);
            $totalAsesment += $kriteria;
        }

        // SKRINING RISIKO NUTRISIONAL
        $skriningNamesRisikoNutrisionalAnak = [
            'Apakah pasien tampak kurus?',
            'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif',
            'Apakah terdapat salah satu kondisi berikut? - Diare ≥ 5 kali/hari dan atau muntah > 3 kali/hari dalam seminggu terakhir - Asupan makanan kurang selama 1 minggu terakhir',
            'Apakah terdapat penyakit atau keadaan yang mangakibatkan pasien beresiko malnutrisi dan sudah malnutrisi (Gizi buruk)?',
        ];
        $skriningNilaiRisikoNutrisionalAnak = [
            $anakSatu,
            $anakDua,
            $anakTiga,
            $anakEmpat,
        ];

        $totalSkriningNilaiAnak = 0;
        foreach ($skriningNilaiRisikoNutrisionalAnak as $key => $skriningNilaiNutrisionalAnak) {
            $nameSkriningAnak = isset($skriningNamesRisikoNutrisionalAnak[$key]) ? $skriningNamesRisikoNutrisionalAnak[$key] : 'Unknown';
            IgdResikoNutrisionalAssKepPatient::create([
                'igd_ase_kep_patient_id' => $askepIgd->id,
                'name' => $nameSkriningAnak,
                'category' => 'anak',
                'nilai' => $skriningNilaiNutrisionalAnak,
            ]);
            $totalSkriningNilaiAnak += $skriningNilaiNutrisionalAnak;
        }

        $dewasaSatuNilai = 0;
        $dewasaSatuYa = ' ';
        if ($dewasaSatu == 'Tidak') {
            $dewasaSatuNilai = 0;
        } else if ($dewasaSatu == 'Tidak yakin (tanda-tanda : baju menjadi longgar)') {
            $dewasaSatuNilai = 2;
        } else if ($dewasaSatu == '1-5 Kg') {
            $dewasaSatuNilai = 1;
            $dewasaSatuYa = ' Ya, ada penurunan BB sebanyak ';
        } else if ($dewasaSatu == '6-10 Kg' || $dewasaSatu == 'Tidak tahu berapa kg penurunan') {
            $dewasaSatuNilai = 2;
            $dewasaSatuYa = ' Ya, ada penurunan BB sebanyak ';
        } else if ($dewasaSatu == '11-15 Kg') {
            $dewasaSatuNilai = 3;
            $dewasaSatuYa = ' Ya, ada penurunan BB sebanyak ';
        } else if ($dewasaSatu == '>15 Kg') {
            $dewasaSatuNilai = 4;
            $dewasaSatuYa = ' Ya, ada penurunan BB sebanyak ';
        }
        $dewasaSatuName = $dewasaSatuYa . $dewasaSatu;

        $dewasaDuaNilai = 0;
        if ($dewasaDua == 0) {
            $dewasaDuaName = 'Tidak';
            $dewasaDuaNilai = 0;
        } else {
            $dewasaDuaName = 'Ya';
            $dewasaDuaNilai = 2;
        }


        $skriningNamesRisikoNutrisionalDewasa = [
            'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? -' . $dewasaSatuName,
            'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif ? ' . $dewasaDuaName,
        ];

        $skriningNilaiRisikoNutrisionalDewasa = [
            $dewasaSatuNilai,
            $dewasaDuaNilai,
        ];

        $totalSkriningNilaiDewasa = 0;

        foreach ($skriningNilaiRisikoNutrisionalDewasa as $key => $skriningNilaiNutrisionalDewasa) {
            $nameSkriningDewasa = isset($skriningNamesRisikoNutrisionalDewasa[$key]) ? $skriningNamesRisikoNutrisionalDewasa[$key] : 'Unknown';
            IgdResikoNutrisionalAssKepPatient::create([
                'igd_ase_kep_patient_id' => $askepIgd->id,
                'name' => $nameSkriningDewasa,
                'category' => 'dewasa',
                'nilai' => $skriningNilaiNutrisionalDewasa,
            ]);
            $totalSkriningNilaiDewasa += $skriningNilaiNutrisionalDewasa;
        }
        return back()->with('success', 'Berhasil Ditambahkan');
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
