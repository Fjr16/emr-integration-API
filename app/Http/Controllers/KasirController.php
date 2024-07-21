<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\KasirPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('filter')) {
            $filter = new DateTime(request('filter'));
        }
        $filterDate = $filter ?? now();
        $data = KasirPatient::whereDate('created_at', $filterDate)->latest()->get();
        return view('pages.pasienPembayaran.index', [
            "title" => "Pembayaran",
            "menu" => "In Patient",
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
        $item = KasirPatient::find($id);
        return view('pages.surat.kwitansikasir', [
            "title" => "Pembayaran",
            "menu" => "In Patient",
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
        $item = KasirPatient::find($id);
        return view('pages.pasienPembayaran.show', [
            "title" => "Pembayaran",
            "menu" => "In Patient",
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
        $item = KasirPatient::find($id);
        $stt = $request->input('status');
        
        $item->update([
            'status' => $stt,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('rajal/kasir/pembayaran/index')->with('success', 'Status Berhasil Diperbarui');
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
