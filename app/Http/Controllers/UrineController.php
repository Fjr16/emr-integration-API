<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.urine.index', [
            'title' => 'Urine',
            'menu' => 'In Patient'
        ]);
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
    public function store(Request $request)
    {
        $majorSubjektif = $request->input('majorSubjektif', []);
        $majorObjektif = $request->input('majorObjektif', []);
        $minorSubjektif = $request->input('minorSubjektif', []);
        $minorObjektif = $request->input('minorObjektif', []);
        $dkbd = $request->input('dkbd', []);
        $dkdd = $request->input('dkdd', []);
        $luaran = $request->input('luaran', []);
        $observasi = $request->input('observasi', []);
        $terapeutik = $request->input('terapeutik', []);
        $edukasi = $request->input('edukasi', []);
        $implementasi = $request->input('implementasi', []);
        $evaluasi = $request->input('evaluasi', []);
        $jam = $request->input('jam');

        $data = [$majorSubjektif, $majorObjektif, $minorSubjektif, $minorObjektif, $dkbd, $dkdd, $luaran, $observasi, $terapeutik, $edukasi, $implementasi, $evaluasi, $jam];
        dd($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('pages.urine.show');
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
