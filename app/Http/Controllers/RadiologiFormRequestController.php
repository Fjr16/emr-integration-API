<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ActionCategory;
use App\Models\Queue;
use Illuminate\Http\Request;
use App\Models\InitialAssesment;
use App\Models\NewRadiologiRequest;
use App\Models\PatientActionReport;
use Illuminate\Support\Facades\URL;
use App\Models\RadiologiFormRequest;
use App\Models\RadiologiFormRequestDetail;
use Illuminate\Support\Facades\Auth;

class RadiologiFormRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $urlParent = URL::previous();

        $categoryActionRadiologi = ActionCategory::where('name', 'Radiologi')->first(); 
        $data = Action::where('action_category_id', $categoryActionRadiologi->id)->get();
        $item = Queue::findOrFail($id);

        $diagnosa = null;
        $rawat_jalan_poli_patient_id = $item->rawatJalanPatient->rawatJalanPoliPatient->id ?? '';
        if ($rawat_jalan_poli_patient_id) {
            $assesmenAwalMedis = InitialAssesment::where('rawat_jalan_poli_patient_id', $rawat_jalan_poli_patient_id)->latest()->first();
            $patientActionReport = PatientActionReport::where('rawat_jalan_poli_patient_id', $rawat_jalan_poli_patient_id)->latest()->first();

            if ($assesmenAwalMedis && $patientActionReport) {
                if ($assesmenAwalMedis->created_at->isBefore($patientActionReport->created_at)) {
                    $diagnosa = $patientActionReport->diagnosa;
                } else {
                    $diagnosa = $assesmenAwalMedis->diagnosa_kerja;
                }
            } elseif ($assesmenAwalMedis && !$patientActionReport) {
                $diagnosa = $assesmenAwalMedis->diagnosa_kerja;
            } elseif (!$assesmenAwalMedis && $patientActionReport) {
                $diagnosa = $patientActionReport->diagnosa;
            }
        }
        return view('pages.permintaanRadiologi.create', [
            'title' => 'Rawat Jalan',
            'menu' => 'Rawat Jalan',
            'item' => $item,
            'data' => $data,
            'diagnosa' => $diagnosa,
            'urlParent' => $urlParent,
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
        $this->validate($request, [
            'patient_id' => 'required',
            'room_detail_id' => 'required',
            'ttd_user' => 'required',
            'action_id' => 'required',
        ]);
        $queue = Queue::find($id);

        // Create new radiology request
        $data = [
            'user_id' => Auth::user()->id,
            'patient_id' => $request->patient_id,
            'queue_id' => $queue->id,
            'room_detail_id' => $request->room_detail_id,
            'diagnosa_klinis' => $request->diagnosa_klinis,
            'catatan' => $request->catatan,
            'ttd_dokter' => $request->ttd_user,
        ];

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

        return redirect()
            ->route('rajal/show', ['id' => $id, 'title' => 'Rawat Jalan'])
            ->with([
                'success' => 'Berhasil Ditambahkan',
                'btn' => 'dokter',
                'dokter' => 'radiologi',
            ]);
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
        $title = 'Rawat Jalan';
        $menu = 'In Patient';
        $urlParent = URL::previous();
        $queue = Queue::findOrFail($id);

        $item = RadiologiFormRequest::findOrFail($id2);
        if ($item->status == 'FINISHED' || $item->status == 'ONGOING') {
            return back()->with([
                'error' => 'Data Tidak Dapat Diubah !! Karena Permintaan Dalam Pemeriksaan / Telah Selesai',
                'btn' => 'dokter',
                'dokter' => 'radiologi',
            ]);
        }
        $categoryActionRadiologi = ActionCategory::where('name', 'Radiologi')->first(); 
        $data = Action::where('action_category_id', $categoryActionRadiologi->id)->get();

        return view('pages.permintaanRadiologi.edit', [
            'title' => $title,
            'menu' => $menu,
            'queue' => $queue,
            'urlParent' => $urlParent,
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
    public function update(Request $request, $id)
    {
        $item = RadiologiFormRequest::find($id);
        if ($item->status == 'FINISHED' || $item->status == 'ONGOING') {
            return back()->with('error', 'Data Tidak Dapat Diubah !! Karena Status Dalam Pemeriksaan atau Telah Selesai ');
        }
        $data = [
            'diagnosa_klinis' => $request->diagnosa_klinis,
            'catatan' => $request->catatan,
        ];
        $item->update($data);

        $toUpdateDetails = $request->input('radiologi_detail_id', []);
        $detailActions = $request->input('action_id', []);
        $detailKets = $request->input('keterangan', []);
        foreach ($detailActions as $key => $action) {
            if (isset($toUpdateDetails[$key])) {
                RadiologiFormRequestDetail::find($toUpdateDetails[$key])->update([
                    'radiologi_form_request_id' => $item->id,
                    'action_id' => $action,
                    'keterangan' => $detailKets[$key]
                ]);
            }else{
                RadiologiFormRequestDetail::create([
                    'radiologi_form_request_id' => $item->id,
                    'action_id' => $action,
                    'keterangan' => $detailKets[$key]
                ]);
            }
        }

        return redirect()
        ->route('rajal/show', ['id' => $item->queue->id, 'title' => 'Rawat Jalan'])
        ->with([
            'success' => 'Berhasil Diubah',
            'btn' => 'dokter',
            'dokter' => 'radiologi',
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
        // code baru
        $item = RadiologiFormRequest::find($id);
        if ($item->status == 'FINISHED' || $item->status == 'ONGOING') {
            return back()->with([
                'error' => 'Data Tidak Dapat Dihapus !! Karena Permintaan Dalam Pemeriksaan / Telah Selesai',
                'btn' => 'dokter',
                'dokter' => 'radiologi',
            ]);
        }
        $item->radiologiFormRequestDetails()->delete();
        $item->delete();
        return back()
            ->with([
                'success' => 'Berhasil Dihapus',
                'btn' => 'dokter',
                'dokter' => 'radiologi',
            ]);
    }
}
