<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicineDistributionDetail;
use App\Models\MedicineStok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicineDistributionRequest;
use App\Models\MedicineDistributionResponse;

class MedicineDistributionResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_id = Auth::user()->unit_category_id;
        $data = MedicineDistributionResponse::where('unit_category_id', $category_id)->where('isAmprahan', true)->get();
        return view('pages.distribusiresponse.index', [
            "title" => "Distribusi Response",
            "menu" => "Farmasi",
            "data" => $data,
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
        $item = MedicineDistributionResponse::find($id);
        return view('pages.distribusiresponse.faktur', [
            "title" => "Faktur",
            "menu" => "Farmasi",
            "item" => $item,
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
        $data = $request->all();
        $item = MedicineDistributionRequest::find($id);
        if ($data['status'] == 'DITERIMA') {
            $item = MedicineDistributionResponse::find($id);
            foreach($data['detail_id'] as $index => $id){
                $medicineDetail = MedicineDistributionDetail::find($id);
                $stokAll = $medicineDetail->medicine->medicineStoks->where('unit_category_id', $item->unit_category_id)->sum('stok');
                if(!$stokAll || $stokAll < $data['jumlah'][$index]){
                    return redirect()->route('farmasi/obat/distribusi/response.index')->with('error', 'Maaf Stok Obat '. $medicineDetail->medicine->name .' Tidak Mencukupi');
                }

                $jumlah = $data['jumlah'][$index];
                $medicineStoks = $medicineDetail->medicine->medicineStoks()->where('unit_category_id', $item->unit_category_id)->where('stok', '>', 0)->orderBy('exp_date', 'asc')->get();
                foreach ($medicineStoks as $medicineStok) {
                    if($medicineStok->stok >= $jumlah){
                        $medicineDetail->update([
                            'medicine_stok_id' => $medicineStok->id,
                            'jumlah' => $jumlah,
                        ]);
                    }else{
                        $jumlah = $data['jumlah'][$index] - $medicineStok->stok;
                        MedicineDistributionDetail::create([
                            'medicine_distribution_request_id' => $medicineDetail->medicine_distribution_request_id,
                            'medicine_id' => $medicineDetail->medicine_id,
                            'medicine_stok_id' => $medicineStok->id,
                            'satuan' => $medicineDetail->satuan,
                            'jumlah' => $medicineStok->stok,
                        ]);
                    }
                }
            }
            $req = MedicineDistributionRequest::find($item->medicine_distribution_request_id);
            $req->update([
                'status' => $data['status']
            ]);
            return redirect()->route('farmasi/obat/distribusi/response.index')->with('success', 'Berhasil Diperbarui');
        } elseif($data['status'] == 'EDIT') {
            $response_id = $item->medicineDistributionResponse->id;
            $item = MedicineDistributionResponse::find($response_id);
            return view('pages.distribusiresponse.edit', [
                "title" => "Distribusi Response",
                "menu" => "Farmasi",
                "item" => $item,
            ]);
        } elseif($data['status'] == 'BATAL') {
            $item->update([
                'status' => $data['status']
            ]);
            $res = MedicineDistributionResponse::find($item->medicineDistributionResponse->id);
            $res->update([
                'status' => $data['status']
            ]);

            return back()->with('success', 'Berhasil Diperbarui');
        } elseif($data['status'] == 'DITOLAK') {
            $item->update([
                'status' => $data['status']
            ]);
            $res = MedicineDistributionResponse::find($item->medicineDistributionResponse->id);
            $res->update([
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
