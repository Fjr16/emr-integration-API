<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\RanapMppAssesManagement;
use App\Models\RanapMppManagerPlanning;
use App\Models\RanapMppPatient;
use App\Models\RanapMppPelayananAdvanced;
use App\Models\RanapMppProblemRiskChance;
use App\Models\RanapMppSkriningPatient;
use App\Models\RanapRekapTindakanPelayananPatient;
use App\Models\RawatInapPatient;
use App\Models\RekapTindakanPelayananPatientDetail;
use App\Models\RingkasanMasukDanKeluarPatient;
use App\Models\RoomDetail;
use App\Models\SuratPengantarRawatJalanPatient;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RanapEvaluasiAwalMppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient')->get();
        return view('pages.mpp.index', [
            "title" => "MANAGER PELAYANAN PASIEN",
            "menu" => "Rawat Inap",
            'data' => $data,
        ]);
    }

    public function detail($id)
    {
        $item = RawatInapPatient::find($id);
        $data = RanapMppPatient::where('rawat_inap_patient_id', $id)->get();


        return view('pages.mpp.detail', [
            "title" => "MANAGER PELAYANAN PASIEN",
            "menu" => "Rawat Inap",
            "item" => $item,
            "data" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = RawatInapPatient::find($id);

        $cekData = RanapMppPatient::where('rawat_inap_patient_id', $item->id)->first();
        if ($cekData) {
            return redirect()->route('evaluasi/awal/MPP.edit', $cekData->id);
        }
        $roomDetails = RoomDetail::where('isActive', true)->get();
        $ringkasanPasien = RingkasanMasukDanKeluarPatient::where('rawat_inap_patient_id', $item->id)->first();
        $suratPengantar = SuratPengantarRawatJalanPatient::where('queue_id', $item->queue_id)->first();
        $ranapRekap = RanapRekapTindakanPelayananPatient::where('rawat_inap_patient_id', $item->id)->first();
        if ($ranapRekap) {
            $tindakan = RekapTindakanPelayananPatientDetail::where('ranap_rekap_tindakan_pelayanan_patient_id', $ranapRekap->id)->first();
        } else {
            $tindakan = [];
        }
        $arrKategoriMajor = [
            [
                'kriteria' => 'Pasien dengan Discharge Planning',
                'acuan' => '0 - 1',
            ],
            [
                'kriteria' => 'Isu sosial seperti terlantar, napi, tinggal sendiri, narkoba, krisis keluarga',
                'acuan' => '0 - 1',
            ],
            [
                'kriteria' => 'Sering masuk IGD, readmisi RS',
                'acuan' => '0 - 1',
            ],
            [
                'kriteria' => 'Potensi complain tinggi',
                'acuan' => '0 - 1',
            ],
        ];
        $arrKategoriMinor = [
            [
                'kriteria' => 'Usia',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Fungsi kognitif rendah',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Penyakit kronis, katastropik, terminal, multiple DPJP',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Status fungsional rendah, kebutuhan ADL (activity daily living) yang tinggi',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Riwayat penggunaan peralatan medis di masa lalu',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Riwayat gangguan mental',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Upaya bunuh diri',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Perkiraan asuhan dengan biaya tinggi',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Kemungkinan system pembiayaan yang kompleks, adanya masalah finansial',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Kasus yang melebihi rata-rata lama rawa',
                'acuan' => '0 - 3',
            ],
        ];

        $arrProbRiskChance = [
            'Asuhan tidak sesuai panduan / norma yang digunakan',
            'Kurangnya dukungan keluarga',
            'Under / Over Utilization Pelayanan dengan dasar panduan / Norma yang digunakan',
            'Pemulangan / Rujuan yang belum memenuhi kriteria atau yang ditunda',
            'Edukasi kurang memadai, pemahaman belum memadai',
            'Penurunan determinasi pasien',
            'Ketidakpatuhan pasien',
            'Kendala keuangan',
        ];
        $arrProbRiskChancePilihan = [
            [
                'LOS memanjang',
                'Tidak sesuai Clinical Pathway',
            ],
            [
                'Terlantar',
                'Tidak ditunggui keluarga',
            ],
            [
                'Pemeriksaan penunjang/pengobatan menunjukkan ketidaksesuaian dengan penyakit',
            ],
            [
                'Pasien/keluarga minta pulang paksa dengan kondisi berisiko',
                'Tempat rujukan tidak tersedia',
            ],
            [
                'Proses penyakit',
                'Kondisi terkini',
                'Daftar obat',
            ],
            [
                'Komplikasi',
                'Kondisi terminal',
            ],
            [
                'Menolak rencana asuhan',
            ],
            [
                'Pasien tanpa jaminan asuransi',
            ],
        ];
        return view('pages.mpp.create', [
            "title" => "MANAGER PELAYANAN PASIEN",
            "menu" => "Rawat Inap",
            "item" => $item,
            "arrKategoriMajor" => $arrKategoriMajor,
            "arrKategoriMinor" => $arrKategoriMinor,
            "arrProbRiskChance" => $arrProbRiskChance,
            "arrProbRiskChancePilihan" => $arrProbRiskChancePilihan,
            "roomDetails" => $roomDetails,
            "ringkasanPasien" => $ringkasanPasien,
            "suratPengantar" => $suratPengantar,
            "tindakan" => $tindakan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $item = RawatInapPatient::find($id);
        $totalSkorMajor = $request->input('total_skor_major');
        $totalSkorMinor = $request->input('total_skor_minor');
        $dataMppPatient = [
            'rawat_inap_patient_id' => $item->id,
            'patient_id' => $item->queue->patient->id,
            'user_id' => Auth::user()->id,
            'tanggal_masuk' => $request->input('tanggal_masuk'),
            'tanggal_keluar' => $request->input('tanggal_keluar'),
            'room_detail_id' => $request->input('room_detail_id'),
            'kelas_rawatan' => $request->input('kelas_rawatan'),
            'tindakan' => $request->input('tindakan'),
            'diagnosa' => $request->input('diagnosa'),
            'total_skor_minor' => $totalSkorMinor ?? '',
            'total_skor_major' => $totalSkorMajor ?? '',
        ];

        $itemRanapMppPatient = RanapMppPatient::create($dataMppPatient);

        // kategori major
        $arrKategoriMajor = [
            [
                'kriteria' => 'Pasien dengan Discharge Planning',
                'acuan' => '0 - 1',
            ],
            [
                'kriteria' => 'Isu sosial seperti terlantar, napi, tinggal sendiri, narkoba, krisis keluarga',
                'acuan' => '0 - 1',
            ],
            [
                'kriteria' => 'Sering masuk IGD, readmisi RS',
                'acuan' => '0 - 1',
            ],
            [
                'kriteria' => 'Potensi complain tinggi',
                'acuan' => '0 - 1',
            ],
        ];
        $skorMajors = $request->input('major_skor', []);
        $dataMajor = [];
        foreach ($arrKategoriMajor as $key => $major) {
            $dataMajor[$key] = [
                'ranap_mpp_patient_id' => $itemRanapMppPatient->id,
                'kriteria' => $major['kriteria'],
                'skor' => $skorMajors[$key],
                'kategori' => 'MAJOR',
            ];
            RanapMppSkriningPatient::create($dataMajor[$key]);
        }


        // kategori minor
        $arrKategoriMinor = [
            [
                'kriteria' => 'Usia',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Fungsi kognitif rendah',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Penyakit kronis, katastropik, terminal, multiple DPJP',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Status fungsional rendah, kebutuhan ADL (activity daily living) yang tinggi',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Riwayat penggunaan peralatan medis di masa lalu',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Riwayat gangguan mental',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Upaya bunuh diri',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Perkiraan asuhan dengan biaya tinggi',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Kemungkinan system pembiayaan yang kompleks, adanya masalah finansial',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Kasus yang melebihi rata-rata lama rawa',
                'acuan' => '0 - 3',
            ],
        ];
        $skorMinors = $request->input('minor_skor', []);
        $dataMinor = [];
        foreach ($arrKategoriMinor as $key => $minor) {
            $dataMinor[$key] = [
                'ranap_mpp_patient_id' => $itemRanapMppPatient->id,
                'kriteria' => $minor['kriteria'],
                'skor' => $skorMinors[$key],
                'kategori' => 'MINOR',
            ];
            RanapMppSkriningPatient::create($dataMinor[$key]);
        }

        // identifikasi masalah resiko kesempatan
        $arrProbRiskChance = [
            'Asuhan tidak sesuai panduan / norma yang digunakan',
            'Kurangnya dukungan keluarga',
            'Under / Over Utilization Pelayanan dengan dasar panduan / Norma yang digunakan',
            'Pemulangan / Rujuan yang belum memenuhi kriteria atau yang ditunda',
            'Edukasi kurang memadai, pemahaman belum memadai',
            'Penurunan determinasi pasien',
            'Ketidakpatuhan pasien',
            'Kendala keuangan',
        ];
        $chanceValues = $request->input('value', []);
        $rencanaAsuhanKeterangan = $request->input('keterangan_rencana_asuhan');

        $dataChance = [];
        foreach ($arrProbRiskChance as $key => $chance) {
            foreach ($chanceValues as $indexValue => $values) {
                if ($indexValue == $key) {
                    foreach ($values as $value) {
                        $keterangan = '';
                        if ($value == 'Menolak rencana asuhan') {
                            $keterangan = $rencanaAsuhanKeterangan;
                        }
                        $dataChance[] = [
                            'ranap_mpp_patient_id' => $itemRanapMppPatient->id,
                            'name' => $chance,
                            'value' => $value,
                            'keterangan' => $keterangan,
                        ];
                    }
                }
            }
        }

        if (!empty($dataChance)) {
            foreach ($dataChance as $key => $chances) {
                RanapMppProblemRiskChance::create($chances);
            }
        }

        // Perencanaan Manager Pelayanan Pasien
        $keteranganPlanning = $request->input('ket_manager_plan');
        if ($keteranganPlanning) {
            RanapMppManagerPlanning::create([
                'ranap_mpp_patient_id' => $itemRanapMppPatient->id,
                'keterangan' => $request->input('ket_manager_plan'),
            ]);
        }

        // Kelanjutan Pelayanan Pasien
        $tanggal = $request->input('tanggal', []);
        $kelanjutanKet = $request->input('kelanjutan_keterangan', []);
        $paraf  = $request->input('ttd_petugas');
        $petugas = $request->input('nama_petugas');
        foreach ($tanggal as $key => $tanggal) {
            if ($tanggal && $kelanjutanKet[$key]) {
                RanapMppPelayananAdvanced::create([
                    'ranap_mpp_patient_id' => $itemRanapMppPatient->id,
                    'tanggal' => $tanggal,
                    'name' => $petugas,
                    'paraf' => $paraf,
                    'keterangan' => $kelanjutanKet[$key],
                ]);
            }
        }


        // Assesmen untuk manager pelayanan pasien
        $fisik_kognitif = $request->input('fisik_kognitif');
        $pemahaman_kesehatan = $request->input('pemahaman_kesehatan');
        $riwayat_kesehatan = $request->input('riwayat_kesehatan');
        $riwayat_penggunaan_obat = $request->input('riwayat_penggunaan_obat');
        $perilaku = $request->input('perilaku');
        $pekerjaan = $request->input('pekerjaan');
        $kesehatan_mental = $request->input('kesehatan_mental');
        $adaptasi = $request->input('adaptasi');
        $dukungan_keluarga = $request->input('dukungan_keluarga');
        $asuransi = $request->input('asuransi');
        $lingkungan = $request->input('lingkungan');
        $perencanaan_lanjutan = $request->input('perencanaan_lanjutan');
        $riwayat_trauma = $request->input('riwayat_trauma');
        $aspek_legal = $request->input('aspek_legal');

        $arrAssManager = [
            'Fisik, Fungsional, Kognitif, Kemandirian',
            'Pemahaman Tentang Kesehatan',
            'Riwayat Kesehatan',
            'Riwayat Penggunaan Obat (Alternatif/NAPZA)',
            'Perilaku Psiko - Spiritual - Sosio - Kultural',
            'Finansial / Sumber Keuangan',
            'Kesehatan Mental & Kognitif',
            'Kemampuan Menerima Perubahan',
            'Tersedia dukungan keluarga / kemampuan merawat',
            'Asuransi / Penjamin',
            'Lingkungan & tempat tinggal',
            'Perencanaan Lanjutan',
            'Riwayat Trauma / Kekerasan',
            'Aspek legal',
        ];
        $arrValueAssManager = [
            $fisik_kognitif,
            $pemahaman_kesehatan,
            $riwayat_kesehatan,
            $riwayat_penggunaan_obat,
            $perilaku,
            $pekerjaan,
            $kesehatan_mental,
            $adaptasi,
            $dukungan_keluarga,
            $asuransi,
            $lingkungan,
            $perencanaan_lanjutan,
            $riwayat_trauma,
            $aspek_legal,
        ];

        $dataAssManager = [];
        foreach ($arrAssManager as $key => $nameAss) {
            if ($arrValueAssManager[$key]) {
                $dataAssManager[$key] = [
                    'ranap_mpp_patient_id' => $itemRanapMppPatient->id,
                    'name' => $nameAss,
                    'value' => $arrValueAssManager[$key],
                ];

                RanapMppAssesManagement::create($dataAssManager[$key]);
            }
        }

        return redirect()->route('evaluasi/awal/MPP.detail', $item->id)->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'managerpelayananpasien',
        ]);
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
        $item = RanapMppPatient::find($id);
        $roomDetails = RoomDetail::where('isActive', true)->get();
        $kelanjutanPelayanan =  RanapMppPelayananAdvanced::where('ranap_mpp_patient_id', $item->id)->get();
        $ranapProblem =  RanapMppProblemRiskChance::where('ranap_mpp_patient_id', $item->id)->get();
        $arrKategoriMajor = [
            [
                'kriteria' => 'Pasien dengan Discharge Planning',
                'acuan' => '0 - 1',
            ],
            [
                'kriteria' => 'Isu sosial seperti terlantar, napi, tinggal sendiri, narkoba, krisis keluarga',
                'acuan' => '0 - 1',
            ],
            [
                'kriteria' => 'Sering masuk IGD, readmisi RS',
                'acuan' => '0 - 1',
            ],
            [
                'kriteria' => 'Potensi complain tinggi',
                'acuan' => '0 - 1',
            ],
        ];
        $arrKategoriMinor = [
            [
                'kriteria' => 'Usia',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Fungsi kognitif rendah',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Penyakit kronis, katastropik, terminal, multiple DPJP',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Status fungsional rendah, kebutuhan ADL (activity daily living) yang tinggi',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Riwayat penggunaan peralatan medis di masa lalu',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Riwayat gangguan mental',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Upaya bunuh diri',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Perkiraan asuhan dengan biaya tinggi',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Kemungkinan system pembiayaan yang kompleks, adanya masalah finansial',
                'acuan' => '0 - 3',
            ],
            [
                'kriteria' => 'Kasus yang melebihi rata-rata lama rawa',
                'acuan' => '0 - 3',
            ],
        ];

        $arrProbRiskChance = [
            'Asuhan tidak sesuai panduan / norma yang digunakan',
            'Kurangnya dukungan keluarga',
            'Under / Over Utilization Pelayanan dengan dasar panduan / Norma yang digunakan',
            'Pemulangan / Rujuan yang belum memenuhi kriteria atau yang ditunda',
            'Edukasi kurang memadai, pemahaman belum memadai',
            'Penurunan determinasi pasien',
            'Ketidakpatuhan pasien',
            'Kendala keuangan',
        ];
        $arrProbRiskChancePilihan = [
            [
                'LOS memanjang',
                'Tidak sesuai Clinical Pathway',
            ],
            [
                'Terlantar',
                'Tidak ditunggui keluarga',
            ],
            [
                'Pemeriksaan penunjang/pengobatan menunjukkan ketidaksesuaian dengan penyakit',
            ],
            [
                'Pasien/keluarga minta pulang paksa dengan kondisi berisiko',
                'Tempat rujukan tidak tersedia',
            ],
            [
                'Proses penyakit',
                'Kondisi terkini',
                'Daftar obat',
            ],
            [
                'Komplikasi',
                'Kondisi terminal',
            ],
            [
                'Menolak rencana asuhan',
            ],
            [
                'Pasien tanpa jaminan asuransi',
            ],
        ];
        return view('pages.mpp.edit', [
            "title" => "MANAGER PELAYANAN PASIEN",
            "menu" => "Rawat Inap",
            "item" => $item,
            "arrKategoriMajor" => $arrKategoriMajor,
            "arrKategoriMinor" => $arrKategoriMinor,
            "arrProbRiskChance" => $arrProbRiskChance,
            "arrProbRiskChancePilihan" => $arrProbRiskChancePilihan,
            "roomDetails" => $roomDetails,
            "kelanjutanPelayanan" => $kelanjutanPelayanan,
            "ranapProblem" => $ranapProblem,
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
        $item = RanapMppPatient::find($id);
        // Kelanjutan Pelayanan Pasien

        // deteleData Lama
        RanapMppPelayananAdvanced::where('ranap_mpp_patient_id', $item->id)->delete();
        $tanggal = $request->input('tanggal', []);
        $kelanjutanKet = $request->input('kelanjutan_keterangan', []);
        $paraf  = $request->input('ttd_petugas');
        $petugas = $request->input('nama_petugas');
        foreach ($tanggal as $key => $tanggal) {
            if ($tanggal && $kelanjutanKet[$key]) {
                RanapMppPelayananAdvanced::create([
                    'ranap_mpp_patient_id' => $item->id,
                    'tanggal' => $tanggal,
                    'name' => $petugas,
                    'paraf' => $paraf,
                    'keterangan' => $kelanjutanKet[$key],
                ]);
            }
        }
        return redirect()->route('evaluasi/awal/MPP.detail', $item->rawat_inap_patient_id)->with([
            'success' => 'Berhasil Diupdate',
            'btn' => 'managerpelayananpasien',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = RanapMppPatient::find($id);
        RanapMppSkriningPatient::where('ranap_mpp_patient_id', $data->id)->delete();
        RanapMppProblemRiskChance::where('ranap_mpp_patient_id', $data->id)->delete();
        RanapMppManagerPlanning::where('ranap_mpp_patient_id', $data->id)->delete();
        RanapMppPelayananAdvanced::where('ranap_mpp_patient_id', $data->id)->delete();
        RanapMppAssesManagement::where('ranap_mpp_patient_id', $data->id)->delete();
        $data->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data!!');
    }

    public function getTtd(Request $request)
    {

        try {
            $item = User::findOrFail($request->user_id);
            if (Hash::check($request->password, $item->password)) {
                return response()->json($item->paraf);
            } else {
                throw new Exception("Terjadi Kesalahan, Mohon Periksa Kembali Password Yang Anda Masukkan", 500);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Terjadi Kesalahan, User Tidak Ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
}
