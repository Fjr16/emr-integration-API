<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomDetail;
use Illuminate\Http\Request;

class RoomDetailController extends Controller
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
        $data = Room::where('isActive', true)->get();
        return view('pages.ruangDetail.create', [
            "title" => "Ruang",
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
        RoomDetail::create($data);
        
        return redirect()->route('ruang.index')->with('success', 'Behasil Ditambahkan');
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
        $item = RoomDetail::find($id);
        $data = Room::where('isActive', true)->get();
        return view('pages.ruangDetail.edit', [
            "title" => "Ruang",
            "menu" => "Setting",
            'item' => $item,
            'data' => $data,
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
        $item = RoomDetail::find($id);

        $item->update($data);
        
        return redirect()->route('ruang.index')->with('success', 'Behasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = RoomDetail::find($id);
        $item->update(['isActive' => false]);
        
        return back()->with('success', 'Behasil Dihapus');
    }
}
