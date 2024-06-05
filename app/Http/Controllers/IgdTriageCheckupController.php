<?php

namespace App\Http\Controllers;

use App\Models\IgdTriageCategoryCheckup;
use App\Models\IgdTriageCheckup;
use App\Models\IgdTriageScale;
use Illuminate\Http\Request;

class IgdTriageCheckupController extends Controller
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
        $data = IgdTriageCheckup::all();
        $skalas = IgdTriageScale::orderBy('name', 'asc')->get();
        $kategoris = IgdTriageCategoryCheckup::all();
        return view('pages.igdTriagePemeriksaan.create', [
            'title' => 'Pemeriksaan',
            'menu' => 'Pemeriksaan',
            'data' => $data,
            'skalas' => $skalas,
            'kategoris' => $kategoris,
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
        $data  = $request->all();
        IgdTriageCheckup::create($data);

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
        $item = IgdTriageCheckup::findOrFail($id);
        $item->delete();
        return back()->with('success', 'Berhasil Dihapus');
        
    }
}
