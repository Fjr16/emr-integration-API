<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Queue;
use Illuminate\Http\Request;
use App\Models\RawatJalanPatient;
use App\Models\PatientActionReport;
use App\Models\RajalFarmasiPatient;
use Illuminate\Support\Facades\Auth;
use App\Models\RawatJalanPoliPatient;
use App\Models\LaboratoriumPatientResult;
use App\Models\DiagnosisKeperawatanPatient;
use App\Models\MedicineReceipt;
use App\Models\PermintaanLaboratoriumPatologiAnatomikPatient;
use App\Models\RadiologiFormRequest;
use App\Models\SuratBuktiPelayananPatient;
use App\Models\SuratPengantarRawatJalanPatient;

class RawatJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('filter')) {
            $filter = new DateTime(request('filter'));
        }
        $filterDate = $filter ?? now();
        $user = Auth::user();
        if ($user->hasRole('Dokter Poli')) {
            $data = Queue::where('status_antrian', 'SELESAI')->whereHas('rawatJalanPatient', function ($query) use ($filterDate) {
                $query->whereHas('rawatJalanPoliPatient', function ($query1) use ($filterDate) {
                    $query1->whereDate('created_at', $filterDate);
                });
            })->whereHas('doctorPatient', function ($query2) {
                $query2->where('user_id', Auth::user()->id);
            })->get();
        } else {
            $data = Queue::where('status_antrian', 'SELESAI')->whereHas('rawatJalanPatient', function ($query) use ($filterDate) {
                $query->whereHas('rawatJalanPoliPatient', function ($query1) use ($filterDate) {
                    $query1->whereDate('created_at', $filterDate);
                });
            })->get();
        }
        $data = $data->sortBy(function ($queue) {
            $status = $queue->rawatJalanPatient->rawatJalanPoliPatient->status ?? '';
            return $status == 'WAITING' ? 0 : ($status === 'DIPANGGIL' ? 1 : 2);
        })->values();
        return view('pages.rawatjalan.index', [
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
            "data" => $data,
            "filterDate" => $filterDate,
            "user" => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function panggil($id)
    {
        $item = Queue::find($id);
        return view('pages.rawatjalan.panggil', [
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
            'item' => $item,
        ]);
    }

    public function updatePanggil(Request $request, $id)
    {
        $rawatJalan = RawatJalanPatient::where('queue_id', $id)->first();
        $poli = RawatJalanPoliPatient::where('rawat_jalan_patient_id', $rawatJalan->id)->first();
        $poli->update([
            'created_at' => now(),
            'status' => 'DIPANGGIL',
        ]);
        return redirect()->back()->with('success', 'Status Berhasil Diperbarui');
    }
    public function updateTidakHadir(Request $request, $id)
    {
        $rawatJalan = RawatJalanPatient::where('queue_id', $id)->first();
        $poli = RawatJalanPoliPatient::where('rawat_jalan_patient_id', $rawatJalan->id)->first();
        $poli->update([
            'created_at' => now(),
            'status' => 'TIDAK HADIR',
        ]);
        return redirect()->back()->with('success', 'Status Berhasil Diperbarui');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $title)
    {
        if (!session('btn')) {
            session(['btn' => 'dashboard']);
        } else {
            session(['btn' => session('btn')]);
        }

        if (!session('dokter')) {
            session(['dokter' => 'assesmen']);
        } else {
            session(['dokter' => session('dokter')]);
        }

        $today = new DateTime();
        $item = Queue::findOrFail($id);
        $asesmentPatientLatest = DiagnosisKeperawatanPatient::where('patient_id', $item->patient->id)->latest()->first();
        $reportActions = PatientActionReport::where('patient_id', $item->patient->id)->latest()->get();
        $receipts = MedicineReceipt::where('patient_id', $item->patient->id)->latest()->get();
        $diagnosisPatient = DiagnosisKeperawatanPatient::where('queue_id', $item->id)->first();
        // $asesmentPatient = DiagnosisKeperawatanPatient::where('patient_id', $item->patient->id)->get();
        $asesmentPatient = DiagnosisKeperawatanPatient::where('patient_id', $item->patient->id)
    ->orderBy('created_at', 'desc')
    ->get();

        $suratPengantars = SuratPengantarRawatJalanPatient::where('patient_id', $item->patient->id)->latest()->get();
        $sbpks = SuratBuktiPelayananPatient::where('patient_id', $item->patient->id)->latest()->get();
        //hasil pemeriksaan radiologi
        $radiologiResults = RadiologiFormRequest::where('patient_id', $item->patient->id)->where('status', 'FINISHED')->orWhere('status', 'ONGOING')->latest()->get();
        // hasil pemeriksaan labor pa
        $laborPaResults = PermintaanLaboratoriumPatologiAnatomikPatient::where('patient_id', $item->patient->id)->whereHas('antrianLaboratoriumPatologiAnatomiPatient', function($query){
            $query->whereHas('detailAntrianLaboratoriumPatologiAnatomiPatient', function ($detail){
                $detail->where('status', 'Validated')->orWhere('status', 'Unvalidate');
            });
        })
        ->with(['antrianLaboratoriumPatologiAnatomiPatient.detailAntrianLaboratoriumPatologiAnatomiPatient'])
        ->get();
        return view('pages.rawatjalan.show', [
            "title" => $title,
            "menu" => "In Patient",
            "item" => $item,
            'today' => $today,
            'asesmentPatient' => $asesmentPatient,
            'asesmentPatientLatest' => $asesmentPatientLatest,
            'reportActions' => $reportActions,
            'receipts' => $receipts,
            'suratPengantars' => $suratPengantars,
            'sbpks' => $sbpks,
            'radiologiResults' => $radiologiResults,
            'laborPaResults' => $laborPaResults,
            'diagnosisPatient' => $diagnosisPatient,
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
        $item = RawatJalanPoliPatient::find($id);
        $status = $request->input('status');

        // $checkAssesmenAwal = $item->rawatJalanPatient->queue->patient->initialAssesments;
        // $checkCppt = $item->rmeCppts;
        // $checkPrmrj = $item->prmrjs;
        // if (($checkAssesmenAwal->isEmpty() && $checkCppt->isEmpty()) || $checkPrmrj->isEmpty()) {
        //     $status = 'Belum Lengkap';
        // }

        $item->update([
            'status' => $status,
        ]);

        if ($item->status == 'SELESAI') {
            $rajal = RawatJalanPatient::find($item->rawatJalanPatient->id);
            $queue = Queue::find($rajal->queue_id);
            if ($rajal) {
                if ($rajal->rajalFarmasiPatient) {
                    $itemFarmasi = RajalFarmasiPatient::find($rajal->rajalFarmasiPatient->id);
                    $itemFarmasi->update([
                        'status' => 'WAITING',
                    ]);
                } else {
                    RajalFarmasiPatient::create([
                        'rawat_jalan_patient_id' => $rajal->id,
                        'status' => 'WAITING',
                    ]);
                }
            }
            //create radiologi
            // foreach ($queue->radiologiFormRequests as $reqRadiologi) {
            //     $checkList = RadiologiPatient::where('queue_id', $queue->id)->where('radiologi_form_request_id', $reqRadiologi->id)->first();
            //     if ($checkList) {
            //         continue;
            //     }
            //     $itemRadiologi = RadiologiPatient::create([
            //         'queue_id' => $queue->id,
            //         'patient_id' => $queue->patient_id,
            //         'radiologi_form_request_id' => $reqRadiologi->id,
            //         'status' => 'WAITING',
            //     ]);
            //     $details = $itemRadiologi->radiologiFormRequest->radiologiFormRequestDetails;
            //     foreach ($details as $detail) {
            //         RadiologiPatientRequestDetail::create([
            //             'radiologi_patient_id' => $itemRadiologi->id,
            //             'action_id' => $detail->action_id,
            //             'status' => 'WAITING',
            //         ]);
            //     }
            // }
            //create labor
            if ($queue) {
                foreach ($queue->laboratoriumRequests as $laborReq) {
                    $checkList = LaboratoriumPatientResult::where('queue_id', $queue->id)->where('laboratorium_request_id', $laborReq->id)->first();
                    if ($checkList) {
                        continue;
                    }
                    LaboratoriumPatientResult::create([
                        'queue_id' => $queue->id,
                        'patient_id' => $queue->patient_id,
                        'laboratorium_request_id' => $laborReq->id,
                        'status' => 'WAITING',
                    ]);
                }
            }
        }
        return redirect()->route('rajal/index')->with('success', 'Status Berhasil Diperbarui');
        // }
    }
}
