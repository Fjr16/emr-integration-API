<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Unit;

class MedicineStokController extends Controller
{
    public function index()
    {
        $data = Unit::all();
        return view('pages.stock.index', [
            "title" => "Stock Obat",
            "menu" => "Farmasi",
            'data' => $data
        ]);
    }
    public function all()
    {
        $data = Medicine::all();
        return view('pages.totalstockobat.index', [
            "title" => "Total Stock Obat",
            "menu" => "Farmasi",
            'data' => $data
        ]);
    }
    public function show($id)
    {
        $item = Unit::find($id);
        return view('pages.stockdetail.index', [
            "title" => "Stock Obat",
            "menu" => "Farmasi",
            'item' => $item
        ]);

    }
}
