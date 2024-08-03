<?php

namespace App\Http\Controllers;

use App\Models\RadiologiFormRequest;
use App\Models\RadiologiFormRequestDetail;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RadiologiPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RadiologiFormRequest::whereDate('created_at', date('Y-m-d'))->get();
        return view('pages.pasienRadiologi.index', [
            "title" => "Radiologi",
            "menu" => "Radiologi",
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $today = date('Y-m-d H:i:s');
        $item = RadiologiFormRequest::find($id);
        return view('pages.pasienRadiologi.show', [
            "title" => "Antrian Radiologi",
            "menu" => "Radiologi",
            'item' => $item,
            'today' => $today
        ]);
    }

    // Print per pemeriksaan
    public function show($id)
    {
        $today = date('Y-m-d');
        $item = RadiologiFormRequestDetail::find($id);
        return view('pages.surat.hasilpemeriksaanradiologi', [
            "title" => "Radiologi",
            "menu" => "Radiologi",
            'item' => $item,
            'today' => $today,
        ]);
    }

    // print All
    public function printAll($id)
    {
        $today = date('Y-m-d');
        $rad = RadiologiFormRequest::with('radiologiFormRequestDetails')->find($id);
        return view('pages.surat.hasilpemeriksaanradiologiAll', [
            "title" => "Radiologi",
            "menu" => "Radiologi",
            'rad' => $rad,
            'today' => $today,
        ]);
    }

    public function validasiHasil($id) {
        DB::beginTransaction();
        $errors = [];
        try {
            $item = RadiologiFormRequest::find($id);
            foreach ($item->radiologiFormRequestDetails as $detail) {
                if ($detail->status == 'WAITING') {
                    $errors[] = 'Tidak Dapat Memvalidasi, Hasil Pemeriksaan '. $detail->action->name . ' Belum Diinputkan';
                    continue;
                }

                $detail->update([
                    'status' => 'VALIDATE'
                ]);
            }
            $item->update([
                'validator_rad_id' => Auth::user()->id,
                'status' => 'FINISHED',
            ]);

            if (!empty($errors)) {
                DB::rollBack();
                return back()->with('exceptions', $errors);
            }

            DB::commit();
            return back()->with('success', 'Berhasil Memvalidasi');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        } catch (ModelNotFoundException $mn){
            DB::rollBack();
            return back()->with('error', $mn->getMessage());
        }
    }

    private function updateStatusRadiologi($radiologiFormRequestId, $currentStatus) {
        $itemRadiologiFormRequest = RadiologiFormRequest::find($radiologiFormRequestId);
            $unfinished = RadiologiFormRequestDetail::where('radiologi_form_request_id', $itemRadiologiFormRequest->id)
                                    ->where('status', 'UNVALIDATE')->orWhere('status', 'WAITING')->get();
    
            if ($unfinished->isNotEmpty()) {
                $status = $currentStatus;
                foreach ($unfinished as $stts) {
                    if ($stts->status == 'WAITING') {
                        continue;
                    }elseif($stts->status == 'UNVALIDATE'){
                        $status = 'ONGOING';
                    }
                }
                $itemRadiologiFormRequest->update([
                    'status' => $status,
                ]);
                
            }else{
                $itemRadiologiFormRequest->update([
                    'status' => 'FINISHED',
                    'validator_rad_id' => auth()->user()->id,
                ]);
            }
        
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
        $this->validate($request, [
            'status' => 'required'
        ]);
        //find item radiologi detail
        $item = RadiologiFormRequestDetail::find($id);
        if ($item->radiologiFormRequest->status == 'FINISHED' || $item->status == 'VALIDATE') {
            return back()->with('error', 'Permintaan Telah Selesai, Tidak Dapat Melakukan Perubahan');
        }

        if ($request->status == 'VALIDATE') {
            $item->update(['status' => $request->status]);
            $this->updateStatusRadiologi($item->radiologiFormRequest->id, $item->radiologiFormRequest->status);
        }else{
            $data = $request->validate([
                'image' => 'image',
            ]);
    
            if($request->hasFile('image')){
                $data['image'] = $request->file('image')->store('assets/hasil-radiologi', 'public');
            }
            if (!$item->tanggal_periksa) {
                $data['tanggal_periksa'] = date('Y-m-d H:i:s');
            }
            $data['hasil'] = $request->input('hasil');
            $data['status'] = $request->status;
            $data['user_id'] = Auth::user()->id;
    
            $item->update($data);
            $this->updateStatusRadiologi($item->radiologiFormRequest->id, '');
        }
        return back()->with('success', 'Data Berhasil Diperbarui');
    }
}
