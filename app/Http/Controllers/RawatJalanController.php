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
use Illuminate\Validation\ValidationException;

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
        if ($user->hasRole('Dokter')) {
            $data = Queue::where('status_antrian', 'ARRIVED')->whereHas('rawatJalanPoliPatient')->whereDate('created_at', $filterDate)
            ->whereHas('dpjp', function ($query2) use ($user) {
                $query2->where('dokter_id', $user->id);
            })->get();
        } else {
            $data = Queue::where('status_antrian', 'ARRIVED')->whereHas('rawatJalanPoliPatient')->whereDate('created_at', $filterDate)->get();
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
        if (!session('finished')) {
            session(['finished' => 'status-pelayanan']);
        } else {
            session(['finished' => session('finished')]);
        }

        $today = new DateTime();
        $item = Queue::findOrFail($id);
        $riwKunjungans = Queue::where('patient_id', $item->patient->id)->where('status_antrian', 'ARRIVED')->orWhere('status_antrian', 'FINISHED')->latest()->get();

        $itemAss = PerawatInitialAsesment::where('queue_id', $item->id)->first();
        $reportActions = PatientActionReport::where('queue_id', $item->id)->first();
        $radiologiResults = RadiologiFormRequest::where('patient_id', $item->patient->id)->where('status', 'FINISHED')->orWhere('status', 'ONGOING')->latest()->get();

        // diagnostic dan procedure
        $diagnostics = Diagnostic::orderBy('icd_x_code')->get();
        $procedures = Procedure::get();
        // obat
        // $medicines = MedicineStok::where('stok' ,'>', 0)->get();
        $medicines = Medicine::whereHas('medicineStoks')->with('medicineStoks')->get();
        // resep 
        //tindakan
        $dataTindakan = Action::where('jenis_tindakan', 'Tindakan Pelayanan Medis')->with(['actionRates'])->get();

        return view('pages.rawatjalan.show', [
            "title" => $title,
            "menu" => "In Patient",
            "item" => $item,
            "itemAss" => $itemAss,
            "riwKunjungans" => $riwKunjungans,
            'today' => $today,
            'reportActions' => $reportActions,
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
        try {
            $this->validate($request, [
                'status_pelayanan' => 'required',
            ]);
            $data = $request->all();
            $data['cara_keluar'] = $request->input('cara_keluar');
            $data['keadaan_keluar'] = $request->input('keadaan_keluar');
            $data['intruksi'] = $request->input('intruksi_pulang');
            $data['diet'] = $request->input('diet_pasien');
            $data['status'] = $request->status_pelayanan;
            $item = RawatJalanPoliPatient::find($id);
            //data untuk pengiriman ke farmasi, radiologi, laboratorium, dan tindakan
            if ($item->queue->dpjp->id == auth()->user()->id) {
                if($request->receipts_ready && $request->receipts_ready == 1){
                    $data['receipts_ready'] = true;
                }
                if($request->actions_ready && $request->actions_ready == 1){
                    $data['actions_ready'] = true;
                }
                if($request->radiologies_ready && $request->radiologies_ready == 1){
                    $data['radiologies_ready'] = true;
                }
                if($request->radiologies_ready && $request->radiologies_ready == 1){
                    $data['laboratories_ready'] = true;
                }
            }
            //end
            $item->update($data);
            if ($item->receipts_ready) {
                // melempar data ke farmasi pasien
                if ($item->queue->medicineReceipt) {
                    if (!$item->queue->rajalFarmasiPatient) {
                        RajalFarmasiPatient::create([
                            'queue_id' => $item->queue->id,
                            'status' => 'WAITING',
                        ]);
                    }elseif($item->queue->rajalFarmasiPatient->status == 'DENIED'){
                        $item->queue->rajalFarmasiPatient()->update([
                            'status' => 'WAITING',
                        ]);
                    }
                }
            }
            return back()->with([
                'success' => 'Status Pelayanan Berhasil Disimpan',
                'btn' => 'finished',
            ]);
        } catch (ValidationException $th) {
            return back()->with([
                'error' => 'Terjadi Kesalahan pada data yang anda kirimkan. Error Message: ' . $th->getMessage(),
                'btn' => 'finished',
            ]);
        }
    }
}
