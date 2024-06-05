<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\BedroomRate;
use Illuminate\Http\Request;

class BedroomRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $bed = Bed::findOrFail($id);
        return view('pages.tarifkamar.index', [
            "title" => "Ranjang",
            "menu" => "Setting",
            "bed" => $bed,
        ]);     
    }

    public function update(Request $request, $id)
    {
        $item = BedroomRate::find($id);
        $data = $request->all();

        $item->update($data);
        return back()->with('success', 'Tarif Berhasil Diperbarui');
    }

}
