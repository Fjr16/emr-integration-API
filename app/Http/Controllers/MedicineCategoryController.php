<?php

namespace App\Http\Controllers;

use App\Models\MedicineCategory;
use Illuminate\Http\Request;

class MedicineCategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.golonganObat.create', [
            'title' => 'Master Obat',
            'menu' => 'Setting',
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
        MedicineCategory::create($data);

        return redirect()->route('farmasi/obat.index')->with([
            'success' => 'Berhasil Di Tambahkan',
            'btn' => 'golObat'
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
        $item = MedicineCategory::find($id);
        return view('pages.golonganObat.edit', [
            'title' => 'Master Obat',
            'menu' => 'Setting',
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
        $item = MedicineCategory::find($id);
        $item->update($data);

        return redirect()->route('farmasi/obat.index')->with([
            'success' => 'Berhasil Di Perbarui',
            'btn' => 'golObat'
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
        $item = MedicineCategory::find($id);
        $item->delete();

        return back()->with([
            'success' => 'Berhasil Di Hapus',
            'btn' => 'golObat'
        ]);
    }
}
