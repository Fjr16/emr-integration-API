<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NyeriAkutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.nyeriAkut.index', [
            'title' => 'Nyeri Akut',
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
        $nadi = 'Frekuensi nadi : ' . $request->input('nadi') . ' x/l';
        $darah = 'Tekanan darah : ' . $request->input('darah') . ' mmHg';
        $dkddnadi = 'Frekuensi nadi : ' . $request->input('dkddnadi') . ' x/l ';
        $dkdddarah = 'Tekanan darah : ' . $request->input('dkdddarah') . ' mmHg';
        $dkddnyeri = 'Pasien mengatakan skala nyeri ' . $request->input('nyeri');
        $fisiologi = 'Agen pencendera fisiologi ' . $request->input('fisiologi');
        $kimiawi = 'Agen pencendera kimiawi ' . $request->input('kimiawi');
        $fisik = 'Agen pencendera fisik ' . $request->input('fisik');
        $nyeri = 'Skala nyeri meliputi ' . $request->input('nyeri');
        $obat = 'Memberikan obat ' . $request->input('nyeri') . ' sesuai instruksi dokter (SC / IV / IM / Supositoria)';

        $data = [
            $majorSubjektif,
            $majorObjektif,
            $minorSubjektif,
            $minorObjektif,
            $dkbd,
            $dkdd,
            $luaran,
            $observasi,
            $terapeutik,
            $edukasi,
            $implementasi,
            $evaluasi,
            $jam,
            $nadi,
            $darah,
            $dkddnadi,
            $dkdddarah,
            $dkddnyeri,
            $fisiologi,
            $kimiawi,
            $fisik,
            $nyeri,
            $obat,
        ];
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
        return view('pages.nyeriAkut.show');
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
