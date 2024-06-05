<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InvoiceReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $supplier = Supplier::find($id);
        $data = Invoice::where('supplier_id', $id)->where('status', 'RETURN')->get();
        return view('pages.returnFaktur.index', [
            'title' => 'Return',
            'menu' => 'Farmasi',
            'data' => $data,
            'supplier' => $supplier
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $supplier = Supplier::find($id);
        $tgl = date('Y-m-d');
        return view('pages.returnFaktur.create', [
            'title' => 'Return',
            'menu' => 'Farmasi',
            'supplier' => $supplier,
            'tgl' => $tgl
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
        $data['supplier_id'] = $id;
        $data['status'] = 'RETURN';
        $faktur = Invoice::create($data);

        if(Str::length($faktur->id) == 1){
            $nofaktur = mt_rand(00000,99999).$faktur->id;
        }elseif(Str::length($faktur->id) == 2){
            $randomNumber = mt_rand(0000,9999);
            $nofaktur = $randomNumber.$faktur->id;
        }elseif(Str::length($faktur->id) == 3){
            $randomNumber = mt_rand(000,999);
            $nofaktur = $randomNumber.$faktur->id;
        }elseif(Str::length($faktur->id) == 4){
            $randomNumber = mt_rand(00,99);
            $nofaktur = $randomNumber.$faktur->id;
        }elseif(Str::length($faktur->id) == 5){
            $randomNumber = mt_rand(0,9);
            $nofaktur = $randomNumber.$faktur->id;
        }elseif(Str::length($faktur->id) == 6){
            $nofaktur = $faktur->id;
        }elseif(Str::length($faktur->id) == 7){
            return 'OVERFLOW';
        }

        $item = Invoice::find($faktur->id);
        $item->update([
            'no_faktur' => $nofaktur
        ]);
        
        return redirect()->route('farmasi/obat/return/faktur.index', $id)->with('success', 'Berhasil Ditambahkan');
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
        return view('pages.returnFaktur.edit', [
            "title" => "Return",
            "menu" => "Farmasi",
            "item" => $item,
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
        $data = $request->all();
        $item = Invoice::find($id);
        if($item->update($data)){
            if(count($item->medicineTransactions)!=0){
                $total = $item->medicineTransactions->sum('total');
                $ppn = $total*$item->ppn/100;
                $total_bayar = $total+$ppn+$item->materai-$item->diskon;
                $item->update([
                    'total_kotor' => $total,
                    'total_bayar' => $total_bayar
                ]);
            }
        }
        
        $supplier_id = $request->supplier_id;
        return redirect()->route('farmasi/obat/return/faktur.index', $supplier_id)->with('success', 'Berhasil Diperbarui');
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
            return back()->with('danger', 'Tidak Dapat Dihapus!! Karena Terdapat Data Transaksi Obat Dalam Faktur');
        }
        $item->delete();

        return back()->with('success', 'Berhasil Dihapus');
    }
}
