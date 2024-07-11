<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Medicine;
use App\Models\Supplier;
use Illuminate\Support\Str;
use App\Models\MedicineStok;
use Illuminate\Http\Request;
use App\Models\MedicineTransaction;
use App\Models\Unit;

class MedicineTransactionPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Invoice::where('status', 'BELI')->get();
        return view('pages.pembelian.index', [
            "title" => "Pembelian",
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
        $suppliers = Supplier::all();
        $obats = Medicine::all();
        $units = Unit::where('name', 'like', '%'.'Gudang'.'%')->get();
        return view('pages.pembelian.create', [
            "title" => "Pembelian",
            "menu" => "Farmasi",
            "obats" => $obats,
            "suppliers" => $suppliers,
            "units" => $units,
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
        $this->validate($request, [
            'unit_id' => 'required',
        ]);

        $nextId = Invoice::latest()->pluck('id')->first() + 1;
        if(Str::length($nextId) == 1){
            $nofaktur = mt_rand(00000,99999).$nextId;
        }elseif(Str::length($nextId) == 2){
            $nofaktur = mt_rand(0000,9999).$nextId;
        }elseif(Str::length($nextId) == 3){
            $nofaktur = mt_rand(000,999).$nextId;
        }elseif(Str::length($nextId) == 4){
            $nofaktur = mt_rand(00,99).$nextId;
        }elseif(Str::length($nextId) == 5){
            $nofaktur = mt_rand(0,9).$nextId;
        }elseif(Str::length($nextId) == 6){
            $nofaktur = $nextId;
        }elseif(Str::length($nextId) == 7){
            return 'OVERFLOW';
        }
        // create faktur
        $item = Invoice::create([
            'supplier_id' => $request->input('supplier_id'),
            'no_faktur' => $nofaktur,
            'tanggal' => $request->input('tanggal'),
            'total_kotor' => $request->input('total_kotor'),
            'total_pajak' => $request->input('ppn'),
            'total_diskon' => $request->input('diskon_faktur'),
            'total_bayar' => $request->input('total_bayar'),
            'status' => 'BELI',
        ]);

        $data = $request->all();
        $unitId = $request->unit_id;
        foreach ($data['medicine_id'] as $index => $medicineId) {
            $input['invoice_id'] = $item->id;
            $input['unit_id'] = $unitId;
            $input['medicine_id'] = $medicineId;
            $input['jumlah'] = $data['jumlah'][$index];
            $input['satuan'] = $data['satuan'][$index] ?? '';
            $input['harga'] = $data['harga'][$index];
            $input['total_harga'] = $data['total_harga'][$index];
            $input['no_batch'] = $data['no_batch'][$index];
            $input['production_date'] = $data['production_date'][$index];
            $input['exp_date'] = $data['exp_date'][$index];
            $input['pajak'] = $data['pajak'][$index];
            $input['diskon'] = $data['diskon'][$index];
            if($new = MedicineTransaction::create($input)){
                $findStok = MedicineStok::where('medicine_id', $new['medicine_id'])->where('unit_id', $unitId)
                            ->where('no_batch', $new['no_batch'])->where('satuan', $new['satuan'])->first();
                if($findStok){
                    $stok = $findStok->stok;
                    $totalStok = $stok+$new['jumlah'];

                    $findStok->update([
                        'stok' => $totalStok,
                    ]); 
                }else{
                     //pengaturan harga jual didapat dari harga pembelian per obat dibagi dengan jumlah per obat pada tabel medicine transaction
                    $diskonSatuan = $new['diskon']/$new['jumlah'];
                    $pajakSatuan = $new['pajak']/$new['jumlah'];
                    $totalStok = $new['jumlah'];
                    $medicineStok = [
                        'unit_id' => $unitId,
                        'medicine_id' => $new['medicine_id'],
                        'stok' => $totalStok,
                        'satuan' => $new['satuan'] ?? '',
                        'base_harga' => $new['harga'],
                        'diskon_satuan' => $diskonSatuan,
                        'pajak_satuan' => $pajakSatuan,
                        'no_batch' => $new['no_batch'],
                        'production_date' => $new['production_date'],
                        'exp_date' => $new['exp_date'],

                    ];
                    MedicineStok::create($medicineStok);
                }
            
            }
        }
        
        return redirect()->route('farmasi/obat/pembelian.index')->with('success', 'Berhasil Ditambahkan');
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
        $item = Invoice::find($id);
        $suppliers = Supplier::all();
        $obats = Medicine::all();
        return view('pages.pembelian.edit', [
            "title" => "Pembelian",
            "menu" => "Farmasi",
            "item" => $item,
            "obats" => $obats,
            "suppliers" => $suppliers,
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
        // $item = Invoice::find($id);
        // // create faktur
        // $item->update([
        //     'supplier_id' => $request->input('supplier_id'),
        //     'tanggal' => $request->input('tanggal'),
        //     'total_kotor' => $request->input('total_kotor'),
        //     'total_pajak' => $request->input('ppn'),
        //     'total_diskon' => $request->input('diskon_faktur'),
        //     'total_bayar' => $request->input('total_bayar'),
        //     'status' => 'BELI',
        // ]);

        // $data = $request->all();
        // $unit = Unit::where('name', 'gudang')->first();
        // foreach ($data['medicine_id'] as $index => $medicineId) {
        //     $input['invoice_id'] = $item->id;
        //     $input['unit_id'] = $unit->id;
        //     $input['medicine_id'] = $medicineId;
        //     $input['jumlah'] = $data['jumlah'][$index];
        //     $input['satuan'] = $data['satuan'][$index];
        //     $input['harga'] = $data['harga'][$index];
        //     $input['total_harga'] = $data['total_harga'][$index];
        //     $input['no_batch'] = $data['no_batch'][$index];
        //     $input['production_date'] = $data['production_date'][$index];
        //     $input['exp_date'] = $data['exp_date'][$index];
        //     $input['pajak'] = $data['pajak'][$index];
        //     $input['diskon'] = $data['diskon'][$index];
        //     if($new = MedicineTransaction::create($input)){
        //         $findStok = MedicineStok::where('medicine_id', $new['medicine_id'])->where('unit_id', $unit->id)
        //                     ->where('no_batch', $new['no_batch'])->where('satuan', $new['satuan'])->first();
        //         if($findStok){
        //             $stok = $findStok->stok;
        //             $totalStok = $stok+$new['jumlah'];

        //             $findStok->update([
        //                 'stok' => $totalStok,
        //             ]); 
        //         }else{
        //              //pengaturan harga jual didapat dari harga pembelian per obat dibagi dengan jumlah per obat pada tabel medicine transaction
        //             $diskonSatuan = $new['diskon']/$new['jumlah'];
        //             $pajakSatuan = $new['pajak']/$new['jumlah'];
        //             $totalStok = $new['jumlah'];
        //             $medicineStok = [
        //                 'unit_id' => $unit->id,
        //                 'medicine_id' => $new['medicine_id'],
        //                 'stok' => $totalStok,
        //                 'satuan' => $new['satuan'],
        //                 'base_harga' => $new['harga'],
        //                 'diskon_satuan' => $diskonSatuan,
        //                 'pajak_satuan' => $pajakSatuan,
        //                 'no_batch' => $new['no_batch'],
        //                 'production_date' => $new['production_date'],
        //                 'exp_date' => $new['exp_date'],

        //             ];
        //             MedicineStok::create($medicineStok);
        //         }
            
        //     }
        // }
        
        // return redirect()->route('farmasi/obat/pembelian.index')->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Invoice::find($id);
        if(count($item->medicineTransactions)!=0){
            $data = MedicineTransaction::where('invoice_id', $item->id)->get();
            foreach ($data as $medicineTran) {
                $findStok = MedicineStok::where('medicine_id', $medicineTran->medicine_id)->where('unit_id', $medicineTran->unit_id)->first();
                if($findStok){
                    $stok = $findStok->stok;
                    $totalStok = $stok-$medicineTran->jumlah;
                    
                    if($totalStok <= 0){
                        $totalStok = '0';
                    }

                    $findStok->update([
                        'stok' => $totalStok
                    ]); 
                }
                $medicineTran->delete();
            }
        }

        $item->delete();

        return back()->with('success', 'Berhasil Dihapus');
    }
}
