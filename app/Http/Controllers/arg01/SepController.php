<?php

namespace App\Http\Controllers\arg01;

use App\Http\Controllers\Controller;
use App\Services\Bpjs\VClaim;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\arg01\Patients;
use App\Models\arg01\Seps;
use App\Models\arg01\SuratKontrols;
use App\Models\arg01\LogVclaims;
use App\Models\arg01\Queues;
use App\Models\arg01\RawatJalanPatients;
use App\Models\arg01\RawatJalanPoliPatients;

class SepController extends Controller
{
    protected $dataVclaim;

    public function __construct() {
        $this->dataVclaim = new VClaim;
    }

    /**
     * halaman beranda list data sep
     */
    public function berandaSep()
    {
        $dataSep = Seps::orderBy('id', 'desc')->get();
        return view('arg01.sep.beranda', [
            'title' => 'list-sep',
            'menu' => 'SEP',
            'dataSep' => $dataSep,
        ]);
    }

    /**
     * halaman index sep
     */
    public function index()
    {
        $jenisPencarian = [
            ['id' => 1, 'nama' => 'Nomor Kepesertaan/Kartu', 'role' => 'noka'], 
            ['id' => 2, 'nama' => 'Berdasarkan NIK', 'role' => 'nik'], 
            ['id' => 3, 'nama' => 'Rujukan Berdasarkan Nomor Rujukan (PCare)', 'role' => 'rujukan'], 
            ['id' => 4, 'nama' => 'Rujukan Berdasarkan Nomor Rujukan (PCare) Rumah Sakit', 'role' => 'rujukanrs'], 
            // ['id' => 5, 'nama' => 'Rujukan Berdasarkan Nomor Kartu (PCare) Rumah Sakit'], 
            // ['id' => 6, 'nama' => 'Rujukan Berdasarkan Nomor Kartu (PCare)'], 
            ['id' => 7, 'nama' => 'Surat Kontrol/SPRI', 'role' => 'kontrol'],
        ];

        $jenisPelayanan = [
            ['id' => 1, 'nama' => 'Rawat Inap'], 
            ['id' => 2, 'nama' => 'Rawat Jalan'],
        ];

        $kelasRawatNaik = [
            ['id' => 1, 'nama' => 'VVIP'], 
            ['id' => 2, 'nama' => 'VIP'],
            ['id' => 3, 'nama' => 'Kelas 1'],
            ['id' => 4, 'nama' => 'Kelas 2'],
            ['id' => 5, 'nama' => 'Kelas 3'],
            ['id' => 6, 'nama' => 'ICCU'],
            ['id' => 7, 'nama' => 'ICU'],
            ['id' => 8, 'nama' => 'Diatas Kelas 1'],
        ];

        $kelasPembiayaan = [
            ['id' => 1, 'nama' => 'Pribadi'], 
            ['id' => 2, 'nama' => 'Pemberi Kerja'],
            ['id' => 3, 'nama' => 'Asuransi Kesehatan Tambahan'],
        ];

        $asalRujukan = [
            ['id' => 1, 'nama' => 'Faskes 1'], 
            ['id' => 2, 'nama' => 'Faskes 2 (RS)'],
        ];

        $yaTidak = [
            ['id' => 0, 'nama' => 'Tidak'], 
            ['id' => 1, 'nama' => 'Ya'],
        ];

        $tujuanKunjungan = [
            ['id' => 0, 'nama' => 'Normal'], 
            ['id' => 1, 'nama' => 'Prosedur'],
            ['id' => 2, 'nama' => 'Konsul Dokter'],
        ];

        $flagProsedur = [
            ['id' => 0, 'nama' => 'Prosedur Tidak Berkelanjutan'], 
            ['id' => 1, 'nama' => 'Prosedur dan Terapi Berkelanjutan'],
        ];

        $kdPenunjang = [
            ['id' => 1, 'nama' => 'Radioterapi'], 
            ['id' => 2, 'nama' => 'Kemoterapi'],
            ['id' => 3, 'nama' => 'Rehabilitasi Medik'],
            ['id' => 4, 'nama' => 'Rehabilitasi Psikososial'],
            ['id' => 5, 'nama' => 'Transfusi Darah'],
            ['id' => 6, 'nama' => 'Pelayanan Gigi'],
            ['id' => 7, 'nama' => 'Laboratorium'],
            ['id' => 8, 'nama' => 'USG'],
            ['id' => 9, 'nama' => 'Farmasi'],
            ['id' => 10, 'nama' => 'Lain-Lain'],
            ['id' => 11, 'nama' => 'MRI'],
            ['id' => 12, 'nama' => 'HEMODIALISA'],
        ];

        $asesmentPel = [
            ['id' => 1, 'nama' => 'Poli spesialis tidak tersedia pada hari sebelumnya'], 
            ['id' => 2, 'nama' => 'Jam Poli telah berakhir pada hari sebelumnya'],
            ['id' => 3, 'nama' => 'Dokter Spesialis yang dimaksud tidak praktek pada hari sebelumnya'],
            ['id' => 4, 'nama' => 'Atas Instruksi RS'],
            ['id' => 5, 'nama' => 'Tujuan Kontrol'],
        ];

        $sumberSEP = [
            ['id' => 1, 'kode' => 'RUJ', 'nama' => 'Rujukan'], 
            ['id' => 2, 'kode' => 'IGD', 'nama' => 'Ket IGD'],
            ['id' => 3, 'kode' => 'KONTROL', 'nama' => 'Lembar Kontrol'],
            ['id' => 4, 'kode' => 'INTERNAL', 'nama' => 'Rujukan Internal'],
            ['id' => 5, 'kode' => 'RESUME', 'nama' => 'Resume'],
            ['id' => 6, 'kode' => 'RAWATINAP', 'nama' => 'Sudi Merawat'],
        ];

        $data = [];

        return view('arg01.sep.index', [
            'title' => 'sep-create',
            'menu' => 'SEP',
            'jenisPencarian' => $jenisPencarian,
            'jenisPelayanan' => $jenisPelayanan,
            'kelasRawatNaik' => $kelasRawatNaik,
            'kelasPembiayaan' => $kelasPembiayaan,
            'asalRujukan' => $asalRujukan,
            'tujuanKunjungan' => $tujuanKunjungan,
            'flagProsedur' => $flagProsedur,
            'kdPenunjang' => $kdPenunjang,
            'asesmentPel' => $asesmentPel,
            'yaTidak' => $yaTidak,
            'sumberSEP' => $sumberSEP,
            'dokters' => $data,
        ]);
    }

