<?php

namespace App\Http\Controllers;

use App\Models\KasirPatient;
use App\Models\Queue;
use Illuminate\Http\Request;
use App\Models\RawatJalanPoliPatient;
use Illuminate\Validation\ValidationException;

class QueueConfirmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = Queue::find($id);
        return view('pages.antrian-modal.create', [
            'title' => 'Entri Antrian',
            'menu' => 'Antrian',
            'item' => $item,
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
        $status = $request->input('status_antrian');
        $item = Queue::find($id);
        $item->update([
            'status_antrian' => $status,
        ]);

        return back()->with('success', 'Berhasil Diperbarui');
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
     * DONE, Konfirmasi Registrasi Ulang Antrian sebelum disimpan
     */
    public function edit($id)
    {
        $item = Queue::find($id);
        return view('pages.antrian-modal.edit', [
            'title' => 'Daftar Antrian',
            'menu' => 'Antrian',
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        try {
            $item = Queue::findOrFail($id);
            if ($item->status_antrian == 'WAITING') {
                RawatJalanPoliPatient::create([
                    'queue_id' => $item->id,
                    'status' => 'WAITING'
                ]);
    
                $item->update([
                    'status_antrian' => 'ARRIVED',
                ]);
                // buat main table billing kasir patient
                KasirPatient::create([
                    'queue_id' => $item->id,
                    'status' => 'WAITING',
                ]);
    
                return redirect()->route('rajal/general/consent.create', $id);
            }
        } catch (ValidationException $th) {
            return back()->with('error', $th->getMessage());
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
