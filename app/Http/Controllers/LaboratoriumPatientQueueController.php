<?php

namespace App\Http\Controllers;

use App\Models\KasirPatient;
use Illuminate\Http\Request;
use App\Models\DetailKasirPatient;
use App\Models\LaboratoriumRequest;
use Illuminate\Support\Facades\Auth;

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
        if ($status != 'ACCEPTED') {
            $item->update([
                'status' => $status,
            ]);
        }else{
            $tanggal = $request->input('tanggal');
    
            $lastReg = LaboratoriumRequest::whereDate('jadwal_periksa', $tanggal)->orderBy('no_reg', 'desc')->pluck('no_reg')->first();

            if ($lastReg) {
                $arrSplit = explode('/', $lastReg);
                $lastReg = $arrSplit[4];
            }
            $nextReg = $this->createRegPK($lastReg ?? 0);
            $item->update([
                'no_reg' => $nextReg,
                'jadwal_periksa' => $tanggal,
                'status' => 'ACCEPTED',
            ]);
        }

        //create Tagihan
        // $patientCategoryId = $item->queue->patientCategory->id ?? '';
        // if($patientCategoryId){
        //     $kasirPatient = KasirPatient::where('rawat_jalan_patient_id', $item->queue->rawatJalanPatient->id)->first();
        //     if($kasirPatient){
        //         $total = $kasirPatient->total;
        //         foreach ($item->laboratoriumRequest->laboratoriumRequestDetails as $detail) {
        //             $tarif = LaboratoriumRequestMasterRate::where('laboratorium_request_master_variable_id', $detail->laboratoriumRequestMasterVariable->id)->where('patient_category_id', $patientCategoryId)->first();
        //             DetailKasirPatient::create([
        //                 'kasir_patient_id' => $kasirPatient->id,
        //                 'name' => $detail->laboratoriumRequestMasterVariable->name,
        //                 'tanggal' => date('Y-m-d H:i:s'),
        //                 'category' => 'Pemeriksaan Laboratorium PK',
        //                 'jumlah' => 1,
        //                 'tarif' => $tarif->tarif_umum ?? 0,
        //             ]);
        //             $total += $tarif->tarif_umum ?? 0;
        //         }
        //         $kasirPatient->update([
        //             'total' => $total,
        //         ]);
        //     }else{
        //         $total = 0;
        //         $itemKasirPatient =  KasirPatient::create([
        //             'rawat_jalan_patient_id' => $item->queue->rawatJalanPatient->id,
        //             'total' => $total,
        //             'status' => 'PENDING',
        //         ]);
        //         foreach ($item->laboratoriumRequest->laboratoriumRequestDetails as $detail) {
        //             $tarif = LaboratoriumRequestMasterRate::where('laboratorium_request_master_variable_id', $detail->laboratoriumRequestMasterVariable->id)->where('patient_category_id', $patientCategoryId)->first();
        //             DetailKasirPatient::create([
        //                 'kasir_patient_id' => $itemKasirPatient->id,
        //                 'name' => $detail->laboratoriumRequestMasterVariable->name,
        //                 'tanggal' => date('Y-m-d H:i:s'),
        //                 'category' => 'Pemeriksaan Laboratorium PK',
        //                 'jumlah' => 1,
        //                 'tarif' => $tarif->tarif_umum ?? 0,
        //             ]);
        //             $total += $tarif->tarif_umum ?? 0; 
        //         }
        //         $itemKasirPatient->update([
        //             'total' => $total,
        //         ]);
        //     }
        // }

        return back()->with('success', 'Berhasil Memperbarui Antrian');
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
        $item = LaboratoriumPatientResult::find($id);
        $item->update([
            'status' => 'VALIDATED',
        ]);
        $item->laboratoriumUserValidator()->update([
            'user_id' => Auth::user()->id,
        ]);
        
        return back()->with('success', 'Berhasil Validasi');
    }
}
