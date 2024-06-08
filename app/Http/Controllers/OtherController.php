<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OtherController extends Controller
{
    public function getTtdUser(Request $request){
        try {
            $item = User::findOrFail($request->user_id);
            if (Hash::check($request->password, $item->password)) {
                return response()->json($item->paraf);
            }else{
                throw new Exception("Terjadi Kesalahan, Mohon Periksa Kembali Password Anda", 500);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Terjadi Kesalahan, User Tidak Ditemukan', 404]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
    // public function getTtd(Request $request){
    //     try {
    //         $item = User::findOrFail($request->user_id);
    //         if (Hash::check($request->password, $item->password)) {
    //             return response()->json($item->paraf);
    //         }else{
    //             throw new Exception("Terjadi Kesalahan, Mohon Periksa Kembali Password Anda", 500);
    //         }
    //     } catch (ModelNotFoundException $e) {
    //         return response()->json(['error' => 'Terjadi Kesalahan, User Tidak Ditemukan', 404]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 403);
    //     }
    // }
}
