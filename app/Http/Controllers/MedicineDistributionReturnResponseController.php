<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\MedicineStok;
use Illuminate\Http\Request;
use App\Models\MedicineDistribution;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicineDistributionRequest;
use App\Models\MedicineDistributionResponse;

class MedicineDistributionReturnResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_id = Auth::user()->unit_category_id;
        $data = MedicineDistributionResponse::where('unit_category_id', $category_id)->where('isAmprahan', 0)->get();
        return view('pages.distribusireturnresponse.index', [
            'title' => 'Return Response',
            'menu' => 'Farmasi',
            'data' => $data,
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
        //
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
        $res = MedicineDistributionResponse::find($id);
        $req = MedicineDistributionRequest::find($res->medicine_distribution_request_id);

        if($data['status'] == 'SELESAI'){

            $medicineStokRequest = MedicineStok::where('unit_category_id', $req->unit_category_id)->where('medicine_id', $req->medicine_id)->first();
            if($medicineStokRequest){
                $stok = $medicineStokRequest->stok;
                if($stok < $req['jumlah']){
                    return back()->with('error', 'Maaf!! Stok Tidak Mencukupi');
                }
                $stokRequest = $stok-$req->jumlah;
                $medicineStokRequest->update([
                    'stok' => $stokRequest
                ]);
            }else{
                return back()->with('error', 'Maaf!! Data Tidak Tersedia');
            }


            $medicineStokResponse = MedicineStok::where('unit_category_id', $res->unit_category_id)->where('medicine_id', $req->medicine_id)->first();
            if($medicineStokResponse){
                $stok = $medicineStokResponse->stok;
                $stokResponse = $stok+$req->jumlah;
                $medicineStokResponse->update([
                    'stok' => $stokResponse
                ]);
            }else{
                $new = [
                    'unit_category_id' => $res->unit_category_id,
                    'medicine_id' => $req->medicine_id,
                    'stok' => $req->jumlah
                ];

                MedicineStok::create($new);
            }

            $distribusi = [
                'medicine_distribution_response_id' => $res->id,
                'tanggal' => date('Y-m-d'),
                'status' => 'RETURN',
            ];
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

                $item = MedicineDistribution::find($dis->id);
                $item->update([
                    'no_distribusi' => $no_dis
                ]);
            }
        }

        $res->update([
            'status' => $data['status'],
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
