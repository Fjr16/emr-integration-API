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

class AsesmentKeperawatanStatusFisikRanapController extends Controller
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
        return view('pages.ranapAsesmentKeperawatanPatient.statusFisik.index', [
            'item' => $item,
            'kriteriaNames' => $kriteriaNames,
            'kondisiUmum' => $kondisiUmum,
            'kebutuhanKhusus' => $kebutuhanKhusus,
            'kesadaran' => $kesadaran,
            'psikologis' => $psikologis,
            'spritual' => $spritual,
            'asesmentNyeri' => $asesmentNyeri,
            "title" => "Asesmen Awal Keperawatan Pasien Rawat Inap",
            "menu" => "Rawat Inap",
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
        // dd($request->all());
        // input status fisik
        $kondisiUmum = $request->input('kondisi-umum', []);
        $kesadaran = $request->input('kesadaran', []);
        $kebutuhanKhusus = $request->input('kebutuhan-khusus', []);
        $darah = $request->input('darah');
        $nadi = $request->input('nadi');
        $suhu = $request->input('suhu');
        $pernafasan = $request->input('pernafasan');
        $tb = $request->input('tb');
        $bb = $request->input('bb');

        // input psiko-sosio
        $psikologis = $request->input('psikologis', []);
        $pasien = $request->input('pasien');
        $interaksi = $request->input('interaksi');
        $datang = $request->input('datang');
        $hubungan = $request->input('hubungan');
        $kerabatNama = $request->input('kerabat-nama');
        $kerabatHubungan = $request->input('kerabat-hubungan');
        $kerabatHp = $request->input('kerabat-hp');
        $hmbtnSosial = $request->input('hambatan-sosial');
        if ($hmbtnSosial == 'Ada') {
            $hambatanSosial = $request->input('ket-hambatan-sosial');
        } else {
            $hambatanSosial = 'Tidak Ada';
        }
        $spiritual = $request->input('spiritual');
        if ($spiritual == 'Sehat') {
            $ketHambatanSpiritual = $request->input('ket-sehat');
        } elseif ($spiritual == 'Sakit') {
            $ketHambatanSpiritual = $request->input('ket-sakit');
        } elseif ($spiritual == 'Hambatan Spiritual') {
            $hambatanSpiritual = $request->input('hambatan-spiritual');
            if ($hambatanSpiritual == 'Ada') {
                $ketHambatanSpiritual = $request->input('ket-hambatan-spiritual');
            } else {
                $ketHambatanSpiritual = 'Tidak Ada';
            }
        }
        $nilaiKepercayaan = $request->input('nilai-kepercayaan');
        if ($nilaiKepercayaan == 'Ada') {
            $ketNilaiKepercayaan = $request->input('ket-nilai-kepercayaan');
        } else {
            $ketNilaiKepercayaan = 'Tidak Ada';
        }
        $rohani = $request->input('rohani');
        if ($rohani == 'Ya') {
            $ketRohani = $request->input('ket-rohani');
        } else {
            $ketRohani = 'Tidak';
        }

        // input ekonomi
        $status = $request->input('status');
        $hambatanEkonomi = $request->input('hambatan-ekonomi');
        if ($hambatanEkonomi == 'Ada') {
            $ketHambatanEkonomi = $request->input('ket-hambatan-ekonomi');
        } else {
            $ketHambatanEkonomi = 'Tidak Ada';
        }

        // input riwayat alergi
        $alergi = $request->input('alergi');
        if ($alergi == 'Ada') {
            $alergi = $request->input('alergi');
            $alergiObat = $request->input('alergi-obat');
            $reaksiObat = $request->input('reaksi-obat');
            $alergiMakanan = $request->input('alergi-makanan');
            $reaksiMakanan = $request->input('reaksi-makanan');
            $alergiLainnya = $request->input('alergi-lainnya');
            $reaksiLainnya = $request->input('reaksi-lainnya');
        } else {
            $alergi = $request->input('alergi');
            $alergiObat = null;
            $reaksiObat = null;
            $alergiMakanan = null;
            $reaksiMakanan = null;
            $alergiLainnya = null;
            $reaksiLainnya = null;
        }

        // input skrining dan asesmen nyeri
        $rasaNyeri = $request->input('rasa-nyeri');
        if ($rasaNyeri == 'Ya') {
            $rasaNyeri = $request->input('rasa-nyeri');
            $kategoriNyeri = $request->input('kategori-nyeri');
        } else {
            $rasaNyeri = $request->input('rasa-nyeri');
            $kategoriNyeri = null;
        }
        $provocation = $request->input('provocation');
        $quality = $request->input('quality');
        $region = $request->input('region');
        $severity = $request->input('severity');
        $time = $request->input('time');
        $nyeriHilang = $request->input('nyeri-hilang', []);

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
                DetailStatusFisikDiagnosaKeperawatanPatient::where('status_fisik_diagnosa_keperawatan_patient_id', $statusFisikDiagnosaKeperawatanPatient)->delete();
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

        foreach ($kondisiUmum as $ku) {
            DetailStatusFisikDiagnosaKeperawatanPatient::create([
                'status_fisik_diagnosa_keperawatan_patient_id' => $statusFisikDiagnosaKeperawatan->id,
                'category' => 'Kondisi Umum',
                'name' => $ku,
            ]);
        }

        foreach ($kebutuhanKhusus as $kk) {
            DetailStatusFisikDiagnosaKeperawatanPatient::create([
                'status_fisik_diagnosa_keperawatan_patient_id' => $statusFisikDiagnosaKeperawatan->id,
                'category' => 'Kebutuhan Khusus',
                'name' => $kk,
            ]);
        }

        foreach ($kesadaran as $k) {
            DetailStatusFisikDiagnosaKeperawatanPatient::create([
                'status_fisik_diagnosa_keperawatan_patient_id' => $statusFisikDiagnosaKeperawatan->id,
                'category' => 'Kesadaran',
                'name' => $k,
            ]);
        }

        // Psiko Sosio Spritual
        $psikoSosioSpritual = PsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
        ]);

        foreach ($psikologis as $p) {
            DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
                'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
                'category' => 'psikologis',
                'name' => $p,
                'value' => 'checked',
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
            'name' => $spiritual,
            'value' => $ketHambatanSpiritual
        ]);

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'spritual',
            'name' => 'Kultural / Nilai Kepercayaan',
            'value' => $ketNilaiKepercayaan
        ]);

        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::create([
            'psiko_sosio_spritual_diagnosa_keperawatan_patient_id' => $psikoSosioSpritual->id,
            'category' => 'spritual',
            'name' => 'Apakah pasien memerlukan pelayanan / bimbingan rohani selama dirawat?',
            'value' => $ketRohani
        ]);

        // Ekonomi
        EkonomiDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
            'status' => $status,
            'hambatan' => $ketHambatanEkonomi,
        ]);

        //Riwayat Alergi
        RiwayatAlergiDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
            'status' => $alergi,
            'alergi' => $alergiObat,
            'reaksi' => $reaksiObat,
        ]);

        RiwayatAlergiDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
            'status' => $alergi,
            'alergi' => $alergiMakanan,
            'reaksi' => $reaksiMakanan,
        ]);

        RiwayatAlergiDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
            'status' => $alergi,
            'alergi' => $alergiLainnya,
            'reaksi' => $reaksiLainnya,
        ]);

        // SKRINING DAN ASESMEN NYERI
        $asesmentNyeriDiagnosaKeperawatanPatient = AsesmentNyeriDiagnosaKeperawatanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'asesment_keperawatan_status_fisik_patient_id' => $asesmentKeperawatanStatusFisikPatient->id,
            'status' => $rasaNyeri,
            'category' => $kategoriNyeri,
            'provocation' => $provocation,
            'quality' => $quality,
            'region' => $region,
            'severity' => $severity,
            'time' => $time,
        ]);

        foreach ($nyeriHilang as $nyeri_hilang) {
            DetailAsesmentNyeriDiagnosaKeperawatanPatient::create([
                'asesment_nyeri_diagnosa_keperawatan_patient_id' => $asesmentNyeriDiagnosaKeperawatanPatient->id,
                'name' => $nyeri_hilang,
            ]);
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
