<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\UnitCategory;
use App\Models\UnitCategoryPivot;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Unit::all();
        return view('pages.unit.index', [
            'title' => 'Unit',
            'menu' => 'Setting',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_unit = UnitCategoryPivot::all();  
        return view('pages.unit.create', [
            'title' => 'Unit',
            'menu' => 'Setting',
            'sub_unit' => $sub_unit,
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
        if($item = Unit::create($data)){
            $sub_unit = UnitCategoryPivot::all();
            foreach($sub_unit as $sub){
                $category['unit_id'] = $item->id;
                $category['unit_category_pivot_id'] = $sub->id;
                UnitCategory::create($category);
            }
        }

        return redirect()->route('unit.index')->with('success', 'Berhasil Ditambahkan');
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
        $item = Unit::find($id);
        return view('pages.unit.edit', [
            'title' => 'Unit',
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
        $item = Unit::find($id);
        $data = $request->all();
        $item->update($data);

        return redirect()->route('unit.index')->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Unit::find($id);
        if($item->unitCategories){
            foreach($item->unitCategories as $sub_unit){
                $sub_unit->delete();
            }
        }
        $item->delete();

        return back()->with('success', 'Berhasil Dihapus');
    }
}
