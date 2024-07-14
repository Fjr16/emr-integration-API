<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Queue;
use App\Models\Patient;
use App\Models\RmeCppt;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\MedicineReceipt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\MedicineReceiptDetail;
use App\Models\RawatJalanPoliPatient;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RmeCpptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function checkCpptVerif($rawatJalanPoliPatientId)
    {
        $item = RawatJalanPoliPatient::find($rawatJalanPoliPatientId);
        $anyVerif = RmeCppt::where('rawat_jalan_poli_patient_id', $rawatJalanPoliPatientId)
                ->where('ttd_dpjp', null)
                ->whereNot('user_id', $item->rawatJalanPatient->queue->doctorPatient->user->id)
                ->exists();

        return $anyVerif;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $item = Queue::find($id);
        $subjectives = $request->input('subjective');
        $objectives = $request->input('objective');
        $asesmens = $request->input('asesmen');
        $planings = $request->input('planning');
        
        $data['subjective'] = $subjectives;
        $data['objective'] = $objectives;
        $data['asesment'] = $asesmens;
        $data['planning'] = $planings;
        if (auth()->user()->id == $item->dpjp->id) {
            $data['ttd'] = $item->dpjp->paraf;
        }

        if ($item->soapDokter) {
            $soap = $item->soapDokter;
            $soap->update($data);
        }else{
            $data['queue_id'] = $item->id;
            $data['patient_id'] = $item->patient->id;
            $data['user_id'] = Auth::user()->id;
            RmeCppt::create($data);
        }
       
      


        //create resep obat
        // $medicineIds = $request->input('medicine_id', []);
        // if (!empty($medicineIds)) {
        //     $resep['user_id'] = Auth::user()->id;
        //     $resep['patient_id'] = $patientId;
        //     $resep['rawat_jalan_poli_patient_id'] = $rawatJalanPoliPatientId;
        //     if($itemResep = MedicineReceipt::create($resep)){
        //         foreach($medicineIds as $index => $medicine_id){
        //             $resepDetail['medicine_receipt_id'] = $itemResep->id;
        //             $resepDetail['medicine_id'] = $medicine_id;
        //             $resepDetail['jumlah'] = $request['jumlah'][$index];
        //             $resepDetail['aturan_pakai'] = $request['aturan_pakai'][$index];
        //             $resepDetail['keterangan'] = $request['keterangan'][$index];
        //             $resepDetail['other'] = $request['other'][$index];
        //             MedicineReceiptDetail::create($resepDetail);
        //         }
        //     }
        // }

        // if(isset($item->doctorPatient)){
        //      // create prmrj jika yang input dpjp
        //     $diag_penting = null;
        //     if(count($newAss) != 0){
        //         $diag_penting = implode(',', $newAss);
        //     }

        //     $uraianK = [];
        //     if(count($newSub) != 0){
        //         $sub = implode(',', $newSub);
        //         $uraianK[] = $sub;
        //     }
        //     if(count($newObj) != 0){
        //         $obj = implode(',', $newObj);
        //         $uraianK[] = $obj;
        //     }
        //     $uraianKs = implode(',', $uraianK);
            
        //     $rencanaP = [];
        //     if(count($newPlan) != 0){
        //         $pla = implode(',', $newPlan);
        //         $rencanaP[] = $pla;
        //     }
        //     $rencanaP[] = $intruksi ?? '';
        //     $rencanaPs = implode(',', $rencanaP);

        //     if ($item->doctorPatient->user->id == Auth::user()->id) {
        //         $data = [
        //             'user_id' => $item->doctorPatient->user->id,
        //             'rawat_jalan_poli_patient_id' => $rawatJalanPoliPatientId,
        //             'patient_id' => $patientId,
        //             'diagnosa_penting' => $diag_penting ?? '',
        //             'uraian_klinis' => $uraianKs ?? '',
        //             'rencana_penting' => $rencanaPs ?? '',
        //             'tanggal' => date('Y-m-d H:i:s') ?? '',
        //             'paraf' => $item->doctorPatient->user->paraf ?? '',
        //         ];
        //         Prmrj::create($data);
        //     }
        // }
        
        return back()->with([
            'success' => 'Berhasil Diperbarui',
            'btn' => 'cppt',
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
        $queue = Queue::find($id);
        $item = Patient::find($queue->patient->id);
        return view('pages.cppt.show', [
            'title' => 'CPPT',
            'menu' => 'Rawat Jalan',
            'queue' => $queue,
            'item' => $item,
        ]);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $queue = Queue::find($id);
        $item = Patient::find($queue->patient->id);
        return view('pages.cppt.print', [
            'title' => 'CPPT',
            'menu' => 'Rawat Jalan',
            'item' => $item,
            'queue' => $queue,
        ]);
    }

    public function updateTtd(Request $request)
    {
        try {
            $itemCppt = RmeCppt::findOrFail($request->cppt_id);
            $item = User::findOrFail($request->user_id);
            if (Hash::check($request->password, $item->password)) {
                $data[$request->ket_ttd] = $item->paraf;
                if ($request->ket_ttd == 'ttd_dpjp') {
                    $data['tanggal_dpjp'] = date('Y-m-d H:i:s');
                    $data['id_dpjp'] = $item->id;
                    $data['tanggal'] = date('Y-m-d H:i:s');
                }
                $itemCppt->update($data);
                $anyVerif = $this->checkCpptVerif($itemCppt->rawat_jalan_poli_patient_id);
                if (!$anyVerif) {
                    return response()->json(['redirect' => '/rajal/cppt/create/' . $itemCppt->rawatJalanPoliPatient->rawatJalanPatient->queue->id]);
                }
            } else {
                throw new Exception("Terjadi Kesalahan, Mohon Periksa Kembali Password Yang Anda Masukkan", 500);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Terjadi Kesalahan, User Tidak Ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
}
