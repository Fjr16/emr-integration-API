<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Medicine;
use Illuminate\Support\Str;
use App\Models\MedicineStok;
use App\Models\UnitCategory;
use Illuminate\Http\Request;
use App\Models\MedicineDistribution;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicineDistributionRequest;
use App\Models\MedicineDistributionResponse;
use App\Models\UnitConversionMaster;

class MedicineDistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Unit::all();
        return view('pages.distribusiObat.index', [
            'title' => 'Distribusi',
            'menu' => 'Farmasi',
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
        $tgl = date('Y-m-d');
        $category = UnitCategory::find($id);
        $medicines = Medicine::all();
        $satuans = UnitConversionMaster::all();
        return view('pages.distribusiObat.create', [
            'title' => 'Distribusi',
            'menu' => 'Farmasi',
            'category' => $category,
            'medicines' => $medicines,
            'tgl' => $tgl,
            'satuans' => $satuans,
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
        //check stok
        $medicineStokResponse = MedicineStok::where('unit_category_id', Auth::user()->unit_category_id)->where('medicine_id', $request->medicine_id)->first();
        if($medicineStokResponse){
            $stok = $medicineStokResponse->stok;
            if($stok < $request['jumlah']){
                return back()->with('error', 'Maaf!! Stok Tidak Mencukupi');
            }
            $stokResponse = $stok-$request->jumlah;
            $medicineStokResponse->update([
                'stok' => $stokResponse
            ]);
        }else{
            return back()->with('error', 'Maaf!! Data Stok Obat Tidak Tersedia, Silahkan Lakukan Pembelian Terlebih Dahulu');
        }

        //create request
        $distribusi_request = [
            'unit_category_id' => $request->unit_category_id,
            'medicine_id' => $request->medicine_id,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'status' => 'SELESAI',
        ];
        if($req = MedicineDistributionRequest::create($distribusi_request)){

            //update or create stok request
            $medicineStokRequest = MedicineStok::where('unit_category_id', $req->unit_category_id)->where('medicine_id', $req->medicine_id)->first();
            if($medicineStokRequest){
                $stok = $medicineStokRequest->stok;
                $stokRequest = $stok+$req->jumlah;
                $medicineStokRequest->update([
                    'stok' => $stokRequest
                ]);
            }else{
                $new = [
                    'unit_category_id' => $req->unit_category_id,
                    'medicine_id' => $req->medicine_id,
                    'stok' => $req->jumlah
                ];

                MedicineStok::create($new);
            }

            $distribusi_response = [
                'unit_category_id' => Auth::user()->unit_category_id,
                'medicine_distribution_request_id' => $req->id,
                'harga' => $request->harga,
                'no_batch' => $request->no_batch,
                'production_date' => $request->production_date,
                'exp_date' => $request->exp_date,
                'status' => 'SELESAI',
                'isAmprahan' => 1,
            ];

            //create response
            if($res = MedicineDistributionResponse::create($distribusi_response)){
                $distribusi = [
                    'medicine_distribution_response_id' => $res->id,
                    'tanggal' => $request->tanggal,
                    'status' => 'AMPRAHAN',
                ];
                //create distribusi
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
                    
                    return redirect()->route('farmasi/obat/distribusi.show', $request->unit_category_id)->with('success', 'Berhasil Ditambahkan');
                }
            }
        }
        return back()->with('error', 'Gagal Disimpan, Mohon Coba Kembali');
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
        $data = MedicineDistributionResponse::where('status', 'SELESAI')->where('isAmprahan', true)->whereHas('medicineDistributionRequest', function($query) use ($id){
            $query->where('unit_category_id', $id);
        })->get();
        // ->whereHas('medicineDistribution', function ($distribusi){
        //     $distribusi->where('status', 'RETURN');
        // })
        return view('pages.distribusiObat.show', [
            'title' => 'Distribusi',
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
