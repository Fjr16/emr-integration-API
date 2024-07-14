<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Action;
use Illuminate\Http\Request;
use App\Models\LaboratoriumMasterTemplate;
use App\Models\LaboratoriumMasterTemplateDetail;
use App\Models\LaboratoriumRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\LaboratoriumRequestDetail;

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
        $data = Action::where('jenis_tindakan', 'Laboratorium')->get();
        $templates = LaboratoriumMasterTemplate::all();
        $routeStore = 'rajal/laboratorium/request.store';
        return view('pages.permintaanLaboratorium.create', [
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
            'item' => $item,
            'data' => $data,
            'templates' => $templates,
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
        $data = Action::where('action_category_id', 'Laboratorium')->get();
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
        return view('pages.permintaanLaboratorium.show', [
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
            'queue' => $queue,
            'item' => $item,
        ]);
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
        if ($item->status == 'FINISHED' || $item->status == 'ONGOING') {
            return back()->with([
                'error' => 'Data Tidak Dapat Dihapus !! Karena Permintaan Dalam Pemeriksaan / Telah Selesai',
                'btn' => 'dokter',
                'dokter' => 'laboratorium',
            ]);
        }
        $item->laboratoriumRequestDetails()->delete();
        $item->delete();

        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'dokter',
            'dokter' => 'laboratorium',
        ]);
    }
}
