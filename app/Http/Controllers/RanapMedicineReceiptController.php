<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\RawatInapPatient;
use App\Models\RanapMedicineReceipt;
use Illuminate\Support\Facades\Auth;
use App\Models\RanapMedicineReceiptDetail;

class RanapMedicineReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient', function ($query) {
            $query->whereNot('status', 'WAITING')->whereNot('status', 'BATAL');
        })->get();
        return view('pages.ranapResepDokter.index', [
            "title" => "Resep Obat Ranap",
            "menu" => "Rawat Inap",
            "data" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = RawatInapPatient::find($id);
        $data = Medicine::all();
        $today = date('Y-m-d H:i');
        return view('pages.ranapResepDokter.create', [
            "title" => "Resep Obat Ranap",
            "menu" => "Rawat Inap",
            "item" => $item,
            "data" => $data,
            "today" => $today,
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
        $data = $request->all();

        $item = RawatInapPatient::find($id);
        $data['user_id'] = Auth::user()->id;
        $data['patient_id'] = $item->queue->patient->id;
        $data['rawat_inap_patient_id'] = $item->id;
        if ($itemResep = RanapMedicineReceipt::create($data)) {
            foreach ($data['medicine_id'] as $index => $medicine_id) {
                $resepDetail['ranap_medicine_receipt_id'] = $itemResep->id;
                $resepDetail['medicine_id'] = $medicine_id;
                $resepDetail['jumlah'] = $request['jumlah'][$index];
                $resepDetail['aturan_pakai'] = $request['aturan_pakai'][$index];
                $resepDetail['keterangan'] = $request['keterangan'][$index];
                $resepDetail['other'] = $request['other'][$index];
                // $resepDetail['category'] = $request['category'][$index];
                RanapMedicineReceiptDetail::create($resepDetail);
            }
        }
        return redirect()->route('ranap/resep/dokter.detail', $item->id)->with([
            'success' => 'Berhasil Ditambahkan',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $item = RawatInapPatient::find($id);
        return view('pages.ranapResepDokter.detail', [
            "title" => "Resep Obat Ranap",
            "menu" => "Rawat Inap",
            "item" => $item,
        ]);
    }

    public function show($id)
    {
        $item = RanapMedicineReceipt::find($id);
        return view('pages.ranapResepDokter.show', [
            'title' => 'Resep Obat Ranap',
            'menu' => 'Rawat Inap',
            'item' => $item,
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
        $item = RanapMedicineReceipt::find($id);
        $dataObat = Medicine::all();
        return view('pages.ranapResepDokter.edit', [
            'title' => 'Resep Obat Ranap',
            'menu' => 'Rawat Inap',
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
        $item = RanapMedicineReceipt::find($id);

        if ($item->ranapMedicineReceiptDetails->isNotEmpty()) {
            $item->ranapMedicineReceiptDetails()->delete();
        }

        foreach ($data['medicine_id'] as $index => $medicine_id) {
            $resepDetail['ranap_medicine_receipt_id'] = $item->id;
            $resepDetail['medicine_id'] = $medicine_id;
            $resepDetail['jumlah'] = $request['jumlah'][$index];
            $resepDetail['aturan_pakai'] = $request['aturan_pakai'][$index];
            $resepDetail['keterangan'] = $request['keterangan'][$index];
            $resepDetail['other'] = $request['other'][$index];
            $resepDetail['category'] = $request['category'][$index];
            RanapMedicineReceiptDetail::create($resepDetail);
        }

        return redirect()->route('ranap/resep/dokter.detail', $item->rawatInapPatient->id)->with([
            'success' => 'Berhasil Diperbarui',
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
        $item = RanapMedicineReceipt::find($id);
        if ($item->ranapMedicineReceiptDetails->isNotEmpty()) {
            $item->ranapMedicineReceiptDetails()->delete();
        }

        $item->delete();

        return back()->with([
            'success' => 'Berhasil Dihapus',
        ]);
    }
}
