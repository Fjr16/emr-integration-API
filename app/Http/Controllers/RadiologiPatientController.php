<?php

namespace App\Http\Controllers;

use App\Models\ChangeLog;
use App\Models\RadiologiFormRequestMaster;
use App\Models\RadiologiPatient;
use App\Models\RadiologiPatientRequestDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RadiologiPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date('Y-m-d');
        $data = RadiologiPatient::whereDate('created_at', $today)->get();
        // $data = RadiologiPatient::where('status', 'WAITING')->get();
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
        $item = RadiologiPatient::find($id);
        return view('pages.pasienRadiologi.show', [
            "title" => "Antrian Radiologi",
            "menu" => "Radiologi",
            'item' => $item
        ]);
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
        $today = date('Y-m-d');
        $item = RadiologiPatientRequestDetail::find($id);
        return view('pages.surat.hasilpemeriksaanradiologi', [
            "title" => "Radiologi",
            "menu" => "Radiologi",
            'item' => $item,
            'today' => $today,
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
         //no reg lab
         $format = 'RO';
         $currentYear = date('y');
         $currentMonth = date('m');
         $lastItem = RadiologiPatientRequestDetail::where('status', 'SELESAI')->latest()->first();
         $findUsg = RadiologiFormRequestMaster::whereRaw('UPPER(name) = ?', ['USG'])->first();
         if($findUsg){
            if($findUsg->id == $lastItem->radiologiFormRequestDetail->radiologi_form_request_master_id){
                $lastItem = RadiologiPatientRequestDetail::where('status', 'SELESAI')->whereHas('radiologiFormRequestDetail', function($detail) use ($findUsg){
                    $detail->where('radiologi_form_request_master_id', $findUsg->id);
                })->latest()->first();
                $format = 'U';
            }
         }
         if($lastItem){
             $arr = explode('-', $lastItem->nomor);
             $arr2 = explode(' ', $arr[0]);
             $lastItemYear = $arr2[1] ?? '';
             $lastItemMonth = $arr[1] ?? '';
             $lastNumber = $arr[2] ?? '';
             if($lastItemMonth == $currentMonth && $lastItemYear == $currentYear){
                 $temp = $lastNumber+1;
                 if(strlen($temp) == 1){
                     $newNumber = '00' . $temp;
                 }elseif(strlen($temp) == 2){
                     $newNumber = '0' . $temp;
                 }elseif(strlen($temp) == 3){
                     $newNumber = $temp;
                 }else{
                     return 'NOMOR REGISTRASI RADIOLOGI OVERFLOW';
                 }
             }else{
                 $newNumber = '001';
             }
         }else{
             $newNumber = '001';
         }
 
         $noRegRad = '' .$format . ' '. $currentYear.'-'. $currentMonth. '-' .$newNumber;

        $today = date('Y-m-d');
        $item = RadiologiPatientRequestDetail::find($id);
        return view('pages.pasienRadiologi.create', [
            "title" => "Radiologi",
            "menu" => "Radiologi",
            'item' => $item,
            'today' => $today,
            'noRegRad' => $noRegRad,
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

        $data = $request->validate([
            'nomor' => 'required',
            'tanggal' => 'required',
            'image' => 'image',
        ]);

        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('assets/hasil-radiologi', 'public');
        }

        $data['hasil'] = $request->input('hasil');
        $data['status'] = 'SELESAI';
        $data['user_id'] = Auth::user()->id;

        $item = RadiologiPatientRequestDetail::with(['radiologiFormRequestDetail', 'radiologiFormRequestDetail.radiologiFormRequestMaster', 'radiologiFormRequestDetail.radiologiFormRequestMasterDetail'])->find($id);

        $old_data = null;
        if($item->radiologiPatient->status == 'VALIDATED'){
            $old_data = json_encode($item);
        }
        
        $item->update($data);

        if($old_data){
            ChangeLog::create([
                'user_id' => Auth::user()->id,
                'record_id' => $item->id,
                'record_type' => RadiologiPatientRequestDetail::class,
                'old_data' => $old_data,
                'new_data' => json_encode($item),
            ]);
        }

        $itemRadiologiPatient = RadiologiPatient::find($item->radiologiPatient->id);
        $checkRequestStatus = RadiologiPatientRequestDetail::where('radiologi_patient_id', $itemRadiologiPatient->id)
                                ->where('status', 'WAITING')->get();

        if($checkRequestStatus->isEmpty()){
            $itemRadiologiPatient->update([
                'status' => 'UNVALIDATED',
            ]);
        }
        
        return back()->with('success', 'Data Berhasil Diperbarui');
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
    
    
    public function showChange($id)
    {
        $today = date('Y-m-d');
        $item = RadiologiPatientRequestDetail::find($id);
        return view('pages.pasienRadiologi.showChange', [
            "title" => "Radiologi",
            "menu" => "Radiologi",
            'item' => $item,
            'today' => $today,
        ]);
    }
}
