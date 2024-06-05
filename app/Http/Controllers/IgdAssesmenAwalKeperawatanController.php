<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\IgdAseKepPatient;
use App\Models\IgdEkonomiAssKepPatient;
use App\Models\IgdStatusFisikAssKepPatient;
use App\Models\IgdAsesmenNyeriAssKepPatient;
use App\Models\IgdRencanaAsuhanAssKepPatient;
use App\Models\IgdRiwayatAlergiAssKepPatient;
use App\Models\IgdPsikoSpiritualAssKepPatient;
use App\Models\IgdSkriningResikoAssKepPatient;
use App\Models\IgdStatusFungsionalAssKepPatient;
use App\Models\IgdDetailStatusFisikAssKepPatient;
use App\Models\IgdResikoNutrisionalAssKepPatient;
use App\Models\IgdDetailAsesmenNyeriAssKepPatient;
use App\Models\IgdMasalahKeperawatanAssKepPatient;
use App\Models\IgdDetailSkriningResikoAssKepPatient;
use App\Models\IgdDiagnosisKeperawatanAssKepPatient;

class IgdAssesmenAwalKeperawatanController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = IgdAseKepPatient::find($id);

        //status fisik
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

        $statusFisik = IgdStatusFisikAssKepPatient::where('igd_ase_kep_patient_id', $item->id)->first();
        $kondisiUmums = IgdDetailStatusFisikAssKepPatient::where('igd_status_fisik_ass_kep_patient_id', $statusFisik->id)->where('category', 'Kondisi Umum')->get();
        $kebutuhanKhususs = IgdDetailStatusFisikAssKepPatient::where('igd_status_fisik_ass_kep_patient_id', $statusFisik->id)->where('category', 'Kebutuhan Khusus')->get();
        $kesadarans = IgdDetailStatusFisikAssKepPatient::where('igd_status_fisik_ass_kep_patient_id', $statusFisik->id)->where('category', 'Kesadaran')->get();
        $psikos = IgdPsikoSpiritualAssKepPatient::where('igd_ase_kep_patient_id', $item->id)->where('category', 'psikologis')->get();
        $sosials = IgdPsikoSpiritualAssKepPatient::where('igd_ase_kep_patient_id', $item->id)->where('category', 'sosial')->get();
        $spirituals = IgdPsikoSpiritualAssKepPatient::where('igd_ase_kep_patient_id', $item->id)->where('category', 'spritual')->get();
        $ekonomi = IgdEkonomiAssKepPatient::where('igd_ase_kep_patient_id', $item->id)->first();
        $alergi = IgdRiwayatAlergiAssKepPatient::where('igd_ase_kep_patient_id', $item->id)->first();
        $skrinAsesmenNyeri = IgdAsesmenNyeriAssKepPatient::where('igd_ase_kep_patient_id', $item->id)->first();
        $nyeriHilang = IgdDetailAsesmenNyeriAssKepPatient::where('igd_asesmen_nyeri_ass_kep_patient_id', $skrinAsesmenNyeri->id)->first();

        //skrining dan asesmen risiko jatuh
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

        $skriningResiko = IgdSkriningResikoAssKepPatient::where('igd_ase_kep_patient_id', $item->id)->first();
        $detailSkriningResiko = IgdDetailSkriningResikoAssKepPatient::where('igd_skrining_resiko_ass_kep_patient_id', $skriningResiko->id)->get();
        $statusFungsional = IgdStatusFungsionalAssKepPatient::where('igd_ase_kep_patient_id', $item->id)->get();
        $skriningNutrisional = IgdResikoNutrisionalAssKepPatient::where('igd_ase_kep_patient_id', $item->id)->get();

        $bdNyeriAkut = [
            'Agen pencedera fisiologis *(Inflamasi/Iskemia/Neoplasma)',
            'Agen pencedera fisik *(Abses/Amputasi/Terpotong/Trauma/Fraktur/Prosedur Operasi/Latihan Fisik berlebihan/Mengangkat Berat)',
            'Agen pencedera kimia *(terbakar/bahan kimia iritan)',
        ];

        $bdFisik = [
            'Kerusakan Struktur Tulang',
            'Kontraktur',
            'Penurunan kekuatan otot',
            'Kekakuan Sendi',
            'Program Pembatasan Gerak',
        ];
        $bdIntegritas = [
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
        $bdJalanNafas = [
            'Spasme Jalan Napas',
            'Sekresi yang tertahan',
            'Benda asing dalam jalan napas',
        ];
        $bdPolaNafas = [
            'Efek Agen Farmakologis',
            'Hambatan Upaya Napas',
        ];

        $masalahKeperawatan = [
            'Nyeri Akut / Kronis',
            'Retensi Urine',
            'Bersihan Jalan Napas',
            'Gangguan Mobilitas Fisik',
            'Gangguan Integritas Kulit',
            'Pola Napas Tidak Efektif',
        ];

        $asesmenDiagnosa = IgdDiagnosisKeperawatanAssKepPatient::where('igd_ase_kep_patient_id', $item->id)->get();
        $masalah = IgdMasalahKeperawatanAssKepPatient::where('igd_ase_kep_patient_id', $item->id)->get();

        //rencana asuhan
        $rencanaAsuhan = [
            'Manajemen Nyeri',
            'Dukungan Mobilisasi',
            'Perawatan Luka',
            'Manajemen Jalan Napas',
            'Perawatan Retensi Urine',
        ];

        $detailRencana = IgdRencanaAsuhanAssKepPatient::where('igd_ase_kep_patient_id', $item->id)->get();

        $tgl_lahir = new DateTime($item->patient->tanggal_lhr);
        $today = new DateTime();
        $usia = $tgl_lahir->diff($today)->y;

        return view('pages.igdAssKepPatient.show', [
            "item" => $item,
            "title" => "Asesmen Awal Keperawatan Pasien Rawat Inap",
            "menu" => "Rawat Inap",
            "kriteriaNames" => $kriteriaNames,
            "kondisiUmum" => $kondisiUmum,
            "kebutuhanKhusus" => $kebutuhanKhusus,
            "kesadaran" => $kesadaran,
            "psikologis" => $psikologis,
            "spritual" => $spritual,
            "asesmentNyeri" => $asesmentNyeri,
            "statusFisik" => $statusFisik,
            "kondisiUmums" => $kondisiUmums,
            "kebutuhanKhususs" => $kebutuhanKhususs,
            "kesadarans" => $kesadarans,
            "psikos" => $psikos,
            "sosials" => $sosials,
            "spirituals" => $spirituals,
            "ekonomi" => $ekonomi,
            "alergi" => $alergi,
            "skrinAsesmenNyeri" => $skrinAsesmenNyeri,
            "nyeriHilang" => $nyeriHilang,
            "komponenPenilaian1" => $komponenPenilaian1,
            "komponenPenilaian2" => $komponenPenilaian2,
            "skriningResiko" => $skriningResiko,
            "detailSkriningResiko" => $detailSkriningResiko,
            "skriningNutrisional" => $skriningNutrisional,
            "statusFungsional" => $statusFungsional,
            "bdNyeriAkut" => $bdNyeriAkut,
            "bdFisik" => $bdFisik,
            "bdIntegritas" => $bdIntegritas,
            "bdUrine" => $bdUrine,
            "bdJalanNafas" => $bdJalanNafas,
            "bdPolaNafas" => $bdPolaNafas,
            "masalahKeperawatan" => $masalahKeperawatan,
            "asesmenDiagnosa" => $asesmenDiagnosa,
            "masalah" => $masalah,
            "rencanaAsuhan" => $rencanaAsuhan,
            "detailRencana" => $detailRencana,
            "usia" => $usia,
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
        $item = IgdAseKepPatient::find($id);
        if ($item->igdStatusFisikAssKepPatient) {
            $item->igdStatusFisikAssKepPatient->igdDetailStatusFisikAssKepPatients()->delete();
            $item->igdStatusFisikAssKepPatient->delete();
        }
        if ($item->igdPsikoSpiritualAssKepPatients) {
            $item->igdPsikoSpiritualAssKepPatients()->delete();
        }
        if ($item->igdEkonomiAssKepPatient) {
            $item->igdEkonomiAssKepPatient->delete();
        }
        if ($item->igdRiwayatAlergiAssKepPatient) {
            $item->igdRiwayatAlergiAssKepPatient->delete();
        }
        if ($item->igdAsesmenNyeriAssKepPatient) {
            $item->igdAsesmenNyeriAssKepPatient->igdDetailAsesmenNyeriAssKepPatients()->delete();
            $item->igdAsesmenNyeriAssKepPatient->delete();
        }
        if ($item->igdSkriningResikoAssKepPatient) {
            $item->igdSkriningResikoAssKepPatient->igdDetailSkriningResikoAssKepPatients()->delete();
            $item->igdSkriningResikoAssKepPatient->delete();
        }
        if ($item->igdStatusFungsionalAssKepPatients) {
            $item->igdStatusFungsionalAssKepPatients()->delete();
        }
        if ($item->igdResikoNutrisionalAssKepPatients) {
            $item->igdResikoNutrisionalAssKepPatients()->delete();
        }
        
        if ($item->igdDiagnosisKeperawatanAssKepPatients) {
            foreach ($item->igdDiagnosisKeperawatanAssKepPatients as $key) {
                $key->igdHubDiagnosisKepAssKepPatients()->delete();
            }
            $item->igdDiagnosisKeperawatanAssKepPatients()->delete();
        }
        if ($item->igdMasalahKeperawatanAssKepPatients) {
            $item->igdMasalahKeperawatanAssKepPatients()->delete();
        }
        $item->delete();

        return back()->with([
            'success' => 'Berhasil Dihapus',
            'active' => 'asesmenperawat',
        ]);

    }
}
