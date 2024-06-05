<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicineStok;
use App\Models\UnitCategory;
use Illuminate\Http\Request;
use App\Models\UnitConversionMaster;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicineDistributionRequest;
use App\Models\MedicineDistributionResponse;

class MedicineDistributionReturnRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = UnitCategory::whereHas('unit', function($query){
            $query->where('name', 'Gudang');
        })->get();
        $medicines = Medicine::all();
        $category_id = Auth::user()->unit_category_id;
        $data = MedicineDistributionResponse::where('isAmprahan', false)->whereHas('medicineDistributionRequest', function($query) use ($category_id){
            $query->where('unit_category_id', $category_id);
        })->get();
        $satuans = UnitConversionMaster::all();
        return view('pages.distrribusireturnrequest.index', [
            "title" => "Return Request",
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
        $req = [
            'unit_category_id' => Auth::user()->unit_category_id,
            'medicine_id' => $request->medicine_id,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'status' => 'PENDING',
        ];
        $checkStok = MedicineStok::where('unit_category_id', $req['unit_category_id'])->where('medicine_id', $req['medicine_id'])->first();
        if(!$checkStok || $checkStok->stok < $req['jumlah']){
            return back()->withInput()->with('error', 'Maaf!! Data Tidak Tersedia atau Stok Tidak Cukup');
        }
        if($item = MedicineDistributionRequest::create($req)){
            $res = [
                'medicine_distribution_request_id' => $item->id,
                'unit_category_id' => $request->unit_category_id,
                'harga' => $request->harga,
                'no_batch' => $request->no_batch,
                'production_date' => $request->production_date,
                'exp_date' => $request->exp_date,
                'status' => 'PENDING',
                'isAmprahan' => 0
            ];
            MedicineDistributionResponse::create($res);
        }
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
        //
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
        if($data['status'] == 'BATAL'){
            $item->update([
                'status' => $data['status']
            ]);

            $req = MedicineDistributionRequest::find($item->medicineDistributionRequest->id);
            $req->update([
                'status' => $data['status']
            ]);

            return back()->with('success', 'Berhasil Diperbarui');
        }
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
