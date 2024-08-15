<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Diagnostic::limit(500)->latest()->get();
        return view('pages.diagnosa.index', [
            "title" => "Diagnosa",
            "menu" => "Diagnosa-Tindakan",
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
        return view('pages.diagnosa.create', [
            "title" => "Diagnosa",
            "menu" => "Diagnosa-Tindakan",
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
        Diagnostic::create($data);

        return redirect()->route('diagnosa.index')->with('success', 'Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Diagnostic::find($id);
        return view('pages.diagnosa.edit', [
            "title" => "Diagnosa",
            "menu" => "Diagnosa-Tindakan",
            "item" => $item,
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
        $item = Diagnostic::find($id);
        $data = $request->all();
        $item->update($data);

        return redirect()->route('diagnosa.index')->with('success', 'Berhasil Di Perbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Diagnostic::find($id);
        $item->delete();

        return back()->with('success', 'Berhasil Di Hapus');
    }
}
