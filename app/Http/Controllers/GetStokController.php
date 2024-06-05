<?php

namespace App\Http\Controllers;

use App\Models\MedicineStok;
use App\Models\PatientCategory;
use Illuminate\Http\Request;

class GetStokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stok = MedicineStok::where('medicine_id', $request->medicine_id)->where('unit_id', $request->unit_id)->sum('stok');
        return response()->json($stok);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $stok = MedicineStok::where('medicine_id', $request->medicine_id)->where('unit_id', $request->unit_id)->sum('stok');
        $item = MedicineStok::where('medicine_id', $request->medicine_id)->where('unit_id', $request->unit_id)->where('stok', '>', 0)->orderBy('exp_date', 'asc')->first();
        $temp = $item->base_harga;
        $tanggungan = PatientCategory::find($request->tanggungan_id);
        if ($tanggungan->name == 'BPJS') {
            $temp = $item->base_harga - $item->diskon_satuan;
        }
        
        $margin = $temp*$tanggungan->margin/100;
        $harga = $temp+$margin;

        return response()->json([
            'stok' => $stok,
            'harga' => $harga,
        ]);
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
