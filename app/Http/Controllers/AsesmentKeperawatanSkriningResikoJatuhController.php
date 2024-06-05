<?php

namespace App\Http\Controllers;

use App\Models\AsesmentKeperawatanSkriningResikoJatuhPatient;
use App\Models\AsesmentKeperawatanStatusFisikPatient;
use App\Models\AsesmentStatusFungsionalDiagnosaKeperawatanPatient;
use App\Models\DetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient;
use App\Models\DetailResikoRajalDiagnosaKeperawatanPatient;
use App\Models\DetailRisikoNutrisionalDiagnosaKeperawatanPatient;
use App\Models\DiagnosisKeperawatanPatient;
use App\Models\Queue;
use App\Models\ResikoRajalDiagnosaKeperawatanPatient;
use App\Models\RisikoNutrisionalDiagnosaKeperawatanPatient;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsesmentKeperawatanSkriningResikoJatuhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $item = Queue::find($id);
        $tanggal_lahir = new DateTime($item->patient->tanggal_lhr);
        $sekarang = new DateTime();
        $usia = $sekarang->diff($tanggal_lahir)->y;
        $diagnosisPatient = DiagnosisKeperawatanPatient::where('queue_id', $item->id)->first();
        $resikorajal = ResikoRajalDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->first();
        $kategoriSkriningRajal = DetailResikoRajalDiagnosaKeperawatanPatient::where('resiko_rajal_diagnosa_keperawatan_patient_id', $resikorajal->id ?? '')->first();
        $statusfungsional = AsesmentStatusFungsionalDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->first();
        $detailstatusfungsional = DetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient::where('asesment_status_fungsional_diagnosa_keperawatan_patient_id', $statusfungsional->id ?? '')->get();
         $asesmentKeperawatanSkriningResikoJatuh = AsesmentKeperawatanSkriningResikoJatuhPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->first();

        $dewasa = RisikoNutrisionalDiagnosaKeperawatanPatient::where('asesment_keperawatan_skrining_resiko_jatuh_patient_id', $asesmentKeperawatanSkriningResikoJatuh->id ?? '')->first();
    
        $anak = DetailRisikoNutrisionalDiagnosaKeperawatanPatient::where('risiko_nutrisional_diagnosa_keperawatan_patient_id', $dewasa->id ?? '')->get();
        $dewasaDua = DetailRisikoNutrisionalDiagnosaKeperawatanPatient::where('risiko_nutrisional_diagnosa_keperawatan_patient_id', $dewasa->id ?? '')->get();
