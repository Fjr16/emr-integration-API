<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Bpjs\VClaim;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SepController extends Controller
{
    protected $sepUatVclaim;

    public function __construct() {
        $this->sepUatVclaim = new VClaim;
    }

    /** insert SEP versi 2.0.0 begin */
    public function postSep(Request $request)
    {
        // $dataRequest = $request->all();
        $currentDateTime = Carbon::now('Asia/Jakarta');
        // dd(Carbon::now('Asia/Jakarta')->toIso8601String());
        
                    // "tglSep" => $currentDateTime->toDateTimeString(),
                    // "tglSep" => 1707711611,
                    // noka lama : 0002051486076
        $dataRequest = [
            "request" => [
                "t_sep" => [
                    "noKartu" => "0002063235036",
                    "tglSep" => "2024-04-03",
                    "ppkPelayanan" => "0301R021",
                    "jnsPelayanan" => "2",
                    "klsRawat" => [
                        "klsRawatHak" => "",
                        "klsRawatNaik" => "",
                        "pembiayaan" => "",
                        "penanggungJawab" => "",
                    ],
                    "noMR" => "172844",
                    "rujukan" => [
                        "asalRujukan" => "1",
                        "tglRujukan" => "",
                        "noRujukan" => "",
                        "ppkRujukan" => "",
                    ],
                    "catatan" => "Catatan",
                    "diagAwal" => "I12",
                    "poli" => [
                        "tujuan" => "IGD", 
                        "eksekutif" => "0"
                    ],
                    "cob" => [
                        "cob" => "0",
                    ],
                    "katarak" => [
                        "katarak" => "0",
                    ],
                    "jaminan" => [
                        "lakaLantas" => "0",
                        "penjamin" => [
                            "tglKejadian" => "",
                            "keterangan" => "",
                            "suplesi" => [
                                "suplesi" => "0",
                                "noSepSuplesi" => "",
                                "lokasiLaka" => [
                                    "kdPropinsi" => "",
                                    "kdKabupaten" => "",
                                    "kdKecamatan" => "",
                                ],
                            ],
                        ],
                    ],
                    "tujuanKunj" => "0",
                    "flagProcedure" => "",
                    "kdPenunjang" => "",
                    "assesmentPel" => "4",
                    "skdp" => [
                        "noSurat" => "", 
                        "kodeDPJP" => "",
                    ],
                    "dpjpLayan" => "31537",
                    "noTelp" => "085264578855",
                    "user" => "admin",
                ],
            ],
        ];

        

        // $dataRequest = [
        //     "request" => [
        //         "t_sep" => [
        //             "noKartu" => "0002082421754",
        //             "tglSep" => "2024-04-03",
        //             "ppkPelayanan" => "0301R021",
        //             "jnsPelayanan" => "1",
        //             "klsRawat" => [
        //                 "klsRawatHak" => "2",
        //                 "klsRawatNaik" => "",
        //                 "pembiayaan" => "",
        //                 "penanggungJawab" => "",
        //             ],
        //             "noMR" => "172844",
        //             // "rujukan" => [
        //             //     "asalRujukan" => "1",
        //             //     "tglRujukan" => "",
        //             //     "noRujukan" => "",
        //             //     "ppkRujukan" => "4123",
        //             // ],
        //             "rujukan" => [
        //                 "asalRujukan" => "1",
        //                 "tglRujukan" => "2024-03-27",
        //                 "noRujukan" => "0050B1070324P000010",
        //                 "ppkRujukan" => "0050B107",
        //             ],
        //             "catatan" => "Darurat",
        //             "diagAwal" => "I12",
        //             "poli" => [
        //                 "tujuan" => "", 
        //                 "eksekutif" => "0"
        //             ],
        //             "cob" => [
        //                 "cob" => "0",
        //             ],
        //             "katarak" => [
        //                 "katarak" => "0",
        //             ],
        //             "jaminan" => [
        //                 "lakaLantas" => "0",
        //                 "penjamin" => [
        //                     "tglKejadian" => "",
        //                     "keterangan" => "",
        //                     "suplesi" => [
        //                         "suplesi" => "0",
        //                         "noSepSuplesi" => "",
        //                         "lokasiLaka" => [
        //                             "kdPropinsi" => "",
        //                             "kdKabupaten" => "",
        //                             "kdKecamatan" => "",
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //             "tujuanKunj" => "0",
        //             "flagProcedure" => "",
        //             "kdPenunjang" => "",
        //             "assesmentPel" => "4",
        //             "skdp" => [
        //                 "noSurat" => "", 
        //                 "kodeDPJP" => "",
        //             ],
        //             "dpjpLayan" => "",
        //             "noTelp" => "085264578855",
        //             "user" => "admin",
        //         ],
        //     ],
        // ];
        $dataRequest = json_encode($dataRequest);
        $createSep = $this->sepUatVclaim->postSepInsert($dataRequest);
        return $createSep;
    }
    /** insert SEP versi 2.0.0 end */

    /** update SEP versi 2.0.0 begin */
    public function putSep(Request $request)
    {
        $dataRequest = $request->all();
        $dataRequest = json_encode($dataRequest);
        // $dataRequest = [
        //     "request" => [
        //         "t_sep" => [
        //             "noSep" => "0301R0210324V000001",
        //             "klsRawat" => [
        //                 "klsRawatHak" => "2",
        //                 "klsRawatNaik" => "",
        //                 "pembiayaan" => "",
        //                 "penanggungJawab" => "",
        //             ],
        //             "noMR" => "172844",
        //             "catatan" => "Darurat",
        //             "diagAwal" => "K35",
        //             "poli" => [
        //                 "tujuan" => "IGD", 
        //                 "eksekutif" => "0"
        //             ],
        //             "cob" => [
        //                 "cob" => "0",
        //             ],
        //             "katarak" => [
        //                 "katarak" => "0",
        //             ],
        //             "jaminan" => [
        //                 "lakaLantas" => "0",
        //                 "penjamin" => [
        //                     "tglKejadian" => "",
        //                     "keterangan" => "",
        //                     "suplesi" => [
        //                         "suplesi" => "0",
        //                         "noSepSuplesi" => "",
        //                         "lokasiLaka" => [
        //                             "kdPropinsi" => "",
        //                             "kdKabupaten" => "",
        //                             "kdKecamatan" => "",
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //             "dpjpLayan" => "31537",
        //             "noTelp" => "085264578855",
        //             "user" => "admin",
        //         ],
        //     ],
        // ];
        $updateSep = $this->sepUatVclaim->putSepUpdate($dataRequest);
        return $updateSep;
    }
    /** update SEP versi 2.0.0 end */

    /** delete SEP versi 2.0.0 begin */
    public function deleteSep(Request $request)
    {
        $dataRequest = $request->all(); 
        $dataRequest = json_encode($dataRequest);
        $deleteSep = $this->sepUatVclaim->deleteSep($dataRequest);
        return $deleteSep;
    }
    /** delete SEP versi 2.0.0 end */

    /** search SEP dari VCLAIM begin */
    public function searchSep($noSep)
    { 
        $cariDataSep = $this->sepUatVclaim->cariSepVclaim($noSep);
        return $cariDataSep;
    }
    /** search SEP dari VCLAIM end */

    /** Update tanggal pulang SEP begin */
    public function tglPulangSep(Request $request)
    { 
        $dataRequest = $request->all(); 
        $dataRequest = json_encode($dataRequest);
        $tglPulang = $this->sepUatVclaim->putTglPulang($request);
        return $tglPulang;
    }
    /** Update tanggal pulang SEP end */

    /** Update tanggal pulang SEP begin */
    public function listDataTanggalPulang($bulan, $tahun, $filter = null)
    { 
        $listDataPulang = $this->sepUatVclaim->getListDataTglPulang($bulan, $tahun, $filter);
        return $listDataPulang;
    }
    /** Update tanggal pulang SEP end */


    /** List data Referensi > Poli begin */
    public function listDataPoli()
    { 
        $listPoli = $this->sepUatVclaim->getPoli();
        return $listPoli;
    }
    /** List data Referensi > Poli end */


    /** List data Referensi > Poli begin */
    public function getDokterList($kdDokter = null)
    {
        $dokter = $this->sepUatVclaim->getDokter($kdDokter);
        return $dokter;
    }
     /** List data Referensi > Poli end */


     /** List data Referensi > Poli begin */
    public function getFaskes($nama, $jenis)
    {
        $faskes = $this->sepUatVclaim->getFaskes($nama, $jenis);
        return $faskes;
    }
     /** List data Referensi > Poli end */

    /** List Cari rujukan RS begin */
    public function getCariRujukan($nomorRujukan)
    {
        $cariRujukan = $this->sepUatVclaim->getCariRujukan($nomorRujukan);
        return $cariRujukan;
    }
     /** List Cari rujukan RS end */

    /** List insert rujukan RS begin */
    public function postRujukan(Request $request)
    {
        $dataRequest = $request->all(); 
        $dataRequest = json_encode($dataRequest);
        // dd($dataRequest);
        // $dataRequest = [
        //     "request" => [
        //        "t_rujukan" => [
        //           "noSep" => "0301R0210324V000001",
        //           "tglRujukan" => "2024-04-01",
        //           "ppkDirujuk" => "0301R002",
        //           "jnsPelayanan" => "1",
        //           "catatan" => "test",
        //           "diagRujukan" => "A00.1",
        //           "tipeRujukan" => "1",
        //           "poliRujukan" => "INT",
        //           "user" => "Coba Ws"
        //        ],
        //     ],
        // ];    
        $insertRujukan = $this->sepUatVclaim->postRujukanInsert($request);
        return $insertRujukan;
    }
     /** List insert rujukan RS end */


     /**
      * cari rujukan berdasarkan nomor rujukan PCare/Faskes
      */
    public function cariRujukanBerdasarkanNomorRujukanFaskes($nomorRujukan) {
        $cariRujukan = $this->sepUatVclaim->getCariRujukanBerdasarkanNomorRujukanFaskes($nomorRujukan);
        return $cariRujukan;
    }

    /**
     * Cari rujukan berdasarkan nomor kartu peserta PCare/Faskes
     */
    public function cariRujukanBerdasarkanNokaFaskes($noka) {
        $cariRujukan = $this->sepUatVclaim->getCariRujukanBerdasarkanNokaFaskes($noka);
        return $cariRujukan;
    }

    /**
     * Cek data peserta BPJS berdasarkan NOKA
     */
    public function cekPesertaNoka($noka, $tglSep) {
        $cariPeserta = $this->sepUatVclaim->getCekPesertaNoka($noka, $tglSep);
        return $cariPeserta;
    }

    /**
     * Cek data peserta BPJS berdasarkan NIK
     */
    public function cekPesertaNik($nik, $tglSep) {
        $cariPeserta = $this->sepUatVclaim->getCekPesertaNik($nik, $tglSep);
        return $cariPeserta;
    }

    /**
     * insert SEP IGD
     * rawat jalan dengan kunjungan tanpa rujukan melalui IGD
    */
    public function postSepIgd(Request $request)
    {
        $dataRequest = [
            "request" => [
                "t_sep" => [
                    "noKartu" => "0002082421754",
                    "tglSep" => "2024-05-20",
                    "ppkPelayanan" => "0301R021", //untuk ropanasuri
                    "jnsPelayanan" => "2",
                    "klsRawat" => [
                        "klsRawatHak" => "3",
                        "klsRawatNaik" => "",
                        "pembiayaan" => "",
                        "penanggungJawab" => "",
                    ],
                    "noMR" => "000007",
                    "rujukan" => [
                        "asalRujukan" => "1",
                        "tglRujukan" => "",
                        "noRujukan" => "",
                        "ppkRujukan" => "",
                    ],
                    "catatan" => "sep igd tes",
                    "diagAwal" => "C50",
                    "poli" => [
                        "tujuan" => "IGD", 
                        "eksekutif" => "0"
                    ],
                    "cob" => [
                        "cob" => "0",
                    ],
                    "katarak" => [
                        "katarak" => "0",
                    ],
                    "jaminan" => [
                        "lakaLantas" => "0",
                        "penjamin" => [
                            "penjamin" => "",
                            "tglKejadian" => "",
                            "keterangan" => "",
                            "suplesi" => [
                                "suplesi" => "0",
                                "noSepSuplesi" => "",
                                "lokasiLaka" => [
                                    "kdPropinsi" => "",
                                    "kdKabupaten" => "",
                                    "kdKecamatan" => "",
                                ],
                            ],
                        ],
                    ],
                    "tujuanKunj" => "0",
                    "flagProcedure" => "",
                    "kdPenunjang" => "",
                    "assesmentPel" => "",
                    "skdp" => [
                        "noSurat" => "", 
                        "kodeDPJP" => "",
                    ],
                    "dpjpLayan" => "31537",
                    "noTelp" => "085264578855",
                    "user" => "Admin Ropana",
                ],
            ],
        ];

        $dataRequest = json_encode($dataRequest);
        $createSep = $this->sepUatVclaim->postSepInsert($dataRequest);
        return $createSep;
    }


    /**
     * insert SEP dengan nomor rujukan
     * rawat jalan kunjungan pertama menggunakan rujukan
    */
    public function postSepRujukan(Request $request)
    {
        $dataRequest = [
            "request" => [
                "t_sep" => [
                    "noKartu" => "0002082421754",
                    "tglSep" => "2024-04-24",
                    "ppkPelayanan" => "0301R021", //untuk ropanasuri
                    "jnsPelayanan" => "2",
                    "klsRawat" => [
                        "klsRawatHak" => "3",
                        "klsRawatNaik" => "",
                        "pembiayaan" => "",
                        "penanggungJawab" => "",
                    ],
                    "noMR" => "172844",
                    "rujukan" => [
                        "asalRujukan" => "1",
                        "tglRujukan" => "2024-03-27",
                        "noRujukan" => "0050B1070324P000010",
                        "ppkRujukan" => "0050B107",
                    ],
                    "catatan" => "Catatan",
                    "diagAwal" => "I12",
                    "poli" => [
                        "tujuan" => "BED", 
                        "eksekutif" => "0"
                    ],
                    "cob" => [
                        "cob" => "0",
                    ],
                    "katarak" => [
                        "katarak" => "0",
                    ],
                    "jaminan" => [
                        "lakaLantas" => "0",
                        "penjamin" => [
                            "tglKejadian" => "",
                            "keterangan" => "",
                            "suplesi" => [
                                "suplesi" => "0",
                                "noSepSuplesi" => "",
                                "lokasiLaka" => [
                                    "kdPropinsi" => "",
                                    "kdKabupaten" => "",
                                    "kdKecamatan" => "",
                                ],
                            ],
                        ],
                    ],
                    "tujuanKunj" => "0",
                    "flagProcedure" => "",
                    "kdPenunjang" => "",
                    "assesmentPel" => "",
                    "skdp" => [
                        "noSurat" => "", 
                        "kodeDPJP" => "",
                    ],
                    "dpjpLayan" => "31537",
                    "noTelp" => "085264578855",
                    "user" => "ropana",
                ],
            ],
        ];

        $dataRequest = json_encode($dataRequest);
        $createSep = $this->sepUatVclaim->postSepInsert($dataRequest);
        return $createSep;
    }

    /**
     * insert SEP kontrol rawat jalan
     * dengan di terbitkan terlebih dahulu surat kontrol nya
     * poli harus sama dengan poli rujukan
     * untuk prosedur berkelanjutan
    */
    public function postSepRujukanKontrolRajalProsedureBerkelanjutan(Request $request)
    {
        $dataRequest = [
            "request" => [
                "t_sep" => [
                    "noKartu" => "0002082421754",
                    "tglSep" => "2024-04-16",
                    "ppkPelayanan" => "0301R021", //untuk ropanasuri
                    "jnsPelayanan" => "2",
                    "klsRawat" => [
                        "klsRawatHak" => "3",
                        "klsRawatNaik" => "",
                        "pembiayaan" => "",
                        "penanggungJawab" => "",
                    ],
                    "noMR" => "172844",
                    "rujukan" => [
                        "asalRujukan" => "1",
                        "tglRujukan" => "2024-03-27",
                        "noRujukan" => "0050B1070324P000010",
                        "ppkRujukan" => "0050B107",
                    ],
                    "catatan" => "Kontrol Rajal prosedur",
                    "diagAwal" => "I12",
                    "poli" => [
                        "tujuan" => "BED", 
                        "eksekutif" => "0"
                    ],
                    "cob" => [
                        "cob" => "0",
                    ],
                    "katarak" => [
                        "katarak" => "0",
                    ],
                    "jaminan" => [
                        "lakaLantas" => "0",
                        "penjamin" => [
                            "tglKejadian" => "",
                            "keterangan" => "",
                            "suplesi" => [
                                "suplesi" => "0",
                                "noSepSuplesi" => "",
                                "lokasiLaka" => [
                                    "kdPropinsi" => "",
                                    "kdKabupaten" => "",
                                    "kdKecamatan" => "",
                                ],
                            ],
                        ],
                    ],
                    "tujuanKunj" => "1",
                    "flagProcedure" => "1",
                    "kdPenunjang" => "2",
                    "assesmentPel" => "",
                    "skdp" => [
                        "noSurat" => "0301R0210424K000001", 
                        "kodeDPJP" => "31537",
                    ],
                    "dpjpLayan" => "31537",
                    "noTelp" => "085264578855",
                    "user" => "ropana",
                ],
            ],
        ];

        // $dataRequest = [
        //     "request" => [
        //         "t_sep" => [
        //             "noKartu" => "0002063235036",
        //             "tglSep" => "2024-04-15",
        //             "ppkPelayanan" => "0301R021", //untuk ropanasuri
        //             "jnsPelayanan" => "2",
        //             "klsRawat" => [
        //                 "klsRawatHak" => "3",
        //                 "klsRawatNaik" => "",
        //                 "pembiayaan" => "",
        //                 "penanggungJawab" => "",
        //             ],
        //             "noMR" => "172844",
        //             "rujukan" => [
        //                 "asalRujukan" => "1",
        //                 "tglRujukan" => "2024-03-27",
        //                 "noRujukan" => "0050B1070324P000010",
        //                 "ppkRujukan" => "0050B107",
        //             ],
        //             "catatan" => "Kontrol Rajal",
        //             "diagAwal" => "I12",
        //             "poli" => [
        //                 "tujuan" => "BED", 
        //                 "eksekutif" => "0"
        //             ],
        //             "cob" => [
        //                 "cob" => "0",
        //             ],
        //             "katarak" => [
        //                 "katarak" => "0",
        //             ],
        //             "jaminan" => [
        //                 "lakaLantas" => "0",
        //                 "penjamin" => [
        //                     "tglKejadian" => "",
        //                     "keterangan" => "",
        //                     "suplesi" => [
        //                         "suplesi" => "0",
        //                         "noSepSuplesi" => "",
        //                         "lokasiLaka" => [
        //                             "kdPropinsi" => "",
        //                             "kdKabupaten" => "",
        //                             "kdKecamatan" => "",
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //             "tujuanKunj" => "1",
        //             "flagProcedure" => "1",
        //             "kdPenunjang" => "2",
        //             "assesmentPel" => "",
        //             "skdp" => [
        //                 "noSurat" => "0301R0210424K000001", 
        //                 "kodeDPJP" => "31537",
        //             ],
        //             "dpjpLayan" => "31537",
        //             "noTelp" => "085264578855",
        //             "user" => "ropana",
        //         ],
        //     ],
        // ];

        $dataRequest = json_encode($dataRequest);
        $createSep = $this->sepUatVclaim->postSepInsert($dataRequest);
        return $createSep;
    }

    /**
     * insert SEP kontrol rawat jalan
     * dengan di terbitkan terlebih dahulu surat kontrol nya
     * poli harus sama dengan poli rujukan
     * untuk prosedur tidak berkelanjutan
    */
    public function postSepRujukanKontrolRajalProsedureTidakBerkelanjutan(Request $request)
    {
        $dataRequest = [
            "request" => [
                "t_sep" => [
                    "noKartu" => "0002082421754",
                    "tglSep" => "2024-04-17",
                    "ppkPelayanan" => "0301R021", //untuk ropanasuri
                    "jnsPelayanan" => "2",
                    "klsRawat" => [
                        "klsRawatHak" => "3",
                        "klsRawatNaik" => "",
                        "pembiayaan" => "",
                        "penanggungJawab" => "",
                    ],
                    "noMR" => "172844",
                    "rujukan" => [
                        "asalRujukan" => "1",
                        "tglRujukan" => "2024-03-27",
                        "noRujukan" => "0050B1070324P000010",
                        "ppkRujukan" => "0050B107",
                    ],
                    "catatan" => "Prosedur tidak berkelanjutan",
                    "diagAwal" => "I12",
                    "poli" => [
                        "tujuan" => "BED", 
                        "eksekutif" => "0"
                    ],
                    "cob" => [
                        "cob" => "0",
                    ],
                    "katarak" => [
                        "katarak" => "0",
                    ],
                    "jaminan" => [
                        "lakaLantas" => "0",
                        "penjamin" => [
                            "tglKejadian" => "",
                            "keterangan" => "",
                            "suplesi" => [
                                "suplesi" => "0",
                                "noSepSuplesi" => "",
                                "lokasiLaka" => [
                                    "kdPropinsi" => "",
                                    "kdKabupaten" => "",
                                    "kdKecamatan" => "",
                                ],
                            ],
                        ],
                    ],
                    "tujuanKunj" => "1",
                    "flagProcedure" => "0",
                    "kdPenunjang" => "11",
                    "assesmentPel" => "",
                    "skdp" => [
                        "noSurat" => "0301R0210424K000001", 
                        "kodeDPJP" => "31537",
                    ],
                    "dpjpLayan" => "31537",
                    "noTelp" => "085264578855",
                    "user" => "ropana",
                ],
            ],
        ];

        $dataRequest = json_encode($dataRequest);
        $createSep = $this->sepUatVclaim->postSepInsert($dataRequest);
        return $createSep;
    }


    /**
     * insert SEP kontrol rawat jalan
     * dengan di terbitkan terlebih dahulu surat kontrol nya
     * poli harus sama dengan poli rujukan
     * untuk Konsultasi
    */
    public function postSepRujukanKontrolRajalKonsul(Request $request)
    {
        $dataRequest = [
            "request" => [
                "t_sep" => [
                    "noKartu" => "0002082421754",
                    "tglSep" => "2024-04-16",
                    "ppkPelayanan" => "0301R021", //untuk ropanasuri
                    "jnsPelayanan" => "2",
                    "klsRawat" => [
                        "klsRawatHak" => "3",
                        "klsRawatNaik" => "",
                        "pembiayaan" => "",
                        "penanggungJawab" => "",
                    ],
                    "noMR" => "172844",
                    "rujukan" => [
                        "asalRujukan" => "1",
                        "tglRujukan" => "2024-03-27",
                        "noRujukan" => "0050B1070324P000010",
                        "ppkRujukan" => "0050B107",
                    ],
                    "catatan" => "Konsul",
                    "diagAwal" => "I12",
                    "poli" => [
                        "tujuan" => "BED", 
                        "eksekutif" => "0"
                    ],
                    "cob" => [
                        "cob" => "0",
                    ],
                    "katarak" => [
                        "katarak" => "0",
                    ],
                    "jaminan" => [
                        "lakaLantas" => "0",
                        "penjamin" => [
                            "tglKejadian" => "",
                            "keterangan" => "",
                            "suplesi" => [
                                "suplesi" => "0",
                                "noSepSuplesi" => "",
                                "lokasiLaka" => [
                                    "kdPropinsi" => "",
                                    "kdKabupaten" => "",
                                    "kdKecamatan" => "",
                                ],
                            ],
                        ],
                    ],
                    "tujuanKunj" => "2",
                    "flagProcedure" => "",
                    "kdPenunjang" => "",
                    "assesmentPel" => "5",
                    "skdp" => [
                        "noSurat" => "0301R0210424K000001", 
                        "kodeDPJP" => "31537",
                    ],
                    "dpjpLayan" => "31537",
                    "noTelp" => "085264578855",
                    "user" => "ropana",
                ],
            ],
        ];

        $dataRequest = json_encode($dataRequest);
        $createSep = $this->sepUatVclaim->postSepInsert($dataRequest);
        return $createSep;
    }

    /**
     * List data Referensi > Poli begin
     */
    public function getDpjp($jenisLayanan, $tglsep, $kode)
    {
        $dpjp = $this->sepUatVclaim->getDokterDPJP($jenisLayanan, $tglsep, $kode);
        return $dpjp;
    }

    /**
     * insert SEP rawat inap
     * dengan di terbitkan SPRI terlebih dahulu
     * poli di kosongkan
    */
    public function postSepRawatInap(Request $request)
    {
        // $dataRequest = [
        //     "request" => [
        //         "t_sep" => [
        //             "noKartu" => "0002082421754",
        //             "tglSep" => "2024-05-08",
        //             "ppkPelayanan" => "0301R021", //untuk ropanasuri
        //             "jnsPelayanan" => "1",
        //             "klsRawat" => [
        //                 "klsRawatHak" => "3",
        //                 "klsRawatNaik" => "",
        //                 "pembiayaan" => "",
        //                 "penanggungJawab" => "",
        //             ],
        //             "noMR" => "000007",
        //             "rujukan" => [
        //                 "asalRujukan" => "2",
        //                 "tglRujukan" => "2024-05-08",
        //                 "noRujukan" => "0301R0210524V000008",
        //                 "ppkRujukan" => "0301R021",
        //             ],
        //             "catatan" => "sep rawat inap",
        //             "diagAwal" => "K35",
        //             "poli" => [
        //                 "tujuan" => "", 
        //                 "eksekutif" => "0"
        //             ],
        //             "cob" => [
        //                 "cob" => "0",
        //             ],
        //             "katarak" => [
        //                 "katarak" => "0",
        //             ],
        //             "jaminan" => [
        //                 "lakaLantas" => "0",
        //                 "penjamin" => [
        //                     "tglKejadian" => "",
        //                     "keterangan" => "",
        //                     "suplesi" => [
        //                         "suplesi" => "0",
        //                         "noSepSuplesi" => "",
        //                         "lokasiLaka" => [
        //                             "kdPropinsi" => "",
        //                             "kdKabupaten" => "",
        //                             "kdKecamatan" => "",
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //             "tujuanKunj" => "0",
        //             "flagProcedure" => "",
        //             "kdPenunjang" => "",
        //             "assesmentPel" => "",
        //             "skdp" => [
        //                 "noSurat" => "0301R0210524K000002", 
        //                 "kodeDPJP" => "438372",
        //             ],
        //             "dpjpLayan" => "",
        //             "noTelp" => "085264578855",
        //             "user" => "ropana",
        //         ],
        //     ],
        // ];

        $dataRequest = [
            "request" => [
                "t_sep" => [
                    "noKartu" => "0001226522812",
                    "tglSep" => "2024-05-13",
                    "ppkPelayanan" => "0301R021", //untuk ropanasuri
                    "jnsPelayanan" => "1",
                    "klsRawat" => [
                        "klsRawatHak" => "1",
                        "klsRawatNaik" => "8",
                        "pembiayaan" => "",
                        "penanggungJawab" => "",
                    ],
                    "noMR" => "000008",
                    "rujukan" => [
                        "asalRujukan" => "2",
                        "tglRujukan" => "2024-05-12",
                        "noRujukan" => "0301R0210524V000020",
                        "ppkRujukan" => "0301R021",
                    ],
                    "catatan" => "sep naik kelas",
                    "diagAwal" => "K35",
                    "poli" => [
                        "tujuan" => "", 
                        "eksekutif" => "0"
                    ],
                    "cob" => [
                        "cob" => "0",
                    ],
                    "katarak" => [
                        "katarak" => "0",
                    ],
                    "jaminan" => [
                        "lakaLantas" => "0",
                        "penjamin" => [
                            "tglKejadian" => "",
                            "keterangan" => "",
                            "suplesi" => [
                                "suplesi" => "0",
                                "noSepSuplesi" => "",
                                "lokasiLaka" => [
                                    "kdPropinsi" => "",
                                    "kdKabupaten" => "",
                                    "kdKecamatan" => "",
                                ],
                            ],
                        ],
                    ],
                    "tujuanKunj" => "0",
                    "flagProcedure" => "",
                    "kdPenunjang" => "",
                    "assesmentPel" => "",
                    "skdp" => [
                        "noSurat" => "0301R0210524K000004", 
                        "kodeDPJP" => "31537",
                    ],
                    "dpjpLayan" => "",
                    "noTelp" => "0822369147456",
                    "user" => "ropana",
                ],
            ],
        ];

        $dataRequest = json_encode($dataRequest);
        $createSep = $this->sepUatVclaim->postSepInsert($dataRequest);
        return $createSep;
    }

    /**
     * List data poli rencana kontrol
     * Vclaim > Rencana Kontrol > Data Poli/Spesialistik
     */
    public function getDataPoliRencanaKontrol($jenisKontrol, $nomor, $tgl)
    {
        $poliRencanaKontrol = $this->sepUatVclaim->getDataPoliRencanaKontrol($jenisKontrol, $nomor, $tgl);
        return $poliRencanaKontrol;
    }

    /**
     * List data dokter rencana kontrol
     * Vclaim > Rencana Kontrol > Data Dokter
     */
    public function getDataDokterRencanaKontrol($jenisKontrol, $kodePoli, $tgl)
    {
        $poliRencanaKontrol = $this->sepUatVclaim->getDataDokterRencanaKontrol($jenisKontrol, $kodePoli, $tgl);
        return $poliRencanaKontrol;
    }

    /**
     * insert SEP rawat jalan
     * dengan di terbitkan Surat Kontrol terlebih dahulu
    */
    public function postSepKontrolRanap(Request $request)
    {
        $dataRequest = [
            "request" => [
                "t_sep" => [
                    "noKartu" => "0002082421754",
                    "tglSep" => "2024-05-11",
                    "ppkPelayanan" => "0301R021", //untuk ropanasuri
                    "jnsPelayanan" => "2",
                    "klsRawat" => [
                        "klsRawatHak" => "3",
                        "klsRawatNaik" => "",
                        "pembiayaan" => "",
                        "penanggungJawab" => "",
                    ],
                    "noMR" => "000007",
                    "rujukan" => [
                        "asalRujukan" => "2",
                        "tglRujukan" => "2024-05-09",
                        "noRujukan" => "0301R0210524V000008",
                        "ppkRujukan" => "0301R021",
                    ],
                    "catatan" => "sep kontrol post ranap",
                    "diagAwal" => "K35",
                    "poli" => [
                        "tujuan" => "BED", 
                        "eksekutif" => "0"
                    ],
                    "cob" => [
                        "cob" => "0",
                    ],
                    "katarak" => [
                        "katarak" => "0",
                    ],
                    "jaminan" => [
                        "lakaLantas" => "0",
                        "penjamin" => [
                            "tglKejadian" => "",
                            "keterangan" => "",
                            "suplesi" => [
                                "suplesi" => "0",
                                "noSepSuplesi" => "",
                                "lokasiLaka" => [
                                    "kdPropinsi" => "",
                                    "kdKabupaten" => "",
                                    "kdKecamatan" => "",
                                ],
                            ],
                        ],
                    ],
                    "tujuanKunj" => "0",
                    "flagProcedure" => "",
                    "kdPenunjang" => "",
                    "assesmentPel" => "",
                    "skdp" => [
                        "noSurat" => "0301R0210524K000003", 
                        "kodeDPJP" => "31537",
                    ],
                    "dpjpLayan" => "31537",
                    "noTelp" => "085264578855",
                    "user" => "ropana",
                ],
            ],
        ];

        $dataRequest = json_encode($dataRequest);
        $createSep = $this->sepUatVclaim->postSepInsert($dataRequest);
        return $createSep;
    }

    /** List data Referensi > Poli begin */
    public function getInaCBGIntegrasi($noSep)
    {
        $inacbg = $this->sepUatVclaim->getIntegrasiInacbg($noSep);
        return $inacbg;
    }
}