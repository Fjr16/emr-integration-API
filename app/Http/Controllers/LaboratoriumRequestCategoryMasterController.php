<?php

namespace App\Http\Controllers;

use App\Models\LaboratoriumRequestCategoryMaster;
use Illuminate\Http\Request;

class LaboratoriumRequestCategoryMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = LaboratoriumRequestCategoryMaster::all();
        // return view('pages.masterKategoriPemeriksaanLaborPK.index', [
        //     'title' => 'Master Labor PK',
        //     'menu' => 'Master Labor PK',
        //     'data' => $data,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.masterKategoriPemeriksaanLaborPK.create', [
            'title' => 'Master Labor PK',
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
        $data['name'] = strtoupper($request->input('name'));
        LaboratoriumRequestCategoryMaster::create($data);

        return redirect()->route('laboratorium/pk/variabel/pemeriksaan.create')->with('success', 'Berhasil Ditambahkan');
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
        $item = LaboratoriumRequestCategoryMaster::find($id);
        return view('pages.masterKategoriPemeriksaanLaborPK.edit', [
            'title' => 'Master Labor PK',
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
        $item = LaboratoriumRequestCategoryMaster::find($id); 
        $data = $request->all();
        $data['name'] = strtoupper($request->input('name'));
        $item->update($data);

        return redirect()->route('laboratorium/pk/variabel/pemeriksaan.create')->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = LaboratoriumRequestCategoryMaster::find($id);

        if($item->laboratoriumRequestMasterVariables->isNotEmpty()){
            return back()->with('error', 'Gagal !! Data Sedang Digunakan');
        }
        $item->delete();

        return back()->with('success', 'Berhasil Dihapus');
    }

}
