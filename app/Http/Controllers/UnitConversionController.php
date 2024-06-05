<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\UnitConversion;
use App\Models\UnitConversionMaster;
use Illuminate\Http\Request;

class UnitConversionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = UnitConversion::all();
        return view('pages.konversi.index', [
            'title' => 'Konversi',
            'menu' => 'Setting',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = UnitConversionMaster::all();
        $medicines = Medicine::all();
        return view('pages.konversi.create', [
            'title' => 'Konversi',
            'menu' => 'Setting',
            'data' => $data,
            'medicines' => $medicines,
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
        UnitConversion::create($data);

        return redirect()->route('farmasi/obat/konversi.index')->with('success', 'Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $item = Medicine::findOrFail($request->id);
        $satuan = $item->unitConversionMaster->name;
        $data = "<option value='$satuan'>$satuan</option>";
        echo $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = UnitConversionMaster::all();
        $medicines = Medicine::all();
        $item = UnitConversion::findOrFail($id);
        return view('pages.konversi.edit', [
            'title' => 'Konversi',
            'menu' => 'Setting',
            'item' => $item,
            'data' => $data,
            'medicines' => $medicines,
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
        $item = UnitConversion::findOrFail($id);

        $item->update($data);

        return redirect()->route('farmasi/obat/konversi.index')->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = UnitConversion::findOrFail($id);
        $item->delete($id);

        return back()->with('success', 'Berhasil Dihapus');
    }
}
