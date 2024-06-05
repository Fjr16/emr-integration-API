<?php

namespace App\Http\Controllers;

use App\Models\AsuhanKeperawatanPatient;
use App\Models\DetailDiagnosisKeperawatanPatient;
use Illuminate\Http\Request;

class AsuhanKeperawatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $item = DetailDiagnosisKeperawatanPatient::find($id);
        $routeName = '';
        if ($item->diagnosa == 'Ansietas') {
            $routeName = 'ansietas.index';
        } else if ($item->diagnosa == '*) Nyeri Akut / Kronis') {
            $routeName = 'nyeri.index';
        } else if ($item->diagnosa == 'Gangguan Mobilitas Fisik') {
            $routeName = 'fisik.index';
        } else if ($item->diagnosa == '*) Gangguan Integritas Kulit/jaringan') {
            $routeName = 'kulit.index';
        } else {
            $routeName = 'urine.index';
        }
        $data = AsuhanKeperawatanPatient::where('detail_diagnosis_keperawatan_patient_id', $item->id)->get();
        return view('pages.asuhanKeperawatan.index', [
            'title' => 'Asuhan Keperawatan',
            'menu' => 'Rawat Jalan',
            'item' => $item,
            'routeName' => $routeName,
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
        //
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
        //
    }
}
