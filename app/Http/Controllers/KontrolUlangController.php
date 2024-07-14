<?php

namespace App\Http\Controllers;

use App\Models\PlanControlPatient;
use Exception;
use App\Models\User;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KontrolUlangController extends Controller
{
    public function update(Request $request, $id)
    {
        $item = Queue::find($id);
        $ttd = null;
        if (auth()->user()->id === $item->dpjp->id) {
            $ttd = $item->dpjp->paraf;
        }
        if ($request->isKontrol) {
            if (!$request->tgl_kontrol || $request->tgl_kontrol <= date('Y-m-d')) {
                return back()->with([
                    'error' => 'Tanggal Kontrol Tidak Boleh Kosong Dan Kontrol Tidak Dapat Dilakukan Hari Ini Atau Hari Sebelumnya',
                    'btn' => 'kontrol-ulang',
                ]);
            }
            if ($item->planControlPatient) {
                $item->planControlPatient()->update([
                    'tgl_kontrol' => $request->tgl_kontrol,
                    'ttd' => $ttd,
                ]);
            }else{
                PlanControlPatient::create([
                    'queue_id' => $item->id,
                    'user_id' => auth()->user()->id,
                    'tgl_kontrol' => $request->tgl_kontrol,
                    'ttd' => $ttd,
                ]);
            }
        }
        return back()->with([
            'success' => 'Jadwal Kontrol Berhasil Diperbarui',
            'btn' => 'kontrol-ulang',
        ]);
    }
    public function destroy($id)
    {
        $item = PlanControlPatient::find($id);
        if ($item && $item->status != 'FINISHED') {
            $item->delete();   
            return back()->with([
                'success' => 'Data Kontrol berhasil Dibatalkan / Dihapus',
                'btn' => 'kontrol-ulang',
            ]);
        }else{
            return back()->with([
                'error' => 'Data Kontrol Tidak Dapat Dibatalkan,  Karena Status Telah Selesai atau Data Tidak Ditemukan',
                'btn' => 'kontrol-ulang',
            ]);
        }
    }

    public function show($id)
    {
        $item = Queue::find($id);
        return view('pages.surat.kontro-ulang', [
            "title" => "Surat Bukti Pelayanan Kesehatan",
            "menu" => "In Patient",
            "item" => $item,
        ]);
    }

    public function getTtd(Request $request)
    {

        try {
            $item = User::findOrFail($request->user_id);
            if (Hash::check($request->password, $item->password)) {
                return response()->json($item->paraf);
            } else {
                throw new Exception("Terjadi Kesalahan, Mohon Periksa Kembali Password Yang Anda Masukkan", 500);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Terjadi Kesalahan, User Tidak Ditemukan'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
}
