<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Queue;
use App\Models\RoomDetail;
use Illuminate\Http\Request;
use App\Models\InitialAssesment;
use App\Models\RawatInapPatient;
use App\Models\LaboratoriumRequest;
use App\Models\PatientActionReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\LaboratoriumPatientResult;
use App\Models\LaboratoriumRequestDetail;
use App\Models\LaboratoriumRequestTypeMaster;
use App\Models\LaboratoriumRequestCategoryMaster;
use App\Models\LaboratoriumRequestMasterVariable;

class LaboratoriumFormRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $currentRouteName = Route::currentRouteName();

        $item = Queue::find($id);
        $data = LaboratoriumRequestCategoryMaster::all();
        $types = LaboratoriumRequestTypeMaster::all();
        
        if ($currentRouteName == 'rajal/laboratorium/request.index') {
            $roomDetails = RoomDetail::where('isActive', true)->get();
            $rawat_jalan_poli_patient_id = $item->rawatJalanPatient->rawatJalanPoliPatient->id ?? '';
            $diagnosa = null;
            if($rawat_jalan_poli_patient_id){
                $assesmenAwalMedis = InitialAssesment::where('rawat_jalan_poli_patient_id', $rawat_jalan_poli_patient_id)->latest()->first();
                $patientActionReport = PatientActionReport::where('rawat_jalan_poli_patient_id', $rawat_jalan_poli_patient_id)->latest()->first();

                if($assesmenAwalMedis && $patientActionReport){
                    if($assesmenAwalMedis->created_at->isBefore($patientActionReport->created_at)){
                        $diagnosa = $patientActionReport->diagnosa;
                    }else{
                        $diagnosa = $assesmenAwalMedis->diagnosa_kerja;
                    }
                }elseif($assesmenAwalMedis && !$patientActionReport){
                    $diagnosa = $assesmenAwalMedis->diagnosa_kerja;
                }elseif(!$assesmenAwalMedis && $patientActionReport){
                    $diagnosa = $patientActionReport->diagnosa;
                }
            }
            $routeStore = 'rajal/laboratorium/request.store';

            return view('pages.permintaanLaboratorium.create', [
                "title" => "Rawat Jalan",
                "menu" => "In Patient",
                'item' => $item,
                'data' => $data,
                'types' => $types,
                'diagnosa' => $diagnosa,
                'roomDetails' => $roomDetails,
                'currentRouteName' => $currentRouteName,
                'routeStore' => $routeStore,
            ]);
        }else if ($currentRouteName == 'ranap/laboratorium/request.index'){
            $diagnosa = '';
            $room = Room::where('name', 'like', '%PBM%')->first();
            $roomDetails = RoomDetail::where('isActive', true)->where('room_id', $room->id)->get();
            $routeStore = 'ranap/laboratorium/request.store';
            return view('pages.permintaanLaboratorium.create', [
                "title" => "Rawat Inap",
                "menu" => "Rawat Inap",
                'item' => $item,
                'data' => $data,
                'types' => $types,
                'diagnosa' => $diagnosa,
                'room' => $room,
                'roomDetails' => $roomDetails,
                'currentRouteName' => $currentRouteName,
                'routeStore' => $routeStore,
            ]);
        }
        
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
    public function store(Request $request, $id)
    {
        $currentRouteName = Route::currentRouteName();
        //get data for Laboratorium Request from request post
        $diagnosa = $request->input('diagnosa');
        $ruang = $request->input('ruang');
        $ruangDetail = $request->input('room_detail_id');
        $tanggal = $request->input('tanggal');
        $tipe = $request->input('laboratorium_request_type_master_id');
        $catatan =  $request->input('catatan');
        $queue = Queue::find($id);

        //get data for request detail
        $laboratoriumReqIds = $request->input('laboratorium_request_master_variable_id', []);

        $addDetails = [];

        foreach ($laboratoriumReqIds as $reqId) {
            $addDetails[] = [
                'laboratorium_request_master_variable_id' => $reqId,
                'value' => null,
            ];
        }

         // create Laboratorium Request
         $item = LaboratoriumRequest::create([
            'user_id' => Auth::user()->id,
            'patient_id' => $queue->patient->id,
            'queue_id' => $queue->id,
            'diagnosa' => $diagnosa,
            'ruang' => $ruang,
            'room_detail_id' => $ruangDetail,
            'tanggal' => $tanggal,
            'catatan' => $catatan,
            'laboratorium_request_type_master_id' => $tipe,
        ]);

        //create Laboratorium Request Detail
        foreach($addDetails as $new){
            LaboratoriumRequestDetail::create([
                'laboratorium_request_id' => $item->id, 
                'laboratorium_request_master_variable_id' => $new['laboratorium_request_master_variable_id'], 
                'value' => $new['value'], 
            ]);
        }
        
        if ($currentRouteName == 'rajal/laboratorium/request.store') {
            return redirect()->route('rajal/show', ['id' => $id, 'title' => 'Rawat Jalan'])
                    ->with([
                        'success' => 'Berhasil Ditambahkan',
                        'btn' => 'dokter',
                        'dokter' => 'laboratorium',
                    ]);
        }else{
            LaboratoriumPatientResult::create([
                'queue_id' => $queue->id,
                'patient_id' => $queue->patient_id,
                'laboratorium_request_id' => $item->id,
                'status' => 'WAITING',
            ]);
            return redirect()->route('rawat/inap.show', $queue->rawatInapPatient->id)
                    ->with([
                        'success' => 'Berhasil Ditambahkan',
                        'btn' => 'skriningCovid',
                    ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($queue_id, $id)
    {
        $queue = Queue::find($queue_id);
        $item = LaboratoriumRequest::find($id);
        $categoryIds = [];
        foreach ($item->laboratoriumRequestDetails as $detail) {
            if($detail->laboratoriumRequestMasterVariable->laboratoriumRequestCategoryMaster){
                $categoryIds[] = $detail->laboratoriumRequestMasterVariable->laboratoriumRequestCategoryMaster->id;
            }
        }
        $dataKategori = LaboratoriumRequestCategoryMaster::all();
        return view('pages.permintaanLaboratorium.show', [
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
            'queue' => $queue,
            'item' => $item,
            'dataKategori' => $dataKategori,
            'categoryIds' => $categoryIds,
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
        $item = LaboratoriumRequestCategoryMaster::find($id);
        $data = $item->laboratoriumRequestMasterVariables->pluck('id');
        return response()->json($data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = LaboratoriumRequest::find($id);
        if(!$item->laboratoriumPatientResult){
            $item->laboratoriumRequestDetails()->delete();
            $item->delete();
        }else{
            if($item->laboratoriumPatientResult->status == 'SELESAI' || $item->laboratoriumPatientResult->tanggal_periksa == null){
                $item->laboratoriumRequestDetails()->delete();
                $item->laboratoriumPatientResult->delete();
                $item->delete();
            }else{
                return back()->with([
                    'error' => 'Gagal!! Pasien telah didaftarkan untuk pemeriksaan',
                    'btn' => 'dokter',
                    'dokter' => 'laboratorium',
                ]);
            }
        }

        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'dokter',
            'dokter' => 'laboratorium',
        ]);
    }

    public function uncheckCategory($id){
        $item = LaboratoriumRequestMasterVariable::find($id);
        $category = $item->laboratorium_request_category_master_id;
        return response()->json($category);
    }
}