// dd($dewasaDua);
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
            'Resiko Tinggi (ditemukan a dan b)',
        ];
        $komponenPenilaian2 = [
            'Tidak ada tindakan',
            'Bila resiko rendah ; pasien diberi edukasi pencegahan resiko jatuh',
            'Bila resiko tinggi ; pasien dipasan kalung resiko jatuh warna kuning dan diberi edukasi pencegahan resiko jatuh',
        ];
        return view('pages.asesmentKeperwatanPatient.skriningResikoJatuh.index', [
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
            "kriteriaNames" => $kriteriaNames,
            'komponenPenilaian1' => $komponenPenilaian1,
            'komponenPenilaian2' => $komponenPenilaian2,
            "item" => $item,
            "usia" => $usia,
            'resikorajal' => $resikorajal,
            'kategoriSkriningRajal' => $kategoriSkriningRajal,
            'statusfungsional' => $statusfungsional,
            'detailstatusfungsional' => $detailstatusfungsional,
            'dewasa' => $dewasa,
            'anak' => $anak,
            'dewasaDua' => $dewasaDua,
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
        $queue = Queue::find($id);
        $kategoriSkriningRajal = $request->input('kategori-skrining-rajal', []);

        $kriteriaStatusFungsional = $request->input('kriteria', []);
        $a = $request->input('a');
        $b = $request->input('b');
        $anakSatu = $request->input('anak-satu');
        $anakDua = $request->input('anak-dua');
        $anakTiga = $request->input('anak-tiga');
        $anakEmpat = $request->input('anak-empat');
        $dewasaSatu = $request->input('dewasa-satu');
        $dewasaDua = $request->input('dewasa-dua');

        $diagnosisKeperawatanPatient = DiagnosisKeperawatanPatient::where('queue_id', $queue->id)->first();

        if ($diagnosisKeperawatanPatient == null) {
            $diagnosisKeperawatanPatient = DiagnosisKeperawatanPatient::create([
                'no_rm' => $id,
                'patient_id' => $queue->patient->id,
                'queue_id' => $queue->id,
                'user_id' => Auth::user()->id,
            ]);
        }
        $asesmentKeperawatanSkriningResikoJatuh = AsesmentKeperawatanSkriningResikoJatuhPatient::where('diagnosis_keperawatan_patient_id', $diagnosisKeperawatanPatient->id)->first();

if ($asesmentKeperawatanSkriningResikoJatuh == null) {
    $asesmentKeperawatanSkriningResikoJatuh = AsesmentKeperawatanSkriningResikoJatuhPatient::create([
        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id
    ]);
} else {
    if ($asesmentKeperawatanSkriningResikoJatuh->resikoRajalDiagnosaKeperawatanPatient) {
        $asesmentKeperawatanSkriningResikoJatuh->resikoRajalDiagnosaKeperawatanPatient->detailResikoRajalDiagnosaKeperawatanPatient()->delete();
        $asesmentKeperawatanSkriningResikoJatuh->resikoRajalDiagnosaKeperawatanPatient->delete();
    }
    if ($asesmentKeperawatanSkriningResikoJatuh->asesmentStatusFungsionalDiagnosaKeperawatanPatient) {
        $asesmentKeperawatanSkriningResikoJatuh->asesmentStatusFungsionalDiagnosaKeperawatanPatient->detailAsesmentStatusFungsionalDiagnosaKeperawatanPatient()->delete();
        $asesmentKeperawatanSkriningResikoJatuh->asesmentStatusFungsionalDiagnosaKeperawatanPatient->delete();
    }
    $risikoNutrisional = RisikoNutrisionalDiagnosaKeperawatanPatient::where('asesment_keperawatan_skrining_resiko_jatuh_patient_id', $asesmentKeperawatanSkriningResikoJatuh->id)->first();
            if ($risikoNutrisional) {
                DetailRisikoNutrisionalDiagnosaKeperawatanPatient::where('risiko_nutrisional_diagnosa_keperawatan_patient_id', $risikoNutrisional->id)->delete();
                $risikoNutrisional->delete();
            }
}

        $resikoRajalDiagnosaKeperawatanPatient = ResikoRajalDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'asesment_keperawatan_skrining_resiko_jatuh_patient_id' => $asesmentKeperawatanSkriningResikoJatuh->id,
            'a' => $a,
            'b' => $b,
        ]);


        foreach ($kategoriSkriningRajal as $kategoriRajal) {
            $detailresikoRajalDiagnosaKeperawatanPatient = DetailResikoRajalDiagnosaKeperawatanPatient::create([
                'resiko_rajal_diagnosa_keperawatan_patient_id' => $resikoRajalDiagnosaKeperawatanPatient->id,
                'name' => $kategoriRajal,
            ]);
        }

        $asesmentStatusFungsionalDiagnosaKeperawatanPatient = AsesmentStatusFungsionalDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'asesment_keperawatan_skrining_resiko_jatuh_patient_id' => $asesmentKeperawatanSkriningResikoJatuh->id,

        ]);

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
            $detailAsesmentStatusFungsionalDiagnosaKeperawatanPatient = DetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient::create([
                'asesment_status_fungsional_diagnosa_keperawatan_patient_id' => $asesmentStatusFungsionalDiagnosaKeperawatanPatient->id,
                'name' => $name,
                'nilai' => $kriteria,
            ]);
            $totalAsesment += $kriteria;
        }

        // SKRINING RISIKO NUTRISIONAL

        // dd($asesmentStatusFungsionalDiagnosaKeperawatanPatient->id);

        $risikoNutrisional = RisikoNutrisionalDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'asesment_keperawatan_skrining_resiko_jatuh_patient_id' => $asesmentKeperawatanSkriningResikoJatuh->id,
            'diagnosa' => 'tidak',
        ]);

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
            $detailRisikoNutrisional = DetailRisikoNutrisionalDiagnosaKeperawatanPatient::create([
                'risiko_nutrisional_diagnosa_keperawatan_patient_id' => $risikoNutrisional->id,
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
            $dewasaDuaNilai = 1;
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
            $detailRisikoNutrisional = DetailRisikoNutrisionalDiagnosaKeperawatanPatient::create([
                'risiko_nutrisional_diagnosa_keperawatan_patient_id' => $risikoNutrisional->id,
                'name' => $nameSkriningDewasa,
                'category' => 'dewasa',
                'nilai' => $skriningNilaiNutrisionalDewasa,
            ]);
            $totalSkriningNilaiDewasa += $skriningNilaiNutrisionalDewasa;
        }
        return redirect(route('rajal/asesmen/diagnosis/keperawatan.index', $queue->id))->with('success', 'SUKSES BERHASIL DI TAMBAHKAN');

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
