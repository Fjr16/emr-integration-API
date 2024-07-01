<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Queue;
use App\Models\Action;
use App\Models\RoomDetail;
use Illuminate\Http\Request;
use App\Models\ActionCategory;
use App\Models\InitialAssesment;
use App\Models\LaboratoriumMasterTemplate;
use App\Models\LaboratoriumMasterTemplateDetail;
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
        $item = Queue::find($id);
        $categoryActionPk = ActionCategory::where('name', 'Laboratorium Patologi Klinik')->first(); 
        $data = Action::where('action_category_id', $categoryActionPk->id)->get();
        $templates = LaboratoriumMasterTemplate::all();

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
            'templates' => $templates,
            'diagnosa' => $diagnosa,
            'routeStore' => $routeStore,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTemplate($id)
    {
        $categoryActionPk = ActionCategory::where('name', 'Laboratorium Patologi Klinik')->first(); 
        $data = Action::where('action_category_id', $categoryActionPk->id)->get();
        $item = LaboratoriumMasterTemplate::find($id);
        return response()->json([
            'details' => $item->laboratoriumMasterTemplateDetails,
            'actions' => $data
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
        // laboratoriumRequest
        $this->validate($request, [
            'action_id' => 'required',
        ]);
        // data detail request
        $detailActions = $request->input('action_id', []); 
        $detailKets = $request->input('keterangan', []); 

        // create template master lab pk
        if ($request->generate_template) {
            $dataTemplate = $request->validate([
                'name' => 'required'
            ]);
            $itemTemplate = LaboratoriumMasterTemplate::create($dataTemplate);
            foreach ($detailActions as $key => $action_id) {
                LaboratoriumMasterTemplateDetail::create([
                    'laboratorium_master_template_id' => $itemTemplate->id,
                    'action_id' => $action_id,
                    'keterangan' => $detailKets[$key] ?? '',
                ]);
            }
        }
        
        $data = $request->validate([
            'diagnosa' => 'required',
            'tanggal_sampel' => 'required',
            'tipe_permintaan' => 'required',
            'room_detail_id' => 'required',
            'ttd_dokter' => 'required',
        ]);

        // find queue
        $queue = Queue::find($id);

        // create Laboratorium Request
        $data['user_id'] =  Auth::user()->id;
        $data['queue_id'] =  $queue->id;
        $data['patient_id'] =  $queue->patient->id;
        $data['catatan'] =  $request->input('catatan');
        $item = LaboratoriumRequest::create($data);

        //create Laboratorium Request Detail
        foreach($detailActions as $key => $action_id){
            LaboratoriumRequestDetail::create([
                'laboratorium_request_id' => $item->id, 
                'action_id' => $action_id, 
                'keterangan' => $detailKets[$key] ?? '', 
            ]);
        }
        
        return redirect()->route('rajal/show', ['id' => $id, 'title' => 'Rawat Jalan'])
                ->with([
                    'success' => 'Berhasil Ditambahkan',
                    'btn' => 'dokter',
                    'dokter' => 'laboratorium',
                ]);
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
