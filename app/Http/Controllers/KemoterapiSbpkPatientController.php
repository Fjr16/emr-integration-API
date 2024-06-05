<?php

namespace App\Http\Controllers;

use App\Models\KemoterapiPatient;
use App\Models\KemoterapiSbpkPatient;
use App\Models\KemoterapiSbpkPatientDetail;
use App\Models\KemoterapiSbpkSekunderAction;
use App\Models\KemoterapiSbpkSekunderDiagnosis;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KemoterapiSbpkPatientController extends Controller
{
    public function create($id)
    {
        $item = KemoterapiPatient::find($id);
        return view('pages.KemoterapiSbpk.create', [
            'menu' => 'Kemoterapi',
            'title' => 'Pasien Kemo',
            'item' => $item,
        ]);
    }

    public function store(Request $request, $id)
    {
        $item = KemoterapiPatient::find($id);
        $data = $request->all();

        //sbpk patient
        $tanggal = $request->input('tanggal', '');
        $jenis_kelamin = $request->input('jenis_kelamin', '');
        $tanggal_masuk = $request->input('tanggal_masuk', '');
        $keterangan = $request->input('keterangan', '');
        $anamnesa = $request->input('anamnesa', '');
        $diagnosis_utama = $request->input('diagnosis_utama', '');
        $icdx = $request->input('icdx', '');
        $tindakan_utama = $request->input('tindakan_utama', '');
        $icdg = $request->input('icdg', '');
        $nama_dpjp = Auth::user()->name;
        $ttd_dpjp = Auth::user()->paraf;
        $mainTb = KemoterapiSbpkPatient::create([
            'queue_id' => $item->queue_id,
            'patient_id' => $item->queue->patient->id,
            'tanggal' => $tanggal,
            'tanggal_masuk' => $tanggal_masuk,
            'jenis_kelamin' => $jenis_kelamin,
            'keterangan' => $keterangan,
            'anamnesa' => $anamnesa,
            'diagnosis_utama' => $diagnosis_utama,
            'icdx' => $icdx,
            'tindakan_utama' => $tindakan_utama,
            'icdg' => $icdg,
            'nama_dpjp' => $nama_dpjp,
            'ttd_dpjp' => $ttd_dpjp,
        ]);

        //sbpk detail
        $detailDiagnosa = $request->input('diagnosa', []);
        $detailIcd = $request->input('icd', []);
        $detailNamaTindakan = $request->input('nama_tindakan', []);
        foreach ($detailDiagnosa as $key => $diagnosa) {
            KemoterapiSbpkPatientDetail::create([
                'kemoterapi_sbpk_patient_id' => $mainTb->id,
                'diagnosa' => $diagnosa,
                'icd' => $detailIcd[$key],
                'nama_tindakan' => $detailNamaTindakan[$key],
            ]);
        }

        // sbpk diagnosa sekunder
        $sekunderDiagnosaName = $request->input('diagnosa_name', []);
        $sekunderDiagnosaIcd = $request->input('diagnosa_icdx', []);
        // sekunderDiagnosaIcd Tidak masuk kedalam database
        foreach ($sekunderDiagnosaName as $key => $sekunderDiag) {
            KemoterapiSbpkSekunderDiagnosis::create([
                'kemoterapi_sbpk_patient_id' => $mainTb->id,
                'diagnosa_name' => $sekunderDiag,
                'diagnosa_icdx' => $sekunderDiagnosaIcd[$key],
            ]);
        }
        // sbpk diagnosa sekunder
        $sekunderTindakanName = $request->input('action_name', []);
        $sekunderTindakanIcd = $request->input('action_icdg', []);
        foreach ($sekunderTindakanName as $key => $tindName) {
            KemoterapiSbpkSekunderAction::create([
                'kemoterapi_sbpk_patient_id' => $mainTb->id,
                'action_name' => $tindName,
                'action_icdg' => $sekunderTindakanIcd[$key],
            ]);
        }

        return redirect()
            ->route('kemoterapi/patient.show', ['id' => $item->id, 'title' => 'Pasien Kemo'])
            ->with([
                'success' => 'Berhasil Ditambahkan',
                'btn' => 'sbpk',
            ]);
    }

    public function show($id)
    {
        $kemoterapiPatient = KemoterapiSbpkPatient::find($id);
        $kemoterapiPatientDetail = KemoterapiSbpkPatientDetail::where('kemoterapi_sbpk_patient_id', $id)->get();
        $kemoterapiSekunderAction = KemoterapiSbpkSekunderAction::where('kemoterapi_sbpk_patient_id', $id)->get();
        $kemoterapiSekunderDiagnosis = KemoterapiSbpkSekunderDiagnosis::where('kemoterapi_sbpk_patient_id', $id)->get();
        return view('pages.kemoterapiSbpk.show', [
            'title' => 'Surat Bukti Pelayanan Kesehatan',
            'menu' => 'Kemoterapi',
            'kemoterapiPatient' => $kemoterapiPatient,
            'kemoterapiPatientDetail' => $kemoterapiPatientDetail,
            'kemoterapiSekunderAction' => $kemoterapiSekunderAction,
            'kemoterapiSekunderDiagnosis' => $kemoterapiSekunderDiagnosis,
        ]);
    }

    public function edit($id)
    {
        $kemoterapiSbpkPatient = KemoterapiSbpkPatient::find($id);
        $item = Queue::find($kemoterapiSbpkPatient->queue_id);
        $kemoterapiPatientDetail = KemoterapiSbpkPatientDetail::where('kemoterapi_sbpk_patient_id', $id)->first();
        $kemoterapiSekunderAction = KemoterapiSbpkSekunderAction::where('kemoterapi_sbpk_patient_id', $id)->first();
        $kemoterapiSekunderDiagnosis = KemoterapiSbpkSekunderDiagnosis::where('kemoterapi_sbpk_patient_id', $id)->first();
        return view('pages.KemoterapiSbpk.edit', [
            'menu' => 'Kemoterapi',
            'title' => 'Pasien Kemo',
            'item' => $item,
            'kemoterapiSbpkPatient' => $kemoterapiSbpkPatient,
            'kemoterapiPatientDetail' => $kemoterapiPatientDetail,
            'kemoterapiSekunderAction' => $kemoterapiSekunderAction,
            'kemoterapiSekunderDiagnosis' => $kemoterapiSekunderDiagnosis,
        ]);
    }

    public function destroy($id)
    {
        KemoterapiSbpkPatient::destroy($id);
        KemoterapiSbpkPatientDetail::where('kemoterapi_sbpk_patient_id', $id)->delete();
        KemoterapiSbpkSekunderAction::where('kemoterapi_sbpk_patient_id', $id)->delete();
        KemoterapiSbpkSekunderDiagnosis::where('kemoterapi_sbpk_patient_id', $id)->delete();

        return back()->with([
            'success' => 'Data Berhasil Dihapus',
            'btn' => 'sbpk',
        ]);
    }
}
