<?php

namespace App\Http\Controllers;

use App\Models\AsesmentKeperawatanSkriningResikoJatuhPatient;
use App\Models\AsesmentStatusFungsionalDiagnosaKeperawatanPatient;
use App\Models\DetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient;
use App\Models\DetailResikoRajalDiagnosaKeperawatanPatient;
use App\Models\DetailRisikoNutrisionalDiagnosaKeperawatanPatient;
use App\Models\DiagnosisKeperawatanPatient;
use App\Models\Queue;
use App\Models\ResikoRajalDiagnosaKeperawatanPatient;
use App\Models\RisikoNutrisionalDiagnosaKeperawatanPatient;
use App\Models\SkriningAsesmenResikoJatuhRanap;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AsesmentKeperawatanSkriningResikoJatuhRanapController extends Controller
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
            'Pasien usia < 1 tahun termasuk kategori risiko jatuh tinggi',
            'Usia 1 - 12 tahun dengan Humpty dumpty',
            'Dewasa usia > 12 - 65 tahun dengan Morse Fall Scale',
            'Usia > 65 tahun dengan Hendrich',
        ];

        return view('pages.ranapAsesmentKeperawatanPatient.skriningResikoJatuh.index', [
            "title" => "Asesmen Awal Keperawatan Pasien Rawat Inap",
            "menu" => "Rawat Inap",
            "kriteriaNames" => $kriteriaNames,
            "komponenPenilaian1" => $komponenPenilaian1,
            "item" => $item,
            "usia" => $usia,
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
        //input skrining dan asesmen risiko jatuh
        $usia = $request->input('usia');
        $skor = $request->input('skor');
        $kategori = $request->input('kategori');

        //input asesmen status fungsional
        $kriteriaStatusFungsional = $request->input('kriteria', []);
        $anakSatu = $request->input('anak-satu');
        $anakDua = $request->input('anak-dua');
        $anakTiga = $request->input('anak-tiga');
        $anakEmpat = $request->input('anak-empat');
        $dewasaSatu = $request->input('dewasa-satu');
        $dewasaDua = $request->input('dewasa-dua');
        $diagnosa = $request->input('diagnosa');
        $status = $request->input('status');
        if ($status == 'Ya') {
            $tanggal = $request->input('date') . " " . $request->input('time');
        } else {
            $tanggal = null;
        }

        $folder_path = 'assets/paraf-dietisien/';
        Storage::makeDirectory('public/' . $folder_path);

        // ttd dietisien
        if ($request->input('ttdDietisien')) {
            $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdDietisien')));
            $filename = $folder_path . uniqid() . '.png';
            Storage::put('public/' . $filename, $ttd);
            $ttdDietisien = $filename;
        } else {
            $diagnosisKeperawatanPatient = DiagnosisKeperawatanPatient::where('queue_id', $queue->id)->first();
            $skrining = SkriningAsesmenResikoJatuhRanap::where('diagnosis_keperawatan_patient_id', $diagnosisKeperawatanPatient->id)->first();
            $ttdDietisien = $skrining->ttd;
        }

        $dietisien = $request->input('dietisien');

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
            SkriningAsesmenResikoJatuhRanap::where('asesment_keperawatan_skrining_resiko_jatuh_patient_id', $asesmentKeperawatanSkriningResikoJatuh->id)->delete();

            $asesmentStatusFungsional = AsesmentStatusFungsionalDiagnosaKeperawatanPatient::where('asesment_keperawatan_skrining_resiko_jatuh_patient_id', $asesmentKeperawatanSkriningResikoJatuh->id)->first();
            if ($asesmentStatusFungsional) {
                DetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient::where('asesment_status_fungsional_diagnosa_keperawatan_patient_id', $asesmentStatusFungsional->id)->delete();
                $asesmentStatusFungsional->delete();
            }

            $risikoNutrisional = RisikoNutrisionalDiagnosaKeperawatanPatient::where('asesment_keperawatan_skrining_resiko_jatuh_patient_id', $asesmentKeperawatanSkriningResikoJatuh->id)->first();
            if ($risikoNutrisional) {
                DetailRisikoNutrisionalDiagnosaKeperawatanPatient::where('risiko_nutrisional_diagnosa_keperawatan_patient_id', $risikoNutrisional->id)->delete();
                $risikoNutrisional->delete();
            }
        }

        SkriningAsesmenResikoJatuhRanap::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'asesment_keperawatan_skrining_resiko_jatuh_patient_id' => $asesmentKeperawatanSkriningResikoJatuh->id,
            'usia' => $usia,
            'skor' => $skor,
            'kategori' => $kategori,
            'status' => $status,
            'tanggal' => $tanggal,
            'name' => $dietisien,
            'ttd' => $ttdDietisien,
        ]);

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
            DetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient::create([
                'asesment_status_fungsional_diagnosa_keperawatan_patient_id' => $asesmentStatusFungsionalDiagnosaKeperawatanPatient->id,
                'name' => $name,
                'nilai' => $kriteria,
            ]);
            $totalAsesment += $kriteria;
        }

        // SKRINING RISIKO NUTRISIONAL

        $risikoNutrisional = RisikoNutrisionalDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'asesment_keperawatan_skrining_resiko_jatuh_patient_id' => $asesmentStatusFungsionalDiagnosaKeperawatanPatient->id,
            'diagnosa' => $diagnosa,
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
            DetailRisikoNutrisionalDiagnosaKeperawatanPatient::create([
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
            DetailRisikoNutrisionalDiagnosaKeperawatanPatient::create([
                'risiko_nutrisional_diagnosa_keperawatan_patient_id' => $risikoNutrisional->id,
                'name' => $nameSkriningDewasa,
                'category' => 'dewasa',
                'nilai' => $skriningNilaiNutrisionalDewasa,
            ]);
            $totalSkriningNilaiDewasa += $skriningNilaiNutrisionalDewasa;
        }
        return back()->with('success', 'SUKSES BERHASIL DI TAMBAHKAN');
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
        $item = DiagnosisKeperawatanPatient::find($id);
        // skrining risiko jatuh
        $asesmentKeperawatanSkriningResikoJatuh = AsesmentKeperawatanSkriningResikoJatuhPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $skrining = SkriningAsesmenResikoJatuhRanap::where('asesment_keperawatan_skrining_resiko_jatuh_patient_id', $asesmentKeperawatanSkriningResikoJatuh->id)->first();
        // status fungsional
        $statusFungsional = AsesmentStatusFungsionalDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $detailStatusFungsional = DetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient::where('asesment_status_fungsional_diagnosa_keperawatan_patient_id', $statusFungsional->id)->get();
        // risiko nutrisional
        $risikoNutrisional = RisikoNutrisionalDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $detailRisikoNutrisional = null;
        // $detailRisikoNutrisional = DetailRisikoNutrisionalDiagnosaKeperawatanPatient::where('risiko_nutrisional_diagnosa_keperawatan_patient_id', $risikoNutrisional->id)->get();
        $tanggal_lahir = new DateTime($item->patient->tanggal_lhr);
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
            'Pasien usia < 1 tahun termasuk kategori risiko jatuh tinggi',
            'Usia 1 - 12 tahun dengan Humpty dumpty',
            'Dewasa usia > 12 - 65 tahun dengan Morse Fall Scale',
            'Usia > 65 tahun dengan Hendrich',
        ];

        return view('pages.ranapAsesmentKeperawatanPatient.skriningResikoJatuh.edit', [
            "title" => "Asesmen Awal Keperawatan Pasien Rawat Inap",
            "menu" => "Rawat Inap",
            "kriteriaNames" => $kriteriaNames,
            "komponenPenilaian1" => $komponenPenilaian1,
            "item" => $item,
            "skrining" => $skrining,
            "statusFungsional" => $statusFungsional,
            "detailStatusFungsional" => $detailStatusFungsional,
            "risikoNutrisional" => $risikoNutrisional,
            "detailRisikoNutrisional" => $detailRisikoNutrisional,
            "usia" => $usia,
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
