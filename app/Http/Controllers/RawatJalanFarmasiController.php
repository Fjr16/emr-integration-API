<?php

namespace App\Http\Controllers;

use App\Models\AdministrasiCacatanPerjalananRanapPatient;
use App\Models\CatatanPerjalanRanapPatient;
use App\Models\DetailAdministrasiCacatanPerjalananRanapPatient;
use App\Models\Queue;
use App\Models\Medicine;
use App\Models\KasirPatient;
use App\Models\MedicineStok;
use App\Models\UnitCategory;
use Illuminate\Http\Request;
use App\Models\PatientCategory;
use App\Models\RadiologiPatient;
use App\Models\RajalRoadPatient;
use App\Models\RawatInapPatient;
use App\Models\RawatJalanPatient;
use App\Models\DetailKasirPatient;
use App\Models\PatientActionReport;
use App\Models\RajalFarmasiPatient;
use Illuminate\Support\Facades\Auth;
use App\Models\RajalFarmasiObatDetail;
use App\Models\RajalFarmasiObatInvoice;
use App\Models\LaboratoriumPatientResult;
use App\Models\LaboratoriumRequest;
use App\Models\LaboratoriumRequestTypeMaster;
use App\Models\PatientActionReportDetail;
use App\Models\RadiologiFormRequest;
use App\Models\RadiologiPatientRequestDetail;
use App\Models\SuratPengantarRawatJalanPatient;
use App\Models\Unit;

class RawatJalanFarmasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date('Y-m-d');
        $data = RajalFarmasiPatient::where('status', 'WAITING')->whereDate('created_at', $today)->latest()->get();
        return view('pages.pasienfarmasi.index', [
            "title" => "Farmasi",
            "menu" => "In Patient",
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = RajalFarmasiPatient::find($id);
        $etc = $item->rawatJalanPatient->rawatJalanPoliPatient->medicineReceipts->first();
        $unitPetugas = Auth::user()->unitCategory->unit->id ?? '';
        $dataUnit = UnitCategory::where('unit_id', $unitPetugas)->get();
        $tanggungans = PatientCategory::all();

        $dataObat = Medicine::all();

        return view('pages.pasienfarmasi.create', [
            "title" => "Farmasi",
            "menu" => "In Patient",
            'item' => $item,
            'dataUnit' => $dataUnit,
            'dataObat' => $dataObat,
            'tanggungans' => $tanggungans,
            'etc' => $etc
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get no faktur
        $unitName = 'FR';
        $last_id = RajalFarmasiObatInvoice::orderBy('id', 'desc')->pluck('id')->first();
        $new_id = $last_id + 1;

        $dataInvoice = [
            'user_id' => Auth::user()->id,
            'patient_id' => $request->patient_id,
            'rajal_farmasi_patient_id' => $request->rajal_farmasi_patient_id,
            'no_faktur' => $unitName . '' . $new_id,
        ];
        $itemInvoice = RajalFarmasiObatInvoice::create($dataInvoice);


        $unit = Unit::find($request->input('unit_id'));
        $grandTotal = 0;
        foreach ($request['medicine_id'] as $index => $medicine_id) {
            $medicine = Medicine::find($medicine_id);

            $jumlah = $request->input('jumlah')[$index];
            $stokAll = MedicineStok::where('medicine_id', $medicine->id)->where('unit_id', $unit->id)->sum('stok');
            if (!$stokAll || $stokAll < $jumlah) {
                $itemInvoice->rajalFarmasiObatDetails()->delete();
                $itemInvoice->delete();
                return back()->with('error', 'Maaf Stok Obat ' . $medicine->name . ' Tidak Mencukupi');
            }

            $dataMedicineStoks = MedicineStok::where('medicine_id', $medicine->id)->where('unit_id', $unit->id)->where('stok', '>', 0)->orderBy('exp_date', 'asc')->get();

            $stopIteration = false;
            foreach ($dataMedicineStoks as $medicineStok) {
                if ($stopIteration) {
                    break;
                }

                $tanggunganCat = $request->input('patient_category_id')[$index];
                if ($medicineStok->stok >= $jumlah) {
                    $dataDetail = [
                        'rajal_farmasi_obat_invoice_id' => $itemInvoice->id,
                        'unit_id' => $unit->id,
                        'patient_category_id' => $tanggunganCat,
                        'medicine_id' => $medicine->id,
                        'medicine_stok_id' => $medicineStok->id,
                        'harga_satuan' => $request->input('harga')[$index],
                        'jumlah' => $jumlah,
                        'total_harga' => $request->input('total_harga')[$index],
                    ];
                    $stopIteration = true;
                } else {
                    $jumlah = $request->input('jumlah')[$index] - $medicineStok->stok;

                    $dataDetail = [
                        'rajal_farmasi_obat_invoice_id' => $itemInvoice->id,
                        'unit_id' => $unit->id,
                        'patient_category_id' => $tanggunganCat,
                        'medicine_id' => $medicine->id,
                        'medicine_stok_id' => $medicineStok->id,
                        'harga_satuan' => $request->input('harga')[$index],
                        'jumlah' => $medicineStok->stok,
                        'total_harga' => $request->input('total_harga')[$index],
                    ];
                }

                $itemDetail = RajalFarmasiObatDetail::create($dataDetail);
                $grandTotal += $itemDetail->total_harga;
            }
        }

        $itemInvoice->update([
            'grand_total' => $grandTotal
        ]);

        return back()->with('success', 'Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tanggunganUmum = PatientCategory::where('name', 'UMUM')->first();
        $item = RajalFarmasiObatInvoice::find($id);
        return view('pages.surat.kwitansifarmasi', [
            "title" => "Farmasi",
            "menu" => "In Patient",
            'item' => $item,
            'tanggunganUmum' => $tanggunganUmum,
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
        $item = RajalFarmasiObatInvoice::find($id);

        $tanggungans = PatientCategory::all();

        $dataObat = Medicine::all();

        return view('pages.pasienfarmasi.edit', [
            "title" => "Farmasi",
            "menu" => "In Patient",
            'item' => $item,
            'dataObat' => $dataObat,
            'tanggungans' => $tanggungans,
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
        $itemInvoice = RajalFarmasiObatInvoice::find($id);

        $grandTotal = 0;
        $unit_id = $request->input('unit_id');
        foreach ($request->detail_id as $index => $detail_id) {
            $jumlah = $request->input('jumlah')[$index];
            $medicine = Medicine::find($request->input('medicine_id')[$index]);
            $stokAll = MedicineStok::where('medicine_id', $medicine->id)->where('unit_id', $unit_id)->sum('stok');
            if (!$stokAll || $stokAll < $jumlah) {
                return back()->with('error', 'Maaf Stok Obat ' . $medicine->name . ' Tidak Mencukupi');
            }

            $dataMedicineStoks = MedicineStok::where('medicine_id', $request->input('medicine_id')[$index])->where('unit_id', $unit_id)->where('stok', '>', 0)->orderBy('exp_date', 'asc')->get();

            $stopIteration = false;
            foreach ($dataMedicineStoks as $medicineStok) {
                if ($stopIteration) {
                    break;
                }

                $tanggunganCat = $request->input('patient_category_id')[$index];
                if ($medicineStok->stok >= $jumlah) {
                    $dataDetail = [
                        'unit_id' => $unit_id,
                        'patient_category_id' => $tanggunganCat,
                        'medicine_id' => $medicine->id,
                        'medicine_stok_id' => $medicineStok->id,
                        'harga_satuan' => $request->input('harga')[$index],
                        'jumlah' => $jumlah,
                        'total_harga' => $request->input('total_harga')[$index],
                    ];
                    $itemDetail = RajalFarmasiObatDetail::find($detail_id);
                    $itemDetail->update($dataDetail);
                    $stopIteration = true;
                } else {
                    $jumlah = $request->input('jumlah')[$index] - $medicineStok->stok;

                    $dataDetail = [
                        'rajal_farmasi_obat_invoice_id' => $itemInvoice->id,
                        'unit_id' => $unit_id,
                        'patient_category_id' => $tanggunganCat,
                        'medicine_id' => $medicine->id,
                        'medicine_stok_id' => $medicineStok->id,
                        'harga_satuan' => $request->input('harga')[$index],
                        'jumlah' => $medicineStok->stok,
                        'total_harga' => $request->input('total_harga')[$index],
                    ];
                    $itemDetail = RajalFarmasiObatDetail::create($dataDetail);
                }

                $grandTotal += $itemDetail->total_harga;
            }
        }
        $itemInvoice->update([
            'grand_total' => $grandTotal
        ]);

        return redirect()->route('rajal/farmasi/create', $itemInvoice->rajalFarmasiPatient->id)->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateStatus(Request $request, $id)
    {
        //hanya category umum, karena bpjs tidak ditagihkan
        $unitCategoryUmum = PatientCategory::where('name', 'Umum')->first();

        $total = 0;
        $status = $request->input('status');
        $item = RajalFarmasiPatient::find($id);
        $checkInvoice = $item->rajalFarmasiObatInvoices ?? '';

        if ($item && $checkInvoice->isNotEmpty()) {
            $totalFarm = 0;
            foreach ($item->rajalFarmasiObatInvoices as $farm) {
                $farmall = RajalFarmasiObatDetail::where('rajal_farmasi_obat_invoice_id', $farm->id)->where('patient_category_id', $unitCategoryUmum->id)->get();
                foreach ($farmall as $farmobatall) {
                    $totalFarm += $farmobatall->total_harga;
                }
            }

            $rajal = RawatJalanPatient::find($item->rawatJalanPatient->id);
            if ($rajal->kasirPatient) {
                $itemKasir = KasirPatient::find($rajal->kasirPatient->id);
                $total = $rajal->kasirPatient->total + $totalFarm;

                $itemKasir->update([
                    'total' => $total,
                ]);
            } else {
                $itemKasir =  KasirPatient::create([
                    'rawat_jalan_patient_id' => $rajal->id,
                    'user_id' => null,
                    'total' => $total,
                    'status' => 'PENDING',
                ]);
            }

            foreach ($item->rajalFarmasiObatInvoices as $invoice) {
                foreach ($invoice->rajalFarmasiObatDetails->where('patient_category_id', $unitCategoryUmum->id) as $detail) {
                    DetailKasirPatient::create([
                        'kasir_patient_id' => $itemKasir->id,
                        'name' => $detail->medicine->name,
                        'tanggal' => $detail->medicine->created_at,
                        'category' => 'Medicine',
                        'jumlah' => $detail->jumlah,
                        'tarif' => $detail->harga_satuan,
                    ]);
                }
            }
        } else {
            $status = 'Belum Lengkap';
        }

        $item->update([
            'status' => $status,
        ]);

        return redirect()->route('rajal/farmasi/index')->with('success', 'Status Berhasil Diperbarui !!');
    }

    // public function updateStatusRME(Request $request, $id){
    //     $stts = $request->input('status');
    //     $rajal = RawatJalanPatient::where('queue_id', $id)->first();
    //     $queue = Queue::find($id);

    //     // if($rajal->rawatJalanPoliPatient->status == 'SELESAI'){
    //         if($stts == 'LABORATORIUM PA'){
    //             if(!in_array('LABORATORIUM PA', $rajal->rajalRoadPatients->pluck('name')->toArray())){
    //                 dd('laboratorium pa');
    //                 // $itemReq = LaboratoriumRequest::create([
    //                 //     'user_id' => Auth::user()->id,
    //                 //     'patient_id' => $queue->patient->id,
    //                 //     'queue_id' => $queue->id,
    //                 //     'laboratorium_request_type_master_id' => $tipeReguler->id,
    //                 //     'room_detail_id' => Auth::user()->room_detail_id ?? '',
    //                 //     'tanggal' => date('Y-m-d'),
    //                 // ]);
    //                     // LaboratoriumPatientResult::create([
    //                     //     'queue_id' => $queue->id,
    //                     //     'laboratorium_request_id' => $itemReq->id,
    //                     //     'status' => 'WAITING',
    //                     // ]);
    //             }else{
    //                 return back()->with('forbidden', 'Antrian Telah Terdaftar Di Laboratorium PA, Silahkan Buat Antrian Baru');
    //             }
    //         }elseif($stts == 'RADIOLOGI'){
    //             if(!in_array('RADIOLOGI', $rajal->rajalRoadPatients->pluck('name')->toArray())){
    //                 $itemRad = RadiologiFormRequest::create([
    //                     'user_id' => Auth::user()->id,
    //                     'queue_id' => $queue->id,
    //                     'patient_id' => $queue->patient->id,
    //                     'room_detail_id' => Auth::user()->room_detail_id ?? '',
    //                 ]);
    //                 $item = RadiologiPatient::create([
    //                     'queue_id' => $queue->id,
    //                     'patient_id' => $queue->patient->id,
    //                     'radiologi_form_request_id' => $itemRad->id,
    //                     'status' => 'WAITING',
    //                 ]);
    //             }else{
    //                 return back()->with('forbidden', 'Antrian Telah Terdaftar Di Radiologi, Silahkan Buat Antrian Baru');
    //             }
    //             // foreach ($rajal->rawatJalanPoliPatient->radiologiFormRequests as $reqRadiologi) {
    //             //     $checkList = RadiologiPatient::where('queue_id', $rajal->queue_id)->where('radiologi_form_request_id', $reqRadiologi->id)->first();
    //             //     if($checkList){
    //             //         continue;
    //             //     }

    //                 // $detailIds = $item->radiologiFormRequest->radiologiFormRequestMasters()->where('radiologi_form_request_id', $item->radiologiFormRequest->id)->pluck('radiologi_form_request_details.id');
    //                 // foreach($detailIds as $detailId){
    //                 //     RadiologiPatientRequestDetail::create([
    //                 //         'radiologi_patient_id' => $item->id,
    //                 //         'radiologi_form_request_detail_id' => $detailId,
    //                 //         'status' => 'WAITING',
    //                 //     ]);
    //                 // }
    //             // }
    //         }elseif($stts == 'LABORATORIUM PK'){
    //             if(!in_array('LABORATORIUM PK', $rajal->rajalRoadPatients->pluck('name')->toArray())){
    //                 $tipeReguler = LaboratoriumRequestTypeMaster::find(1);
    //                 if($queue){
    //                     $itemReq = LaboratoriumRequest::create([
    //                         'user_id' => Auth::user()->id,
    //                         'patient_id' => $queue->patient->id,
    //                         'queue_id' => $queue->id,
    //                         'laboratorium_request_type_master_id' => $tipeReguler->id,
    //                         'room_detail_id' => Auth::user()->room_detail_id ?? '',
    //                         'tanggal' => date('Y-m-d'),
    //                     ]);
    //                     LaboratoriumPatientResult::create([
    //                         'queue_id' => $queue->id,
    //                         'laboratorium_request_id' => $itemReq->id,
    //                         'status' => 'WAITING',
    //                     ]);
    //                 }
    //             }else{
    //                 return back()->with('forbidden', 'Antrian Telah Terdaftar Di Laboratorium PK, Silahkan Buat Antrian Baru');
    //             }
    //         }
    //         $checkRoad = $rajal->rajalRoadPatients->where('name', $stts)->first();
    //         if(!$checkRoad)
    //         RajalRoadPatient::create([
    //             'rawat_jalan_patient_id' => $rajal->id,
    //             'name' => $stts,
    //         ]);
    //     // }else{
    //     //     return back()->with('forbidden', 'Gagal !! Status Pada Poli Belum Selesai');
    //     // }

    //     return back()->with('success', 'Status Berhasil Diperbarui');
    // }
}
