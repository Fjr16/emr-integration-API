<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\KasirPatient;
use App\Models\RawatJalanPoliPatient;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
     * Display the specified resource.
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

    private function sumTotalPembayaran($kasirPatient){
        $totalJasa = $kasirPatient->billingDoctorConsultations()->sum('tarif') ?? 0;
        $totalTindMedis = $kasirPatient->billingDoctorActions()->sum('sub_total') ?? 0;
        $totalRad = $kasirPatient->billingRadiologies()->sum('sub_total') ?? 0;
        $totalLab = $kasirPatient->billingLaboratories()->sum('sub_total') ?? 0;
        $totalReceipt = $kasirPatient->billingOfMedicineFees()->sum('sub_total') ?? 0;
        $total = $totalJasa + $totalTindMedis + $totalRad + $totalLab + $totalReceipt;

        return $total;
    }


    /**
     * DONE
     */
    public function edit($id)
    {
        $item = KasirPatient::find($id);
        $totalAkhir = $this->sumTotalPembayaran($item);

        return view('pages.pasienPembayaran.show', [
            "title" => "Pembayaran",
            "menu" => "In Patient",
            "item" => $item,
            "totalAkhir" => $totalAkhir,
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
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'status' => 'required|string|in:WAITING,FINISHED',
            ]);

            $item = KasirPatient::findOrFail(decrypt($id));

            $stt = $request->status;
            $totalAkhir = $this->sumTotalPembayaran($item);
            if (!$totalAkhir || $totalAkhir < 0) {
                return back()->with('error', 'Terjadi Kesalahan Saat Menghitung jumlah Tagihan');
            }

            $item->update([
                'status' => $stt,
                'total' => $totalAkhir,
                'user_id' => Auth::user()->id,
            ]);

            DB::commit();
            return redirect()->route('rajal/kasir/pembayaran/index')->with('success', 'Status Berhasil Diperbarui');

        } catch (ModelNotFoundException $mn) {
            DB::rollBack();
            return back()->with('error', $mn->getMessage());
        } catch (Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        } catch (ValidationException $ve){
            DB::rollBack();
            return back()->with('error', $ve->getMessage());
        }
    }
    
    // pengajuan revisi tindakan medis
    public function revisiPatientAction($id)
    {
        $item = RawatJalanPoliPatient::find($id);
        $item->update([
            'actions_ready' => false,
        ]);

        return back()->with([
            'success' => 'Revisi Berhasil Diajukan, Silahkan Menunggu perbaikan sebelum menyelesaikan pembayaran',
        ]);
    }
}
