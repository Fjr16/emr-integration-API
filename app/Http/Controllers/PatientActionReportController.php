<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ActionCategory;
use App\Models\Queue;
use App\Models\KasirPatient;
use Illuminate\Http\Request;
use App\Models\ActionMembers;
use App\Models\DetailKasirPatient;
use App\Models\PatientActionReport;
use Illuminate\Support\Facades\Auth;
use App\Models\PatientActionReportDetail;

class PatientActionReportController extends Controller
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
    public function create(Request $request)
    {
        $today = date('Y-m-d H:i');
        $actCategory = ActionCategory::where('name', 'Tindakan Parasat / Poli')->first();
        $data = Action::where('action_category_id', $actCategory->id)->get();
        $item = Queue::findOrFail($request->queue_id);
        return view('pages.laporanTindakan.create', [
            'title' => 'Laporan Tindakan',
            'menu' => 'Rawat Jalan',
            'item' => $item,
            'data' => $data,
            'today' => $today
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
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['paraf'] = $request->input('ttd_user');
        $item = PatientActionReport::create($data);

        //create tagihan Tindakan
        // $queue = $item->rawatJalanPoliPatient->rawatJalanPatient->queue;
        // $tindakanAll = PatientActionReportDetail::where('patient_action_report_id', $item->id)->get();
        // if ($queue->rawatJalanPatient->kasirPatient) {
        //     $itemKasirPatient = KasirPatient::find($queue->rawatJalanPatient->kasirPatient->id);

        //     $total = $itemKasirPatient->total;
        //     foreach ($tindakanAll as $member) {
        //         $newDetail =  DetailKasirPatient::create([
        //             'kasir_patient_id' => $itemKasirPatient->id,
        //             'name' => $member->actionMembers->name,
        //             'tanggal' => date('Y-m-d H:i:s'),
        //             'category' => 'Action',
        //             'jumlah' => '1',
        //             'tarif' => $member->actionMembers->tarif_umum,
        //         ]);
        //         $total += $newDetail->tarif;
        //     }
        //     $itemKasirPatient->update([
        //         'total' => $total,
        //     ]);
        // } else {
        //     $total = 0;
        //     foreach ($tindakanAll as $member) {
        //         $total += $member->actionMembers->tarif_umum;
        //     }
        //     $itemKasirPatient = KasirPatient::create([
        //         'rawat_jalan_patient_id' => $item->rawatJalanPoliPatient->rawatJalanPatient->id,
        //         'user_id' => null,
        //         'total' => $total,
        //         'status' => 'PENDING',
        //     ]);

        //     foreach ($tindakanAll as $member) {
        //         $newDetail = DetailKasirPatient::create([
        //             'kasir_patient_id' => $itemKasirPatient->id,
        //             'name' => $member->actionMembers->name,
        //             'tanggal' => date('Y-m-d H:i:s'),
        //             'category' => 'Action',
        //             'jumlah' => '1',
        //             'tarif' => $member->actionMembers->tarif_umum,
        //         ]);
        //     }
        // }

        return back()->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'tindakan',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = PatientActionReport::find($id);
        return view('pages.laporanTindakan.show', [
            'title' => 'Laporan Tindakan',
            'menu' => 'Rawat Jalan',
            'item' => $item,
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
        $today = date('Y-m-d H:i');
        $item = PatientActionReport::findOrFail($id);
        return view('pages.laporanTindakan.edit', [
            'title' => 'Laporan Tindakan',
            'menu' => 'Rawat Jalan',
            'item' => $item,
            'today' => $today,
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
        $data = $request->all();
        $item = PatientActionReport::findOrFail($id);
        // $item->action_members()->sync($request->action_member_id);
        $item->update($data);

        return back()->with([
            'success' => 'Berhasil Diperbarui',
            'btn' => 'tindakan',
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
        $item = PatientActionReport::findOrFail($id);
        $item->action_members()->detach();
        $item->delete();
        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'tindakan',
        ]);
    }
}
