<?php

namespace App\Http\Controllers;

use App\Models\LaboratoriumRequestTypeMaster;
use Illuminate\Http\Request;

class LaboratoriumRequestTypeMasterController extends Controller
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
        $data = LaboratoriumRequestTypeMaster::all();
        return view('pages.masterTipePermintaanLabor.create', [
            'title' => 'Master Labor PK',
            'menu' => 'Setting',
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
        LaboratoriumRequestTypeMaster::create($data);

        return back()->with('success', 'Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LaboratoriumRequestTypeMaster  $laboratoriumRequestTypeMaster
     * @return \Illuminate\Http\Response
     */
    public function show(LaboratoriumRequestTypeMaster $laboratoriumRequestTypeMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaboratoriumRequestTypeMaster  $laboratoriumRequestTypeMaster
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = LaboratoriumRequestTypeMaster::find($id);
        return view('pages.masterTipePermintaanLabor.edit', [
            'title' => 'Master Labor PK',
            'menu' => 'Setting',
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaboratoriumRequestTypeMaster  $laboratoriumRequestTypeMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = LaboratoriumRequestTypeMaster::find($id);
        $item->update($data);

        return redirect()->route('laboratorium/pk/tipe/permintaan.create')->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaboratoriumRequestTypeMaster  $laboratoriumRequestTypeMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = LaboratoriumRequestTypeMaster::find($id);
        if($item->laboratoriumRequests->isNotEmpty()){
            return back()->with('error', 'Gagal !! Data Sedang Digunakan');
        }
        $item->delete();
        return back()->with('success', 'Berhasil Dihapus');
    }
}
