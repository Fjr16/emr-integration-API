<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetWilayahController extends Controller
{
    public function kota(Request $request){
        $kotas = \Indonesia::findProvince($request['province_id'])->cities->sortBy('name');
        $data =  "<option selected disabled>Pilih Kota</option>";
        foreach ($kotas as $kota) {
            $data .= "<option value='$kota->id'>$kota->name</option>";
        }
        echo $data;
    }
    
    public function kecamatan(Request $request){
        if($request['city_id']){
            $kecamatans = \Indonesia::findCity($request['city_id'])->districts->sortBy('name');
            $data = "<option selected disabled>Pilih Kecamatan</option>";
            foreach ($kecamatans as $kec) {
                $data .= "<option value='$kec->id'>$kec->name</option>";
            }
            echo $data;
        }else{
            $data = "<option value='' selected>Pilih Kecamatan</option>";
            echo $data;
        }
    }

    public function kelurahan(Request $request){
        if($request['district_id']){
            $villages = \Indonesia::findDistrict($request['district_id'])->villages->sortBy('name');
            $data = "<option value='' selected>Pilih Kelurahan</option>";
            foreach ($villages as $village) {
                $data .= "<option value='$village->id'>$village->name</option>";
            }
            echo $data; 
        }else{
            echo "<option value='' selected>Pilih Kelurahan</option>";
        }
    }
}
