<?php

namespace App\Http\Controllers;

use App\Services\SatuSehat\BaseUrlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RequestApiController extends Controller
{
    private $apiSatuSehat;
    public function __construct(BaseUrlService $apiSatuSehat) {
        $this->apiSatuSehat = $apiSatuSehat;
    }
    
    public function postDataPatient(Request $request) {
        
        $res = Http::post('http://127.0.0.1:3000/data/pasien/registrasi');
        $data = json_decode($res, true);
        dd($data);
    }
    public function getDataByNik() {
        $url = "data/pasien/get/130107210792000";
        $res = $this->apiSatuSehat->getRequest($url);

        return $res;
    }
    public function getRiwayatByRm() {
        $res = Http::get('http://127.0.0.1:3000/data/riwayat/pengobatan/get');
        $data = json_decode($res, true);
        dd($res);
    }
}
