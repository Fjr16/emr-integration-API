<?php

namespace App\Http\Controllers;

use App\Models\AsuransiPatient;
use Illuminate\Http\Request;

class AsuransiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AsuransiPatient::all();
        return view('pages.asuransi.index', [
            'data' => $data,
            'title' => 'ASURANSI',
            'menu' => 'KEUANGAN',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.asuransi.create', [
            'title' => 'ASURANSI',
            'menu' => 'KEUANGAN',
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
        AsuransiPatient::create($data);
        return redirect()->route('asuransi.index')->with('success', 'SUKSESS');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = AsuransiPatient::find($id);
        return view('pages.asuransi.pengantar', [
            'item' => $item,
            'title' => 'ASURANSI',
            'menu' => 'KEUANGAN',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
