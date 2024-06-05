<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\MedicineStok;
use App\Models\UnitCategory;
use Illuminate\Http\Request;
use App\Models\MedicineDistribution;
use App\Models\MedicineDistributionRequest;
use App\Models\MedicineDistributionResponse;

class MedicineDistributionReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Unit::all();
        return view('pages.distribusiReturn.index', [
            'title' => 'Distribusi Return',
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
        $category = UnitCategory::find($id);
        $data = MedicineDistributionResponse::where('status', 'SELESAI')->where('isAmprahan', false)->whereHas('medicineDistributionRequest', function($query) use ($id){
            $query->where('unit_category_id', $id);
        })->get();
        // ->whereHas('medicineDistribution', function ($distribusi){
        //     $distribusi->where('status', 'RETURN');
        // })
        return view('pages.DistribusiReturn.show', [
            'title' => 'Distribusi Return',
            'menu' => 'Farmasi',
            'category' => $category,
            'data' => $data,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $distribusi = MedicineDistribution::find($id);
        $res = MedicineDistributionResponse::find($distribusi->medicine_distribution_response_id);
        $req = MedicineDistributionRequest::find($res->medicine_distribution_request_id);
        
        $stokReq = MedicineStok::where('unit_category_id', $req->unit_category_id)->first();
        $stokRes = MedicineStok::where('unit_category_id', $res->unit_category_id)->first();
        if($stokReq){
            $newStokReq = $stokReq->stok - $req->jumlah;
            $stokReq->update([
                'stok' => $newStokReq,
            ]);
        } if($stokRes){
            $newStokRes = $stokRes->stok + $req->jumlah;
            $stokRes->update([
                'stok' => $newStokRes,
            ]);
        }

        $distribusi->delete();
        $res->delete();
        $req->delete();
        
        return back()->with('success', 'Berhasil Dihapus');
    }
}
