<?php

namespace App\Http\Controllers;

use App\Models\BillingLaboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LaboratoriumRequest;

class LaboratoriumPatientQueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date('Y-m-d');
        $filter = request('filter', $today);
        $data = LaboratoriumRequest::whereDate('jadwal_periksa', $filter)->get();
        return view('pages.pasienLaboratorium.index', [
            'title' => 'Antrian Laboratorium PK',
            'menu' => 'Laboratorium PK',
            'today' => $today,
            'data' => $data,
            'filter' => $filter,
        ]);
    }

    private function createRegPK($current_no)
    {
        //format RAD/24/06/27/01
        $initial = 'PK';
        $currentDate = date('Y/m/d');

        $no = 1;
        if ($current_no) {
            $no = $current_no + 1;
        }

        if (strlen($no) == 1) {
            $number = '0' . $no;
        }else{
            $number = $no;
        }

        $nextNumber = $initial . '/' . $currentDate . '/' . $number;
        return $nextNumber;
    }

    public function store(Request $request, $id)
    {
        $item = LaboratoriumRequest::find($id);
        $status = $request->input('status');
        $tanggal = $request->input('tanggal');

        $lastReg = LaboratoriumRequest::whereDate('jadwal_periksa', $tanggal)->orderBy('no_reg', 'desc')->pluck('no_reg')->first();
        if ($lastReg) {
            $arrSplit = explode('/', $lastReg);
            $lastReg = $arrSplit[4];
        }
        $nextReg = $this->createRegPK($lastReg ?? 0);

        if ($status == 'RESCHEDULE'){
            $item->update([
                'no_reg' => $nextReg,
                'jadwal_periksa' => $tanggal,
                'status' => 'ACCEPTED',
            ]);
        }else if ($status == 'ACCEPTED'){
            DB::beginTransaction();
            $errors = [];
            try {
                $item->update([
                    'no_reg' => $nextReg,
                    'jadwal_periksa' => $tanggal,
                    'status' => 'ACCEPTED',
                ]);

                foreach ($item->laboratoriumRequestDetails as $key => $detailTindakan) {
    
                    if (!$detailTindakan->action || !$detailTindakan->action->action_code || !$detailTindakan->action->name) {
                        $errors[] = 'Tindakan Yang Dipilih Pada Detail Permintaan Radiologi ID {X} Tidak Valid Mohon periksa Kembali Master Data Tindakan';
                        continue;
                    }
                    $actRate = $detailTindakan->action->actionRates->where('patient_category_id', $item->queue->patientCategory->id)->first();
                    if (!$actRate || $actRate->tarif <= 0) {
                        $errors[] = 'Harga Satuan Tindakan '. $detailTindakan->action->name .' Tidak Valid, mohon periksa data tindakan pasien';
                        continue;
                    }
                    
                    BillingLaboratory::create([
                        'kasir_patient_id' => $item->queue->kasirPatient->id,
                        'action_id' => $detailTindakan->action->id ?? null,
                        'patient_category_id' => $item->queue->patientCategory->id ?? null,
                        'kode_tindakan' => $detailTindakan->action->action_code,
                        'nama_tindakan' => $detailTindakan->action->name,
                        'jumlah' => 1,
                        'tarif' => $actRate->tarif,
                        'sub_total' => $actRate->tarif,
                    ]);
                }
                if (!empty($errors)) {
                    DB::rollBack();
                    return back()->with('exceptions', $errors);
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('error', $e->getMessage());
            } catch (ModelNotFoundException $mn){
                DB::rollBack();
                return back()->with('error', $mn->getMessage());
            }
        } else {
            $item->update([
                'status' => $status,
            ]);
        }

        return back()->with('success', 'Berhasil Memperbarui Permintaan');
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
        $item = LaboratoriumRequest::find($id);
        if ($item->status == 'UNVALIDATE' && $item->petugas_id != null) {
            $item->update([
                'status' => 'FINISHED',
                'validator_id' => auth()->user()->id,
            ]);
            return back()->with('success', 'Berhasil Validasi');
        }else{
            return back()->with('error', 'Gagal !! Petugas Belum Melakukan Pemeriksaan');
        }
        
    }
}
