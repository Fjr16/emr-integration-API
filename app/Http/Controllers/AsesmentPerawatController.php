<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Queue;
use App\Models\DiagnosisKeperawatanPatient;
use App\Models\HubunganDiagnosaAwalPatient;
use App\Models\DetailDiagnosisKeperawatanPatient;
use App\Models\EkonomiDiagnosaKeperawatanPatient;
use App\Models\AsesmentKeperawatanStatusFisikPatient;
use App\Models\ResikoRajalDiagnosaKeperawatanPatient;
use App\Models\AsesmentKeperawatanRencanaAsuhanPatient;
use App\Models\AsesmentNyeriDiagnosaKeperawatanPatient;
use App\Models\DetailMasalahDiagnosisKeperawatanPatient;
use App\Models\DetailResikoRajalDiagnosaKeperawatanPatient;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}
