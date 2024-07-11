<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Unit;
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
        return view('pages.stockdetail.index', [
            "title" => "Stock Obat",
            "menu" => "Farmasi",
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
