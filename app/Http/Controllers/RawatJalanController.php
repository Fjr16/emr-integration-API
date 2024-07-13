<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Queue;
use App\Models\Action;
use App\Models\Medicine;
use App\Models\Procedure;
use App\Models\Diagnostic;
use App\Models\MedicineStok;
use Illuminate\Http\Request;
use App\Models\MedicineReceipt;
use App\Models\PatientActionReport;
use App\Models\RajalFarmasiPatient;
use App\Models\RadiologiFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\RawatJalanPoliPatient;
use App\Models\PerawatInitialAsesment;
use App\Models\SuratBuktiPelayananPatient;

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
        $routeToFilter = route('rajal/index');
        $user = Auth::user();
        if ($user->hasRole('Dokter Poli')) {
            $data = Queue::where('status_antrian', 'ARRIVED')->whereHas('rawatJalanPoliPatient', function ($query) use ($filterDate) {
                $query->whereDate('created_at', $filterDate);
            })->whereHas('dpjp', function ($query2) {
                $query2->where('dokter_id', Auth::user()->id);
            })->get();
        } else {
            $data = Queue::where('status_antrian', 'ARRIVED')->whereHas('rawatJalanPoliPatient', function ($query) use ($filterDate) {
                $query->whereDate('created_at', $filterDate);
            })->get();
        }
        $data = $data->sortBy(function ($queue) {
            $status = $queue->rawatJalanPoliPatient->status ?? '';
            return $status == 'WAITING' ? 0 : ($status === 'ONGOING' ? 1 : 2);
        })->values();
        return view('pages.rawatjalan.index', [
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
            "data" => $data,
            "filterDate" => $filterDate,
            "user" => $user,
            "routeToFilter" => $routeToFilter,
        ]);
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
            session(['btn' => 'riwayat']);
        } else {
            session(['btn' => session('btn')]);
        }
        if (!session('penunjang')) {
            session(['penunjang' => 'radiologi']);
        } else {
            session(['penunjang' => session('penunjang')]);
        }
        if (!session('asesmen')) {
            session(['asesmen' => 'dokter']);
        } else {
            session(['asesmen' => session('asesmen')]);
        }
        if (!session('diag-tind')) {
            session(['diag-tind' => 'diagnosa']);
        } else {
            session(['diag-tind' => session('diag-tind')]);
        }

        $today = new DateTime();
        $item = Queue::findOrFail($id);
        $riwKunjungans = Queue::where('patient_id', $item->patient->id)->where('status_antrian', 'ARRIVED')->orWhere('status_antrian', 'FINISHED')->latest()->get();

        $itemAss = PerawatInitialAsesment::where('queue_id', $item->id)->first();
        $reportActions = PatientActionReport::where('queue_id', $item->id)->first();
        $sbpks = SuratBuktiPelayananPatient::where('patient_id', $item->patient->id)->latest()->get();
        $radiologiResults = RadiologiFormRequest::where('patient_id', $item->patient->id)->where('status', 'FINISHED')->orWhere('status', 'ONGOING')->latest()->get();

        // diagnostic dan procedure
        $diagnostics = Diagnostic::orderBy('icd_x_code')->get();
        $procedures = Procedure::get();
        // obat
        $medicines = MedicineStok::where('stok' ,'>', 0)->get();
        // resep 
        //tindakan
        $dataTindakan = Action::where('jenis_tindakan', 'Tindakan Pelayanan Medis')->get();

        return view('pages.rawatjalan.show', [
            "title" => $title,
            "menu" => "In Patient",
            "item" => $item,
            "itemAss" => $itemAss,
            "riwKunjungans" => $riwKunjungans,
            'today' => $today,
            'reportActions' => $reportActions,
            'sbpks' => $sbpks,
            'radiologiResults' => $radiologiResults,
            'diagnostics' => $diagnostics,
            'procedures' => $procedures,
            'medicines' => $medicines,
            'dataTindakan' => $dataTindakan,
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

        $item->update([
            'status' => $status,
        ]);

        if ($item->status == 'FINISHED') {
            $queue = Queue::find($item->queue_id);
            if ($queue) {
                if ($queue->rajalFarmasiPatient) {
                    $itemFarmasi = RajalFarmasiPatient::find($queue->rajalFarmasiPatient->id);
                    $itemFarmasi->update([
                        'status' => 'WAITING',
                    ]);
                } else {
                    RajalFarmasiPatient::create([
                        'queue_id' => $queue->id,
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
            // if ($queue) {
            //     foreach ($queue->laboratoriumRequests as $laborReq) {
            //         LaboratoriumPatientResult::create([
            //             'queue_id' => $queue->id,
            //             'patient_id' => $queue->patient_id,
            //             'laboratorium_request_id' => $laborReq->id,
            //             'status' => 'WAITING',
            //         ]);
            //     }
            // }
        }
        return redirect()->route('rajal/index')->with('success', 'Status Berhasil Diperbarui');
    }
}
