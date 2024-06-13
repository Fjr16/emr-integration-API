<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RequestApiController extends Controller
{
    public function postDataPatient(Request $request) {
        
        $res = Http::post('http://127.0.0.1:3000/data/pasien/registrasi', [
            
        ]);
        $data = json_decode($res, true);
        dd($data);
    }
    public function getDataByNik() {
        $res = Http::get('http://127.0.0.1:3000/data/pasien/get/1301072107920002');
        $data = json_decode($res, true);
        if($data['status']['code'] == '200'){
            $data = $data['data']['entry'][0]['resource'];
        }else{
            dd($data['status']);
        }

        dd($data);
    }
    public function getRiwayatByRm() {
        $res = Http::get('http://127.0.0.1:3000/data/riwayat/pengobatan/get');
        $data = json_decode($res, true);
        dd($res);
    }
}
