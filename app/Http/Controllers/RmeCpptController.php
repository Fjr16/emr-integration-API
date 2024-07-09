<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prmrj;
use App\Models\Queue;
use App\Models\Patient;
use App\Models\RmeCppt;
use App\Models\Medicine;
use App\Models\ChangeLog;
use Illuminate\Http\Request;
use App\Models\MedicineReceipt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\MedicineReceiptDetail;
use App\Models\RajalCpptSbarPatient;
use App\Models\RajalCpptSerahTerimaPatient;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = Queue::find($id);
        $today = now()->format('Y-m-d H:i');
        return view('pages.cppt.create', [
            'title' => 'Rawat Jalan',
            'menu' => 'In Patient',
            'item' => $item,
            'today' => $today,
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
        $item = Queue::find($id);
        $subjectives = $request->input('subjective');
        $objectives = $request->input('objective');
        $asesmens = $request->input('asesmen');
        $planings = $request->input('planning');
        
        $data['ttd_dpjp'] = $request->input('ttd_dpjp');
        $data['ttd_user'] = $request->input('ttd_user');
        $data['user_id'] = Auth::user()->id;
        // $data['dpjp_id'] = $item->doctorPatient->user->name;
        $data['queue_id'] = $item->id;
        $data['patient_id'] = $item->patient->id;
        $data['subjective'] = $subjectives;
        $data['objective'] = $objectives;
        $data['asesment'] = $asesmens;
        $data['planning'] = $planings;
        $data['category_soap'] = 'DPJP';
        RmeCppt::create($data);


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
        
        return redirect()->route('rajal/show', ['title' => 'Rawat Jalan', 'id' => $id])->with([
            'success' => 'Berhasil Ditambahkan',
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = RmeCppt::findOrFail($id);

        //memecah string soap menjadi array
        $soap = $item->soap;
        if($soap){
            $explode = explode('|', $soap);

            $pattern = '~<p><strong>.*?</strong></p>~';
            $replacement = '';
            $data = [];
            foreach($explode as $new){
                $temp = preg_replace($pattern, $replacement, $new);
                $temp2 = strip_tags($temp);
                $data[] = explode(',', $temp2);
            }

            if(preg_match('/\b(SUBJECTIVE|OBJECTIVE|ASSESMEN|PLANING)\b/', $soap)){
                $newData['subjective'] = $data[0] ?? [];
                $newData['objective'] = $data[1] ?? [];
                $newData['asesmen'] = $data[2] ?? [];
                $newData['planning'] = $data[3] ?? [];
            }else{
                $newData['assessment'] = $data[0] ?? [];
                $newData['diagnosa'] = $data[1] ?? [];
                $newData['intervensi'] = $data[2] ?? [];
                $newData['monitoring'] = $data[3] ?? [];
                $newData['evaluasi'] = $data[4] ?? [];
            }

        }
        $today = now()->format('Y-m-d H:i');
        return view('pages.cppt.edit', [
            'title' => 'Rawat Jalan',
            'menu' => 'In Patient',
            'item' => $item,
            'newData' => $newData,
            'today' => $today,
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
        $headingSubj = '<p><strong>SUBJECTIVE (S):&nbsp;</strong></p>';
        $headingObj = '<p><strong>OBJECTIVE (O):&nbsp;</strong></p>';
        $headingAsses = '<p><strong>ASSESMEN (A):&nbsp;</strong></p>';
        $headingPlan = '<p><strong>PLANING (P):&nbsp;</strong></p>';

        $soaps = [];

        $subjectives = $request->input('subjective', []);
        $newSub = [];
        foreach($subjectives as $sub){
            if($sub != null){
                $newSub[] = $sub; 
            }
        }
        if(count($newSub) != 0){
            $subjective = $headingSubj . '<ol><li>' . implode('</li>,<li>', $newSub) . '</li></ol>';
            $soaps[] = $subjective;
        }

        $objectives = $request->input('objective', []);
        $newObj = [];
        foreach($objectives as $obj){
            if($obj != null){
                $newObj[] = $obj; 
            }
        }
        if(count($newObj) != 0){
            $objective = $headingObj . '<ol><li>' . implode('</li>,<li>', $newObj) . '</li></ol>';
            $soaps[] = $objective;
        }
        
        $asesmens = $request->input('asesmen', []);
        $newAss = [];
        foreach($asesmens as $ass){
            if($ass != null){
                $newAss[] = $ass; 
            }
        }
        if(count($newAss) != 0){
            $asesmen = $headingAsses . '<ol><li>' . implode('</li>,<li>', $newAss) . '</li></ol>';
            $soaps[] = $asesmen;
        }
        
        $planings = $request->input('planning', []);
        $newPlan = [];
        foreach($planings as $plan){
            if($plan != null){
                $newPlan[] = $plan; 
            }
        }
        if(count($newPlan) != 0){
            $planing = $headingPlan . '<ol><li>' . implode('</li>,<li>', $newPlan) . '</li></ol>';
            $soaps[] = $planing;
        }

        $soap = implode('|', $soaps);


        //adime
        $headingA = '<p><strong>ASSESSMENT (A):&nbsp;</strong></p>';
        $headingDiag = '<p><strong>DIAGNOSA (D):&nbsp;</strong></p>';
        $headingInter = '<p><strong>INTERVENSI (I):&nbsp;</strong></p>';
        $headingMoni = '<p><strong>MONITORING (M):&nbsp;</strong></p>';
        $headingEva = '<p><strong>EVALUASI (E):&nbsp;</strong></p>';

        $adimes = [];

        $assessments = $request->input('assessment', []);
        $newA = [];
        foreach($assessments as $asst){
            if($asst != null){
                $newA[] = $asst; 
            }
        }
        if(count($newA) != 0){
            $adimeAss = $headingA . '<ol><li>' . implode('</li>,<li>', $newA) . '</li></ol>';
            $adimes[] = $adimeAss;
        }

        $diagnosas = $request->input('diagnosa', []);
        $newDiag = [];
        foreach($diagnosas as $diag){
            if($diag != null){
                $newDiag[] = $diag; 
            }
        }
        if(count($newDiag) != 0){
            $diagnosa = $headingDiag . '<ol><li>' . implode('</li>,<li>', $newDiag) . '</li></ol>';
            $adimes[] = $diagnosa;
        }
        
        $intervensis = $request->input('intervensi', []);
        $newInter = [];
        foreach($intervensis as $inter){
            if($inter != null){
                $newInter[] = $inter; 
            }
        }
        if(count($newInter) != 0){
            $intervensi = $headingInter . '<ol><li>' . implode('</li>,<li>', $newInter) . '</li></ol>';
            $adimes[] = $intervensi;
        }
        
        $monitorings = $request->input('monitoring', []);
        $newMoni = [];
        foreach($monitorings as $moni){
            if($moni != null){
                $newMoni[] = $moni; 
            }
        }
        if(count($newMoni) != 0){
            $monitoring = $headingMoni . '<ol><li>' . implode('</li>,<li>', $newMoni) . '</li></ol>';
            $adimes[] = $monitoring;
        }


        $evaluasis = $request->input('evaluasi', []);
        $newEva = [];
        foreach($evaluasis as $eva){
            if($eva != null){
                $newEva[] = $eva; 
            }
        }
        if(count($newEva) != 0){
            $evaluasi = $headingEva . '<ol><li>' . implode('</li>,<li>', $newEva) . '</li></ol>';
            $adimes[] = $evaluasi;
        }
        
        $adime = implode('|', $adimes);

        $datasoap = $soap ? $soap : $adime;


        $intruksi = $request->input('intruksi');
        $tanggal = $request->input('tanggal');

        $data['soap'] = $datasoap;
        $data['intruksi'] = $intruksi;
        $data['tanggal'] = $tanggal;

        //find cppt
        $item = RmeCppt::find($id);

        //changeLog
        $old_data = json_encode($item);
        
        //update cppt
        $item->update($data);

        //create change Log
        $log_data = [
            'user_id' => Auth::user()->id,
            'record_id' => $item->id,
            'record_type' => RmeCppt::class,
            'old_data' => $old_data,
            'new_data' => json_encode($item),
        ];
        ChangeLog::create($log_data);

        return redirect()->route('rajal/show',['title' => 'Rawat Jalan', 'id' => $item->rawatJalanPoliPatient->rawatJalanPatient->queue->id])->with([
            'success' => 'Berhasil Diperbarui',
            'btn' => 'cppt',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = RmeCppt::findOrFail($id);
        $item->delete();
        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'cppt',
        ]);
    }

    public function updateTtd(Request $request)
    {
        try {
            $itemCppt = RmeCppt::findOrFail($request->cppt_id);
            $item = User::findOrFail($request->user_id);
            if (Hash::check($request->password, $item->password)) {
                if ($request->ket_ttd == 'ttd') {
                    RajalCpptSbarPatient::create([
                        'rme_cppt_id' => $itemCppt->id,
                        'user_id' => $item->id,
                        'tanggal' => date('Y-m-d'),
                        'ttd' => $item->paraf,
                    ]);
                } elseif ($request->ket_ttd == 'ttd_serah_terima'){
                    RajalCpptSerahTerimaPatient::create([
                        'rme_cppt_id' => $itemCppt->id,
                        'user_id' => $item->id,
                        'tanggal' => date('Y-m-d'),
                        'ttd' => $item->paraf,
                    ]);
                }else{
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
