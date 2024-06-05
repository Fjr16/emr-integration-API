<?php

namespace App\Http\Controllers;

use App\Models\Icd;
use Illuminate\Http\Request;

class IcdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Icd::all();
        return view('pages.icd.index', [
            'title' => 'ICD',
            'menu' => 'Setting',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.icd.create', [
            'title' => 'ICD',
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
        Icd::create($data);
        
        return redirect()->route('icd.index')->with('success', 'Berhasil Di Tambahkan');
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
        $item = Icd::find($id);
        return view('pages.icd.edit', [
            'title' => 'ICD',
            'menu' => 'Setting',
            'item' => $item
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
        $item = Icd::find($id);
        $data = $request->all();
        $item->update($data);

        return redirect()->route('icd.index')->with('success', 'Berhasil Di Perbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Icd::find($id);
        $item->delete();

        return back()->with('success', 'Berhasil Di Hapus');
    }
}
