<?php

namespace App\Http\Controllers;

use App\Models\RadiologiFormRequestMasterDetail;
use Illuminate\Http\Request;

class RadiologiFormRequestMasterDetailController extends Controller
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
        return view('pages.RadiologiMasterDetail.create', [
            'title' => 'Master Radiologi',
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
        RadiologiFormRequestMasterDetail::create($data);

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
        $item = RadiologiFormRequestMasterDetail::find($id);
        return view('pages.RadiologiMasterDetail.edit', [
            'title' => 'Master Radiologi',
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
        $item = RadiologiFormRequestMasterDetail::find($id);
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
        $item = RadiologiFormRequestMasterDetail::find($id);
        $item->update([
            'isActive' => false,
        ]);

        return back()->with('success', 'Berhasil Dihapus');
    }
}