    /**
     * View SEP 
     */
    public function viewSep($idSep) {
        $dataSep = Seps::where('id', decrypt($idSep))->first();

        return view('arg01.sep.view', [
            'title' => 'list-sep',
            'menu' => 'SEP',
            'dataSep' => $dataSep,
        ]);
    }

    /**
     * Cek data peserta BPJS berdasarkan NOKA ataupun berdasarkan NIK
     * kode 1 = NOKA
     * kode 2 = NIK
     */
    public function cekDataPeserta(Request $request) {
        try {
            $jenisPencarian = $request->jenisPencarian;
            $tglCurrent = Carbon::now('Asia/Jakarta');
            if($jenisPencarian == 1){
                /** pencarian NOKA */
                $cariPeserta = $this->dataVclaim->getCekPesertaNoka($request->nomorPencarian, $tglCurrent->toDateString());
            }else if($jenisPencarian == 2){
                /** pencarian NIK */
                $cariPeserta = $this->dataVclaim->getCekPesertaNik($request->nomorPencarian, $tglCurrent->toDateString());
            }
            
            if (!empty($cariPeserta)) {
                $data = json_decode($cariPeserta, true);
                $pasien = Patients::where('nik', $data['response']['peserta']['nik'])->first();
                return response()->json([
                    'data' => $data,
                    'pasien' => $pasien
                ], 200);
            } else {
                return response()->json(['error' => 'Data peserta tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Cek data peserta BPJS berdasarkan Rujukan Online
     * role rujukan = Nomor Rujukan Berdasarkan PCare/Faskes
     * role rujukanrs = Nomor Rujukan Berdasarkan Rumah sakit
     */
    public function cekDataRujukan(Request $request) {
        try {
            $rolePencarian = $request->role;
            if($rolePencarian == "rujukan"){
                /** pencarian nomor rujukan pcare/faskes */
                $rujukan = $this->dataVclaim->getCariRujukanBerdasarkanNomorRujukanFaskes($request->nomorPencarian);
            }else if($rolePencarian == 'rujukanrs'){
                /** pencarian nomor rujukan rumah sakit */
                $rujukan = $this->dataVclaim->getCariRujukanBerdasarkanNomorRujukanRS($request->nomorPencarian);
            }
            
            if (!empty($rujukan)) {
                $data = json_decode($rujukan, true);
                $pasien = Patients::where('nik', $data['response']['rujukan']['peserta']['nik'])->first();
                return response()->json([
                    'data' => $data,
                    'pasien' => $pasien
                ], 200);
            } else {
                return response()->json(['error' => 'Data peserta tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get data faskes berdasarkan inputan nama/kode faskes dan jenis faskes
     * untuk PPK Rujukan
     */
    public function getDataFaskes(Request $request) {
        try {            
            $faskes = $this->dataVclaim->getFaskes($request->faskes, $request->jenisFaskes);
            
            if (!empty($faskes)) {
                $data = json_decode($faskes, true);
                // dd($data);
                return response()->json(['data' => $data], 200);
            } else {
                return response()->json(['error' => 'Data faskes tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Get data diagnosa berdasarkan inputan nama/kode diagnosa
     * untuk menmapilkan data diagnosa
     */
    public function getDataDiagnosa(Request $request) {
        try {            
            $diagnosa = $this->dataVclaim->getDiagnosa($request->keyword);
            
            if (!empty($diagnosa)) {
                $data = json_decode($diagnosa, true);
                return response()->json(['data' => $data], 200);
            } else {
                return response()->json(['error' => 'Data diagnosa tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Get data dokter DPJP 
     */
    public function getDataDokterDPJP(Request $request) {
        try {            
            $dokter = $this->dataVclaim->getDokterDPJP($request->jenis, $request->tgl, $request->kodePoli);
            
            if (!empty($dokter)) {
                $data = json_decode($dokter, true);
                return response()->json(['data' => $data], 200);
            } else {
                return response()->json(['error' => 'Data dokter tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get data dokter untuk kondisi IGD
     * Referensi 
     */
    public function getDataDokter() {
        try {            
            // $dokter = Users::where('isDokter', 1)->get();
            $dokter = $this->dataVclaim->getDokter();
            
            if (!empty($dokter)) {
                $data = json_decode($dokter, true);
                return response()->json(['data' => $data], 200);
            } else {
                return response()->json(['error' => 'Data dokter tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Get data poli tujuan 
     */
    public function getDataPoli(Request $request) {
        try {            
            $poli = $this->dataVclaim->getRefPoli($request->keyword);
            
            if (!empty($poli)) {
                $data = json_decode($poli, true);
                return response()->json(['data' => $data], 200);
            } else {
                return response()->json(['error' => 'Data poli tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }


    /**
     * fungsi untuk create SEP
     */
    public function createSEP(Request $request) {
        try {
            $user = auth()->user();

            if(!$request->dataRequestSistem['catatan']){
                $catatan = '-';
            }else{
                $catatan = $request->dataRequestSistem['catatan'];
            }

            $dataRequest = [
                "request" => [
                    "t_sep" => [
                        "noKartu" => $request->dataRequestSistem['noKartu'],
                        "tglSep" => $request->dataRequestSistem['tglSep'],
                        "ppkPelayanan" => "0301R021", //untuk ropanasuri
                        "jnsPelayanan" => $request->dataRequestSistem['jnsPelayanan'],
                        "klsRawat" => [
                            "klsRawatHak" => $request->dataRequestSistem['klsRawatHak'],
                            "klsRawatNaik" => $request->dataRequestSistem['klsRawatNaik'] ?? "",
                            "pembiayaan" => $request->dataRequestSistem['pembiayaan'] ?? "",
                            "penanggungJawab" => $request->dataRequestSistem['penanggungJawab'] ?? "",
                        ],
                        "noMR" => $request->dataRequestSistem['noMR'],
                        "rujukan" => [
                            "asalRujukan" => $request->dataRequestSistem['asalRujukan'],
                            "tglRujukan" => $request->dataRequestSistem['tglRujukan'] ?? "",
                            "noRujukan" => $request->dataRequestSistem['noRujukan']  ?? "",
                            "ppkRujukan" => $request->dataRequestSistem['ppkRujukan'] ?? "",
                        ],
                        "catatan" => $request->dataRequestSistem['catatan'] ?? '-',
                        "diagAwal" => $request->dataRequestSistem['diagAwal'],
                        "poli" => [
                            "tujuan" => $request->dataRequestSistem['tujuan'] ?? "", 
                            "eksekutif" => $request->dataRequestSistem['eksekutif']
                        ],
                        "cob" => [
                            "cob" => $request->dataRequestSistem['cob'],
                        ],
                        "katarak" => [
                            "katarak" => $request->dataRequestSistem['katarak'],
                        ],
                        "jaminan" => [
                            "lakaLantas" => $request->dataRequestSistem['lakaLantas'],
                            "penjamin" => [
                                "penjamin" => $request->dataRequestSistem['penjamin'] ?? "",
                                "tglKejadian" => $request->dataRequestSistem['tglKejadian'] ?? "",
                                "keterangan" => $request->dataRequestSistem['keterangan'] ?? "",
                                "suplesi" => [
                                    "suplesi" => $request->dataRequestSistem['suplesi'],
                                    "noSepSuplesi" => $request->dataRequestSistem['noSepSuplesi'] ?? "",
                                    "lokasiLaka" => [
                                        "kdPropinsi" => $request->dataRequestSistem['kdPropinsi'] ?? "",
                                        "kdKabupaten" => $request->dataRequestSistem['kdKabupaten'] ?? "",
                                        "kdKecamatan" => $request->dataRequestSistem['kdKecamatan'] ?? "",
                                    ],
                                ],
                            ],
                        ],
                        "tujuanKunj" => $request->dataRequestSistem['tujuanKunj'],
                        "flagProcedure" => $request->dataRequestSistem['flagProcedure'] ?? "",
                        "kdPenunjang" => $request->dataRequestSistem['kdPenunjang'] ?? "",
                        "assesmentPel" => $request->dataRequestSistem['assesmentPel'] ?? "",
                        "skdp" => [
                            "noSurat" => $request->dataRequestSistem['noSurat'] ?? "", 
                            "kodeDPJP" => $request->dataRequestSistem['kodeDPJP'] ?? "",
                        ],
                        "dpjpLayan" => $request->dataRequestSistem['dpjpLayan'] ?? "",
                        "noTelp" => $request->dataRequestSistem['noTelp'],
                        "user" => $user->name,
                    ],
                ],
            ];
            $dataRequest = json_encode($dataRequest);
            $sep = $this->dataVclaim->postSepInsert($dataRequest);
            
            if (!empty($sep)) {
                $data = json_decode($sep, true);
                // dd($data);

                $sKontrol = SuratKontrols::where('id', $request->dataRequestSistem['idSuratKontrol'])->first();
                $kontrolPoli = "";
                $kontrolNamaPoli = "";
                if($sKontrol && $sKontrol->jenis_surat === 'spri'){
                    $kontrolPoli = $sKontrol->kd_poli;
                    $kontrolNamaPoli = $sKontrol->poli_kontrol;
                }

                $checkNoRujukan = Seps::where('no_rujukan', $request->dataRequestSistem['noRujukan'])->first();
                if ($checkNoRujukan) {
                    return response()->json(['error' => 'Nomor Rujukan Telah Digunakan'], 403);
                }

                if($data['metaData']['code'] == 200){
                    $sepDb = Seps::create([
                        'queue_id' => $request->idAntrian,
                        'no_sep' => $data['response']['sep']['noSep'],
                        'noka' => $request->dataRequestSistem['noKartu'],
                        'nik' => $request->dataRequestSistem['nik'],
                        'nama_peserta' => $data['response']['sep']['peserta']['nama'],
                        'tgl_lahir_peserta' => $data['response']['sep']['peserta']['tglLahir'],
                        'jenis_kelamin' => $data['response']['sep']['peserta']['kelamin'],
                        'jenis_peserta' => $data['response']['sep']['peserta']['jnsPeserta'],
                        'tgl_sep' => $request->dataRequestSistem['tglSep'],
                        'kode_ppk_pelayanan' => $request->dataRequestSistem['ppkPelayanan'],
                        'ppk_pelayanan' => '-',
                        'kd_jns_pelayanan' => $request->dataRequestSistem['jnsPelayanan'],
                        'jns_pelayanan' => $request->dataRequestSistem['nama_jns_pelayanan'],
                        'kd_kls_rawat_hak' => $request->dataRequestSistem['klsRawatHak'],
                        'kls_rawat_hak' => $request->dataRequestSistem['nm_kelas_rawat_hak'],
                        'kd_kls_rawat_naik' => $request->dataRequestSistem['klsRawatNaik'],
                        'kls_rawat_naik' => $request->dataRequestSistem['nama_kelas_naik'] ?? "",
                        'kd_kls_rawat_pembiayaan' => $request->dataRequestSistem['pembiayaan'],
                        'kls_rawat_pembiayaan' => $request->dataRequestSistem['nama_pembiayaan'],
                        'kls_rawat_penanggung_jawab' => $request->dataRequestSistem['penanggungJawab'],
                        'no_mr' => $request->dataRequestSistem['noMR'],
                        'kd_asal_rujukan' => $request->dataRequestSistem['asalRujukan'],
                        'asal_rujukan' => $request->dataRequestSistem['nm_asal_rujukan'],
                        'tgl_rujukan' => $request->dataRequestSistem['tglRujukan'],
                        'no_rujukan' => $request->dataRequestSistem['noRujukan'],
                        'kd_ppk_rujukan' => $request->dataRequestSistem['ppkRujukan'],
                        'ppk_rujukan' => $request->dataRequestSistem['nama_ppk_asal_rujukan'],
                        'catatan' => $request->dataRequestSistem['catatan'] ?? '-',
                        'kd_diag_awal' => $request->dataRequestSistem['diagAwal'],
                        'diag_awal' => $request->dataRequestSistem['nm_diag_awal'],
                        'kode_poli_tujuan' => $request->dataRequestSistem['tujuan'] ?? $kontrolPoli,
                        'poli_tujuan' => $request->dataRequestSistem['nm_poli_tujuan'] ?? $kontrolNamaPoli,
                        'poli_eksekutif' => $request->dataRequestSistem['eksekutif'],
                        'cob' => $request->dataRequestSistem['cob'],
                        'katarak' => $request->dataRequestSistem['katarak'],
                        'kd_laka_lantas' => $request->dataRequestSistem['lakaLantas'],
                        'laka_lantas' => "",
                        'penjamin' => $request->dataRequestSistem['penjamin'],
                        'no_lp' => $request->dataRequestSistem['noLP'],
                        'tgl_kejadian_laka' => $request->dataRequestSistem['tglKejadian'],
                        'keterangan_laka' => $request->dataRequestSistem['keterangan'],
                        'suplesi' => $request->dataRequestSistem['suplesi'],
                        'no_sep_suplesi' => $request->dataRequestSistem['noSepSuplesi'],
                        'kd_provinsi_laka' => $request->dataRequestSistem['kdPropinsi'],
                        'provinsi_laka' => "",
                        'kd_kab_laka' => $request->dataRequestSistem['kdKabupaten'],
                        'kabupaten_laka' => "",
                        'kd_kec_laka' => $request->dataRequestSistem['kdKecamatan'],
                        'kecamatan_laka' => "",
                        'kd_tujuan_kunj' => $request->dataRequestSistem['tujuanKunj'],
                        'tujuan_kunj' => $request->dataRequestSistem['nm_tujuan_kunj'],
                        'kd_flag_procedur' => $request->dataRequestSistem['flagProcedure'],
                        'flag_procedur' => $request->dataRequestSistem['nm_flag_procedur'],
                        'kd_penunjang' => $request->dataRequestSistem['kdPenunjang'],
                        'nama_penunjang' => $request->dataRequestSistem['nama_penunjang'],
                        'kd_assessment_pel' => $request->dataRequestSistem['assesmentPel'],
                        'assessment_pel' => $request->dataRequestSistem['nama_assesment'],
                        'no_skdp' => $request->dataRequestSistem['noSurat'],
                        'kd_skdp_dpjp' => $request->dataRequestSistem['kodeDPJP'],
                        'skd_dpjp' => $request->dataRequestSistem['nama_skdp_kontrol'] ?? "",
                        'kd_dpjp_layanan' => $request->dataRequestSistem['dpjpLayan'],
                        'dpjp_layanan' => $request->dataRequestSistem['nama_dpjp_layanan'],
                        'no_telp' => $request->dataRequestSistem['noTelp'],
                        'sumber_sep' => $request->dataRequestSistem['sumber_sep'],
                        'user_create' => $user->name,
                    ]);
                } else {
                    $sepDb = [];
                }

                $noSepEnc = encrypt($data['response']['sep']['noSep']) ?? '';

                if ($request->dataRequestSistem['clu'] == 'rajal') {
                    $item = Queues::find($request->idAntrian);
                    if ($item->status_antrian == 'DIPANGGIL') {
                        $rajal = RawatJalanPatients::create([
                            'queue_id' => $item->id,
                            'patient_id' => $item->patient_id
                        ]);
                        RawatJalanPoliPatients::create([
                            'rawat_jalan_patient_id' => $rajal->id,
                            'status' => 'WAITING'
                        ]);
                        $item->update([
                            'status_antrian' => 'SELESAI',
                        ]);
                    }
                }

                return response()->json(['data' => $data, 'sep' => $sepDb, 'sep_encrypt' => $noSepEnc], 200);

            } else {
                return response()->json(['error' => 'Data peserta tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }

    /**
     * cetak SEP 
     */
    public function getCetakSEP($noSep) {
        $dataSep = Seps::where('no_sep', decrypt($noSep))->first();

        return view('arg01.sep.cetak', [
            'dataSep' => $dataSep,
        ]);
    }

    /**
     * Cek data Surat Kontrol Pasien
     * role rujukan = Surat Kontrol
     */
    public function cekDataKontrol(Request $request) {
        try {
            $rolePencarian = $request->role;
            $tglCurrent = Carbon::now('Asia/Jakarta');
            if($rolePencarian == "kontrol"){
                /** pencarian nomor surat kontrol */
                $sKontrol = $this->dataVclaim->getCariNomorSuratKontrol($request->nomorPencarian);
            }
            
            if (!empty($sKontrol)) {
                $data = json_decode($sKontrol, true);
                $nomorKartu = "";
                $dataKontrol = SuratKontrols::where('no_surat', $request->nomorPencarian)->first();

                if($data['response']['sep']['peserta']['noKartu']){
                    $nomorKartu = $data['response']['sep']['peserta']['noKartu'];
                }else{
                    $nomorKartu = $dataKontrol->noka;
                }
                $cariPeserta = $this->dataVclaim->getCekPesertaNoka($nomorKartu, $tglCurrent->toDateString());
                $dataPeserta = json_decode($cariPeserta, true);

                $pasien = Patients::where('noka', $nomorKartu)->first();
                return response()->json([
                    'data' => $data,
                    'pasien' => $pasien,
                    'peserta' => $dataPeserta,
                    'dataKontrol' => $dataKontrol,
                ], 200);
            } else {
                return response()->json(['error' => 'Data peserta tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }

    /**
     * form update
     */
    public function formUpdateSEP($id) {
        $dataSep = Seps::where('id', decrypt($id))->first();

        $jenisPelayanan = [
            ['id' => 1, 'nama' => 'Rawat Inap'], 
            ['id' => 2, 'nama' => 'Rawat Jalan'],
        ];

        $asalRujukan = [
            ['id' => 1, 'nama' => 'Faskes 1'], 
            ['id' => 2, 'nama' => 'Faskes 2 (RS)'],
        ];

        $kelasRawatNaik = [
            ['id' => 1, 'nama' => 'VVIP'], 
            ['id' => 2, 'nama' => 'VIP'],
            ['id' => 3, 'nama' => 'Kelas 1'],
            ['id' => 4, 'nama' => 'Kelas 2'],
            ['id' => 5, 'nama' => 'Kelas 3'],
            ['id' => 6, 'nama' => 'ICCU'],
            ['id' => 7, 'nama' => 'ICU'],
            ['id' => 8, 'nama' => 'Diatas Kelas 1'],
        ];

        $kelasPembiayaan = [
            ['id' => 1, 'nama' => 'Pribadi'], 
            ['id' => 2, 'nama' => 'Pemberi Kerja'],
            ['id' => 3, 'nama' => 'Asuransi Kesehatan Tambahan'],
        ];

        $yaTidak = [
            ['id' => 0, 'nama' => 'Tidak'], 
            ['id' => 1, 'nama' => 'Ya'],
        ];

        $tujuanKunjungan = [
            ['id' => 0, 'nama' => 'Normal'], 
            ['id' => 1, 'nama' => 'Prosedur'],
            ['id' => 2, 'nama' => 'Konsul Dokter'],
        ];

        $flagProsedur = [
            ['id' => 0, 'nama' => 'Prosedur Tidak Berkelanjutan'], 
            ['id' => 1, 'nama' => 'Prosedur dan Terapi Berkelanjutan'],
        ];

        $kdPenunjang = [
            ['id' => 1, 'nama' => 'Radioterapi'], 
            ['id' => 2, 'nama' => 'Kemoterapi'],
            ['id' => 3, 'nama' => 'Rehabilitasi Medik'],
            ['id' => 4, 'nama' => 'Rehabilitasi Psikososial'],
            ['id' => 5, 'nama' => 'Transfusi Darah'],
            ['id' => 6, 'nama' => 'Pelayanan Gigi'],
            ['id' => 7, 'nama' => 'Laboratorium'],
            ['id' => 8, 'nama' => 'USG'],
            ['id' => 9, 'nama' => 'Farmasi'],
            ['id' => 10, 'nama' => 'Lain-Lain'],
            ['id' => 11, 'nama' => 'MRI'],
            ['id' => 12, 'nama' => 'HEMODIALISA'],
        ];

        $asesmentPel = [
            ['id' => 1, 'nama' => 'Poli spesialis tidak tersedia pada hari sebelumnya'], 
            ['id' => 2, 'nama' => 'Jam Poli telah berakhir pada hari sebelumnya'],
            ['id' => 3, 'nama' => 'Dokter Spesialis yang dimaksud tidak praktek pada hari sebelumnya'],
            ['id' => 4, 'nama' => 'Atas Instruksi RS'],
            ['id' => 5, 'nama' => 'Tujuan Kontrol'],
        ];

        $sumberSEP = [
            ['id' => 1, 'kode' => 'RUJ', 'nama' => 'Rujukan'], 
            ['id' => 2, 'kode' => 'IGD', 'nama' => 'Ket IGD'],
            ['id' => 3, 'kode' => 'KONTROL', 'nama' => 'Lembar Kontrol'],
            ['id' => 4, 'kode' => 'INTERNAL', 'nama' => 'Rujukan Internal'],
            ['id' => 5, 'kode' => 'RESUME', 'nama' => 'Resume'],
            ['id' => 6, 'kode' => 'RAWATINAP', 'nama' => 'Sudi Merawat'],
        ];

        return view('arg01.sep.edit', [
            'title' => 'list-sep',
            'menu' => 'SEP',
            'dataSep' => $dataSep,
            'jenisPelayanan' => $jenisPelayanan,
            'asalRujukan' => $asalRujukan,
            'kelasRawatNaik' => $kelasRawatNaik,
            'kelasPembiayaan' => $kelasPembiayaan,
            'yaTidak' => $yaTidak,
            'tujuanKunjungan' => $tujuanKunjungan,
            'flagProsedur' => $flagProsedur,
            'kdPenunjang' => $kdPenunjang,
            'asesmentPel' => $asesmentPel,
            'sumberSEP' => $sumberSEP,
        ]);
    }


    /**
     * fungsi untuk update SEP
     */
    public function updateSEP(Request $request) {
        try {
            $user = auth()->user();
            $dataRequest = [
                "request" => [
                    "t_sep" => [
                        "noSep" => $request->dataRequestSistem['noSep'],
                        "klsRawat" => [
                            "klsRawatHak" => $request->dataRequestSistem['klsRawatHak'],
                            "klsRawatNaik" => $request->dataRequestSistem['klsRawatNaik'] ?? "",
                            "pembiayaan" => $request->dataRequestSistem['pembiayaan'] ?? "",
                            "penanggungJawab" => $request->dataRequestSistem['penanggungJawab'] ?? "",
                        ],
                        "noMR" => $request->dataRequestSistem['noMR'],
                        "catatan" => $request->dataRequestSistem['catatan'],
                        "diagAwal" => $request->dataRequestSistem['diagAwal'],
                        "poli" => [
                            "tujuan" => $request->dataRequestSistem['tujuan'] ?? "", 
                            "eksekutif" => $request->dataRequestSistem['eksekutif']
                        ],
                        "cob" => [
                            "cob" => $request->dataRequestSistem['cob'],
                        ],
                        "katarak" => [
                            "katarak" => $request->dataRequestSistem['katarak'],
                        ],
                        "jaminan" => [
                            "lakaLantas" => $request->dataRequestSistem['lakaLantas'],
                            "penjamin" => [
                                "tglKejadian" => $request->dataRequestSistem['tglKejadian'],
                                "keterangan" => $request->dataRequestSistem['keterangan'],
                                "suplesi" => [
                                    "suplesi" => $request->dataRequestSistem['suplesi'],
                                    "noSepSuplesi" => $request->dataRequestSistem['noSepSuplesi'],
                                    "lokasiLaka" => [
                                        "kdPropinsi" => $request->dataRequestSistem['kdPropinsi'],
                                        "kdKabupaten" => $request->dataRequestSistem['kdKabupaten'],
                                        "kdKecamatan" => $request->dataRequestSistem['kdKecamatan'],
                                    ],
                                ],
                            ],
                        ],
                        "dpjpLayan" => $request->dataRequestSistem['dpjpLayan'] ?? "",
                        "noTelp" => $request->dataRequestSistem['noTelp'],
                        "user" => $user->name,
                    ],
                ],
            ];
            $dataRequest = json_encode($dataRequest);
            $sepUpdate = $this->dataVclaim->putSepUpdate($dataRequest);
            
            if (!empty($sepUpdate)) {
                $data = json_decode($sepUpdate, true);

                if($data['metaData']['code'] == 200){
                    $sepDb = Seps::where('id', decrypt($request->dataRequestSistem['idSep']))->first();
                    $sepDb = Seps::update([
                        'kd_kls_rawat_naik' => $request->dataRequestSistem['klsRawatNaik'],
                        'kls_rawat_naik' => $request->dataRequestSistem['nama_kelas_naik'] ?? "",
                        'kd_kls_rawat_pembiayaan' => $request->dataRequestSistem['pembiayaan'],
                        'kls_rawat_pembiayaan' => $request->dataRequestSistem['nama_pembiayaan'],                    
                        'kls_rawat_penanggung_jawab' => $request->dataRequestSistem['penanggungJawab'],
                        'catatan' => $request->dataRequestSistem['catatan'],
                        'kd_diag_awal' => $request->dataRequestSistem['diagAwal'],
                        'diag_awal' => $request->dataRequestSistem['nm_diag_awal'],
                        'kode_poli_tujuan' => $request->dataRequestSistem['tujuan'] ?? $kontrolPoli,
                        'poli_tujuan' => $request->dataRequestSistem['nm_poli_tujuan'] ?? $kontrolNamaPoli,
                        'poli_eksekutif' => $request->dataRequestSistem['eksekutif'],
                        'cob' => $request->dataRequestSistem['cob'],
                        'katarak' => $request->dataRequestSistem['katarak'],
                        'kd_laka_lantas' => $request->dataRequestSistem['lakaLantas'],
                        'laka_lantas' => "",
                        'tgl_kejadian_laka' => $request->dataRequestSistem['tglKejadian'],
                        'keterangan_laka' => $request->dataRequestSistem['keterangan'],
                        'suplesi' => $request->dataRequestSistem['suplesi'],
                        'no_sep_suplesi' => $request->dataRequestSistem['noSepSuplesi'],
                        'kd_provinsi_laka' => $request->dataRequestSistem['kdPropinsi'],
                        'provinsi_laka' => "",
                        'kd_kab_laka' => $request->dataRequestSistem['kdKabupaten'],
                        'kabupaten_laka' => "",
                        'kd_kec_laka' => $request->dataRequestSistem['kdKecamatan'],
                        'kecamatan_laka' => "",
                        'kd_dpjp_layanan' => $request->dataRequestSistem['dpjpLayan'],
                        'dpjp_layanan' => $request->dataRequestSistem['nama_dpjp_layanan'],
                        'sumber_sep' => $request->dataRequestSistem['sumber_sep'],
                        'user_create' => $user->name,
                    ]);

                }else{
                    $sepDb = [];
                }

                return response()->json(['data' => $data, 'sep' => $sepDb], 200);

            } else {
                return response()->json(['error' => 'Data peserta tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Delete data SEP
     */
    public function deleteSEP(Request $request) {
        try { 
            $user = auth()->user();
            $dataRequest = [
                "request" => [
                    "t_sep" => [
                        "noSep" => decrypt($request->noSep),
                        "user" => $user->name,
                    ],
                ],
            ];
            $dataRequest = json_encode($dataRequest);
            $deleteSurat = $this->dataVclaim->deleteSep($dataRequest);
            
            if (!empty($deleteSurat)) {
                $data = json_decode($deleteSurat, true);
                $logVclaim = [];

                if($data['metaData']['code'] == 200){
                    $logVclaim = LogVclaims::create([
                        'no_surat' => decrypt($request->noSep),
                        'kategori' => "SEP",
                        'user' => $user->name,
                    ]);
                    
                    $dataSep = Seps::where('id', decrypt($request->idSep))->first();
                    if ($dataSep) {
                        $dataSep->delete();
                    }
                }
                return response()->json(['data' => $data, 'log_vlaim' => $logVclaim], 200);
            } else {
                return response()->json(['error' => 'Data tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Data form SEP Rajal
     */
    public function sepRajal($antrian, $layanan, $noka, $noRujukan = null){
        try {
            $nokaDec = decrypt($noka);
            $dataRujukan = [];

            $tglCurrent = Carbon::now('Asia/Jakarta');
            if($noRujukan){
                $noRUjukanDec = decrypt($noRujukan);
                $rujukan = $this->dataVclaim->getCariRujukanBerdasarkanNomorRujukanFaskes($noRUjukanDec);
                $dataRujukan = json_decode($rujukan, true);

                $cariPeserta = $this->dataVclaim->getCekPesertaNoka($nokaDec, $tglCurrent->toDateString());
                $data = json_decode($cariPeserta, true);
            }else{
                $cariPeserta = $this->dataVclaim->getCekPesertaNoka($nokaDec, $tglCurrent->toDateString());
                $data = json_decode($cariPeserta, true);
            }
    
            if (json_last_error() !== JSON_ERROR_NONE || !$data) {
                throw new \Exception('Error dalam menguraikan JSON atau data peserta tidak ditemukan');
            }

            $pasien = Patients::where('noka', $nokaDec)->first();

            $jenisPelayanan = [
                ['id' => 1, 'nama' => 'Rawat Inap'], 
                ['id' => 2, 'nama' => 'Rawat Jalan'],
            ];
    
            $asalRujukan = [
                ['id' => 1, 'nama' => 'Faskes 1'], 
                ['id' => 2, 'nama' => 'Faskes 2 (RS)'],
            ];
    
            $kelasRawatNaik = [
                ['id' => 1, 'nama' => 'VVIP'], 
                ['id' => 2, 'nama' => 'VIP'],
                ['id' => 3, 'nama' => 'Kelas 1'],
                ['id' => 4, 'nama' => 'Kelas 2'],
                ['id' => 5, 'nama' => 'Kelas 3'],
                ['id' => 6, 'nama' => 'ICCU'],
                ['id' => 7, 'nama' => 'ICU'],
                ['id' => 8, 'nama' => 'Diatas Kelas 1'],
            ];
    
            $kelasPembiayaan = [
                ['id' => 1, 'nama' => 'Pribadi'], 
                ['id' => 2, 'nama' => 'Pemberi Kerja'],
                ['id' => 3, 'nama' => 'Asuransi Kesehatan Tambahan'],
            ];
    
            $yaTidak = [
                ['id' => 0, 'nama' => 'Tidak'], 
                ['id' => 1, 'nama' => 'Ya'],
            ];
    
            $tujuanKunjungan = [
                ['id' => 0, 'nama' => 'Normal'], 
                ['id' => 1, 'nama' => 'Prosedur'],
                ['id' => 2, 'nama' => 'Konsul Dokter'],
            ];
    
            $flagProsedur = [
                ['id' => 0, 'nama' => 'Prosedur Tidak Berkelanjutan'], 
                ['id' => 1, 'nama' => 'Prosedur dan Terapi Berkelanjutan'],
            ];
    
            $kdPenunjang = [
                ['id' => 1, 'nama' => 'Radioterapi'], 
                ['id' => 2, 'nama' => 'Kemoterapi'],
                ['id' => 3, 'nama' => 'Rehabilitasi Medik'],
                ['id' => 4, 'nama' => 'Rehabilitasi Psikososial'],
                ['id' => 5, 'nama' => 'Transfusi Darah'],
                ['id' => 6, 'nama' => 'Pelayanan Gigi'],
                ['id' => 7, 'nama' => 'Laboratorium'],
                ['id' => 8, 'nama' => 'USG'],
                ['id' => 9, 'nama' => 'Farmasi'],
                ['id' => 10, 'nama' => 'Lain-Lain'],
                ['id' => 11, 'nama' => 'MRI'],
                ['id' => 12, 'nama' => 'HEMODIALISA'],
            ];
    
            $asesmentPel = [
                ['id' => 1, 'nama' => 'Poli spesialis tidak tersedia pada hari sebelumnya'], 
                ['id' => 2, 'nama' => 'Jam Poli telah berakhir pada hari sebelumnya'],
                ['id' => 3, 'nama' => 'Dokter Spesialis yang dimaksud tidak praktek pada hari sebelumnya'],
                ['id' => 4, 'nama' => 'Atas Instruksi RS'],
                ['id' => 5, 'nama' => 'Tujuan Kontrol'],
            ];
    
            $sumberSEP = [
                ['id' => 1, 'kode' => 'RUJ', 'nama' => 'Rujukan'], 
                ['id' => 2, 'kode' => 'IGD', 'nama' => 'Ket IGD'],
                ['id' => 3, 'kode' => 'KONTROL', 'nama' => 'Lembar Kontrol'],
                ['id' => 4, 'kode' => 'INTERNAL', 'nama' => 'Rujukan Internal'],
                ['id' => 5, 'kode' => 'RESUME', 'nama' => 'Resume'],
                ['id' => 6, 'kode' => 'RAWATINAP', 'nama' => 'Sudi Merawat'],
            ];
    
            return view('arg01.sep.sep-rajal', [
                'title' => 'Daftar Antrian',
                'menu' => 'Antrian',
                'peserta' => $data,
                'pasienDb' => $pasien,
                'jenisPelayanan' => $jenisPelayanan,
                'asalRujukan' => $asalRujukan,
                'kelasRawatNaik' => $kelasRawatNaik,
                'kelasPembiayaan' => $kelasPembiayaan,
                'yaTidak' => $yaTidak,
                'tujuanKunjungan' => $tujuanKunjungan,
                'flagProsedur' => $flagProsedur,
                'kdPenunjang' => $kdPenunjang,
                'asesmentPel' => $asesmentPel,
                'sumberSEP' => $sumberSEP,
                'dataRujukan' => $dataRujukan,
                'idAntrian' => $antrian
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memproses permintaan'], 500);
        }
    }

    public function batalAntrianSep(Request $request)
    {
        $batalAntrianSep = Queues::where('id', $request->idAntrian)->first();
        $batalAntrianSep->update([
            'alasan_batal' => $request->alasanPembatalan,
            'status_antrian' => 'BATAL',
        ]);

        // return back()->with('success', 'Antrian telah dibatalkan!');
        return response()->json(['success' => 'Antrian telah dibatalkan!']);
    }
}