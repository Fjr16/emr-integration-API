<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicineCategory;
use App\Models\MedicineForm;
use App\Models\MedicineType;
use App\Models\UnitConversionMaster;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Medicine::all();
        return view('pages.masterobat.index', [
            "title" => "Master Obat",
            "menu" => "Setting",
            "data" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = MedicineType::all();
        $golongan = MedicineCategory::all();
        $sediaan = MedicineForm::all();
        $satuan = UnitConversionMaster::all();
        return view('pages.masterobat.create', [
            "title" => "Master Obat",
            "menu" => "Setting",
            "jenis" => $jenis,
            "golongan" => $golongan,
            "sediaan" => $sediaan,
            "satuan" => $satuan,
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
        Medicine::create($data);

        return redirect()->route('farmasi/obat.index')->with('success', 'Berhasil Ditambahkan');
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
        $item = Medicine::find($id);
        $jenis = MedicineType::all();
        $golongan = MedicineCategory::all();
        $sediaan = MedicineForm::all();
        $satuan = UnitConversionMaster::all();
        return view('pages.masterobat.edit', [
            "title" => "Master Obat",
            "menu" => "Setting",
            "item" => $item,
            "jenis" => $jenis,
            "golongan" => $golongan,
            "sediaan" => $sediaan,
            "satuan" => $satuan,
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
        $item = Medicine::find($id);
        $data = $request->all();
        $item->update($data);

        return redirect()->route('farmasi/obat.index')->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Medicine::find($id);
        $item->delete();

        return back()->with('success', 'Berhasil Dihapus');
    }
}
