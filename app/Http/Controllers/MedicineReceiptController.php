<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;
use App\Models\MedicineReceipt;
use App\Models\MedicineReceiptDetail;
use App\Models\Patient;

class MedicineReceiptController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $item = Queue::find($id);
        if ($item->medicineReceipt) {
            $resep = $item->medicineReceipt;
        }else{
            $resep = MedicineReceipt::create([
                'user_id' => auth()->user()->id,
                'queue_id' => $item->id,
                'no_resep' => '',
                'ttd' => auth()->user()->paraf ?? '',
            ]);
        }
        $data = $request->all();
        if (isset($data['medicine_id'])) {
            $data['nama_obat_custom'] = null;
            $data['satuan_obat_custom'] = null;
        }
        $resep->medicineReceiptDetails()->create($data);

        return back()->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'resep dokter',
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
        $item = Queue::find($id);

        $patient = Patient::find($item->patient_id);
        return view('pages.resepDokter.show', [
            'title' => 'Resep Dokter',
            'menu' => 'In Patient',
            'item' => $item,
            'patient' => $patient,
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
        $item = MedicineReceiptDetail::find($id);
        $item->update($data);

        return back()->with([
            'success' => 'Berhasil Diperbarui',
            'btn' => 'resep dokter',
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
        $item = MedicineReceiptDetail::find($id);
        $item->delete();

        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'resep dokter',
        ]);
    }
}
