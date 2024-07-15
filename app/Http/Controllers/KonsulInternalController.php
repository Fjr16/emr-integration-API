<?php

namespace App\Http\Controllers;

use App\Models\KonsulInternal;
use App\Models\Queue;
use Illuminate\Http\Request;

class KonsulInternalController extends Controller
{
    public function update(Request $request, $id) {
        try {
            $this->validate($request, [
                'dokter_id' => 'required|integer',
                'keterangan_konsul' => 'required',
            ]);
            $item = Queue::find($id);
            $data = [
                'queue_id' => $item->id,
                'user_id' => auth()->user()->id,
                'dokter_konsul_id' => $request->dokter_id,
                'permintaan_konsul' => $request->keterangan_konsul,
            ];
            if (auth()->user()->id == $item->dpjp->id) {
                $data['ttd_user'] = $item->dpjp->paraf;
            }
    
            if ($item->konsulInternal) {
                $item->konsulInternal->update($data);
            }else{
                KonsulInternal::create($data);
            }
    
            return back()->with([
                'success' => 'Data Konsul Berhasil Disimpan',
                'btn' => 'finished',
                'finished' => 'konsul-internal',
            ]);
        } catch (\Illuminate\Validation\ValidationException $th) {
            return back()->with([
                'error' => 'Gagal !! Data Konsul Tidak Dapat Disimpan, Karena Data Tidak Lengkap',
                'btn' => 'finished',
                'finished' => 'konsul-internal',
            ]);
        }
    }

    public function destroy($id){
        $item = KonsulInternal::find($id);
        if ($item->status == 'FINISHED' || $item->status == 'ACCEPTED') {
            return back()->with([
                'error' => 'Gagal !! Tidak Dapat menghapus Permintaan Konsul, Karena Konsul Telah Diterima atau Selesai',
                'btn' => 'finished',
                'finished' => 'konsul-internal',
            ]);
        }
        $item->delete();

        return back()->with([
            'success' => 'Data Konsul Berhasil Dihapus',
            'btn' => 'finished',
            'finished' => 'konsul-internal',
        ]);
    }
}
