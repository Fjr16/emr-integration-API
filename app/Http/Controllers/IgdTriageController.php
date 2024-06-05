<?php

namespace App\Http\Controllers;

use App\Models\IgdPatient;
use App\Models\IgdTriage;
use App\Models\IgdTriageCategoryCheckup;
use App\Models\IgdTriageDetail;
use App\Models\IgdTriageDoa;
use App\Models\IgdTriageScale;
use App\Models\Queue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IgdTriageController extends Controller
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
    public function create($id)
    {
        session(['igd_patient_id' => $id]);
        $item = IgdPatient::find($id);
        $igd_patient = IgdPatient::findOrFail($id);
        $today = date('Y-m-d H:i');
        $time = date('H:i');
        $cara_masuk = ['Jalan Kaki', 'Brankar', 'Kursi Roda', 'Kendaraan / Ambulance'];
        $asal_masuk = ['Datang Sendiri', 'Poliklinik', 'Diantar Polisi', 'Rujukan'];
        $jenis_kasus = ['Trauma', 'Non Trauma'];
        $dataSkala = IgdTriageScale::orderBy('name')->get();
        return view('pages.triase.create', [
            'title' => 'Triase',
            'menu' => 'In Patient',
            'dataSkala' => $dataSkala,
            'cara_masuk' => $cara_masuk,
            'asal_masuk' => $asal_masuk,
            'jenis_kasus' => $jenis_kasus,
            'today' => $today,
            'time' => $time,
            'igd_patient' => $igd_patient,
            'item' => $item,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $item = IgdPatient::find($id);
        $data = $request->all();
        $data['patient_id'] = $request->patient_id;
        $data['user_id'] = Auth::user()->id;
        $data['igd_patient_id'] = $id;
        
        if(!$request->cara_masuk){
            $data['cara_masuk'] = $request->cara_masuk_input;
        }
        if(!$request->asal_masuk){
            $data['asal_masuk'] = $request->asal_masuk_input;
        }
        $item = IgdTriage::create($data);
        if($request->igd_triage_checkup_id){
            foreach ($request->igd_triage_checkup_id as $detail) {
                IgdTriageDetail::create([
                    'igd_triage_id' => $item->id,
                    'igd_triage_checkup_id' => $detail,
                ]);
            }
        }else{
            $data_doa = [
                'igd_triage_id' => $item->id,
                'kehidupan' => $request->input('kehidupan'),
                'nadi' => $request->input('nadi'),
                'reflek' => $request->input('reflek'),
                'ekg' => $request->input('ekg'),
                'jam_doa' => $request->input('jam_doa'),
            ];
            IgdTriageDoa::create($data_doa);
        }
        // dd($data);
        return redirect()->route('igd/patient/rme.show', session('igd_patient_id'))->with([
            'success' => 'Berhasil Ditambahkan',
            'active' => 'triase',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = IgdTriage::findOrFail($id);
        $cara_masuk = ['Jalan Kaki', 'Brankar', 'Kursi Roda', 'Kendaraan / Ambulance'];
        $asal_masuk = ['Datang Sendiri', 'Poliklinik', 'Diantar Polisi', 'Rujukan'];
        $jenis_kasus = ['Trauma', 'Non Trauma'];
        $categories = IgdTriageCategoryCheckup::all();
        $skalas = IgdTriageScale::orderBy('name', 'asc')->get();
        return view('pages.triase.show', [
            "title" => "Triase",
            "menu" => "In Patient",
            "item" => $item,
            "cara_masuk" => $cara_masuk,
            "asal_masuk" => $asal_masuk,
            "jenis_kasus" => $jenis_kasus,
            "categories" => $categories,
            "skalas" => $skalas,
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
        return 'edit';
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
        $item = IgdTriage::findOrFail($id);

        $item->igdTriageCheckups()->detach();

        if($item->igdTriageDoa){
            $item->igdTriageDoa->delete();
        }

        $item->delete();
        return back()->with([
            'success' => 'Berhasil Dihapus',
            'active' => 'triase',
        ]);
    }

    public function print($id, $dokter_id)
    {
        $item = IgdTriage::findOrFail($id);
        $cara_masuk = ['Jalan Kaki', 'Brankar', 'Kursi Roda', 'Kendaraan / Ambulance'];
        $asal_masuk = ['Datang Sendiri', 'Poliklinik', 'Diantar Polisi', 'Rujukan'];
        $jenis_kasus = ['Trauma', 'Non Trauma'];
        $categories = IgdTriageCategoryCheckup::all();
        $skalas = IgdTriageScale::orderBy('name', 'asc')->get();
        $dokter = User::findOrFail($dokter_id);
        return view('pages.surat.triase', [
            "title" => "Triase",
            "menu" => "In Patient",
            "item" => $item,
            "cara_masuk" => $cara_masuk,
            "asal_masuk" => $asal_masuk,
            "jenis_kasus" => $jenis_kasus,
            "categories" => $categories,
            "skalas" => $skalas,
            "dokter" => $dokter,
        ]);
    }

    public function allPrint($id)
    {
        $item = IgdPatient::findOrFail($id);
        $cara_masuk = ['Jalan Kaki', 'Brankar', 'Kursi Roda', 'Kendaraan / Ambulance'];
        $asal_masuk = ['Datang Sendiri', 'Poliklinik', 'Diantar Polisi', 'Rujukan'];
        $jenis_kasus = ['Trauma', 'Non Trauma'];
        $categories = IgdTriageCategoryCheckup::all();
        $skalas = IgdTriageScale::orderBy('name', 'asc')->get();
        return view('pages.surat.triase', [
            "title" => "Triase",
            "menu" => "In Patient",
            "item" => $item,
            "cara_masuk" => $cara_masuk,
            "asal_masuk" => $asal_masuk,
            "jenis_kasus" => $jenis_kasus,
            "categories" => $categories,
            "skalas" => $skalas,
        ]);
    }
}
