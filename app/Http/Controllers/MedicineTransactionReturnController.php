<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Medicine;
use App\Models\Supplier;
use App\Models\MedicineStok;
use App\Models\UnitCategory;
use Illuminate\Http\Request;
use App\Models\MedicineTransaction;

class MedicineTransactionReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Supplier::all();
        return view('pages.returnobat.index', [
            "title" => "Return",
            "menu" => "Farmasi",
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
        $faktur = Invoice::find($id);
        $unitCategory = UnitCategory::whereHas('unit', function ($query) {
            $query->where('name', 'gudang');
        })->get();
        $obats = Medicine::all();
        return view('pages.returnobat.create', [
            "title" => "Return",
            "menu" => "Farmasi",
            "faktur" => $faktur,
            "unitCategory" => $unitCategory,
            "obats" => $obats,
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
        foreach ($data['unit_category_id'] as $index => $unitCategoryId) {
            $input['unit_category_id'] = $unitCategoryId;
            $input['medicine_id'] = $data['medicine_id'][$index];
            $input['harga'] = $data['harga'][$index];
            $input['diskon'] = $data['diskon'][$index];
            $input['satuan'] = $data['satuan'][$index];
            $input['jumlah'] = $data['jumlah'][$index];
            $input['no_batch'] = $data['no_batch'][$index];
            $input['production_date'] = $data['production_date'][$index];
            $input['exp_date'] = $data['exp_date'][$index];

            $total_harga = $input['harga']-$input['diskon'];
            $input['invoice_id'] = $id;
            $input['total'] = $total_harga;

            $findStok = MedicineStok::where('medicine_id', $input['medicine_id'])->where('unit_category_id', $unitCategoryId)->first();
            if($findStok){
                $stok = $findStok->stok;
                if($stok < $input['jumlah']){
                    return back()->with('error', 'Maaf!! Stok tidak mencukupi');
                }
                $totalStok = $stok-$input['jumlah'];
                $findStok->update([
                    'stok' => $totalStok
                ]); 
            }else{
                return back()->with('error', 'Maaf!! Barang Tidak tersedia');
            }

            MedicineTransaction::create($input);
            $total = MedicineTransaction::where('invoice_id', $id)->sum('total');
            $item = Invoice::find($id);
            $ppn = $total*$item->ppn/100;
            $total_bayar = $total+$ppn+$item->materai-$item->diskon;
            $item->update([
                'total_kotor' => $total,
                'total_bayar' => $total_bayar
            ]);
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
        // $item = MedicineTransaction::find($id);
        // $unitCategory = UnitCategory::whereHas('unit', function ($query) {
        //     $query->where('name', 'gudang');
        // })->get();
        // $obats = Medicine::all();
        // return view('pages.returnobat.edit', [
        //     "title" => "Return",
        //     "menu" => "Farmasi",
        //     "item" => $item,
        //     "unitCategory" => $unitCategory,
        //     "obats" => $obats,
        // ]);
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
        // $data = $request->all();
        // $total_harga = $request->harga-$request->diskon;
        // $data['total'] = $total_harga;
        // $item = MedicineTransaction::find($id);
        // if($item->update($data)){
        //     $total = MedicineTransaction::where('invoice_id', $item->invoice_id)->sum('total');
        //     $faktur = Invoice::find($item->invoice_id);
        //     $ppn = $total*$faktur->ppn/100;
        //     $total_bayar = $total+$ppn+$faktur->materai-$faktur->diskon;
        //     $faktur->update([
        //         'total_kotor' => $total,
        //         'total_bayar' => $total_bayar
        //     ]);
        // }

        // return redirect()->route('farmasi/obat/return.create', $item->invoice_id)->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = MedicineTransaction::find($id);
        if($item->delete()){
            $total = MedicineTransaction::where('invoice_id', $item->invoice_id)->sum('total');
            $faktur = Invoice::find($item->invoice_id);
            $ppn = $total*$faktur->ppn/100;
            $total_bayar = $total+$ppn+$faktur->materai-$faktur->diskon;
            $faktur->update([
                'total_kotor' => $total,
                'total_bayar' => $total_bayar
            ]);
            $findStok = MedicineStok::where('medicine_id', $item['medicine_id'])->where('unit_category_id', $item['unit_category_id'])->first();
            if($findStok){
                $stok = $findStok->stok;
                $totalStok = $stok+$item['jumlah'];
                $findStok->update([
                    'stok' => $totalStok
                ]); 
            }else{
            return back()->with('error', 'Maaf!! Barang Tidak tersedia');
            }
        }

        return back()->with('success', 'Berhasil Dihapus');
    }
}
