<?php

namespace App\Http\Controllers;

use App\Models\AsesmentKeperawatanStatusFisikPatient;
use App\Models\AsesmentNyeriDiagnosaKeperawatanPatient;
use App\Models\DetailAsesmentNyeriDiagnosaKeperawatanPatient;
use App\Models\DetailPsikoSosioSpritualDiagnosaKeperawatanPatient;
use App\Models\DetailStatusFisikDiagnosaKeperawatanPatient;
use App\Models\DiagnosisKeperawatanPatient;
use App\Models\EkonomiDiagnosaKeperawatanPatient;
use App\Models\Patient;
use App\Models\PsikoSosioSpritualDiagnosaKeperawatanPatient;
use App\Models\Queue;
use App\Models\RiwayatAlergiDiagnosaKeperawatanPatient;
use App\Models\StatusFisikDiagnosaKeperawatanPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsesmentKeperawatanStatusFisikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $item = Queue::find($id);
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
        $diagnosisPatient = DiagnosisKeperawatanPatient::where('queue_id', $item->id)->first();
        $dbpsiko = PsikoSosioSpritualDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->first();

        $statusFisik = StatusFisikDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->first();
        //  $detailRencana = DetailAsesmentKeperawatanRencanaAsuhanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->get();

        $psikos = DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::where('psiko_sosio_spritual_diagnosa_keperawatan_patient_id', $dbpsiko->id ?? '')->where('category', 'psikologis')->pluck('name')->toArray();
        $sosials = DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::where('psiko_sosio_spritual_diagnosa_keperawatan_patient_id', $dbpsiko->id ?? '')->where('category', 'sosial')->get();
        $spirituals = DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::where('psiko_sosio_spritual_diagnosa_keperawatan_patient_id', $dbpsiko->id ?? '')->where('category', 'spritual')->get();
        $ekonomi = EkonomiDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->first();
        $alergi = RiwayatAlergiDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->first();
        $alergiArr = RiwayatAlergiDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->get();
        $asesmentstatusfisik = AsesmentKeperawatanStatusFisikPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->first();

        $skrinAsesmenNyeri = AsesmentNyeriDiagnosaKeperawatanPatient::where('asesment_keperawatan_status_fisik_patient_id', $asesmentstatusfisik->id ?? '')->first();
        $nyeriHilang = DetailAsesmentNyeriDiagnosaKeperawatanPatient::where('asesment_nyeri_diagnosa_keperawatan_patient_id', $skrinAsesmenNyeri->id ?? '')->get();
        $alergiArray = $alergiArr->toArray();

        return view('pages.asesmentKeperwatanPatient.statusFisik.index', [
            'item' => $item,
            'kriteriaNames' => $kriteriaNames,
            'kondisiUmum' => $kondisiUmum,
            'kebutuhanKhusus' => $kebutuhanKhusus,
            'kesadaran' => $kesadaran,
            'psikologis' => $psikologis,
            'spritual' => $spritual,
            'asesmentNyeri' => $asesmentNyeri,
            'statusFisik' => $statusFisik,
            'psikos' => $psikos,
            'dbpsiko' => $dbpsiko,
            'sosials' => $sosials,
            'spirituals' => $spirituals,
            'ekonomi' => $ekonomi,
            'alergi' => $alergi,
            'alergiArray' => $alergiArray,
            'skrinAsesmenNyeri' => $skrinAsesmenNyeri,
            'nyeriHilang' => $nyeriHilang,
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
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
        $item = Queue::find($id);
        $kondisiUmum = $request->input('kondisi-umum', []);
        $kesadaran = $request->input('kesadaran', []);
        $kebutuhanKhusus = $request->input('kebutuhan-khusus', []);
        $psikologis = $request->input('psikologis', []);
        $rohani = $request->input('rohani', []);
        $hambatan = $request->input('hambatan', []);
        $nyeriHilang = $request->input('nyeri-hilang', []);


        $rasaNyeri = $request->input('rasa-nyeri');
        if ($rasaNyeri == 'Ya') {
            $rasaNyeri = $request->input('rasa-nyeri');
            $kategoriNyeri = $request->input('kategori-nyeri');
        } else {
            $rasaNyeri = $request->input('rasa-nyeri');
            $kategoriNyeri = null;
        }

        // $alergi = $request->input('alergi');
        // if ($alergi === 'Ada') {
        //     $value = $request->input('value');
        //     $reaksi = $request->input('reaksi');
        // } else {
        //     // If $alergi is not 'Ada', set additional information to null
        //     $value = null;
        //     $reaksi = null;
        // }
        // $ketAlergi = $request->input('ket-alergi');
        // $reaksi = $request->input('reaksi');
        $interaksi = $request->input('interaksi');
        $hambatanSosial = $request->input('hambatan-sosial');
        $keteranganHambatanSosial = $request->input('ket-hambatan-sosial');
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
        // $sehat = $request->input('sehat');
        // $ketSehat = $request->input('ket-sehat');
        // $sakit = $request->input('sakit');
        // $ketSakit = $request->input('ket-sakit');
        // $hambatanSpritual = $request->input('hambatan-spritual');
        // $ketHambatanSpritual = $request->input('ket-hambatan-spritual');
        $ketHambatanSpiritual = '';
        $spiritual = [];
        $spiritualSehat = $request->input('spiritual_sehat');
        $spiritualSakit = $request->input('spiritual_sakit');
        $hambatanSpiritual = $request->input('spiritual_hamSpiritual');
        $ketSehat = $request->input('ket-sehat');
        $ketSakit = $request->input('ket-sakit');
        $hambatanSpiritualRadio = $request->input('hambatan-spiritual');
        $ketHambatanSpiritual = $request->input('ket-hambatan-spiritual');

        if ($spiritualSehat) {
            $spiritual[] = [
                'name' => 'Sehat',
                'value' => $ketSehat
            ];
        }

        if ($spiritualSakit) {
            $spiritual[] = [
                'name' => 'Sakit',
                'value' => $ketSakit
            ];
        }

        if ($hambatanSpiritual) {
            $value = ($hambatanSpiritualRadio == 'Ada') ? $ketHambatanSpiritual : 'Tidak Ada';
            $spiritual[] = [
                'name' => 'Hambatan Spiritual',
                'value' => $value
            ];
        }
        $nilaiKepercayaan = $request->input('nilai-kepercayaan');
        $ketNilaiKepercayaan = $request->input('ket-nilai-kepercayaan');
        // $ketRohani = $request->input('ket-rohani');
        $rohani = $request->input('rohani');
        if ($rohani == 'Ya') {
            $ketRohani = $request->input('ket-rohani');
        } else {
            $ketRohani = 'Tidak';
        }
        // $status = $request->input('status');
        // $ketHambatan = $request->input('ket-hambatan');
        $status = $request->input('status');
        $hambatanEkonomi = $request->input('hambatan-ekonomi');
        if ($hambatanEkonomi == 'Ada') {
            $ketHambatanEkonomi = $request->input('ket-hambatan-ekonomi');
        } else {
            $ketHambatanEkonomi = 'Tidak Ada';
        }


        $provocation = $request->input('provocation');
        $quality = $request->input('quality');
        $region = $request->input('region');
        $severity = $request->input('severity');
        $time = $request->input('time');

        $queue = Queue::find($id);
        $patient = Patient::find($queue->patient->id);

        $diagnosisKeperawatanPatient = DiagnosisKeperawatanPatient::where('queue_id', $queue->id)->first();

        if ($diagnosisKeperawatanPatient == null) {
            $diagnosisKeperawatanPatient = DiagnosisKeperawatanPatient::create([
                'no_rm' => $id,
                'patient_id' => $patient->id,
                'queue_id' => $queue->id,
                'user_id' => Auth::user()->id,
            ]);
        }
        $asesmentKeperawatanStatusFisikPatient = AsesmentKeperawatanStatusFisikPatient::where('diagnosis_keperawatan_patient_id', $diagnosisKeperawatanPatient->id)->first();
        if ($asesmentKeperawatanStatusFisikPatient == null) {
            $asesmentKeperawatanStatusFisikPatient = AsesmentKeperawatanStatusFisikPatient::create([
                'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id
            ]);
        } else {
            $statusFisikDiagnosaKeperawatanPatient = StatusFisikDiagnosaKeperawatanPatient::where('asesment_keperawatan_status_fisik_patient_id', $asesmentKeperawatanStatusFisikPatient->id)->first();
            if ($statusFisikDiagnosaKeperawatanPatient) {
                // Hapus detail kondisi fisik
                DetailStatusFisikDiagnosaKeperawatanPatient::where('status_fisik_diagnosa_keperawatan_patient_id', $statusFisikDiagnosaKeperawatanPatient->id)->delete();
                // Hapus entri status fisik
                $statusFisikDiagnosaKeperawatanPatient->delete();
            }


            $psikoSosio = PsikoSosioSpritualDiagnosaKeperawatanPatient::where('asesment_keperawatan_status_fisik_patient_id', $asesmentKeperawatanStatusFisikPatient->id)->first();
            if ($psikoSosio) {
                DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::where('psiko_sosio_spritual_diagnosa_keperawatan_patient_id', $psikoSosio->id)->delete();
                $psikoSosio->delete();
            }

            EkonomiDiagnosaKeperawatanPatient::where('asesment_keperawatan_status_fisik_patient_id', $asesmentKeperawatanStatusFisikPatient->id)->delete();

            RiwayatAlergiDiagnosaKeperawatanPatient::where('asesment_keperawatan_status_fisik_patient_id', $asesmentKeperawatanStatusFisikPatient->id)->delete();

            $asesmentNyeriDiagnosaKeperawatanPatient = AsesmentNyeriDiagnosaKeperawatanPatient::where('asesment_keperawatan_status_fisik_patient_id', $asesmentKeperawatanStatusFisikPatient->id)->first();
            if ($asesmentNyeriDiagnosaKeperawatanPatient) {
                DetailAsesmentNyeriDiagnosaKeperawatanPatient::where('asesment_nyeri_diagnosa_keperawatan_patient_id', $asesmentNyeriDiagnosaKeperawatanPatient->id)->delete();
                $asesmentNyeriDiagnosaKeperawatanPatient->delete();
            }
        }
        // Status Fisik
        $statusFisikDiagnosaKeperawatan = StatusFisikDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
            'darah' => $darah,
            'nadi' => $nadi,
            'suhu' => $suhu,
            'pernafasan' => $pernafasan,
            'tb' => $tb,
            'bb' => $bb,
        ]);

        foreach ($kondisiUmum as $kondisi) {
            DetailStatusFisikDiagnosaKeperawatanPatient::create([
                'status_fisik_diagnosa_keperawatan_patient_id' => $statusFisikDiagnosaKeperawatan->id,
                'category' => 'Kondisi Umum',
                'name' => $kondisi,
            ]);
        }

        foreach ($kebutuhanKhusus as $kebutuhan) {
            DetailStatusFisikDiagnosaKeperawatanPatient::create([
                'status_fisik_diagnosa_keperawatan_patient_id' => $statusFisikDiagnosaKeperawatan->id,
                'category' => 'Kebutuhan Khusus',
                'name' => $kebutuhan,
            ]);
        }

        foreach ($kesadaran as $kesadaran) {
            DetailStatusFisikDiagnosaKeperawatanPatient::create([
                'status_fisik_diagnosa_keperawatan_patient_id' => $statusFisikDiagnosaKeperawatan->id,
                'category' => 'Kesadaran',
                'name' => $kesadaran,
            ]);
        }

        // Psiko sosio Spritual

        $psikoSosioSpritual = PsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
        ]);

        foreach ($psikologis as $psiko) {
            DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
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
            'value' => 'Nama :  ' . $kerabatNama  . ' Hubungan ' . $kerabatHubungan . ' Telepon ' . $kerabatHp,
        ]);

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'sosial',
            'name' => 'Hambatan Sosial',
            'value' => $hambatanSosial . ' Keterangan : ' . $keteranganHambatanSosial,
        ]);
        foreach ($spiritual as $spiritualDetail) {
            DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
                'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
                'category' => 'spritual',
                'name' => $spiritualDetail['name'],
                'value' => $spiritualDetail['value']
            ]);
        }


        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'spritual',
            'name' => 'Kultular / Nilai kepercayaan',
            'value' => $ketNilaiKepercayaan,
            'value' => $nilaiKepercayaan . ' Keterangan : ' . $ketNilaiKepercayaan,
        ]);

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'spritual',
            'name' => 'Apakah pasien memerlukan pelayanan / bimbingan rohani',
            'value' => $ketRohani
        ]);


        // Ekonomi

        EkonomiDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'status' => $status,
            'hambatan' => $ketHambatanEkonomi,
            'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
        ]);


        //Riwayat Alergi
        $alergi = $request->input('alergi');
        if ($alergi) {
            if ($alergi === 'Ada') {
                $ketAlergi = $request->input('ket-alergi');
                $reaksi = $request->input('reaksi');
                foreach ($ketAlergi as $index => $value) {
                    RiwayatAlergiDiagnosaKeperawatanPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'status' => $alergi,
                        'alergi' => $value,
                        'reaksi' => $reaksi[$index],
                        'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
                    ]);
                }
            } else {
                RiwayatAlergiDiagnosaKeperawatanPatient::create([
                    'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                    'status' => $alergi,
                    'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
                ]);
            }
        }



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
            'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
        ]);

        foreach ($nyeriHilang as $nyeri_hilang) {
            DetailAsesmentNyeriDiagnosaKeperawatanPatient::create([
                'asesment_nyeri_diagnosa_keperawatan_patient_id' => $asesmentNyeriDiagnosaKeperawatanPatient->id,
                'name' => $nyeri_hilang,
            ]);
        }
        return redirect(route('rajal/asesmen/skrining/resiko/jatuh.index', $item->id))->with('success', 'SUKSES BERHASIL DI TAMBAHKAN');
    }


    public function save(Request $request, $id)
    {
        $item = Queue::find($id);
        $kondisiUmum = $request->input('kondisi-umum', []);
        $kesadaran = $request->input('kesadaran', []);
        $kebutuhanKhusus = $request->input('kebutuhan-khusus', []);
        $psikologis = $request->input('psikologis', []);
        $rohani = $request->input('rohani', []);
        $hambatan = $request->input('hambatan', []);
        $nyeriHilang = $request->input('nyeri-hilang', []);


        $rasaNyeri = $request->input('rasa-nyeri');
        if ($rasaNyeri == 'Ya') {
            $rasaNyeri = $request->input('rasa-nyeri');
            $kategoriNyeri = $request->input('kategori-nyeri');
        } else {
            $rasaNyeri = $request->input('rasa-nyeri');
            $kategoriNyeri = null;
        }

        // $alergi = $request->input('alergi');
        // if ($alergi === 'Ada') {
        //     $value = $request->input('value');
        //     $reaksi = $request->input('reaksi');
        // } else {
        //     // If $alergi is not 'Ada', set additional information to null
        //     $value = null;
        //     $reaksi = null;
        // }
        // $ketAlergi = $request->input('ket-alergi');
        // $reaksi = $request->input('reaksi');
        $interaksi = $request->input('interaksi');
        $hambatanSosial = $request->input('hambatan-sosial');
        $keteranganHambatanSosial = $request->input('ket-hambatan-sosial');
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
        // $sehat = $request->input('sehat');
        // $ketSehat = $request->input('ket-sehat');
        // $sakit = $request->input('sakit');
        // $ketSakit = $request->input('ket-sakit');
        // $hambatanSpritual = $request->input('hambatan-spritual');
        // $ketHambatanSpritual = $request->input('ket-hambatan-spritual');
        $ketHambatanSpiritual = '';
        $spiritual = [];
        $spiritualSehat = $request->input('spiritual_sehat');
        $spiritualSakit = $request->input('spiritual_sakit');
        $hambatanSpiritual = $request->input('spiritual_hamSpiritual');
        $ketSehat = $request->input('ket-sehat');
        $ketSakit = $request->input('ket-sakit');
        $hambatanSpiritualRadio = $request->input('hambatan-spiritual');
        $ketHambatanSpiritual = $request->input('ket-hambatan-spiritual');

        if ($spiritualSehat) {
            $spiritual[] = [
                'name' => 'Sehat',
                'value' => $ketSehat
            ];
        }

        if ($spiritualSakit) {
            $spiritual[] = [
                'name' => 'Sakit',
                'value' => $ketSakit
            ];
        }

        if ($hambatanSpiritual) {
            $value = ($hambatanSpiritualRadio == 'Ada') ? $ketHambatanSpiritual : 'Tidak Ada';
            $spiritual[] = [
                'name' => 'Hambatan Spiritual',
                'value' => $value
            ];
        }
        $nilaiKepercayaan = $request->input('nilai-kepercayaan');
        $ketNilaiKepercayaan = $request->input('ket-nilai-kepercayaan');
        // $ketRohani = $request->input('ket-rohani');
        $rohani = $request->input('rohani');
        if ($rohani == 'Ya') {
            $ketRohani = $request->input('ket-rohani');
        } else {
            $ketRohani = 'Tidak';
        }
        // $status = $request->input('status');
        // $ketHambatan = $request->input('ket-hambatan');
        $status = $request->input('status');
        $hambatanEkonomi = $request->input('hambatan-ekonomi');
        if ($hambatanEkonomi == 'Ada') {
            $ketHambatanEkonomi = $request->input('ket-hambatan-ekonomi');
        } else {
            $ketHambatanEkonomi = 'Tidak Ada';
        }


        $provocation = $request->input('provocation');
        $quality = $request->input('quality');
        $region = $request->input('region');
        $severity = $request->input('severity');
        $time = $request->input('time');

        $queue = Queue::find($id);
        $patient = Patient::find($queue->patient->id);

        $diagnosisKeperawatanPatient = DiagnosisKeperawatanPatient::where('queue_id', $queue->id)->first();

        if ($diagnosisKeperawatanPatient == null) {
            $diagnosisKeperawatanPatient = DiagnosisKeperawatanPatient::create([
                'no_rm' => $id,
                'patient_id' => $patient->id,
                'queue_id' => $queue->id,
                'user_id' => Auth::user()->id,
            ]);
        }
        $asesmentKeperawatanStatusFisikPatient = AsesmentKeperawatanStatusFisikPatient::where('diagnosis_keperawatan_patient_id', $diagnosisKeperawatanPatient->id)->first();
        if ($asesmentKeperawatanStatusFisikPatient == null) {
            $asesmentKeperawatanStatusFisikPatient = AsesmentKeperawatanStatusFisikPatient::create([
                'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id
            ]);
        } else {
            $statusFisikDiagnosaKeperawatanPatient = StatusFisikDiagnosaKeperawatanPatient::where('asesment_keperawatan_status_fisik_patient_id', $asesmentKeperawatanStatusFisikPatient->id)->first();
            if ($statusFisikDiagnosaKeperawatanPatient) {
                // Hapus detail kondisi fisik
                DetailStatusFisikDiagnosaKeperawatanPatient::where('status_fisik_diagnosa_keperawatan_patient_id', $statusFisikDiagnosaKeperawatanPatient->id)->delete();
                // Hapus entri status fisik
                $statusFisikDiagnosaKeperawatanPatient->delete();
            }


            $psikoSosio = PsikoSosioSpritualDiagnosaKeperawatanPatient::where('asesment_keperawatan_status_fisik_patient_id', $asesmentKeperawatanStatusFisikPatient->id)->first();
            if ($psikoSosio) {
                DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::where('psiko_sosio_spritual_diagnosa_keperawatan_patient_id', $psikoSosio->id)->delete();
                $psikoSosio->delete();
            }

            EkonomiDiagnosaKeperawatanPatient::where('asesment_keperawatan_status_fisik_patient_id', $asesmentKeperawatanStatusFisikPatient->id)->delete();

            RiwayatAlergiDiagnosaKeperawatanPatient::where('asesment_keperawatan_status_fisik_patient_id', $asesmentKeperawatanStatusFisikPatient->id)->delete();

            $asesmentNyeriDiagnosaKeperawatanPatient = AsesmentNyeriDiagnosaKeperawatanPatient::where('asesment_keperawatan_status_fisik_patient_id', $asesmentKeperawatanStatusFisikPatient->id)->first();
            if ($asesmentNyeriDiagnosaKeperawatanPatient) {
                DetailAsesmentNyeriDiagnosaKeperawatanPatient::where('asesment_nyeri_diagnosa_keperawatan_patient_id', $asesmentNyeriDiagnosaKeperawatanPatient->id)->delete();
                $asesmentNyeriDiagnosaKeperawatanPatient->delete();
            }
        }
        // Status Fisik
        $statusFisikDiagnosaKeperawatan = StatusFisikDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
            'darah' => $darah,
            'nadi' => $nadi,
            'suhu' => $suhu,
            'pernafasan' => $pernafasan,
            'tb' => $tb,
            'bb' => $bb,
        ]);

        foreach ($kondisiUmum as $kondisi) {
            DetailStatusFisikDiagnosaKeperawatanPatient::create([
                'status_fisik_diagnosa_keperawatan_patient_id' => $statusFisikDiagnosaKeperawatan->id,
                'category' => 'Kondisi Umum',
                'name' => $kondisi,
            ]);
        }

        foreach ($kebutuhanKhusus as $kebutuhan) {
            DetailStatusFisikDiagnosaKeperawatanPatient::create([
                'status_fisik_diagnosa_keperawatan_patient_id' => $statusFisikDiagnosaKeperawatan->id,
                'category' => 'Kebutuhan Khusus',
                'name' => $kebutuhan,
            ]);
        }

        foreach ($kesadaran as $kesadaran) {
            DetailStatusFisikDiagnosaKeperawatanPatient::create([
                'status_fisik_diagnosa_keperawatan_patient_id' => $statusFisikDiagnosaKeperawatan->id,
                'category' => 'Kesadaran',
                'name' => $kesadaran,
            ]);
        }

        // Psiko sosio Spritual

        $psikoSosioSpritual = PsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
        ]);

        foreach ($psikologis as $psiko) {
            DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
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
            'value' => 'Nama :  ' . $kerabatNama  . ' Hubungan ' . $kerabatHubungan . ' Telepon ' . $kerabatHp,
        ]);

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'sosial',
            'name' => 'Hambatan Sosial',
            'value' => $hambatanSosial . ' Keterangan : ' . $keteranganHambatanSosial,
        ]);
        foreach ($spiritual as $spiritualDetail) {
            DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
                'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
                'category' => 'spritual',
                'name' => $spiritualDetail['name'],
                'value' => $spiritualDetail['value']
            ]);
        }


        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'spritual',
            'name' => 'Kultular / Nilai kepercayaan',
            'value' => $ketNilaiKepercayaan,
            'value' => $nilaiKepercayaan . ' Keterangan : ' . $ketNilaiKepercayaan,
        ]);

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'spritual',
            'name' => 'Apakah pasien memerlukan pelayanan / bimbingan rohani',
            'value' => $ketRohani
        ]);


        // Ekonomi

        EkonomiDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'status' => $status,
            'hambatan' => $ketHambatanEkonomi,
            'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
        ]);


        //Riwayat Alergi
        $alergi = $request->input('alergi');
        if ($alergi) {
            if ($alergi === 'Ada') {
                $ketAlergi = $request->input('ket-alergi');
                $reaksi = $request->input('reaksi');
                foreach ($ketAlergi as $index => $value) {
                    RiwayatAlergiDiagnosaKeperawatanPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'status' => $alergi,
                        'alergi' => $value,
                        'reaksi' => $reaksi[$index],
                        'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
                    ]);
                }
            } else {
                RiwayatAlergiDiagnosaKeperawatanPatient::create([
                    'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                    'status' => $alergi,
                    'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
                ]);
            }
        }



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
            'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
        ]);

        foreach ($nyeriHilang as $nyeri_hilang) {
            DetailAsesmentNyeriDiagnosaKeperawatanPatient::create([
                'asesment_nyeri_diagnosa_keperawatan_patient_id' => $asesmentNyeriDiagnosaKeperawatanPatient->id,
                'name' => $nyeri_hilang,
            ]);
        }
        return redirect(route('rajal/asesmen/status/fisik.index', $queue->id))->with('success', 'SUKSES BERHASIL DI TAMBAHKAN');

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
