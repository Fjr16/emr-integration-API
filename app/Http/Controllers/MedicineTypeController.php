<?php

namespace App\Http\Controllers;

use App\Models\MedicineType;
use Illuminate\Http\Request;

class MedicineTypeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.jenisObat.create', [
            'title' => 'Master Obat',
            'menu' => 'Farmasi',
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
        MedicineType::create($data);

        return redirect()->route('farmasi/obat.index')->with([
            'success' => 'Berhasil Di Tambahkan',
            'navOn' => 'jenisObat'
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
        $item = MedicineType::find($id);
        return view('pages.jenisObat.edit', [
            'title' => 'Master Obat',
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
        $item = MedicineType::find($id);
        $item->update($data);

        return redirect()->route('farmasi/obat.index')->with([
            'success' => 'Berhasil Di Perbarui',
            'navOn' => 'jenisObat'
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
        $item = MedicineType::find($id);
        $item->delete();

        return back()->with([
            'success' => 'Berhasil Di Hapus',
            'navOn' => 'jenisObat'
        ]);
    }
}
