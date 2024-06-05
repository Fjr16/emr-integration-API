<?php

namespace App\Http\Controllers;

use App\Models\ActionMemberRates;
use App\Models\ActionMembers;
use App\Models\ConsultingRates;
use App\Models\PatientCategory;
use App\Models\RanapRekapTindakanPelayananPatient;
use Illuminate\Http\Request;
use App\Models\RawatInapPatient;
use App\Models\RekapTindakanPelayananPatientDetail;
use App\Models\User;

class RanapRekapTindakanPelayananPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $item = RawatInapPatient::find($id);
        $dokters = User::whereNot('room_detail_id', null)->get();
        return view('pages.ranapTindakanPelayananPasien.index', [
            "title" => "Tindakan Pelayanan Pasien",
            "menu" => "Rawat Inap",
            "item" => $item,
            "dokters" => $dokters
        ]);
    }

    public function storeIndex(Request $request, $id)
    {
        $item = RawatInapPatient::find($id);
        $data = $request->all();
        $data['rawat_inap_patient_id'] = $item->id;
        $data['patient_id'] = $item->queue->patient->id;
        
        RanapRekapTindakanPelayananPatient::create($data);

        return redirect()->route('rawat/inap.show', $item->id)->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'tindakanpelayananpasien',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = RanapRekapTindakanPelayananPatient::find($id);
        $tindakans = ActionMembers::all();
        $dokters = User::whereNot('room_detail_id', null)->get();
        return view('pages.ranapTindakanPelayananPasien.create', [
            "title" => "Tindakan Pelayanan Pasien",
            "menu" => "Rawat Inap",
            "item" => $item,
            "tindakans" => $tindakans,
            "dokters" => $dokters
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
        $item = RanapRekapTindakanPelayananPatient::find($id);
        $data = $request->all();
        $data['ranap_rekap_tindakan_pelayanan_patient_id'] = $item->id;

        RekapTindakanPelayananPatientDetail::create($data);
        return redirect()->route('rawat/inap.show', $item->id)->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'tindakanpelayananpasien',
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

    public function getBiayaTindakan(Request $request, $id)
    {
        $item = ActionMembers::find($id);
        $patient_category_id = $request->patient_category_id;
        $patientCategory = PatientCategory::find($patient_category_id);
        $biayaTindakan = ActionMemberRates::where('action_members_id', $item->id)->where('patient_category_id', $patientCategory->id)->first();

        return response()->json($biayaTindakan->tarif_umum);
    }
    public function getBiayaKonsul(Request $request, $id)
    {
        $item = User::find($id);
        $patient_category_id = $request->patient_category_id;
        $biayaKonsul = ConsultingRates::where('user_id', $item->id)->where('patient_category_id', $patient_category_id)->first();
        return response()->json($biayaKonsul->pembayaran);
    }
}
