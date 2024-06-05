<?php

namespace App\Http\Controllers;

use App\Models\ActionMembers;
use App\Models\KemoterapiPatient;
use App\Models\KemoterapiTindakanPelayananPatient;
use App\Models\KemoterapiTindakanPelayananPatientDetail;
use App\Models\User;
use Illuminate\Http\Request;

class KemoterapiTindakanPelayananPatientController extends Controller
{
    public function index($id)
    {
        $item = KemoterapiPatient::find($id);
        $dokters = User::whereNot('room_detail_id', null)->get();
        return view('pages.kemoterapiTindakanPelayananPasien.index', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'dokters' => $dokters,
        ]);
    }

    public function storeIndex(Request $request, $id)
    {
        $item = KemoterapiPatient::find($id);
        $data = $request->all();
        $data['kemoterapi_patient_id'] = $item->id;
        $data['patient_id'] = $item->queue->patient->id;

        KemoterapiTindakanPelayananPatient::create($data);

        return redirect()
            ->route('kemoterapi/patient.show', $item->id)
            ->with([
                'success' => 'Berhasil Ditambahkan',
                'btn' => 'tindakan pelayanan pasien',
            ]);
    }

    public function create($id)
    {
        $item = KemoterapiTindakanPelayananPatient::find($id);
        $tindakans = ActionMembers::all();
        $dokters = User::whereNot('room_detail_id', null)->get();
        return view('pages.kemoterapiTindakanPelayananPasien.create', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'tindakans' => $tindakans,
            'dokters' => $dokters,
        ]);
    }

    public function store(Request $request, $id)
    {
        $item = KemoterapiTindakanPelayananPatient::find($id);
        $data = $request->all();
        $data['kemoterapi_tindakan_pelayanan_patient_id'] = $item->id;

        KemoterapiTindakanPelayananPatientDetail::create($data);
        return redirect()
            ->route('kemoterapi/patient.show', $item->kemoterapi_patient_id)
            ->with([
                'success' => 'Berhasil Ditambahkan',
                'btn' => 'tindakan pelayanan pasien',
            ]);
    }

    public function show($id)
    {
        $item = KemoterapiTindakanPelayananPatient::find($id);
        $details = KemoterapiTindakanPelayananPatientDetail::where('kemoterapi_tindakan_pelayanan_patient_id', $item->id)->get();
        return view('pages.kemoterapiTindakanPelayananPasien.show', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'details' => $details,
        ]);
    }

    public function edit($id)
    {
        $item = KemoterapiTindakanPelayananPatient::find($id);
        $details = KemoterapiTindakanPelayananPatientDetail::where('kemoterapi_tindakan_pelayanan_patient_id', $id)->get();

        return view('pages.kemoterapiTindakanPelayananPasien.edit', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'details' => $details,
        ]);
    }

    public function destroy($id)
    {
        $item = KemoterapiTindakanPelayananPatient::find($id);
        KemoterapiTindakanPelayananPatientDetail::where('kemoterapi_tindakan_pelayanan_patient_id', $item->id)->delete();
        $item->delete();

        return back()->with([
            'success' => 'Data Berhasil Dihapus',
            'btn' => 'tindakan pelayanan pasien',
        ]);
    }

    public function editDetail($id)
    {
        $item = KemoterapiTindakanPelayananPatientDetail::find($id);
        $tindakans = ActionMembers::all();
        $dokters = User::whereNot('room_detail_id', null)->get();
        return view('pages.kemoterapiTindakanPelayananPasien.editDetail', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'tindakans' => $tindakans,
            'dokters' => $dokters,
        ]);
    }

    public function updateDetail(Request $request, $id)
    {
        $item = KemoterapiTindakanPelayananPatientDetail::find($id);
        $data = $request->all();

        $item->update($data);
        return redirect()
            ->route('kemoterapi/tindakan/pelayanan/pasien.edit', $item->kemoterapiTindakanPelayananPatient->kemoterapi_patient_id)
            ->with([
                'success' => 'Berhasil Ditambahkan',
                'btn' => 'tindakan pelayanan pasien',
            ]);
    }

    public function destroyDetail($id)
    {
        KemoterapiTindakanPelayananPatientDetail::find($id)->delete();
        return back()->with([
            'success' => 'Data Berhasil Dihapus',
        ]);
    }
}
