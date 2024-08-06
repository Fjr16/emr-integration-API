<?php

namespace App\Http\Controllers;

use App\Models\BillingDoctorConsultation;
use App\Models\KasirPatient;
use App\Models\Queue;
use Illuminate\Http\Request;
use App\Models\RawatJalanPoliPatient;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class QueueConfirmController extends Controller
{
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
        DB::beginTransaction();
        $errors = [];
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
                if (!$item->dpjp) {
                    $errors[] = 'Data Dokter terkait Tidak Ditemukan, mohon periksa kembali master data dokter';
                }
                if (!$item->dpjp->tarif || $item->dpjp->tarif <= 0) {
                    // $errors[] = 'Tarif Untuk Dokter '. $item->dpjp->name . ' Tidak Ditemukan, mohon periksa kembali master data dokter';
                    $errors[] = 'Tarif Dokter harus Antara Rp 0.01 hingga 99.999.999,99, mohon periksa kembali master data dokter';
                }
                
                $kp = KasirPatient::create([
                    'queue_id' => $item->id,
                    'status' => 'WAITING',
                ]);
                BillingDoctorConsultation::create([
                    'kasir_patient_id' => $kp->id,
                    'user_id' => $item->dpjp->id,
                    'kode_dokter' => $item->dpjp->staff_id ?? '',
                    'nama_dokter' => $item->dpjp->name ?? '',
                    'nama_poli' => $item->dpjp->poliklinik->name ?? '',
                    'tarif' => $item->dpjp->tarif,
                ]);

                if (!empty($errors)) {
                    DB::rollBack();
                    return back()->with('errors', $errors);
                }
    
                DB::commit();
                return redirect()->route('rajal/general/consent.create', $id);
            }
        } catch (ValidationException $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        } catch (Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
