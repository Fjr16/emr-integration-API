<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicineStok;
use App\Models\Unit;
use App\Models\UnitCategory;
use App\Models\UnitCategoryPivot;
use Illuminate\Http\Request;

class MedicineStokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Unit::all();
        return view('pages.stock.index', [
            "title" => "Stock Obat",
            "menu" => "Farmasi",
            'data' => $data
        ]);
    }

    public function all()
    {
        $data = Medicine::all();
        return view('pages.totalstockobat.index', [
            "title" => "Total Stock Obat",
            "menu" => "Farmasi",
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $item = Unit::find($id);
        // $data = UnitCategory::where('unit_id', $id)->get();
        return view('pages.stockdetail.index', [
            "title" => "Stock Obat",
            "menu" => "Farmasi",
            // 'data' => $data,
            'item' => $item
        ]);

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
