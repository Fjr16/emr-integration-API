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
            "title" => "Rekam Medis Elektronik",
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
        $igd = IgdPatient::with('queue.patient')
            ->whereHas('queue', function ($query) use ($id) {
                $query->where('patient_id', $id);
            })
            ->latest()
            ->get();

        $rajal = RawatJalanPatient::with('queue')
            ->where('patient_id', $id)
            ->whereHas('queue', function ($query) {
                $query->where('category', 'RAWAT JALAN');
            })->latest()->get();
        // $rajal = RawatJalanPatient::whereHas('rawatJalanPoliPatient')->latest()->get();
        // $data = Queue::where('status_antrian', 'SELESAI')->whereHas('rawatJalanPatient', function($query) use ($today){
        //     $query->whereHas('rawatJalanPoliPatient');
        // })->get();

        $ranapId = RawatInapPatient::where('patient_id', $id)->get();
        $ranap = RawatInapPatient::with('queue')
            ->where('patient_id', $id)
            ->whereHas('queue', function ($query) use ($ranapId) {
                $query->where('id', $ranapId->pluck('queue_id')->first());
            })
            ->latest()
            ->get();

        $kemoId = KemoterapiPatient::where('patient_id', $id)->get();
        $kemo = KemoterapiPatient::with('queue')
            ->where('patient_id', $id)
            ->whereHas('queue', function ($query) use ($kemoId) {
                $query->where('id', $kemoId->pluck('queue_id')->first());
            })
            ->latest()
            ->get();

        // $all = $igd->merge($kemo);
        // return $all;

        /** menampilkan data SEP dan Surat Kontrol berurut sesuai tanggal yang ada */
        $dataSep = Seps::where('noka', $item->noka)->orderBy('id', 'desc')->get();

        // $rajal = RawatJalanPatient::where('patient_id', $id)->get();

        // dd($rajal);
        // die;
        // foreach ($item->queues as $queue) {
        //     // $dataRajal = RawatJalanPatient::where('queue_id', $queue->id)->first();
        //     $rajal = Queue::where('id', $queue->id)->get();
        // }
        // dd($rajal);
        // die;
        // $itemKemo = KemoterapiPatient::with('queues')->find($id);
        return view('pages.rmePasien.show', [
            "title" => "Rekam Medis Elektronik",
            "menu" => "RME",
            "item" => $item,
            "igd" => $igd,
            "rajal" => $rajal,
            "ranap" => $ranap,
            "kemo" => $kemo,
            "dataSep" => $dataSep,
            // "all" => $all,
            // "itemKemo" => $itemKemo,
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