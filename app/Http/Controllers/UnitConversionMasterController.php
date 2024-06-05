<?php

namespace App\Http\Controllers;

use App\Models\UnitConversionMaster;
use Illuminate\Http\Request;

class UnitConversionMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = UnitConversionMaster::all();
        return view('pages.konversiMaster.create', [
            'title' => 'Master Konversi',
            'menu' => 'Farmasi',
            'data' => $data,
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
        $data = $request->all();
        UnitConversionMaster::create($data);
        return back()->with('success', 'Berhasil Ditambahkan');
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
        $item = UnitConversionMaster::findOrFail($id);
        return view('pages.konversiMaster.edit', [
            'title' => 'Master Konversi',
            'menu' => 'Farmasi',
            'item' => $item,
        ]);
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
        $data = $request->all();
        $item = UnitConversionMaster::findOrFail($id);

        $item->update($data);

        return back()->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = UnitConversionMaster::findOrFail($id);
        $item->delete();
        return back()->with('success', 'Berhasil Dihapus');
    }
}
