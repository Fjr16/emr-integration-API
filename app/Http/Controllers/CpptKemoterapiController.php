<?php

namespace App\Http\Controllers;

use App\Models\ChangeLogCpptKemoterapi;
use App\Models\Patient;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\CpptKemoterapi;
use App\Models\KemoterapiPatient;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicineReceiptDetail;
use App\Models\KemoterapiMedicineReceipt;
use App\Models\KemoterapiMedicineReceiptDetail;


class CpptKemoterapiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = KemoterapiPatient::find($id);
        $data = Medicine::all();
        $today = now()->format('Y-m-d H:i');
        $tipeCppts = [
            'SBAR', 'NON SBAR'
        ];
        return view('pages.cpptKemoterapi.create', [
            'title' => 'CPPT Kemoterapi',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'data' => $data,
            'today' => $today,
            'tipeCppts' => $tipeCppts,
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
        $headingSubj = '<p><strong>SUBJECTIVE (S):&nbsp;</strong></p>';
        $headingObj = '<p><strong>OBJECTIVE (O):&nbsp;</strong></p>';
        $headingAsses = '<p><strong>ASSESMEN (A):&nbsp;</strong></p>';
        $headingPlan = '<p><strong>PLANING (P):&nbsp;</strong></p>';

        $soaps = [];

        $subjectives = $request->input('subjective', []);
        $newSub = [];
        foreach ($subjectives as $sub) {
            if ($sub != null) {
                $newSub[] = $sub;
            }
        }
        if (count($newSub) != 0) {
            $subjective = $headingSubj . '<ol><li>' . implode('</li>,<li>', $newSub) . '</li></ol>';
            $soaps[] = $subjective;
        }

        $objectives = $request->input('objective', []);
        $newObj = [];
        foreach ($objectives as $obj) {
            if ($obj != null) {
                $newObj[] = $obj;
            }
        }
        if (count($newObj) != 0) {
            $objective = $headingObj . '<ol><li>' . implode('</li>,<li>', $newObj) . '</li></ol>';
            $soaps[] = $objective;
        }

        $asesmens = $request->input('asesmen', []);
        $newAss = [];
        foreach ($asesmens as $ass) {
            if ($ass != null) {
                $newAss[] = $ass;
            }
        }
        if (count($newAss) != 0) {
            $asesmen = $headingAsses . '<ol><li>' . implode('</li>,<li>', $newAss) . '</li></ol>';
            $soaps[] = $asesmen;
        }

        $planings = $request->input('planning', []);
        $newPlan = [];
        foreach ($planings as $plan) {
            if ($plan != null) {
                $newPlan[] = $plan;
            }
        }
        if (count($newPlan) != 0) {
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
        foreach ($assessments as $asst) {
            if ($asst != null) {
                $newA[] = $asst;
            }
        }
        if (count($newA) != 0) {
            $adimeAss = $headingA . '<ol><li>' . implode('</li>,<li>', $newA) . '</li></ol>';
            $adimes[] = $adimeAss;
        }

        $diagnosas = $request->input('diagnosa', []);
        $newDiag = [];
        foreach ($diagnosas as $diag) {
            if ($diag != null) {
                $newDiag[] = $diag;
            }
        }
        if (count($newDiag) != 0) {
            $diagnosa = $headingDiag . '<ol><li>' . implode('</li>,<li>', $newDiag) . '</li></ol>';
            $adimes[] = $diagnosa;
        }

        $intervensis = $request->input('intervensi', []);
        $newInter = [];
        foreach ($intervensis as $inter) {
            if ($inter != null) {
                $newInter[] = $inter;
            }
        }
        if (count($newInter) != 0) {
            $intervensi = $headingInter . '<ol><li>' . implode('</li>,<li>', $newInter) . '</li></ol>';
            $adimes[] = $intervensi;
        }

        $monitorings = $request->input('monitoring', []);
        $newMoni = [];
        foreach ($monitorings as $moni) {
            if ($moni != null) {
                $newMoni[] = $moni;
            }
        }
        if (count($newMoni) != 0) {
            $monitoring = $headingMoni . '<ol><li>' . implode('</li>,<li>', $newMoni) . '</li></ol>';
            $adimes[] = $monitoring;
        }

        $evaluasis = $request->input('evaluasi', []);
        $newEva = [];
        foreach ($evaluasis as $eva) {
            if ($eva != null) {
                $newEva[] = $eva;
            }
        }
        if (count($newEva) != 0) {
            $evaluasi = $headingEva . '<ol><li>' . implode('</li>,<li>', $newEva) . '</li></ol>';
            $adimes[] = $evaluasi;
        }

        $adime = implode('|', $adimes);

        $datasoap = $soap ? $soap : $adime;

        $item = KemoterapiPatient::find($id);
        $intruksi = $request->input('intruksi');
        $tanggal = $request->input('tanggal');
        $rawatInapPatientId = $item->id;
        $patientId = $item->queue->patient->id;

        $tipe_cppt = $request->input('tipe_cppt');
        if (isset($tipe_cppt)) {
            if ($tipe_cppt == 'SBAR') {
                $data['ttd_user'] = $request->input('ttd_user');
            }
            $data['tipe_cppt'] = $tipe_cppt;
        } else {
            $data['tipe_cppt'] = 'NON SBAR';
        }

        $data['user_id'] = Auth::user()->id;
        $data['patient_id'] = $patientId;
        $data['soap'] = $datasoap;
        $data['intruksi'] = $intruksi;
        $data['tanggal'] = $tanggal;
        $data['kemoterapi_patient_id'] = $rawatInapPatientId;

        CpptKemoterapi::create($data);

        //create resep obat
        $medicineIds = $request->input('medicine_id', []);
        if (!empty($medicineIds)) {
            $resep['user_id'] = Auth::user()->id;
            $resep['patient_id'] = $patientId;
            $resep['kemoterapi_patient_id'] = $rawatInapPatientId;
            if ($itemResep = KemoterapiMedicineReceipt::create($resep)) {
                foreach ($medicineIds as $index => $medicine_id) {
                    $resepDetail['kemoterapi_medicine_receipt_id'] = $itemResep->id;
                    $resepDetail['medicine_id'] = $medicine_id;
                    $resepDetail['jumlah'] = $request['jumlah'][$index];
                    $resepDetail['aturan_pakai'] = $request['aturan_pakai'][$index];
                    $resepDetail['keterangan'] = $request['keterangan'][$index];
                    $resepDetail['other'] = $request['other'][$index];
                    KemoterapiMedicineReceiptDetail::create($resepDetail);
                }
            }
        }

        // return back()->with([
        //     'success' => 'Berhasil Ditambahkan',
        //     'btn' => 'cppt',
        // ]);
        return redirect()->route('kemoterapi/patient.show', $item->id)->with([
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
        $kemoterapi_patient = KemoterapiPatient::find($id);
        $findUserInDpjp = $kemoterapi_patient->kemoterapiDpjpPatientDetails->where('user_id', auth()->user()->id)->first();
        $isNotNull = $findUserInDpjp->end ?? null;
        if ($isNotNull) {
            $limited_date = date('Y-m-d', strtotime($findUserInDpjp->end));
        } else {
            $limited_date = date('Y-m-d');
        }
        $item = Patient::find($kemoterapi_patient->queue->patient->id);
        $cppt_kemoterapi = $item->cpptKemoterapi()->whereDate('created_at', '<=', $limited_date)->get();
        return view('pages.cpptKemoterapi.show', [
            'title' => 'CPPT Kemoterapi',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'cppt_kemoterapi' => $cppt_kemoterapi,
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
        $item = CpptKemoterapi::findOrFail($id);

        //memecah string soap menjadi array
        $soap = $item->soap;
        if ($soap) {
            $explode = explode('|', $soap);

            $pattern = '~<p><strong>.*?</strong></p>~';
            $replacement = '';
            $data = [];
            foreach ($explode as $new) {
                $temp = preg_replace($pattern, $replacement, $new);
                $temp2 = strip_tags($temp);
                $data[] = explode(',', $temp2);
            }

            if (preg_match('/\b(SUBJECTIVE|OBJECTIVE|ASSESMEN|PLANING)\b/', $soap)) {
                $newData['subjective'] = $data[0] ?? [];
                $newData['objective'] = $data[1] ?? [];
                $newData['asesmen'] = $data[2] ?? [];
                $newData['planning'] = $data[3] ?? [];
            } else {
                $newData['assessment'] = $data[0] ?? [];
                $newData['diagnosa'] = $data[1] ?? [];
                $newData['intervensi'] = $data[2] ?? [];
                $newData['monitoring'] = $data[3] ?? [];
                $newData['evaluasi'] = $data[4] ?? [];
            }
        }

        $today = now()->format('Y-m-d H:i');
        return view('pages.cpptKemoterapi.edit', [
            'title' => 'CPPT',
            'menu' => 'Rawat Inao',
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
        foreach ($subjectives as $sub) {
            if ($sub != null) {
                $newSub[] = $sub;
            }
        }
        if (count($newSub) != 0) {
            $subjective = $headingSubj . '<ol><li>' . implode('</li>,<li>', $newSub) . '</li></ol>';
            $soaps[] = $subjective;
        }

        $objectives = $request->input('objective', []);
        $newObj = [];
        foreach ($objectives as $obj) {
            if ($obj != null) {
                $newObj[] = $obj;
            }
        }
        if (count($newObj) != 0) {
            $objective = $headingObj . '<ol><li>' . implode('</li>,<li>', $newObj) . '</li></ol>';
            $soaps[] = $objective;
        }

        $asesmens = $request->input('asesmen', []);
        $newAss = [];
        foreach ($asesmens as $ass) {
            if ($ass != null) {
                $newAss[] = $ass;
            }
        }
        if (count($newAss) != 0) {
            $asesmen = $headingAsses . '<ol><li>' . implode('</li>,<li>', $newAss) . '</li></ol>';
            $soaps[] = $asesmen;
        }

        $planings = $request->input('planning', []);
        $newPlan = [];
        foreach ($planings as $plan) {
            if ($plan != null) {
                $newPlan[] = $plan;
            }
        }
        if (count($newPlan) != 0) {
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
        foreach ($assessments as $asst) {
            if ($asst != null) {
                $newA[] = $asst;
            }
        }
        if (count($newA) != 0) {
            $adimeAss = $headingA . '<ol><li>' . implode('</li>,<li>', $newA) . '</li></ol>';
            $adimes[] = $adimeAss;
        }

        $diagnosas = $request->input('diagnosa', []);
        $newDiag = [];
        foreach ($diagnosas as $diag) {
            if ($diag != null) {
                $newDiag[] = $diag;
            }
        }
        if (count($newDiag) != 0) {
            $diagnosa = $headingDiag . '<ol><li>' . implode('</li>,<li>', $newDiag) . '</li></ol>';
            $adimes[] = $diagnosa;
        }

        $intervensis = $request->input('intervensi', []);
        $newInter = [];
        foreach ($intervensis as $inter) {
            if ($inter != null) {
                $newInter[] = $inter;
            }
        }
        if (count($newInter) != 0) {
            $intervensi = $headingInter . '<ol><li>' . implode('</li>,<li>', $newInter) . '</li></ol>';
            $adimes[] = $intervensi;
        }

        $monitorings = $request->input('monitoring', []);
        $newMoni = [];
        foreach ($monitorings as $moni) {
            if ($moni != null) {
                $newMoni[] = $moni;
            }
        }
        if (count($newMoni) != 0) {
            $monitoring = $headingMoni . '<ol><li>' . implode('</li>,<li>', $newMoni) . '</li></ol>';
            $adimes[] = $monitoring;
        }


        $evaluasis = $request->input('evaluasi', []);
        $newEva = [];
        foreach ($evaluasis as $eva) {
            if ($eva != null) {
                $newEva[] = $eva;
            }
        }
        if (count($newEva) != 0) {
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

        $item = CpptKemoterapi::find($id);

        //changeLog
        $old_data = json_encode($item);

        $item->update($data);

        // create change Log
        $log_data = [
            'user_id' => Auth::user()->id,
            'record_id' => $item->id,
            'record_type' => CpptKemoterapi::class,
            'old_data' => $old_data,
            'new_data' => json_encode($item),
        ];
         ChangeLogCpptKemoterapi::create($log_data);

        return redirect()->route('kemoterapi/patient.show', $item->id)->with([
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
        $item = CpptKemoterapi::findOrFail($id);
        $item->delete();
        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'cppt',
        ]);
    }

    public function print($id)
    {
        $item = Patient::find($id);
        return view('pages.cpptKemoterapi.print', [
            'title' => 'CPPT',
            'menu' => 'Rawat Inap',
            'item' => $item,
        ]);
    }
}
