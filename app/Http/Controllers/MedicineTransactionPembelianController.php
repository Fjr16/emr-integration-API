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
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
        $unitSelectedId = Auth::user()->unit->id;
        $units = Unit::all();
        return view('pages.pembelian.create', [
            "title" => "Pembelian",
            "menu" => "Farmasi",
            "obats" => $obats,
            "suppliers" => $suppliers,
            "units" => $units,
            "unitSelectedId" => $unitSelectedId,
        ]);
    }

    private function generateInvoiceNumber($current_no)
    {
        //format TR-24-06-27/01
        $initial = 'TR';
        $currentDate = date('Y-m-d');

        $no = 1;
        if ($current_no) {
            $no = $current_no + 1;
        }

        if (strlen($no) == 1) {
            $number = '0' . $no;
        }else{
            $number = $no;
        }

        $nextNumber = $initial . '-' . $currentDate . '/' . $number;
        return $nextNumber;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'unit_id' => 'required',
                'supplier_id' => 'required',
                'medicine_id' => 'required|array',
                'medicine_id.*' => 'required|integer|exists:medicines,id',
                'jumlah' => 'required|array',
                'jumlah.*' => 'required|integer',
                'harga' => 'required|array',
                'harga.*' => 'required|integer',
                'total_harga' => 'required|array',
                'total_harga.*' => 'required|integer',
                'no_batch' => 'required|array',
                'no_batch.*' => 'required',
                'production_date' => 'required|array',
                'production_date.*' => 'required|date',
                'exp_date' => 'required|array',
                'exp_date.*' => 'required|date',
            ], [
                'unit_id.required' => 'Unit Tidak Boleh Kosong',
                'supplier_id.required' => 'Supplier Tidak Boleh Kosong',
                'medicine_id.required' => 'Nama Obat Tidak Boleh Kosong',
                'medicine_id.*.required' => 'Tidak Boleh satu pun Nama Obat Yang Kosong',
                'medicine_id.*.integer' => 'Nama Obat Tidak valid',
                'medicine_id.*.exists' => 'Nama Obat dengan ID {1} Tidak Ditemukan, mohon pilih dengan benar',
                'jumlah.required' => 'Jumlah obat Tidak Boleh Kosong',
                'jumlah.array' => 'Jumlah obat Tidak Boleh Kosong',
                'jumlah.*.required' => 'Jumlah obat dengan ID {1} Tidak Boleh Kosong',
                'jumlah.*.integer' => 'Jumlah obat tidak valid',
                'harga.required' => 'Harga obat Tidak Boleh Kosong',
                'harga.array' => 'Harga obat Tidak Boleh Kosong',
                'harga.*.required' => 'Harga obat dengan ID {1} Tidak Boleh Kosong',
                'harga.*.integer' => 'Harga obat tidak valid',
                'total_harga.required' => 'Total Harga obat Tidak Boleh Kosong',
                'total_harga.array' => 'Total Harga obat Tidak Boleh Kosong',
                'total_harga.*.required' => 'Total Harga obat dengan ID {1} Tidak Boleh Kosong',
                'total_harga.*.integer' => 'Total Harga obat tidak valid',
                'no_batch.required' => 'Nomor Batch obat Tidak Boleh Kosong',
                'no_batch.array' => 'Nomor Batch obat Tidak Boleh Kosong',
                'no_batch.*.required' => 'Nomor Batch obat dengan ID {1} Tidak Boleh Kosong',
                'production_date.required' => 'Production Date obat Tidak Boleh Kosong',
                'production_date.array' => 'Production Date obat Tidak Boleh Kosong',
                'production_date.*.required' => 'Production Date obat dengan ID {1} Tidak Boleh Kosong',
                'production_date.*.date' => 'Production Date obat Tidak Valid',
                'exp_date.required' => 'Expired Date obat Tidak Boleh Kosong',
                'exp_date.array' => 'Expired Date obat Tidak Boleh Kosong',
                'exp_date.*.required' => 'Expired Date obat dengan ID {1} Tidak Boleh Kosong',
                'exp_date.*.date' => 'Expired Date obat Tidak Valid',
            ]);
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
        
        //generate faktur number
        $lastPembelianNumber = Invoice::whereDate('created_at', date('Y-m-d'))->orderBy('no_faktur', 'desc')->pluck('no_faktur')->first();
        if ($lastPembelianNumber) {
            $arrSplit = explode('/', $lastPembelianNumber);
            $lastPembelianNumber = $arrSplit[1];
        }
        $nextInvoiceNumber = $this->generateInvoiceNumber($lastPembelianNumber ?? 0);

        DB::beginTransaction();
        $errors = [];
        try {
            // create faktur
            $item = Invoice::create([
                'supplier_id' => $request->supplier_id,
                'no_faktur' => $nextInvoiceNumber,
                'tanggal' => $request->input('tanggal') ?? date('Y-m-d'),
                'total_kotor' => $request->input('total_kotor') ?? 0,
                'total_pajak' => $request->input('ppn') ?? 0,
                'total_diskon' => $request->input('diskon_faktur') ?? 0,
                'total_bayar' => $request->input('total_bayar') ?? 0,
                'status' => 'BELI',
            ]);
    
            $unitId = $request->unit_id;
            foreach ($request->medicine_id as $index => $medicineId) {
                $medicine = Medicine::findOrFail($medicineId);
    
                $input['invoice_id'] = $item->id;
                $input['unit_id'] = $unitId;
                $input['medicine_id'] = $medicineId;
                $input['jumlah'] = $request->jumlah[$index];
                $input['satuan'] = $medicine->small_unit ?? '';
                $input['harga'] = $request->harga[$index];
                $input['total_harga'] = $request->total_harga[$index];
                $input['no_batch'] = $request->no_batch[$index];
                $input['production_date'] = $request->production_date[$index];
                $input['exp_date'] = $request->exp_date[$index];
                $input['pajak'] = $request->pajak[$index];
                $input['diskon'] = $request->diskon[$index];
                if($new = MedicineTransaction::create($input)){
                    $findStok = MedicineStok::where('medicine_id', $new->medicine_id)->where('unit_id', $unitId)
                                ->where('no_batch', $new->no_batch)->first();
                    if($findStok){
                        $stok = $findStok->stok;
                        $totalStok = $stok+$new->jumlah;
    
                        $findStok->update([
                            'stok' => $totalStok,
                        ]); 
                    }else{
                         //pengaturan harga jual didapat dari harga pembelian per obat dibagi dengan jumlah per obat pada tabel medicine transaction
                        $diskonSatuan = $new->diskon/$new->jumlah;
                        $pajakSatuan = $new->pajak/$new->jumlah;
                        $totalStok = $new->jumlah;
                        $medicineStok = [
                            'unit_id' => $unitId,
                            'medicine_id' => $new->medicine_id,
                            'stok' => $totalStok,
                            'base_harga' => $new->harga,
                            'diskon_satuan' => $diskonSatuan,
                            'pajak_satuan' => $pajakSatuan,
                            'no_batch' => $new->no_batch,
                            'production_date' => $new->production_date,
                            'exp_date' => $new->exp_date,
                            'satuan' => $new->satuan ?? '',
                        ];
                        MedicineStok::create($medicineStok);
                    }
                }
                if ($request->isUpdateHarga[$index]) {
                    $medicine->update([
                        'base_harga' => $new->harga,
                    ]);
                }
            }

            if (!empty($errors)) {
                DB::rollBack();
                return back()->with('errors', $errors);
            }

            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->with('error', 'Data Tidak Ditemukan: ' . $e->getMessage());
        }catch (Exception $e) {
            DB::rollBack();
            return back()->with('errors', $e->getMessage());
        }

        return redirect()->route('farmasi/obat/pembelian.index')->with('success', 'Pembelian Berhasil');
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
