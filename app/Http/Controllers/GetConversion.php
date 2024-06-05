<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\UnitConversion;
use Illuminate\Http\Request;

class GetConversion extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->satuan){
            $unitConversions = UnitConversion::where('medicine_id', $request->id)->where('unit_from', $request->satuan)->get();
            $data = "<option selected disabled>Pilih</option>";
            foreach($unitConversions as $item){
                $data .= "<option value='$item->unit_to'>$item->unit_to</option>";
            }
            echo $data;
        }else{
            $data = "<option selected disabled>Pilih</option>";
            echo $data;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->id){
            $checkSatuan = Medicine::findOrFail($request->id);
            if($checkSatuan){
                $data = "<option selected disabled>Pilih</option>";
                foreach($checkSatuan->unitConversions as $item){
                    $data .= "<option value='$item->unit_from'>$item->unit_from</option>";
                }
                echo $data;
            }else{
                $data = "<option selected disabled>Data Konversi Tidak Tersedia</option>";
                echo $data;
            }
        }else{
            $data = "<option selected disabled>Pilih</option>";
            echo $data;
        }
    }

    public function getJumlah(Request $request){
        $data = UnitConversion::where('unit_from', $request->satuan_awal)->where('unit_to', $request->satuan)->first();
        if($data){
            $total = $request->jumlah_awal*$data->nilai;
            return response()->json($total);
        }

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
        //
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
        //
    }
}
