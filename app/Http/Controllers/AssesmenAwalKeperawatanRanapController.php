<?php

namespace App\Http\Controllers;

use App\Models\AsesmentKeperawatanDiagnosisKeperawatanPatient;
use App\Models\AsesmentKeperawatanRencanaAsuhanPatient;
use App\Models\AsesmentNyeriDiagnosaKeperawatanPatient;
use App\Models\AsesmentStatusFungsionalDiagnosaKeperawatanPatient;
use App\Models\DetailAsesmentKeperawatanRencanaAsuhanPatient;
use App\Models\DetailAsesmentNyeriDiagnosaKeperawatanPatient;
use App\Models\DetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient;
use App\Models\DetailDiagnosisKeperawatanPatient;
use App\Models\DetailMasalahDiagnosisKeperawatanPatient;
use App\Models\DetailPsikoSosioSpritualDiagnosaKeperawatanPatient;
use App\Models\DetailRisikoNutrisionalDiagnosaKeperawatanPatient;
use App\Models\DetailStatusFisikDiagnosaKeperawatanPatient;
use App\Models\DiagnosisKeperawatanPatient;
use App\Models\EkonomiDiagnosaKeperawatanPatient;
use App\Models\PsikoSosioSpritualDiagnosaKeperawatanPatient;
use App\Models\Queue;
use App\Models\RawatInapPatient;
use App\Models\RisikoNutrisionalDiagnosaKeperawatanPatient;
use App\Models\RiwayatAlergiDiagnosaKeperawatanPatient;
use App\Models\SkriningAsesmenResikoJatuhRanap;
use App\Models\StatusFisikDiagnosaKeperawatanPatient;
use DateTime;
use Illuminate\Http\Request;

class AssesmenAwalKeperawatanRanapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient', function($query){
            $query->whereNot('status', 'WAITING')->whereNot('status', 'BATAL');
        })->get();
        return view('pages.ranapAsesmentKeperawatanPatient.index', [
            "title" => "Asesmen Awal Keperawatan Pasien Rawat Inap",
            "menu" => "Rawat Inap",
            'data' => $data,
        ]);
    }

    public function detail($id)
    {
        $item = RawatInapPatient::find($id);
        $data = DiagnosisKeperawatanPatient::where('queue_id', $item->queue_id)->get();

        return view('pages.ranapAsesmentKeperawatanPatient.detail', [
            "item" => $item,
            "title" => "Asesmen Awal Keperawatan Pasien Rawat Inap",
            "menu" => "Rawat Inap",
            "data" => $data,
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
        $item = DiagnosisKeperawatanPatient::find($id);

        //status fisik
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

        $statusFisik = StatusFisikDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $kondisiUmums = DetailStatusFisikDiagnosaKeperawatanPatient::where('status_fisik_diagnosa_keperawatan_patient_id', $statusFisik->id)->where('category', 'Kondisi Umum')->get();
        $kebutuhanKhususs = DetailStatusFisikDiagnosaKeperawatanPatient::where('status_fisik_diagnosa_keperawatan_patient_id', $statusFisik->id)->where('category', 'Kebutuhan Khusus')->get();
        $kesadarans = DetailStatusFisikDiagnosaKeperawatanPatient::where('status_fisik_diagnosa_keperawatan_patient_id', $statusFisik->id)->where('category', 'Kesadaran')->get();
        $psikoSosio = PsikoSosioSpritualDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $psikos = DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::where('psiko_sosio_spritual_diagnosa_keperawatan_patient_id', $psikoSosio->id)->where('category', 'psikologis')->get();
        $sosials = DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::where('psiko_sosio_spritual_diagnosa_keperawatan_patient_id', $psikoSosio->id)->where('category', 'sosial')->get();
        $spirituals = DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::where('psiko_sosio_spritual_diagnosa_keperawatan_patient_id', $psikoSosio->id)->where('category', 'spritual')->get();
        $ekonomi = EkonomiDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $alergi = RiwayatAlergiDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->get();
        $asesmenNyeri = AsesmentNyeriDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $nyeriHilang = DetailAsesmentNyeriDiagnosaKeperawatanPatient::where('asesment_nyeri_diagnosa_keperawatan_patient_id', $asesmenNyeri->id)->get();

        //skrining dan asesmen risiko jatuh
        $komponenPenilaian1 = [
            'Pasien usia < 1 tahun termasuk kategori risiko jatuh tinggi',
            'Usia 1 - 12 tahun dengan Humpty dumpty',
            'Dewasa usia > 12 - 65 tahun dengan Morse Fall Scale',
            'Usia > 65 tahun dengan Hendrich',
        ];

        $skriningResiko = SkriningAsesmenResikoJatuhRanap::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $statusFungsional = AsesmentStatusFungsionalDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $detailStatusFungsional = DetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient::where('asesment_status_fungsional_diagnosa_keperawatan_patient_id', $statusFungsional->id)->get();
        $skriningNutrisional = RisikoNutrisionalDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $detailSkriningNutrisional = DetailRisikoNutrisionalDiagnosaKeperawatanPatient::where('risiko_nutrisional_diagnosa_keperawatan_patient_id', $skriningNutrisional->id)->get();

        //diagnosis keperawatan
        $bdAnsietas = [
            'Tindakan Pembedahan',
            'Kurangi Terpapar Informasi',
        ];
        $bdNyeriAkut = [
            'Agen pencedera fisiologis *(Inflamasi/Neoplasma)',
            'Agen pencedera fisik *(Abses/Trauma/Fraktur/Prosedur Operasi',
            'Agen pencedera kimia *(terbakar/bahan kimia iritan)',
        ];

        $bdNyeriKronis = [
            'Pasca Trauma/Fraktur',
            'Infiltrasi Tumor',
        ];

        $bdFisik = [
            'Kerusakan Struktur Tulang',
            'Kontraktur',
        ];

        $bdNausea = [
            'Distensi Lambung',
            'Efek Farmakologis (anestesi, kemoterapi',
            'Penekanan Tekanan Intraabominal (keganasan)',
        ];
        $bdPendarahan = [
            'Tindakan Pembedahan',
            'Trauma',
            'Efek Agen Farmakologis',
            'Proses Keganasan',
            'Gangguan Koagulasi',
        ];
        $masalahKeperawatan = [
            'Ansietas',
            'Nyeri Akut',
            'Nyeri Kronis',
            'Gangguan Mobilitas Fisik',
            'Nausea',
            'Risiko Pendarahan',
        ];

        $asesmenDiagnosa = AsesmentKeperawatanDiagnosisKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $diagnosis = DetailDiagnosisKeperawatanPatient::where('asesment_keperawatan_diagnosis_keperawatan_patient_id', $asesmenDiagnosa->id)->get();
        $masalah = DetailMasalahDiagnosisKeperawatanPatient::where('asesment_keperawatan_diagnosis_keperawatan_patient_id', $asesmenDiagnosa->id)->get();

        //rencana asuhan
        $rencanaAsuhan = [
            'Reduksi Kecemasan',
            'Manajemen Nyeri',
            'Manajemen Eliminasi',
            'Dukungan Mobilitas',
            'Pencegahan Penularan',
            'Manajemen Mual',
            'Manajemen Muntah',
        ];

        $asesmenRencana = AsesmentKeperawatanRencanaAsuhanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $detailRencana = DetailAsesmentKeperawatanRencanaAsuhanPatient::where('asesment_keperawatan_rencana_asuhan_patient_id', $asesmenRencana->id)->get();

        $tgl_lahir = new DateTime($item->patient->tanggal_lhr);
        $today = new DateTime();
        $usia = $tgl_lahir->diff($today)->y;

        return view('pages.ranapAsesmentKeperawatanPatient.show', [
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
            "asesmenNyeri" => $asesmenNyeri,
            "nyeriHilang" => $nyeriHilang,
            "komponenPenilaian1" => $komponenPenilaian1,
            "skriningResiko" => $skriningResiko,
            "detailStatusFungsional" => $detailStatusFungsional,
            "skriningNutrisional" => $skriningNutrisional,
            "detailSkriningNutrisional" => $detailSkriningNutrisional,
            "bdAnsietas" => $bdAnsietas,
            "bdNyeriAkut" => $bdNyeriAkut,
            "bdNyeriKronis" => $bdNyeriKronis,
            "bdFisik" => $bdFisik,
            "bdNausea" => $bdNausea,
            "bdPendarahan" => $bdPendarahan,
            "masalahKeperawatan" => $masalahKeperawatan,
            "diagnosis" => $diagnosis,
            "masalah" => $masalah,
            "rencanaAsuhan" => $rencanaAsuhan,
            "asesmenRencana" => $asesmenRencana,
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
        $item = DiagnosisKeperawatanPatient::find($id);
        $statusFisik = StatusFisikDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $umm = DetailStatusFisikDiagnosaKeperawatanPatient::where('status_fisik_diagnosa_keperawatan_patient_id', $statusFisik->id)->where('category', 'Kondisi Umum')->get();
        $sdr = DetailStatusFisikDiagnosaKeperawatanPatient::where('status_fisik_diagnosa_keperawatan_patient_id', $statusFisik->id)->where('category', 'Kesadaran')->get();
        $khss = DetailStatusFisikDiagnosaKeperawatanPatient::where('status_fisik_diagnosa_keperawatan_patient_id', $statusFisik->id)->where('category', 'Kebutuhan Khusus')->get();
        $psikologi = PsikoSosioSpritualDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $psi = DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::where('psiko_sosio_spritual_diagnosa_keperawatan_patient_id', $psikologi->id)->where('category', 'psikologis')->get();
        $sos = DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::where('psiko_sosio_spritual_diagnosa_keperawatan_patient_id', $psikologi->id)->where('category', 'sosial')->get();
        $spi = DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::where('psiko_sosio_spritual_diagnosa_keperawatan_patient_id', $psikologi->id)->where('category', 'spritual')->get();
        $ekonomi = EkonomiDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $alergis = RiwayatAlergiDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->get();
        $nyeri = AsesmentNyeriDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $detailNyeri = DetailAsesmentNyeriDiagnosaKeperawatanPatient::where('asesment_nyeri_diagnosa_keperawatan_patient_id', $nyeri->id)->get();

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
        return view('pages.ranapAsesmentKeperawatanPatient.statusFisik.edit', [
            'item' => $item,
            'kriteriaNames' => $kriteriaNames,
            'statusFisik' => $statusFisik,
            'kondisiUmum' => $kondisiUmum,
            'umm' => $umm,
            'kebutuhanKhusus' => $kebutuhanKhusus,
            'khss' => $khss,
            'kesadaran' => $kesadaran,
            'sdr' => $sdr,
            'psikologi' => $psikologi,
            'psikologis' => $psikologis,
            'psi' => $psi,
            'sos' => $sos,
            'spi' => $spi,
            'spritual' => $spritual,
            'ekonomi' => $ekonomi,
            'alergis' => $alergis,
            'nyeri' => $nyeri,
            'detailNyeri' => $detailNyeri,
            'asesmentNyeri' => $asesmentNyeri,
            "title" => "Asesmen Awal Keperawatan Pasien Rawat Inap",
            "menu" => "Rawat Inap",
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
        $item = DiagnosisKeperawatanPatient::find($id);

        //status fisik
        $statusFisik = StatusFisikDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        DetailStatusFisikDiagnosaKeperawatanPatient::where('status_fisik_diagnosa_keperawatan_patient_id', $statusFisik->id)->delete();
        $statusFisik->delete();
        $psikoSosio = PsikoSosioSpritualDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::where('psiko_sosio_spritual_diagnosa_keperawatan_patient_id', $psikoSosio->id)->delete();
        $psikoSosio->delete();
        EkonomiDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->delete();
        RiwayatAlergiDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->delete();
        $asesmenNyeri = AsesmentNyeriDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        DetailAsesmentNyeriDiagnosaKeperawatanPatient::where('asesment_nyeri_diagnosa_keperawatan_patient_id', $asesmenNyeri->id)->delete();
        $asesmenNyeri->delete();

        //skrining dan asesmen risiko jatuh
        SkriningAsesmenResikoJatuhRanap::where('diagnosis_keperawatan_patient_id', $item->id)->delete();
        $statusFungsional = AsesmentStatusFungsionalDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        DetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient::where('asesment_status_fungsional_diagnosa_keperawatan_patient_id', $statusFungsional->id)->delete();
        $statusFungsional->delete();
        RisikoNutrisionalDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->delete();

        //diagnosis keperawatan
        $asesmenDiagnosa = AsesmentKeperawatanDiagnosisKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        DetailDiagnosisKeperawatanPatient::where('asesment_keperawatan_diagnosis_keperawatan_patient_id', $asesmenDiagnosa->id)->delete();
        DetailMasalahDiagnosisKeperawatanPatient::where('asesment_keperawatan_diagnosis_keperawatan_patient_id', $asesmenDiagnosa->id)->delete();
        $asesmenDiagnosa->delete();

        //rencana asuhan
        $asesmenRencana = AsesmentKeperawatanRencanaAsuhanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        DetailAsesmentKeperawatanRencanaAsuhanPatient::where('asesment_keperawatan_rencana_asuhan_patient_id', $asesmenRencana->id)->delete();
        $asesmenRencana->delete();

        $item->delete();

        return back()->with('success', 'BERHASIL DIHAPUS');
    }
}
