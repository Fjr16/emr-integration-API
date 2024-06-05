<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Bpjs\VClaim;
use Illuminate\Http\Request;

class RencanaKontrolController extends Controller
{
    protected $rencanaKontrol;

    public function __construct() {
        $this->rencanaKontrol = new VClaim;
    }

    /** search SEP dari Rencana Kontroll begin */
    public function searchSepRencanaKontrol($noSep)
    { 
        $cariDataSep = $this->rencanaKontrol->getSearchSEPrk($noSep);
        return $cariDataSep;
    }
    /** search SEP dari Rencana Kontroll end */

    /** Insert Surat Perintah Rawat Inap (SPRI) begin */
    public function postSPRI(Request $request)
    { 
        $dataRequest = $request->all();
        $dataRequest = json_encode($dataRequest);
        $insertSPRI = $this->rencanaKontrol->postSPRI($dataRequest);
        return $insertSPRI;
    }
    /** Insert Surat Perintah Rawat Inap (SPRI) end */

    /** Update Surat Perintah Rawat Inap (SPRI) begin */
    public function putSPRI(Request $request)
    { 
        // $dataRequest = $request->all();
        $dataRequest = [
            "request" => [
                "noSPRI" => "0301R0210424K000007",
                "kodeDokter" => "31537",
                "poliKontrol" => "BED",
                "tglRencanaKontrol" => "2024-05-01",
                "user" => "ropana"
            ],
        ];
        
        $dataRequest = json_encode($dataRequest);
        $updateSPRI = $this->rencanaKontrol->putSPRI($dataRequest);
        return $updateSPRI;
    }
    /** Update Surat Perintah Rawat Inap (SPRI) end */


    /**
     * Insert Surat Kontrol begin
     * pembuatan rencana kontrol untuk pasien rawat jalan
     * poli yang sama dengan poli rujukan
     */
    public function postRencanaKontrol(Request $request)
    { 
        // $dataRequest = $request->all();
        $dataRequest = [
            "request" => [
                "noSEP" => "0301R0210424V000023",
                "kodeDokter" => "31537",
                "poliKontrol" => "BED",
                "tglRencanaKontrol" => "2024-04-27",
                "user" => "ropana"
            ],
        ];

        // $dataRequest = [
        //     "request" => [
        //         "noSEP" => "0301R0210424V000007",
        //         "kodeDokter" => "31537",
        //         "poliKontrol" => "INT",
        //         "tglRencanaKontrol" => "2024-04-16",
        //         "user" => "ropana"
        //     ],
        // ];

        $dataRequest = json_encode($dataRequest);
        $postRK = $this->rencanaKontrol->postRencanaKontrol($dataRequest);
        return $postRK;
    }
    /** Insert Surat Kontrol end */

    /** Update Surat Kontrol begin */
    public function updateSuratKontrol(Request $request)
    { 
        // $dataRequest = $request->all();
        $dataRequest = [
            "request" => [
                "noSuratKontrol" => "0301R0210424K000004",
                "noSEP" => "0301R0210424V000024",
                "kodeDokter" => "31537",
                "poliKontrol" => "BED",
                "tglRencanaKontrol" => "2024-04-29",
                "user" => "ropana"
            ],
        ];
        $dataRequest = json_encode($dataRequest);
        $updateSurat = $this->rencanaKontrol->putRencanaKontrol($dataRequest);
        return $updateSurat;
    }

    public function deleteSuratKontrol(Request $request)
    { 
        $dataRequest = $request->all();
        $dataRequest = json_encode($dataRequest);
        $deleteSurat = $this->rencanaKontrol->deleteSuratKontrol($dataRequest);
        return $deleteSurat;
    }
    /** Update Surat Kontrol end */


    /**
     * Cari nomor surat kontrol
     * berdasarkan yang telah dicreate
     */
    public function cariSuratKontrol($noSurat)
    { 
        $cariSurat = $this->rencanaKontrol->getCariNomorSuratKontrol($noSurat);
        return $cariSurat;
    }
}