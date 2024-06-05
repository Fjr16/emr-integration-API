<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Queue;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DiagnosisKeperawatanPatient;
use App\Models\HubunganDiagnosaAwalPatient;
use App\Models\DetailDiagnosisKeperawatanPatient;
use App\Models\EkonomiDiagnosaKeperawatanPatient;
use App\Models\AsesmentKeperawatanStatusFisikPatient;
use App\Models\ResikoRajalDiagnosaKeperawatanPatient;
use App\Models\StatusFisikDiagnosaKeperawatanPatient;
use App\Models\AsesmentKeperawatanRencanaAsuhanPatient;
use App\Models\AsesmentNyeriDiagnosaKeperawatanPatient;
use App\Models\RiwayatAlergiDiagnosaKeperawatanPatient;
use App\Models\DetailMasalahDiagnosisKeperawatanPatient;
use App\Models\DetailRencanaDiagnosisKeperawatanPatient;
use App\Models\DetailResikoRajalDiagnosaKeperawatanPatient;
use App\Models\DetailStatusFisikDiagnosaKeperawatanPatient;
use App\Models\RisikoNutrisionalDiagnosaKeperawatanPatient;
use App\Models\PsikoSosioSpritualDiagnosaKeperawatanPatient;
use App\Models\AsesmentKeperawatanSkriningResikoJatuhPatient;
use App\Models\DetailAsesmentKeperawatanRencanaAsuhanPatient;
use App\Models\DetailAsesmentNyeriDiagnosaKeperawatanPatient;
use App\Models\DetailRisikoNutrisionalDiagnosaKeperawatanPatient;
use App\Models\AsesmentStatusFungsionalDiagnosaKeperawatanPatient;
use App\Models\DetailPsikoSosioSpritualDiagnosaKeperawatanPatient;
use App\Models\DetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient;

class AsesmentPerawatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $item = Queue::find($id);
        return view('pages.rawatjalan.create', [
            'title' => 'Interaksi Obat',
            'menu' => 'Obat',
            'item' => $item,
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

        // $data = $request->only(['agen_pencedera', 'flexRadioDefault']);
        // return $data;
        $kondisiUmum = $request->input('kondisi-umum', []);
        $kebutuhanKhusus = $request->input('kebutuhan-khusus', []);
        $kesadaran = $request->input('kesadaran', []);
        $psikologis = $request->input('psikologis', []);
        $rohani = $request->input('rohani', []);
        $hambatan = $request->input('hambatan', []);
        $nyeriHilang = $request->input('nyeri-hilang', []);
        $kategoriSkriningRajal = $request->input('kategori-skrining-rajal', []);
        $diagnosisKeperawatan = $request->input('diagnosis-keperawatan', []);
        $ansietas = $request->input('ansietas', []);
        $nyeriAkut = $request->input('nyeri-akut', []);
        $nyeriAkut = $request->input('nyeri-akut', []);
        $nyeriKronis = $request->input('nyeri-kronis', []);
        $gangguanMobilitasFisik = $request->input('gangguan-mobilitas-fisik', []);
        $gangguanIntegritasKulit = $request->input('gangguan-integritas-kulit', []);
        $retensiUrine = $request->input('retensi-urine', []);
        $masalahKeperawatan = $request->input('masalah-keperawatan', []);
        $rencanaAsuhan = $request->input('rencana-asuhan', []);
        $kriteriaStatusFungsional = $request->input('kriteria', []);
        $a = $request->input('a');
        $b = $request->input('b');
        $rasaNyeri = $request->input('rasa-nyeri');
        if ($rasaNyeri == 'ya') {
            $kategoriNyeri = $request->input('kategori-nyeri');
        } else {
            $kategoriNyeri = 'tidak';
        }
        $alergi = $request->input('alergi');
        $interaksi = $request->input('interaksi');
        $hambatanSosial = $request->input('hambatan-sosial');
        $pasien = $request->input('pasien');
        $darah = $request->input('darah');
        $nadi = $request->input('nadi');
        $suhu = $request->input('suhu');
        $pernafasan = $request->input('pernafasan');
        $tb = $request->input('tb');
        $bb = $request->input('bb');
        $datang = $request->input('datang');
        $hubungan = $request->input('hubungan');
        $kerabatNama = $request->input('kerabat-nama');
        $kerabatHubungan = $request->input('kerabat-hubungan');
        $kerabatHp = $request->input('kerabat-hp');
        $sehat = $request->input('sehat');
        $ketSehat = $request->input('ket-sehat');
        $sakit = $request->input('sakit');
        $ketSakit = $request->input('ket-sakit');
        $hambatanSpritual = $request->input('hambatan-spritual');
        $ketHambatanSpritual = $request->input('ket-hambatan-spritual');
        $ketNilaiKepercayaan = $request->input('ket-nilai-kepercayaan');
        $ketRohani = $request->input('ket-rohani');
        $status = $request->input('status');
        $ketHambatan = $request->input('ket-hambatan');
        $ketAlergi = $request->input('ket-alergi');
        $reaksi = $request->input('reaksi');
        $provocation = $request->input('provocation');
        $quality = $request->input('quality');
        $region = $request->input('region');
        $severity = $request->input('severity');
        $time = $request->input('time');
        $anakSatu = $request->input('anak-satu');
        $anakDua = $request->input('anak-dua');
        $anakTiga = $request->input('anak-tiga');
        $anakEmpat = $request->input('anak-empat');
        $dewasaSatu = $request->input('dewasa-satu');
        $dewasaDua = $request->input('dewasa-dua');

        if ($hambatanSosial == null) {
            $hambatanSosial = 'Tidak ada';
        }
        if ($ketNilaiKepercayaan == null) {
            $ketNilaiKepercayaan = 'Tidak ada';
        }
        if ($ketRohani == null) {
            $ketRohani = 'Tidak ada';
        }
        if ($ketHambatan == null) {
            $ketHambatan = 'Tidak ada';
        }
        if ($ketHambatan == null) {
            $ketHambatan = 'Tidak ada';
        }

        $queue = Queue::find($id);
        $patient = Patient::find($queue->patient->id);

        $diagnosisKeperawatanPatient = DiagnosisKeperawatanPatient::create([
            'no_rm' => $id,
            'patient_id' => $patient->id,
            'queue_id' => $queue->id,
            'user_id' => Auth::user()->id,
        ]);

        // Status Fisik
        $statusFisikDiagnosaKeperawatan = StatusFisikDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'darah' => $darah,
            'nadi' => $nadi,
            'suhu' => $suhu,
            'pernafasan' => $pernafasan,
            'tb' => $tb,
            'bb' => $bb,
        ]);

        foreach ($kondisiUmum as $kondisi) {
            $detailStatusFisikDiagnosaKeperawatan = DetailStatusFisikDiagnosaKeperawatanPatient::create([
                'status_fisik_diagnosa_keperawatan_patient_id' => $statusFisikDiagnosaKeperawatan->id,
                'category' => 'Kondisi Umum',
                'name' => $kondisi,
            ]);
        }

        foreach ($kebutuhanKhusus as $kebutuhan) {
            $detailStatusFisikDiagnosaKeperawatan = DetailStatusFisikDiagnosaKeperawatanPatient::create([
                'status_fisik_diagnosa_keperawatan_patient_id' => $statusFisikDiagnosaKeperawatan->id,
                'category' => 'Kebutuhan Khusus',
                'name' => $kebutuhan,
            ]);
        }

        foreach ($kesadaran as $kesadaran) {
            $detailStatusFisikDiagnosaKeperawatan = DetailStatusFisikDiagnosaKeperawatanPatient::create([
                'status_fisik_diagnosa_keperawatan_patient_id' => $statusFisikDiagnosaKeperawatan->id,
                'category' => 'Kesadaran',
                'name' => $kesadaran,
            ]);
        }

        // Psiko sosio Spritual

        $psikoSosioSpritual = PsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
        ]);

        foreach ($psikologis as $psiko) {
            $detailSosioSpritual = DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
                'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
                'category' => 'psikologis',
                'name' => $psiko,
                'value' => 'check',
            ]);
        }

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'sosial',
            'name' => 'Pasien tinggal dirumah dengan siapa',
            'value' => $pasien,
        ]);

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'sosial',
            'name' => 'Interaksi dengan lingkungan sekitar',
            'value' => $interaksi,
        ]);

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'sosial',
            'name' => 'Datang kerumah sakit dengan siapa',
            'value' => $datang . '/ Hubungan : ' . $hubungan,
        ]);

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'sosial',
            'name' => 'Kerabat terdekat yang bisa dihubungi : ',
            'value' => 'Nama :  ' . $kerabatNama  . ' Hubungan ' . $kerabatHubungan, ' Telepon ' . $kerabatHp,
        ]);

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'sosial',
            'name' => 'Hambatan Sosial',
            'value' => $hambatanSosial
        ]);

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'spritual',
            'name' => $sehat,
            'value' => $ketSehat
        ]);

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'spritual',
            'name' => $sakit,
            'value' => $ketSakit
        ]);

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'spritual',
            'name' => $hambatanSpritual,
            'value' => $ketHambatanSpritual
        ]);

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'spritual',
            'name' => 'Kultular / Nilai kepercayaan',
            'value' => $ketNilaiKepercayaan
        ]);

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'spritual',
            'name' => 'Apakah pasien memerlukan pelayanan / bimbingan rohani',
            'value' => $ketRohani
        ]);

        // Ekonomi

        $ekonomiDiagnosaKeperawatanPatient = EkonomiDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'status' => $status,
            'hambatan' => $ketHambatan,
        ]);

        //Riwayat Alergi

        $riwayatAlergiDiagnosaKeperawatanPatient = RiwayatAlergiDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'status' => $alergi,
            'hambatan' => $ketHambatan,
            'reaksi' => $reaksi,
        ]);

        // SKRINING DAN ASESMEN NYERI

        $asesmentNyeriDiagnosaKeperawatanPatient = AsesmentNyeriDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'status' => $rasaNyeri,
            'category' => $kategoriNyeri,
            'provocation' => $provocation,
            'quality' => $quality,
            'region' => $region,
            'severity' => $severity,
            'time' => $time,
        ]);

        foreach ($nyeriHilang as $nyeri_hilang) {
            $detailAsesmentNyeriDiagnosaKeperawatanPatient = DetailAsesmentNyeriDiagnosaKeperawatanPatient::create([
                'asesment_nyeri_diagnosa_keperawatan_patient_id' => $asesmentNyeriDiagnosaKeperawatanPatient->id,
                'name' => $nyeri_hilang,
            ]);
        }

        //sampai siko status fisik

        //SKRINING RESIKO JATUH RAWAT JALAN (GET UP AND GO TEST)

        $resikoRajalDiagnosaKeperawatanPatient = ResikoRajalDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'a' => $a,
            'b' => $b,
        ]);

        foreach ($kategoriSkriningRajal as $kategoriRajal) {
            $detailResikoRajalDiagnosaKeperawatanPatient = DetailResikoRajalDiagnosaKeperawatanPatient::create([
                'resiko_rajal_diagnosa_keperawatan_patient_id' => $resikoRajalDiagnosaKeperawatanPatient->id,
                'name' => $kategoriRajal,
            ]);
        }

        $asesmentStatusFungsionalDiagnosaKeperawatanPatient = AsesmentStatusFungsionalDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
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

        $risikoNutrisional = RisikoNutrisionalDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
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
            $detailRisikoNutrisional = DetailRisikoNutrisionalDiagnosaKeperawatanPatient::create([
                'risiko_nutrisional_diagnosa_keperawatan_patient_id' => $risikoNutrisional->id,
                'name' => $nameSkriningDewasa,
                'category' => 'dewasa',
                'nilai' => $skriningNilaiNutrisionalDewasa,
            ]);
            $totalSkriningNilaiDewasa += $skriningNilaiNutrisionalDewasa;
        }

        // DETAIL DIAGNOSIS KEPERAWATAN

        foreach ($diagnosisKeperawatan as $key => $diagnosis) {
            $detailDiagnosisKeperawatanPatient = DetailDiagnosisKeperawatanPatient::create([
                'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                'diagnosa' => $diagnosis,
            ]);
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Ansietas') {
                foreach ($ansietas as $key => $anse) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => 'Ansietas',
                        'name' => $anse,
                    ]);
                }
            }

            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Nyeri Akut / Kronis') {
                foreach ($nyeriAkut as $key => $nyeri) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => 'Nyeri Akut / Kronis',
                        'name' => $nyeri,
                    ]);
                }
            }
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Nyeri Kronis') {
                foreach ($nyeriKronis as $key => $nyeri) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => 'Nyeri Akut / Kronis',
                        'name' => $nyeri,
                    ]);
                }
            }
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Gangguan Mobilitas Fisik') {
                foreach ($gangguanMobilitasFisik as $key => $fisik) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => 'Gangguan Mobilitas Fisik',
                        'name' => $fisik,
                    ]);
                }
            }
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Gangguan Integritas Kulit / Jaringan') {
                foreach ($gangguanIntegritasKulit as $key => $kulit) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => 'Gangguan Integritas Kulit / Jaringan',
                        'name' => $kulit,
                    ]);
                }
            }
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Retensi Urine') {
                foreach ($retensiUrine as $key => $urine) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => 'Retensi Urine',
                        'name' => $urine,
                    ]);
                }
            }
        }

        // MASALAH KEPERAWATAN

        foreach ($masalahKeperawatan as $key => $keperawatan) {
            DetailMasalahDiagnosisKeperawatanPatient::create([
                'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                'diagnosa' => $keperawatan,
            ]);
        }

        // RENCANA ASUHAN

        foreach ($rencanaAsuhan as $key => $asuhan) {
            DetailRencanaDiagnosisKeperawatanPatient::create([
                'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                'diagnosa' => $asuhan,
            ]);
        }

        return redirect()->route('rajal/show', ['id' => $id, 'title' => 'Rawat Jalan'])->with(['success' => 'SUKSES', 'btn' => 'perawat']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = DiagnosisKeperawatanPatient::with([
            'user',
            'patient',
            'queue',
            'detailDiagnosisKeperawatanPatient' => [
                'hubunganDiagnosaAwalPatient'
            ],
            'statusFisikDiagnosaKeperawatanPatient' => [
                'detailStatusFisikDiagnosaKeperawatanPatient'
            ],
            'psikoSosioSpritualDiagnosaKeperawatanPatient' => [
                'detailPsikoSosioSpritualDiagnosaKeperawatanPatient'
            ],
            'ekonomiDiagnosaKeperawatanPatient',
            'riwayatAlergiDiagnosaKeperawatanPatient',
            'asesmentNyeriDiagnosaKeperawatanPatient' => [
                'detailAsesmentNyeriDiagnosaKeperawatanPatient'
            ],
            'resikoRajalDiagnosaKeperawatanPatient' => [
                'detailResikoRajalDiagnosaKeperawatanPatient'
            ],
            'asesmentStatusFungsionalDiagnosaKeperawatanPatient' => [
                'detailAsesmentStatusFungsionalDiagnosaKeperawatanPatient'
            ],
            'risikoNutrisionalDiagnosaKeperawatanPatient' => [
                'detailRisikoNutrisionalDiagnosaKeperawatanPatient'
            ],
            'detailMasalahDiagnosisKeperawatanPatient',
            'detailRencanaDiagnosisKeperawatanPatient',

        ])->find($id);
        // dd($item);
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
        $kondisiUmum = [
            'Baik',
            'Tampak Sakit',
            'Sesak',
            'Pucat',
            'Lemah'
        ];
        $kebutuhanKhusus = [
            'Tidak',
            'Ada',
            'Tongkat',
            'Kacamata',
            'Gigi Palsu'
        ];
        $kesadaran = [
            'Komposmentis',
            'Delirium',
            'Somnolen',
            'Soporokoma',
            'Koma'
        ];
        $psikologis = [
            'Stabil/Tenang',
            'Cemas/Takut',
            'Marah',
            'Kecendrungan Bunuh Diri',
            'Gelisah',
            'Hiperaktif'
        ];
        $spritual = [
            'Sehat',
            'Sakit',
            'Hambatan Spiritual'
        ];
        $asesmentNyeri = [
            'Minum Obat',
            'Istirahat',
            'Mendengar Musik',
            'Berubah Posisi Tidur'
        ];
        $komponenPenilaian1 = [
            'Tidak berisiko (tidak ditemukan a dan b)',
            'Resiko Rendah (ditemukan a atau b)',
            'Resiko Tinggi (ditemukan a atau b)'
        ];
        $komponenPenilaian2 = [
            'Tidak ada tindakan',
            'Bila resiko rendah ; pasien diberi edukasi pencegahan resiko jatuh',
            'Bila resiko tinggi ; pasien dipasan kalung resiko jatuh warna kuning dan diberi edukasi pencegahan resiko jatuh'
        ];
        $bdAnsietas = [
            'Kurang rerpapar informasi',
            'Kurang mengalami kegagalan',
            'Ancaman terhadap konsep diri',
        ];
        $bdNyeri = [
            'Agen pencedera fisiologis *(Inflamasi/Iskemia/Neoplasma)',
            'Agen pencedera fisik *(Abses/Amputasi/Terpotong/Trauma/Fraktur/ Prosedur Operasi/Latihan Fisik berlebihan/Mengangkat Berat)',
            'Agen pencedera kimia *(terbakar/bahan kimia iritan)',
        ];
        $bdFisik = [
            'Kerusakan Struktur Tulang',
            'Kontraktur',
            'Penurunan kekuatan otot',
            'Kekakuan Sendi',
            'Program Pembatasan Gerak',
        ];

        $bdKulit = [
            'Faktor Mekanis *(Penekanan pada Tonjolan Tulang/Luka Operasi)',
            'Faktor elektris (energi listrik tinggi)',
            'Perubahan Sirkulasi',
            'Efek Samping Terapi Radiasi',
        ];
        $bdUrine = [
            'Peningkatan Tekanan Uretra',
            'Disfungsi Neurologis *(Trauma / Penyakit Syaraf)',
            'Efek Agen Farmakologis',
        ];
        $masalahKeperawatan = [
            'Ansietas',
            'Nyeri Akut',
            'Nyeri Kronis',
            'Retensi Urine',
            'Gangguan Mobilitas Fisik',
            'Gangguan Integritas Kulit',
        ];
        $rencanaAsuhan = [
            'Reduksi Ansietas',
            'Manajemen Nyeri',
            'Dukungan Mobilitas',
            'Perawatan Luka',
            'Perawatan Retensi Urine',
            'Perawatan Kateter Urine',
        ];
        $arrAlergi = [
            0 => 'Alergi Obat',
            1 => 'Alergi Makanan',
            2 => 'Alergi Lainnya',
        ];
        return view('pages.asesmentPerawatRawatJalanPrint.index', [
            'title' => 'Interaksi Obat',
            'menu' => 'Obat',
            'kondisiUmum' => $kondisiUmum,
            'kebutuhanKhusus' => $kebutuhanKhusus,
            'kesadaran' => $kesadaran,
            'psikologis' => $psikologis,
            'spritual' => $spritual,
            'asesmentNyeri' => $asesmentNyeri,
            'komponenPenilaian1' => $komponenPenilaian1,
            'komponenPenilaian2' => $komponenPenilaian2,
            'kriteriaNames' => $kriteriaNames,
            'bdAnsietas' => $bdAnsietas,
            'bdNyeri' => $bdNyeri,
            'bdFisik' => $bdFisik,
            'bdKulit' => $bdKulit,
            'bdUrine' => $bdUrine,
            'masalahKeperawatan' => $masalahKeperawatan,
            'rencanaAsuhan' => $rencanaAsuhan,
            'arrAlergi' => $arrAlergi,
            'item' => $item
        ]);
    }
    public function print($id)
    {
        $item = DiagnosisKeperawatanPatient::with([
            'user',
            'patient',
            'queue',
            'detailDiagnosisKeperawatanPatient' => [
                'hubunganDiagnosaAwalPatient'
            ],
            'statusFisikDiagnosaKeperawatanPatient' => [
                'detailStatusFisikDiagnosaKeperawatanPatient'
            ],
            'psikoSosioSpritualDiagnosaKeperawatanPatient' => [
                'detailPsikoSosioSpritualDiagnosaKeperawatanPatient'
            ],
            'ekonomiDiagnosaKeperawatanPatient',
            'riwayatAlergiDiagnosaKeperawatanPatient',
            'asesmentNyeriDiagnosaKeperawatanPatient' => [
                'detailAsesmentNyeriDiagnosaKeperawatanPatient'
            ],
            'resikoRajalDiagnosaKeperawatanPatient' => [
                'detailResikoRajalDiagnosaKeperawatanPatient'
            ],
            'asesmentStatusFungsionalDiagnosaKeperawatanPatient' => [
                'detailAsesmentStatusFungsionalDiagnosaKeperawatanPatient'
            ],
            'risikoNutrisionalDiagnosaKeperawatanPatient' => [
                'detailRisikoNutrisionalDiagnosaKeperawatanPatient'
            ],
            'detailMasalahDiagnosisKeperawatanPatient',
            'detailRencanaDiagnosisKeperawatanPatient',

        ])->find($id);
        $itemm = Queue::find($id);
        $diagnosisPatient = DiagnosisKeperawatanPatient::where('queue_id', $itemm->id)->first();

        $dbpsiko = PsikoSosioSpritualDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id ?? '')->first();
        $spirituals = DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::where('psiko_sosio_spritual_diagnosa_keperawatan_patient_id', $dbpsiko->id ?? '')->where('category', 'spritual')->get();
        $asesmentKeperawatanSkriningResikoJatuh = AsesmentKeperawatanSkriningResikoJatuhPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->first();
        // dd($spirituals);
        $dewasa = RisikoNutrisionalDiagnosaKeperawatanPatient::where('asesment_keperawatan_skrining_resiko_jatuh_patient_id', $asesmentKeperawatanSkriningResikoJatuh->id ?? '')->first();

        $anak = DetailRisikoNutrisionalDiagnosaKeperawatanPatient::where('risiko_nutrisional_diagnosa_keperawatan_patient_id', $dewasa->id ?? '')->get();
        $dewasaDua = DetailRisikoNutrisionalDiagnosaKeperawatanPatient::where('risiko_nutrisional_diagnosa_keperawatan_patient_id', $dewasa->id ?? '')->get();
        $ekonomi = EkonomiDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id ?? '')->first();
        $asesmentstatusfisik = AsesmentKeperawatanStatusFisikPatient::where('diagnosis_keperawatan_patient_id', $item->id ?? '')->first();

        $skrinAsesmenNyeri = AsesmentNyeriDiagnosaKeperawatanPatient::where('asesment_keperawatan_status_fisik_patient_id', $asesmentstatusfisik->id ?? '')->first();
        $nyeriHilang = DetailAsesmentNyeriDiagnosaKeperawatanPatient::where('asesment_nyeri_diagnosa_keperawatan_patient_id', $skrinAsesmenNyeri->id ?? '')->get();

        $resikorajal = ResikoRajalDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id ?? '')->first();
        $kategoriSkriningRajal = DetailResikoRajalDiagnosaKeperawatanPatient::where('resiko_rajal_diagnosa_keperawatan_patient_id', $resikorajal->id ?? '')->first();

        $tanggal_lahir = new DateTime($item->patient->tanggal_lhr);
        $sekarang = new DateTime();
        $usia = $sekarang->diff($tanggal_lahir)->y;

        $asesmentKeperawatanSkriningResikoJatuh = AsesmentKeperawatanSkriningResikoJatuhPatient::where('diagnosis_keperawatan_patient_id', $item->id ?? '')->first();

        $dewasa = RisikoNutrisionalDiagnosaKeperawatanPatient::where('asesment_keperawatan_skrining_resiko_jatuh_patient_id', $asesmentKeperawatanSkriningResikoJatuh->id ?? '')->first();
        $anak = DetailRisikoNutrisionalDiagnosaKeperawatanPatient::where('risiko_nutrisional_diagnosa_keperawatan_patient_id', $dewasa->id ?? '')->get();
        $dewasaDua = DetailRisikoNutrisionalDiagnosaKeperawatanPatient::where('risiko_nutrisional_diagnosa_keperawatan_patient_id', $dewasa->id ?? '')->get();

        $nyeriAkutMain = [];
        $nyeriAkutSub = [];
        $asesmenDiagnosa = DetailDiagnosisKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id ?? '')->get();
        $detailDiagnosa = HubunganDiagnosaAwalPatient::where('diagnosis_keperawatan_patient_id', $item->id ?? '')->get();
        $masalah = DetailMasalahDiagnosisKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id ?? '')->get();
        $asesmentKeperawatanRencanaAsuhan = AsesmentKeperawatanRencanaAsuhanPatient::where('diagnosis_keperawatan_patient_id', $item->id ?? '')->first();
        $detailRencana = DetailAsesmentKeperawatanRencanaAsuhanPatient::where('diagnosis_keperawatan_patient_id', $item->id ?? '')->get();

        $statusfungsional = AsesmentStatusFungsionalDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id ?? '')->first();
        $detailstatusfungsional = DetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient::where('asesment_status_fungsional_diagnosa_keperawatan_patient_id', $statusfungsional->id ?? '')->get();

        // dd($item);
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
        $kondisiUmum = [
            'Baik',
            'Tampak Sakit',
            'Sesak',
            'Pucat',
            'Lemah'
        ];
        $kebutuhanKhusus = [
            'Tidak',
            'Ada',
            'Tongkat',
            'Kacamata',
            'Gigi Palsu'
        ];
        $kesadaran = [
            'Komposmentis',
            'Delirium',
            'Somnolen',
            'Soporokoma',
            'Koma'
        ];
        $psikologis = [
            'Stabil/Tenang',
            'Cemas/Takut',
            'Marah',
            'Kecendrungan Bunuh Diri',
            'Gelisah',
            'Hiperaktif'
        ];
        $spritual = [
            'Sehat',
            'Sakit',
            'Hambatan Spiritual'
        ];
        $asesmentNyeri = [
            'Minum Obat',
            'Istirahat',
            'Mendengar Musik',
            'Berubah Posisi Tidur'
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
        $bdAnsietas = [
            'Kurang terpapar informasi',
            'Kurang mengalami kegagalan',
            'Ancaman terhadap konsep diri',
        ];

        $bdNyeri = [
            'Agen pencedera fisiologis' => ['Inflamasi', 'Iskemia', 'Neoplasma'],
            'Agen pencedera fisik' => ['Abses', 'Amputasi', 'Terpotong', 'Trauma', 'Fraktur', 'Prosedur Operasi', 'Latihan Fisik berlebihan', 'Mengangkat Berat'],
            'Agen pencedera kimia' => ['Terbakar', 'Bahan kimia iritan']
        ];



        $bdNyeriKronis = [
            'Agen pencedera  fisiologis' => ['Inflamasi', 'Iskemia', 'Neoplasma'],
            'Agen pencedera  fisik' => ['Abses', 'Amputasi', 'Terpotong', 'Trauma', 'Fraktur', 'Prosedur Operasi', 'Latihan Fisik berlebihan', 'Mengangkat Berat'],
            'Agen pencedera  kimia' => ['Terbakar', 'Bahan kimia iritan']
        ];

        $bdFisik = [
            'Kerusakan Struktur Tulang',
            'Kontraktur',
            'Penurunan kekuatan otot',
            'Kekakuan Sendi',
            'Program Pembatasan Gerak',
        ];


        $bdKulit = [
            'Faktor Mekanis' => ['Penekanan pada Tonjolan Tulang', 'Luka Operasi'],
            'Faktor elektris' => ['Energi listrik tinggi'],
            'Perubahan Sirkulasi' => [],
            'Efek Samping Terapi Radiasi' => [],
        ];
        $bdJaringan = [
            'Faktor  Mekanis' => ['Penekanan pada Tonjolan Tulang', 'Luka Operasi'],
            'Faktor  elektris' => ['Energi listrik tinggi'],
            'Perubahan  Sirkulasi' => [],
            'Efek Samping Terapi  Radiasi' => [],
        ];

        $bdUrine = [
            'Peningkatan Tekanan Uretra' => [],
            'Disfungsi Neurologis' => ['Trauma', 'Penyakit Syaraf'],
            'Efek Agen Farmakologis' => [],
        ];

        $masalahKeperawatan = [
            'Ansietas',
            'Nyeri Akut',
            'Nyeri Kronis',
            'Retensi Urine',
            'Gangguan Mobilitas Fisik',
            'Gangguan Integritas Kulit',
            'Gangguan Integritas Jaringan',
        ];
        $rencanaAsuhan = [
            'Reduksi Ansietas',
            'Manajemen Nyeri',
            'Dukungan Mobilitas',
            'Perawatan Luka',
            'Perawatan Retensi Urine',
            'Perawatan Kateter Urine',
        ];
        $arrAlergi = [
            0 => 'Alergi Obat',
            1 => 'Alergi Makanan',
            2 => 'Alergi Lainnya',
        ];
        return view('pages.asesmentPerawatRawatJalanPrint.print', [
            'title' => 'Interaksi Obat',
            'menu' => 'Obat',
            'kondisiUmum' => $kondisiUmum,
            'kebutuhanKhusus' => $kebutuhanKhusus,
            'kesadaran' => $kesadaran,
            'psikologis' => $psikologis,
            'spritual' => $spritual,
            'asesmentNyeri' => $asesmentNyeri,
            'komponenPenilaian1' => $komponenPenilaian1,
            'komponenPenilaian2' => $komponenPenilaian2,
            'kriteriaNames' => $kriteriaNames,
            'bdAnsietas' => $bdAnsietas,
            'bdNyeri' => $bdNyeri,
            'bdFisik' => $bdFisik,
            'bdKulit' => $bdKulit,
            'bdUrine' => $bdUrine,
            'masalahKeperawatan' => $masalahKeperawatan,
            'rencanaAsuhan' => $rencanaAsuhan,
            'arrAlergi' => $arrAlergi,
            'item' => $item,
            'diagnosisPatient' => $diagnosisPatient,
            'dbpsiko' => $dbpsiko,
            'spirituals' => $spirituals,
            'dewasa' => $dewasa,
            'anak' => $anak,
            'dewasaDua' => $dewasaDua,
            'ekonomi' => $ekonomi,
            'asesmentstatusfisik' => $asesmentstatusfisik,
            'skrinAsesmenNyeri' => $skrinAsesmenNyeri,
            'nyeriHilang' => $nyeriHilang,
            'resikorajal' => $resikorajal,
            'kategoriSkriningRajal' => $kategoriSkriningRajal,
            'usia' => $usia,
            'asesmenDiagnosa' => $asesmenDiagnosa,
            'masalah' => $masalah,
            'detailDiagnosa' => $detailDiagnosa,
            'nyeriAkutMain' => $nyeriAkutMain,
            'nyeriAkutSub' => $nyeriAkutSub,
            'bdNyeriKronis' => $bdNyeriKronis,
            'bdJaringan' => $bdJaringan,
            'asesmentKeperawatanRencanaAsuhan' => $asesmentKeperawatanRencanaAsuhan,
            'detailRencana' => $detailRencana,
            'detailstatusfungsional' => $detailstatusfungsional,
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
