<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\Medicine;
use App\Models\MedicineCategory;
use App\Models\MedicineForm;
use App\Models\MedicineType;
use App\Models\Supplier;
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
        if (session()->has('navOn')) {
            session(['navOn' => session('navOn')]);
        }else{
            session(['navOn' => 'listObat']);
        }
        $data = Medicine::with(['medicineType', 'medicineForm', 'medicineCategory'])->get();
        $dataJenis = MedicineType::all();
        $dataGol = MedicineCategory::all();
        $dataBentuk = MedicineForm::all();
        $dataPabrik = Factory::all();
        $dataSupplier = Supplier::all();
        return view('pages.masterobat.index', [
            "title" => "Master Obat",
            "menu" => "Setting",
            "data" => $data,
            "dataJenis" => $dataJenis,
            "dataGol" => $dataGol,
            "dataBentuk" => $dataBentuk,
            "dataPabrik" => $dataPabrik,
            "dataSupplier" => $dataSupplier,
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
        return view('pages.masterobat.create', [
            "title" => "Master Obat",
            "menu" => "Setting",
            "jenis" => $jenis,
            "golongan" => $golongan,
            "sediaan" => $sediaan,
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
        $this->validate($request, [
            'kode' => 'required',
            'name' => 'required',
            'medicine_type_id' => 'required',
            'medicine_category_id' => 'required',
            'small_unit' => 'required',
        ]);

        $data = $request->all();
        Medicine::create($data);

        return redirect()->route('farmasi/obat.index')->with([
            'success' => 'Berhasil Ditambahkan',
            'navOn' => 'listObat'
        ]);
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
        return view('pages.masterobat.edit', [
            "title" => "Master Obat",
            "menu" => "Setting",
            "item" => $item,
            "jenis" => $jenis,
            "golongan" => $golongan,
            "sediaan" => $sediaan,
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
        $this->validate($request, [
            'kode' => 'required',
            'name' => 'required',
            'medicine_type_id' => 'required',
            'medicine_category_id' => 'required',
            'small_unit' => 'required',
        ]);
        $item = Medicine::find($id);
        $data = $request->all();
        $item->update($data);

        return redirect()->route('farmasi/obat.index')->with([
            'success' => 'Berhasil Diperbarui',
            'navOn' => 'listObat'
        ]);
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

        return back()->with([
            'success' => 'Berhasil Dihapus',
            'navOn' => 'listObat'
        ]);
    }
}
