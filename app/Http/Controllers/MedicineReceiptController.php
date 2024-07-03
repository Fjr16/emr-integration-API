<?php

namespace App\Http\Controllers;

use App\Models\DiagnosisKeperawatanPatient;
use App\Models\Queue;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\MedicineReceipt;
use App\Models\MedicineReceiptDetail;
use App\Models\Patient;
use App\Models\StatusFisikDiagnosaKeperawatanPatient;
use Illuminate\Support\Facades\Auth;

class MedicineReceiptController extends Controller
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
        //     $today = date('Y-m-d H:i');
        //     $item = Queue::find($id);
        //     $dataObat = Medicine::all();
        //     return view('pages.resepDokter.create', [
        //         'title' => 'Resep Dokter',
        //         'menu' => 'In Patient',
        //         'item' => $item,
        //         'today' => $today,
        //         'dataObat' => $dataObat,
        //     ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // $data = $request->all();

        // $item = Queue::find($id);
        // $data['user_id'] = Auth::user()->id;
        // $data['patient_id'] = $item->patient->id;
        // $data['rawat_jalan_poli_patient_id'] = $item->rawatJalanPatient->rawatJalanPoliPatient->id;
        // if($itemResep = MedicineReceipt::create($data)){
        //     foreach($data['medicine_id'] as $index => $medicine_id){
        //         $resepDetail['medicine_receipt_id'] = $itemResep->id;
        //         $resepDetail['medicine_id'] = $medicine_id;
        //         $resepDetail['jumlah'] = $request['jumlah'][$index];
        //         $resepDetail['aturan_pakai'] = $request['aturan_pakai'][$index];
        //         MedicineReceiptDetail::create($resepDetail);
        //     }
        // }
        // return redirect()->route('rajal/show', ['id' => $id, 'title' => 'Rawat Jalan'])->with([
        //     'success' => 'Berhasil Ditambahkan',
        //     'navOn' => 'resep dokter',
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = MedicineReceipt::find($id);

        // return $item->user;
        $patient = Patient::find($item->patient_id);

        $diagnosisKeperawatanPatient = DiagnosisKeperawatanPatient::where('patient_id', $item->patient_id)->first();
        $statusFisikDiagnosaKeperawatanPatient = StatusFisikDiagnosaKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisKeperawatanPatient->id)->first();
        return view('pages.resepDokter.show', [
            'title' => 'Resep Dokter',
            'menu' => 'In Patient',
            'item' => $item,
            'patient' => $patient,
            'statusFisikDiagnosaKeperawatanPatient' => $statusFisikDiagnosaKeperawatanPatient,
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
        $today = date('Y-m-d H:i');
        $item = MedicineReceipt::find($id);
        $dataObat = Medicine::all();
        return view('pages.resepDokter.edit', [
            'title' => 'Edit Resep Dokter',
            'menu' => 'In Patient',
            'item' => $item,
            'today' => $today,
            'dataObat' => $dataObat,
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
        $data = $request->all();
        $item = MedicineReceipt::find($id);
        $queue = Queue::find($item->rawatJalanPoliPatient->rawatJalanPatient->queue_id);

        foreach ($item->medicineReceiptDetails as $detail) {
            $detail->delete();
        }

        foreach ($data['medicine_id'] as $index => $medicine_id) {
            $resepDetail['medicine_receipt_id'] = $item->id;
            $resepDetail['medicine_id'] = $medicine_id;
            $resepDetail['jumlah'] = $request['jumlah'][$index];
            $resepDetail['aturan_pakai'] = $request['aturan_pakai'][$index];
            $resepDetail['keterangan'] = $request['keterangan'][$index];
            MedicineReceiptDetail::create($resepDetail);
        }

        return redirect()->route('rajal/show', ['id' => $queue->id, 'title' => 'Rawat Jalan'])->with([
            'success' => 'Berhasil Diperbarui',
            'navOn' => 'resep dokter',
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
        $item = MedicineReceipt::find($id);
        foreach ($item->medicineReceiptDetails as $detail) {
            $detail->delete();
        }

        $item->delete();

        return back()->with([
            'success' => 'Berhasil Dihapus',
            'navOn' => 'resep dokter',
        ]);
    }
}
