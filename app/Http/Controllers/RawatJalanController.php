<?php

namespace App\Http\Controllers;

use id;
use DateTime;
use Exception;
use App\Models\Queue;
use App\Models\Action;
use App\Models\Medicine;
use App\Models\Procedure;
use App\Models\Diagnostic;
use App\Models\KasirPatient;
use App\Models\MedicineStok;
use Illuminate\Http\Request;
use App\Models\MedicineReceipt;
use Illuminate\Support\Facades\DB;
use App\Models\BillingDoctorAction;
use App\Models\PatientActionReport;
use App\Models\RajalFarmasiPatient;
use App\Models\RadiologiFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\RawatJalanPoliPatient;
use App\Models\PerawatInitialAsesment;
use App\Models\BillingDoctorConsultation;
use App\Models\LaboratoriumRequest;
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
            $data = Queue::whereIn('status_antrian', ['ARRIVED', 'FINISHED'])->whereHas('rawatJalanPoliPatient')->whereDate('created_at', $filterDate)
            ->whereHas('dpjp', function ($query2) use ($user) {
                $query2->where('dokter_id', $user->id);
            })->get();
        } else {
            $data = Queue::whereIn('status_antrian', ['ARRIVED', 'FINISHED'])->whereHas('rawatJalanPoliPatient')->whereDate('created_at', $filterDate)->get();
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
        $item = Queue::findOrFail(decrypt($id));
        $riwKunjungans = Queue::where('patient_id', $item->patient->id)->where('status_antrian', 'ARRIVED')->orWhere('status_antrian', 'FINISHED')->latest()->get();

        $itemAss = PerawatInitialAsesment::where('queue_id', $item->id)->first();
        $reportActions = PatientActionReport::where('queue_id', $item->id)->first();
        $radiologiResults = RadiologiFormRequest::where('queue_id', $item->id)->where('status', 'FINISHED')->orWhere('status', 'ONGOING')->orWhere('status', 'ACCEPTED')->latest()->get();
        $laboratoriumResults = LaboratoriumRequest::where('queue_id', $item->id)->where('status', 'FINISHED')->orWhere('status', 'UNVALIDATE')->orWhere('status', 'ACCEPTED')->latest()->get();

        // diagnostic dan procedure
        $diagnostics = Diagnostic::orderBy('icd_x_code')->get();
        $procedures = Procedure::get();
        // obat
        // $medicines = MedicineStok::where('stok' ,'>', 0)->get();
        $medicines = Medicine::whereHas('medicineStoks')->get();
        // resep 
        //tindakan
        $dataTindakan = Action::where('jenis_tindakan', 'Tindakan Pelayanan Medis')->get();

        return view('pages.rawatjalan.show', [
            "title" => decrypt($title),
            "menu" => "In Patient",
            "item" => $item,
            "itemAss" => $itemAss,
            "riwKunjungans" => $riwKunjungans,
            'today' => $today,
            'reportActions' => $reportActions,
            'radiologiResults' => $radiologiResults,
            'laboratoriumResults' => $laboratoriumResults,
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

     private function createKasirPatientFirst($antrian) {
        $kp = KasirPatient::create([
            'queue_id' => $antrian->id,
            'status' => 'WAITING',
        ]);
        BillingDoctorConsultation::create([
            'kasir_patient_id' => $kp->id,
            'user_id' => $antrian->dpjp->id,
            'kode_dokter' => $antrian->dpjp->staff_id ?? '',
            'nama_dokter' => $antrian->dpjp->name ?? '',
            'nama_poli' => $antrian->dpjp->poliklinik->name ?? '',
            'tarif' => $antrian->dpjp->tarif,
        ]);

        return $antrian->rawatJalanPoliPatient;
     }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $errors = [];
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

            // pastikan billing pasien telah dibuat
            if (!$item->queue->kasirPatient) {
                $item = $this->createKasirPatientFirst($item->queue);
            }

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
            // update status pelayanan
            $item->update($data);
            //end update status

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
            // melempar data billing tindakan ke kasir
            if ($item->actions_ready) {
                if ($item->queue->patientActionReport && !empty($item->queue->patientActionReport->patientActionReportDetails)) {
                    if (!empty($item->queue->kasirPatient->billingDoctorActions)) {
                        $item->queue->kasirPatient->billingDoctorActions()->delete();
                    }

                    foreach ($item->queue->patientActionReport->patientActionReportDetails as $key => $detailTindakan) {

                        if (!$item->queue->dpjp) {
                            $errors[] = 'Data Dokter Penanggung Jawab pasien Tidak Ditemukan, mohon periksa kembali';
                            continue;
                        }
                        if (!$detailTindakan->action || !$detailTindakan->action->action_code || !$detailTindakan->action->name) {
                            $errors[] = 'Tindakan Yang Dipilih Pada Detail Laporan Tindakan ID {X} Tidak Valid Mohon periksa Kembali Master Data Tindakan';
                            continue;
                        }
                        if (!$detailTindakan->harga_satuan || $detailTindakan->harga_satuan <= 0) {
                            $errors[] = 'Harga Satuan Tindakan '. $detailTindakan->action->name .' Tidak Valid, mohon periksa data tindakan pasien';
                            continue;
                        }
                        if (!$detailTindakan->sub_total || $detailTindakan->sub_total <= 0) {
                            $errors[] = 'Sub Total Tindakan harus Antara Rp 0 hingga 99.999.999,99, mohon periksa kembali data tindakan Pasien';
                            continue;
                        }
                        
                        BillingDoctorAction::create([
                            'kasir_patient_id' => $item->queue->kasirPatient->id,
                            'user_id' => $item->queue->dpjp->id,
                            'action_id' => $detailTindakan->action->id ?? null,
                            'patient_category_id' => $item->queue->patientCategory->id ?? null,
                            'kode_dokter' => $item->queue->dpjp->staff_id ?? null,
                            'nama_dokter' => $item->queue->dpjp->name ?? null,
                            'nama_poli' => $item->queue->dpjp->poliklinik->name ?? null,
                            'kode_tindakan' => $detailTindakan->action->action_code,
                            'nama_tindakan' => $detailTindakan->action->name,
                            'jumlah' => $detailTindakan->jumlah,
                            'tarif' => $detailTindakan->harga_satuan,
                            'sub_total' => $detailTindakan->sub_total,
                        ]);
                    }

                    if (!empty($errors)) {
                        return back()->with([
                            'exceptions' => $errors,
                            'btn' => 'finished',
                        ]);
                        DB::rollBack();
                    }

                }else{
                    return back()->with([
                        'error' => 'Data Tindakan Medis Tidak Ditemukan, Pastikan Tindakan Medis Yang Dilakukan pada pasien telah Diinputkan',
                        'btn' => 'finished',
                    ]);
                    DB::rollBack();
                }
            }
            //end kasir

            DB::commit();
            return redirect()->route('rajal/index')->with([
                'success' => 'Status Pelayanan Berhasil Disimpan',
            ]);
        } catch (ValidationException $th) {
            return back()->with([
                'error' => 'Terjadi Kesalahan pada data yang anda kirimkan. Error Message: ' . $th->getMessage(),
                'btn' => 'finished',
            ]);
        } catch (Exception $e) {
            return back()->with([
                'error' => 'Terjadi Kesalahan pada data yang anda kirimkan. Error Message' . $e->getMessage(),
                'btn' => 'finished',
            ]);
        }
    }
}
