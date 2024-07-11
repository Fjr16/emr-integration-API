<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\UnitConversion;
use Illuminate\Http\Request;

class GetConversion extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $checkSatuan = Medicine::find($request->id);
        if($checkSatuan){
            $data = [
                'small_unit' => $checkSatuan->small_unit ?? null,
                'medium_unit' => $checkSatuan->medium_unit ?? null,
                'big_unit' => $checkSatuan->big_unit ?? null,
                'medium_to_small' => $checkSatuan->small_to_medium ?? null,
                'big_to_medium' => $checkSatuan->medium_to_big ?? null,
            ];
            return response()->json($data);
        }else{
            return response()->json([
                'message' => 'Data Not Found',
            ]);
        }
    }

    // public function getJumlah(Request $request){
    //     $data = UnitConversion::where('unit_from', $request->satuan_awal)->where('unit_to', $request->satuan)->first();
    //     if($data){
    //         $total = $request->jumlah_awal*$data->nilai;
    //         return response()->json($total);
    //     }
}
