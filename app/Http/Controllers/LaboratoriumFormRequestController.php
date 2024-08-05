<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermintaanLaborRequest;
use App\Models\Queue;
use App\Models\Action;
use App\Models\LaboratoriumMasterTemplate;
use App\Models\LaboratoriumMasterTemplateDetail;
use App\Models\LaboratoriumRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\LaboratoriumRequestDetail;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class LaboratoriumFormRequestController extends Controller
{
    /**
     * DONE
     * Form Create Permintaan Laboratorium
     */
    public function index($id)
    {
        $item = Queue::find($id);
        $data = Action::where('jenis_tindakan', 'Laboratorium')->get();
        $templates = LaboratoriumMasterTemplate::all();
        return view('pages.permintaanLaboratorium.create', [
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
            'item' => $item,
            'data' => $data,
            'templates' => $templates,
        ]);
        
    }

    /**
     * DONE
     * Memnyimpan / memperbarui permintaan laboratorium pada db
     */
    public function store(PermintaanLaborRequest $request, $id)
    {
        DB::beginTransaction();
        $errors = [];
        try {
            // find queue
            $queue = Queue::find($id);
            if (auth()->user()->id !== $queue->dpjp->id) {
                return back()->with('error', 'Form Permintaan Laboratorium Hanya berhak diisi Oleh Dokter Penanggung jawab pasien')->withInput();
            }
            
            // data detail request
            $detailActions = $request->input('action_id', []); 
            $detailKets = $request->input('keterangan', []); 

            $data = $request->validated();
    
            // create Laboratorium Request
            $data['user_id'] =  Auth::user()->id;
            $data['queue_id'] =  $queue->id;
            $item = LaboratoriumRequest::create($data);
    
            //create Laboratorium Request Detail dan create template master lab pk
            $itemTemplate = null;
            if ($request->generate_template) {
                $itemTemplate = LaboratoriumMasterTemplate::create($request->name);
            }
            foreach($detailActions as $key => $action_id){
                LaboratoriumRequestDetail::create([
                    'laboratorium_request_id' => $item->id, 
                    'action_id' => $action_id, 
                    'keterangan' => $detailKets[$key] ?? '', 
                ]);

                if ($itemTemplate) {
                    LaboratoriumMasterTemplateDetail::create([
                        'laboratorium_master_template_id' => $itemTemplate->id,
                        'action_id' => $action_id,
                        'keterangan' => $detailKets[$key] ?? '',
                    ]);
                }
            }
    
            
            if (!empty($errors)) {
                DB::rollBack();
                return back()->with('exceptions', $errors)->withInput();
            }

            DB::commit();
            return redirect()->route('rajal/show', ['id' => $id, 'title' => 'Rawat Jalan'])
            ->with([
                'success' => 'Berhasil Menambahkan Permintaan laboratorium',
                'btn' => 'penunjang',
                'penunjang' => 'laboratorium',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }catch (ModelNotFoundException $mn){
            DB::rollBack();
            return back()->with('error', $mn->getMessage())->withInput();
        }
       
    }

    /**
     * DONE
     * Form Edit Permintaan Laboratorium
     */
    public function edit($id)
    {
        $item = LaboratoriumRequest::find($id);
        $data = Action::where('jenis_tindakan', 'Laboratorium')->with('actionRates')->get();
        $templates = LaboratoriumMasterTemplate::all();
        return view('pages.permintaanLaboratorium.edit', [
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
            'item' => $item,
            'data' => $data,
            'templates' => $templates,
        ]);
        
    }

        /**
     * DONE
     * Memnyimpan / memperbarui permintaan laboratorium pada db
     */
    public function update(PermintaanLaborRequest $request, $id)
    {
        DB::beginTransaction();
        $errors = [];
        try {
            $item = LaboratoriumRequest::find($id);
            if (auth()->user()->id !== $item->queue->dpjp->id) {
                return back()->with('error', 'Form Permintaan Laboratorium Hanya berhak diisi Oleh Dokter Penanggung jawab pasien')->withInput();
            }

            // data detail request
            $detailActions = $request->input('action_id', []); 
            $detailKets = $request->input('keterangan', []); 
            $data = $request->validated();
            $data['status'] = 'WAITING';
            // update Laboratorium Request
            $item->update($data);
    
            $item->laboratoriumRequestDetails()->delete();
            //create Laboratorium Request Detail dan create template master lab pk
            $itemTemplate = null;
            if ($request->generate_template) {
                $itemTemplate = LaboratoriumMasterTemplate::create($request->name);
            }
            foreach($detailActions as $key => $action_id){
                LaboratoriumRequestDetail::create([
                    'laboratorium_request_id' => $item->id, 
                    'action_id' => $action_id, 
                    'keterangan' => $detailKets[$key] ?? '', 
                ]);

                if ($itemTemplate) {
                    LaboratoriumMasterTemplateDetail::create([
                        'laboratorium_master_template_id' => $itemTemplate->id,
                        'action_id' => $action_id,
                        'keterangan' => $detailKets[$key] ?? '',
                    ]);
                }
            }
    
            
            if (!empty($errors)) {
                DB::rollBack();
                return back()->with('exceptions', $errors)->withInput();
            }

            DB::commit();
            return redirect()->route('rajal/show', ['id' => $item->queue->id, 'title' => 'Rawat Jalan'])
            ->with([
                'success' => 'Berhasil Memperbarui Permintaan laboratorium',
                'btn' => 'penunjang',
                'penunjang' => 'laboratorium',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }catch (ModelNotFoundException $mn){
            DB::rollBack();
            return back()->with('error', $mn->getMessage())->withInput();
        }
       
    }

    /**
     * DONE
     * Print permintaan
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
     * DONE
     * pembatalaan permintaam
     */
    public function destroy($id)
    {
        $item = LaboratoriumRequest::find($id);
        if ($item->status == 'FINISHED' || $item->status == 'UNVALIDATE' || $item->status == 'ACCEPTED') {
            return back()->with([
                'error' => 'Data Tidak Dapat Dibatalkan !! Karena Permintaan telah diterima oleh petugas laboratorium',
                'btn' => 'penunjang',
                'penunjang' => 'laboratorium',
            ]);
        }
        $item->update([
            'status' => 'CANCEL',
        ]);

        return back()->with([
            'success' => 'Berhasil Dibatalkan',
            'btn' => 'penunjang',
            'penunjang' => 'laboratorium',
        ]);
    }
}
