<?php

namespace App\Http\Controllers;

use App\Models\UnitCategoryPivot;
use Illuminate\Http\Request;

class UnitCategoryPivotController extends Controller
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
        return view('pages.unitSub.create', [
            'title' => 'Unit',
            'menu' => 'Insert',
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
        UnitCategoryPivot::create($data);
        
        return redirect()->route('unit.create')->with('success', 'Data Sub Unit Berhasil Ditambahkan');
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
        $item = UnitCategoryPivot::find($id);
        return view('pages.unitSub.edit', [
            'title' => 'Unit',
            'menu' => 'Insert',
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
        $item = UnitCategoryPivot::find($id);

        $item->update($data);
        return redirect()->route('unit.create')->with('success', 'Data Sub Unit Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = UnitCategoryPivot::find($id);
        $item->delete();

        return back()->with('success', 'Berhasil Dihapus');
    }
}
