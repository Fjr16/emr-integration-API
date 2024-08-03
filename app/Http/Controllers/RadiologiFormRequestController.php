<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermintaanRadiologiRequest;
use App\Models\Action;
use App\Models\Queue;
use App\Models\RadiologiFormRequest;
use App\Models\RadiologiFormRequestDetail;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RadiologiFormRequestController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data = Action::where('jenis_tindakan', 'Radiologi')->with(['actionRates'])->get();
        $item = Queue::findOrFail($id);
        return view('pages.permintaanRadiologi.create', [
            'title' => 'Rawat Jalan',
            'menu' => 'Rawat Jalan',
            'item' => $item,
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermintaanRadiologiRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $queue = Queue::findOrFail($id);
            if (auth()->user()->id !== $queue->dpjp->id) {
                return back()->with('error', 'Permintaan Hanya Dapat Dibuat Oleh Dokter Penanggung Jawab Pasien')->withInput();
            }

        // Create new radiology request
        $data = $request->validated();
        $data['ttd_dokter'] = $data['ttd_user'] ?? null;
        $data['user_id'] = Auth::user()->id;
        $data['queue_id'] = $queue->id;
        $data['catatan'] = $request->catatan ?? null;

        $item = RadiologiFormRequest::create($data);
        $detailActions = $request->input('action_id', []);
        $detailKets = $request->input('keterangan', []);
        foreach ($detailActions as $key => $action) {
            RadiologiFormRequestDetail::create([
                'radiologi_form_request_id' => $item->id,
                'action_id' => $action,
                'keterangan' => $detailKets[$key]
            ]);
        }

        
        DB::commit();
        return redirect()
            ->route('rajal/show', ['id' => $id, 'title' => 'Rawat Jalan'])
            ->with([
                'success' => 'Berhasil Membuat permintaan Pemeriksaan Radiologi',
                'btn' => 'penunjang',
                'penunjang' => 'radiologi',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        } catch(ModelNotFoundException $mn){
            DB::rollBack();
            return back()->with('error', $mn->getMessage())->withInput();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($queue_id, $radiologi_id)
    {
        $itemQueue = Queue::find($queue_id);
        $itemRadiologi = RadiologiFormRequest::find($radiologi_id);
        return view('pages.permintaanRadiologi.show', [
            'title' => 'Rawat Jalan',
            'menu' => 'In Patient',
            'itemQueue' => $itemQueue,
            'itemRadiologi' => $itemRadiologi,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id2)
    {
        $queue = Queue::findOrFail($id);
        $item = RadiologiFormRequest::findOrFail($id2);
        if ($item->status == 'FINISHED' || $item->status == 'ONGOING' || $item->status == 'ACCEPTED') {
            return back()->with([
                'error' => 'Data Tidak Dapat Diubah !! Karena Permintaan Telah Diterima Oleh petugas Radiologi',
                'btn' => 'penunjang',
                'penunjang' => 'radiologi',
            ]);
        }
        $data = Action::where('jenis_tindakan', 'Radiologi')->get();

        return view('pages.permintaanRadiologi.edit', [
            'title' => 'Rawat Jalan',
            'menu' => 'In Patient',
            'queue' => $queue,
            'item' => $item,
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermintaanRadiologiRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $item = RadiologiFormRequest::find($id);
            if ($item->status == 'FINISHED' || $item->status == 'ONGOING' || $item->status == 'ACCEPTED') {
                return back()->with('error', 'Data Tidak Dapat Diubah !! Karena Permintaan Telah Diterima Oleh Petugas radiologi');
            }
            if (auth()->user()->id !== $item->queue->dpjp->id) {
                return back()->with('error', 'Permintaan Hanya Dapat Dibuat Oleh Dokter Penanggung Jawab Pasien')->withInput();
            }


        // Create new radiology request
        $data = $request->validated();
        $data['ttd_dokter'] = $data['ttd_user'] ?? null;
        $data['user_id'] = Auth::user()->id;
        $data['catatan'] = $request->catatan ?? null;
        $item->update($data);

        $item->radiologiFormRequestDetails()->delete();
        $detailActions = $request->input('action_id', []);
        $detailKets = $request->input('keterangan', []);
        foreach ($detailActions as $key => $action) {
            RadiologiFormRequestDetail::create([
                'radiologi_form_request_id' => $item->id,
                'action_id' => $action,
                'keterangan' => $detailKets[$key]
            ]);
        }

        
        DB::commit();
        return redirect()
            ->route('rajal/show', ['id' => $item->queue->id, 'title' => 'Rawat Jalan'])
            ->with([
                'success' => 'Berhasil Memperbarui permintaan Pemeriksaan Radiologi',
                'btn' => 'penunjang',
                'penunjang' => 'radiologi',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        } catch(ModelNotFoundException $mn){
            DB::rollBack();
            return back()->with('error', $mn->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // code baru
        $item = RadiologiFormRequest::find($id);
        if ($item->status == 'FINISHED' || $item->status == 'ONGOING' || $item->status == 'ACCEPTED') {
            return back()->with([
                'error' => 'Data Tidak Dibatalkan !! Karena Permintaan Telah Diterima Oleh Petugas Radiologi',
                'btn' => 'penunjang',
                'penunjang' => 'radiologi',
            ]);
        }
        $item->update([
            'status' => 'CANCEL',
        ]);
        return back()
            ->with([
                'success' => 'Permintaan Berhasil Dibatalkan',
                'btn' => 'penunjang',
                'penunjang' => 'radiologi',
            ]);
    }
}
