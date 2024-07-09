<?php

namespace App\Http\Controllers;

use App\Models\DoctorInitialAsessment;
use App\Models\Queue;
use Illuminate\Http\Request;

class DoctorInitialAssesmentController extends Controller
{
    public function update(Request $request, $id)
    {
        $item = Queue::with('patient')->findOrFail($id);
        $data = $request->all();
        if (auth()->user()->id == $item->dpjp->id && !$item->doctorInitialAssesment->ttd) {
            $data['ttd'] = $item->dpjp->paraf ?? '';
        }
        if ($item->doctorInitialAssesment) {
            $item->doctorInitialAssesment->update($data);
        }else{
            $data['queue_id'] = $item->id;
            $data['patient_id'] = $item->patient->id;
            $data['user_id'] = $item->dpjp->id;
            DoctorInitialAsessment::create($data);
        }

        // if ($assesmen = InitialAssesment::create($data)) {

        //     //create tagihan konsultasi
        //     $patient_category_id = $item->patientCategory->id;
        //     $dpjp_id = $item->doctorPatient->user->id;
        //     $tarifKonsultasi = ConsultingRates::where('user_id', $dpjp_id)->where('patient_category_id', $patient_category_id)->first();
        //     if ($item->kasirPatient) {
        //         $itemKasirPatient = KasirPatient::find($item->kasirPatient->id);

        //         $total = $itemKasirPatient->total;
        //         $detailKasirPatient = false;
        //         foreach ($itemKasirPatient->detailKasirPatients as $detail) {
        //             if ($detailKasirPatient == true) {
        //                 break;
        //             }
        //             if ($detail->name == 'Konsultasi' && $detail->category == 'Konsultasi') {
        //                 $detailKasirPatient = true;
        //             }
        //         }
        //         if ($detailKasirPatient == false) {
        //             $newDetail =  DetailKasirPatient::create([
        //                 'kasir_patient_id' => $itemKasirPatient->id,
        //                 'name' => 'Konsultasi',
        //                 'tanggal' => date('Y-m-d H:i:s'),
        //                 'category' => 'Konsultasi',
        //                 'jumlah' => '1',
        //                 'tarif' => $tarifKonsultasi->pembayaran ?? 0,
        //             ]);
        //             $total += $newDetail->tarif;
        //         }

        //         $itemKasirPatient->update([
        //             'total' => $total,
        //         ]);
        //     } else {
        //         $total = $tarifKonsultasi->pembayaran;
        //         $itemKasirPatient = KasirPatient::create([
        //             'queue_id' => $item->id,
        //             'user_id' => null,
        //             'total' => $total,
        //             'status' => 'PENDING',
        //         ]);
        //         DetailKasirPatient::create([
        //             'kasir_patient_id' => $itemKasirPatient->id,
        //             'name' => 'Konsultasi',
        //             'tanggal' => date('Y-m-d H:i:s'),
        //             'category' => 'Konsultasi',
        //             'jumlah' => '1',
        //             'tarif' => $tarifKonsultasi->pembayaran ?? 0,
        //         ]);
        //     }
        // }

        // if (!empty($medicineIds)) {
        //     $resep['user_id'] = $data['user_id'];
        //     $resep['patient_id'] = $item->patient->id;
        //     $resep['rawat_jalan_poli_patient_id'] = $item->rawatJalanPatient->rawatJalanPoliPatient->id;
        //     if ($itemResep = MedicineReceipt::create($resep)) {
        //         foreach ($medicineIds as $index => $medicine_id) {
        //             $resepDetail['medicine_receipt_id'] = $itemResep->id;
        //             $resepDetail['medicine_id'] = $medicine_id;
        //             $resepDetail['jumlah'] = $request['jumlah'][$index] ?? '';
        //             $resepDetail['aturan_pakai'] = $request['aturan_pakai'][$index] ?? '';
        //             $resepDetail['keterangan'] = $request['keterangan'][$index] ?? '';
        //             $resepDetail['other'] = $request['other'][$index] ?? '';
        //             MedicineReceiptDetail::create($resepDetail);
        //         }
        //     }
        // }
        return back()->with([
            'success' => 'Berhasil Diperbarui',
            'btn' => 'asesmen',
            'asesmen' => 'dokter',
        ]);
    }

    public function print($id)
    {
        $item = DoctorInitialAsessment::findOrFail($id);
        $waktu = new DateTime($item->tanggal);
        $formatId = Carbon::parse($item->tanggal);
        $arrEdukasi = ['Penggunaan obat secara efektif dan aman', 'Penggunaan peralatan medis yang aman', 'Potensi interaksi obat dan makanan', 'Teknik Rehabilitasi'];
        return view('pages.rawatjalan.assesmen_rawat_jalan', [
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
            'item' => $item,
            'waktu' => $waktu,
            'formatId' => $formatId,
            'arrEdukasi' => $arrEdukasi
        ]);
    }
}
