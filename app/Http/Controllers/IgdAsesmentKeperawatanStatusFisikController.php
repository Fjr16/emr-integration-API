<?php

namespace App\Http\Controllers;

use App\Models\IgdPatient;
use Illuminate\Http\Request;
use App\Models\IgdAseKepPatient;
use Illuminate\Support\Facades\Auth;
use App\Models\IgdEkonomiAssKepPatient;
use App\Models\IgdStatusFisikAssKepPatient;
use App\Models\IgdAsesmenNyeriAssKepPatient;
use App\Models\IgdRiwayatAlergiAssKepPatient;
use App\Models\IgdPsikoSpiritualAssKepPatient;
use App\Models\IgdDetailStatusFisikAssKepPatient;
use App\Models\IgdDetailAsesmenNyeriAssKepPatient;

class IgdAsesmentKeperawatanStatusFisikController extends Controller
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

        $statusFisik = IgdStatusFisikAssKepPatient::where('igd_ase_kep_patient_id', $item->igdAseKepPatient->id ?? '')->first();
        $psikos = IgdPsikoSpiritualAssKepPatient::where('igd_ase_kep_patient_id', $item->igdAseKepPatient->id ?? '')->where('category', 'psikologis')->pluck('name')->toArray();
        $sosials = IgdPsikoSpiritualAssKepPatient::where('igd_ase_kep_patient_id', $item->igdAseKepPatient->id ?? '')->where('category', 'sosial')->get();
        $spirituals = IgdPsikoSpiritualAssKepPatient::where('igd_ase_kep_patient_id', $item->igdAseKepPatient->id ?? '')->where('category', 'spritual')->get();
        $ekonomi = IgdEkonomiAssKepPatient::where('igd_ase_kep_patient_id', $item->igdAseKepPatient->id ?? '')->first();
        $alergi = IgdRiwayatAlergiAssKepPatient::where('igd_ase_kep_patient_id', $item->igdAseKepPatient->id ?? '')->first();
        $skrinAsesmenNyeri = IgdAsesmenNyeriAssKepPatient::where('igd_ase_kep_patient_id', $item->igdAseKepPatient->id ?? '')->first();
        $nyeriHilang = IgdDetailAsesmenNyeriAssKepPatient::where('igd_asesmen_nyeri_ass_kep_patient_id', $skrinAsesmenNyeri->id ?? '')->first();

        return view('pages.igdAssKepPatient.statusFisik.index', [
            'item' => $item,
            'kondisiUmum' => $kondisiUmum,
            'kebutuhanKhusus' => $kebutuhanKhusus,
            'kesadaran' => $kesadaran,
            'psikologis' => $psikologis,
            'spritual' => $spritual,
            'asesmentNyeri' => $asesmentNyeri,
            'statusFisik' => $statusFisik,
            'psikos' => $psikos,
            'sosials' => $sosials,
            'spirituals' => $spirituals,
            'ekonomi' => $ekonomi,
            'alergi' => $alergi,
            'skrinAsesmenNyeri' => $skrinAsesmenNyeri,
            'nyeriHilang' => $nyeriHilang,
            'currentIgdPatientId' => $currentIgdPatientId,
            "title" => "IGD",
            "menu" => "IGD",
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
        $ketHambatanSpiritual = '';
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

        $igdPatient = IgdPatient::find($id);
        // $patient = Patient::find($queue->patient->id);

        $igdAssKep = IgdAseKepPatient::where('igd_patient_id', $igdPatient->id)->first();

        if ($igdAssKep == null) {
            $igdAssKep = IgdAseKepPatient::create([
                'patient_id' => $igdPatient->queue->patient->id,
                'igd_patient_id' => $igdPatient->id,
                'user_id' => Auth::user()->id,
            ]);
        }

        $igdStatusFisikAssKepPatient = IgdStatusFisikAssKepPatient::where('igd_ase_kep_patient_id', $igdAssKep->id)->first();
        if ($igdStatusFisikAssKepPatient) { 
            $igdStatusFisikAssKepPatient->igdDetailStatusFisikAssKepPatients()->delete();
            $igdStatusFisikAssKepPatient->delete();

            if ($igdAssKep->igdPsikoSpiritualAssKepPatients()) {
                $igdAssKep->igdPsikoSpiritualAssKepPatients()->delete();
            }
            if ($igdAssKep->igdEkonomiAssKepPatient) {
                $igdAssKep->igdEkonomiAssKepPatient->delete();
            }
            if ($igdAssKep->igdRiwayatAlergiAssKepPatient) {
                $igdAssKep->igdRiwayatAlergiAssKepPatient->delete();
            }
            if ($igdAssKep->igdAsesmenNyeriAssKepPatient) {
                $igdAssKep->igdAsesmenNyeriAssKepPatient->igdDetailAsesmenNyeriAssKepPatients()->delete();
                $igdAssKep->igdAsesmenNyeriAssKepPatient->delete();
            }
        }

        // Status Fisik
        $igdStatusFisikAssKepPatient = IgdStatusFisikAssKepPatient::create([
            'igd_ase_kep_patient_id' => $igdAssKep->id,
            'darah' => $darah,
            'nadi' => $nadi,
            'suhu' => $suhu,
            'pernafasan' => $pernafasan,
            'tb' => $tb,
            'bb' => $bb,
        ]);
        foreach ($kondisiUmum as $ku) {
            IgdDetailStatusFisikAssKepPatient::create([
                'igd_status_fisik_ass_kep_patient_id' => $igdStatusFisikAssKepPatient->id,
                'category' => 'Kondisi Umum',
                'name' => $ku,
            ]);
        }
        foreach ($kebutuhanKhusus as $kk) {
            IgdDetailStatusFisikAssKepPatient::create([
                'igd_status_fisik_ass_kep_patient_id' => $igdStatusFisikAssKepPatient->id,
                'category' => 'Kebutuhan Khusus',
                'name' => $kk,
            ]);
        }
        foreach ($kesadaran as $k) {
            IgdDetailStatusFisikAssKepPatient::create([
                'igd_status_fisik_ass_kep_patient_id' => $igdStatusFisikAssKepPatient->id,
                'category' => 'Kesadaran',
                'name' => $k,
            ]);
        }

        // Psiko Sosio Spritual
        foreach ($psikologis as $p) {
            IgdPsikoSpiritualAssKepPatient::create([
                'igd_ase_kep_patient_id' => $igdAssKep->id,
                'category' => 'psikologis',
                'name' => $p,
                'value' => 'checked',
            ]);
        }
        IgdPsikoSpiritualAssKepPatient::create([
            'igd_ase_kep_patient_id' => $igdAssKep->id,
            'category' => 'sosial',
            'name' => 'Pasien tinggal dirumah dengan siapa',
            'value' => $pasien,
        ]);
        IgdPsikoSpiritualAssKepPatient::create([
            'igd_ase_kep_patient_id' => $igdAssKep->id,
            'category' => 'sosial',
            'name' => 'Interaksi dengan lingkungan sekitar',
            'value' => $interaksi,
        ]);
        IgdPsikoSpiritualAssKepPatient::create([
            'igd_ase_kep_patient_id' => $igdAssKep->id,
            'category' => 'sosial',
            'name' => 'Datang kerumah sakit dengan siapa',
            'value' => $datang . '/ Hubungan : ' . $hubungan,
        ]);
        IgdPsikoSpiritualAssKepPatient::create([
            'igd_ase_kep_patient_id' => $igdAssKep->id,
            'category' => 'sosial',
            'name' => 'Kerabat terdekat yang bisa dihubungi : ',
            'value' => 'Nama :  ' . $kerabatNama  . ' Hubungan ' . $kerabatHubungan, ' Telepon ' . $kerabatHp,
        ]);
        IgdPsikoSpiritualAssKepPatient::create([
            'igd_ase_kep_patient_id' => $igdAssKep->id,
            'category' => 'sosial',
            'name' => 'Hambatan Sosial',
            'value' => $hambatanSosial
        ]);
        IgdPsikoSpiritualAssKepPatient::create([
            'igd_ase_kep_patient_id' => $igdAssKep->id,
            'category' => 'spritual',
            'name' => $spiritual,
            'value' => $ketHambatanSpiritual
        ]);
        IgdPsikoSpiritualAssKepPatient::create([
            'igd_ase_kep_patient_id' => $igdAssKep->id,
            'category' => 'spritual',
            'name' => 'Kultural / Nilai Kepercayaan',
            'value' => $ketNilaiKepercayaan
        ]);
        IgdPsikoSpiritualAssKepPatient::create([
            'igd_ase_kep_patient_id' => $igdAssKep->id,
            'category' => 'spritual',
            'name' => 'Apakah pasien memerlukan pelayanan / bimbingan rohani selama dirawat?',
            'value' => $ketRohani
        ]);

        // Ekonomi
        IgdEkonomiAssKepPatient::create([
            'igd_ase_kep_patient_id' => $igdAssKep->id,
            'status' => $status,
            'hambatan' => $ketHambatanEkonomi,
        ]);

        //Riwayat Alergi
        IgdRiwayatAlergiAssKepPatient::create([
            'igd_ase_kep_patient_id' => $igdAssKep->id,
            'status' => $alergi,
            'alergi_obat' => $alergiObat,
            'reaksi_obat' => $reaksiObat,
            'alergi_mkn' => $alergiMakanan,
            'reaksi_mkn' => $reaksiMakanan,
            'alergi_lainnya' => $alergiLainnya,
            'reaksi_lainnya' => $reaksiLainnya,
        ]);

        // SKRINING DAN ASESMEN NYERI
        $asesmentNyeriDiagnosaKeperawatanPatient = IgdAsesmenNyeriAssKepPatient::create([
            'igd_ase_kep_patient_id' => $igdAssKep->id,
            'status' => $rasaNyeri,
            'category' => $kategoriNyeri,
            'provocation' => $provocation,
            'quality' => $quality,
            'region' => $region,
            'severity' => $severity,
            'time' => $time,
        ]);

        foreach ($nyeriHilang as $nyeri_hilang) {
            IgdDetailAsesmenNyeriAssKepPatient::create([
                'igd_asesmen_nyeri_ass_kep_patient_id' => $asesmentNyeriDiagnosaKeperawatanPatient->id,
                'name' => $nyeri_hilang,
            ]);
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
