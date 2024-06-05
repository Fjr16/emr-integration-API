<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Support\Str;
use App\Models\MedicineStok;
use App\Models\UnitCategory;
use Illuminate\Http\Request;
use App\Models\MedicineDistribution;
use App\Models\MedicineDistributionDetail;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicineDistributionRequest;
use App\Models\MedicineDistributionResponse;
use App\Models\UnitConversionMaster;

class MedicineDistributionRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = UnitCategory::all();
        $category_id = Auth::user()->unit_category_id;
        $data = MedicineDistributionRequest::where('unit_category_id', $category_id)->whereHas('medicineDistributionResponse', function($query){
            $query->where('isAmprahan', true);
        })->get();
        $satuans = UnitConversionMaster::all();
        $medicines = Medicine::all();
        return view('pages.distribusirequest.index', [
            "title" => "Distribusi Request",
            "menu" => "Farmasi",
            "data" => $data,
            "categories" => $categories,
            "medicines" => $medicines,
            "satuans" => $satuans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $input['unit_category_id'] = Auth::user()->unit_category_id;
        $input['status'] = 'PENDING';
        if($req = MedicineDistributionRequest::create($input)){
            $res = [
                'medicine_distribution_request_id' => $req->id,
                'unit_category_id' => $request->unit_category_id,
                'status' => 'PENDING',
                'isAmprahan' => true
            ];
            MedicineDistributionResponse::create($res);
            foreach($data['medicine_id'] as $index => $medicineId){
                $detail['medicine_distribution_request_id'] = $req->id;
                $detail['medicine_id'] = $medicineId;
                $detail['satuan'] = $data['satuan'][$index];
                $detail['jumlah'] = $data['jumlah'][$index];
                MedicineDistributionDetail::create($detail);
            }
        }
        return back()->with('success', 'Berhasil Ditambahkan'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if($request->unit_category_id){
            $medicines = Medicine::all();
            $data = "<option selected disabled>Pilih</option>";
            foreach ($medicines as $medicine) {
                $data .= "<option value='$medicine->id'>$medicine->kode / $medicine->name</option>";
            }
            echo $data;
        }else{
            $data = "<option selected disabled>Pilih</option>";
            echo $data;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $item = MedicineDistributionResponse::find($id);
        $req = MedicineDistributionRequest::find($item->medicine_distribution_request_id);

        if($data['status'] == 'SELESAI'){
            foreach($req->medicineDistributionDetails as $detail){
                $itemMedicineStok = $detail->medicineStok;
                // $medicineStokResponse = MedicineStok::where('unit_category_id', $item->unit_category_id)->where('medicine_id', $detail->medicine_id)->orderBy('exp_date', 'asc')->first();
                if($itemMedicineStok){
                    $stok = $itemMedicineStok->stok;
                    if($stok < $item['jumlah']){
                        return back()->with('error', 'Maaf!! Stok '.$detail->medicine->name.' Tidak Mencukupi');
                    }
                    $stokResponse = $stok-$detail->jumlah;
                    $itemMedicineStok->update([
                        'stok' => $stokResponse
                    ]);
                }else{
                    return back()->with('error', 'Maaf!! Data Tidak Tersedia');
                }

                $itemMedicineStokReq = MedicineStok::where('unit_category_id', $req->unit_category_id)->where('medicine_id', $itemMedicineStok->medicine_id)->where('no_batch', $itemMedicineStok->no_batch)->where('harga', $itemMedicineStok->harga)->first();
                if($itemMedicineStokReq){
                    $stok = $itemMedicineStokReq->stok;
                    $stokRequest = $stok+$detail->jumlah;
                    $itemMedicineStokReq->update([
                        'stok' => $stokRequest
                    ]);
                }else{
                    $new = [
                        'unit_category_id' => $req->unit_category_id,
                        'medicine_id' => $detail->medicine_id,
                        'stok' => $detail->jumlah,
                        'harga' => $detail->medicineStok->harga,
                        'no_batch' => $detail->medicineStok->no_batch,
                        'production_date' => $detail->medicineStok->production_date,
                        'exp_date' => $detail->medicineStok->exp_date,
                        'satuan' => $detail->satuan,
                    ];
    
                    MedicineStok::create($new);
                }
            }

            $distribusi['medicine_distribution_response_id'] = $id;
            $distribusi['tanggal'] = date('Y-m-d');
            $distribusi['status'] = 'AMPRAHAN';
            if($dis = MedicineDistribution::create($distribusi)){
                if(Str::length($dis->id) == 1 ){
                    $no_dis = mt_rand(000000, 999999).$dis->id;
                }elseif(Str::length($dis->id) == 2){
                    $no_dis = mt_rand(00000, 99999).$dis->id;
                }elseif(Str::length($dis->id) == 3){
                    $no_dis = mt_rand(0000, 9999).$dis->id;
                }elseif(Str::length($dis->id) == 4){
                    $no_dis = mt_rand(000, 999).$dis->id;
                }elseif(Str::length($dis->id) == 5){
                    $no_dis = mt_rand(00, 99).$dis->id;
                }elseif(Str::length($dis->id) == 6){
                    $no_dis = mt_rand(0, 9).$dis->id;
                }elseif(Str::length($dis->id) == 7){
                    $no_dis = $dis->id;
                }elseif(Str::length($dis->id) == 8){
                    return 'OVERFLOW';
                }

                $newDis = MedicineDistribution::find($dis->id);
                $newDis->update([
                    'no_distribusi' => $no_dis
                ]);
            }
        }

        $item->update([
            'status' => $data['status'],
            'isAmprahan' => true,
        ]);
        $req->update([
            'status' => $data['status']
        ]);

        return back()->with('success', 'Berhasil Diperbarui');

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
}
