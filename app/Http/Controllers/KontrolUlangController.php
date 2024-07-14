<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KontrolUlangController extends Controller
{
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
