<?php

namespace App\Http\Controllers;

use App\Models\LaboratoriumRequestMasterDetail;
use Illuminate\Http\Request;

class LaboratoriumRequestMasterDetailController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $data = $request->all();
        $data['laboratorium_request_master_variable_id'] = $id;
        LaboratoriumRequestMasterDetail::create($data);

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
        $item = LaboratoriumRequestMasterDetail::find($id);
        return view('pages.masterDetailVariabelLaborPk.edit', [
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
        $item = LaboratoriumRequestMasterDetail::find($id);
        $data = $request->all();

        $item->update($data);
        
        return redirect()->route('laboratorium/pk/variabel/pemeriksaan.edit', $item->laboratoriumRequestMasterVariable->id)->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = LaboratoriumRequestMasterDetail::find($id);
        $item->delete();

        return back()->with('success', 'Berhasil Dihapus');
    }
}
