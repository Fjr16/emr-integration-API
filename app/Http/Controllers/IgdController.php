<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Patient;
use App\Models\IgdPatient;
use Illuminate\Http\Request;
use App\Models\PatientCategory;
use App\Models\Queue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IgdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = new DateTime();
        // $data = IgdPatient::where('user_id', Auth::user()->id)->whereDate(DB::raw('DATE(created_at)'), $today)->get();
        $data = IgdPatient::where('user_id', Auth::user()->id)->latest()->get();
        return view('pages.igd.index', [
            'title' => 'IGD',
            'menu' => 'IGD',
            'today' => $today,
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
        $route = 'igd.patient.create';
        $now = date('Y-m-d');
        $activePatients = IgdPatient::all();
        $categories = PatientCategory::where('name', 'umum')->get();
        $doctors = User::whereNot('room_detail_id', null)->whereHas('roles', function($query){
            $query->where('name', 'LIKE','%'. 'Dokter' .'%');
        })->get();
        $patients = Patient::orderBy('no_rm', 'asc')->get();
        $jk = ['Pria', 'Wanita'];
        $status = ['Belum Kawin', 'Kawin', 'Janda', 'Duda'];
        return view('pages.igd.create', [
            'title' => 'IGD',
            'menu' => 'IGD',
            "doctors" => $doctors,
            "categories" => $categories,
            "patients" => $patients,
            "activePatients" => $activePatients,
            "jk" => $jk,
            "status" => $status,
            "now" => $now,
            "route" => $route,
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
        $today = now();
        $lastQueue = Queue::whereDate('created_at', $today)->where('category', 'IGD')->orderBy('no_antrian', 'desc')->first();
        $nextNumber = $lastQueue ? $lastQueue->no_antrian + 1 : 1;

        $cat_Umum = PatientCategory::firstWhere('name', 'umum');
        
        $data['no_antrian'] = $nextNumber;
        $data['patient_id'] = $request['patient_id'] ?? '';
        $data['patient_category_id'] = $cat_Umum->id;
        $data['tgl_antrian'] = $request['tgl'];
        $data['no_rujukan'] = $request['no_rujukan'];
        $data['last_diagnostic'] = $request['last_diagnostic'];
        $data['status_antrian'] = 'SELESAI';
        $data['category'] = 'IGD';
        $data['user_id'] = Auth::user()->id;
        $data['kuota'] = null;

        if($item = Queue::create($data)){
            IgdPatient::create([
                'queue_id' => $item->id,
                'user_id' => $request->doctor_id,
                'status' => 'WAITING',
            ]);
        }
        return back()->with('success', 'Antrian Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = IgdPatient::find($id);
        return view('pages.igd.show', [
            "item" => $item,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $item = Patient::findOrFail($id);
        $array = $request->all();
        $data = json_decode(json_encode($array), false);
        $dokter = User::find($request->doctor_id);
        return view('pages.igd.edit', [
            "item" => $item,
            "data" => $data,
            "dokter" => $dokter
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
