<?php

namespace App\Http\Controllers;

use App\Models\arg01\Seps;
use App\Models\IgdPatient;
use App\Models\KemoterapiPatient;
use App\Models\Patient;
use App\Models\Queue;
use App\Models\RawatInapPatient;
use App\Models\RawatJalanPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RekamMedisElektronikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::forget('idPatient');
        $data = Patient::all();
        return view('pages.rmePasien.index', [
            "title" => "RME",
            "menu" => "RME",
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
        $item = Patient::with('queues')->find($id);

        $rajal = RawatJalanPatient::with('queue')
            ->where('patient_id', $id)
            ->whereHas('queue', function ($query) {
                $query->where('category', 'RAWAT JALAN');
            })->latest()->get();

        return view('pages.rmePasien.show', [
            "title" => "Rekam Medis Elektronik",
            "menu" => "RME",
            "item" => $item,
            "rajal" => $rajal,
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