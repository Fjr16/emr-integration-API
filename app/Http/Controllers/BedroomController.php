<?php

namespace App\Http\Controllers;

use App\Models\Bedroom;
use App\Models\Floor;
use Illuminate\Http\Request;

class BedroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Bedroom::all();
        return view('pages.kamar.index', [
            "title" => "Kamar",
            "menu" => "Setting",
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Floor::all();
        return view('pages.kamar.create', [
            "title" => "Kamar",
            "menu" => "Setting",
            "data" => $data,
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
        Bedroom::create($data);
        
        return redirect()->route('kamar.index')->with('success', 'Kamar Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $floors = Floor::all();
        $item = Bedroom::findOrFail($id);
        return view('pages.kamar.edit', [
            "title" => "Kamar",
            "menu" => "Setting",
            "item" => $item,
            "floors" => $floors
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
        $item = Bedroom::findOrFail($id);
        $item->update($data);
        return redirect()->route('kamar.index')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Bedroom::findOrFail($id);
        
        $item->delete($id);
        return back()->with('success', 'Kamar Berhasil Dihapus');
    }
}
