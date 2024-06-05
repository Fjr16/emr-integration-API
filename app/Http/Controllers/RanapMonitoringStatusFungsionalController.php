<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\RanapAsesMoniStatusFungsionalDetail;
use App\Models\RanapAsesMoniStatusFungsionalPatient;
use App\Models\RawatInapPatient;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RanapMonitoringStatusFungsionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient', function($query){
            $query->whereNot('status', 'WAITING')->whereNot('status', 'BATAL');
        })->get();
        return view('pages.ranapAsesmenMonitoringStatusFungsional.index', [
            "title" => "Asesmen Monitoring Status Fungsional",
            "menu" => "Rawat Inap",
            'data' => $data,
        ]);
    }

    public function detail($id)
    {
        $item = RawatInapPatient::find($id);
        $data = RanapAsesMoniStatusFungsionalPatient::where('rawat_inap_patient_id', $id)->get();

        return view('pages.ranapAsesmenMonitoringStatusFungsional.detail', [
            "item" => $item,
            "title" => "Asesmen Monitoring Status Fungsional",
            "menu" => "Rawat Inap",
            "data" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = RawatInapPatient::find($id);
        $today = new DateTime();
        return view('pages.ranapAsesmenMonitoringStatusFungsional.create', [
            "title" => "Asesmen Monitoring Status Fungsional",
            "menu" => "Rawat Inap",
            "today" => $today,
            "item" => $item
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
        $item = RawatInapPatient::find($id);

        $mainTb = RanapAsesMoniStatusFungsionalPatient::create([
            'rawat_inap_patient_id' => $item->id,
            'patient_id' => $item->queue->patient->id,
            'user_id' => Auth::user()->id,
            'isPulang' => $request->input('isPulang'),
            'tanggal' => $request->input('tanggal'),
            'total_skor' => $request->input('total_skor'),
            'kategori_skor' => $request->input('kategori_skor'),
            'nama_perawat' => $request->input('nama_perawat'),
            'pelaksanaan_asesmen' => $request->input('pelaksanaan_asesmen')
        ]);

        $arrNilaiName = [
            'MAKAN',
            'TOILET (AKTIVITAS BAB & BAK)',
            'BERPINDAH DARI KURSI RODA KE TEMPAT TIDUR/SEBALIKNYA',
            'KEBERSIHAN DIRI, MENCUCI MUKA, MENYISIR RAMBUT, MENGGOSOK GIGI',
            'MANDI',
            'BERJALAN DI PERMUKAAN DATAR',
            'NAIK TURUN TANGGA',
            'BERPAKAIAN',
            'MENGONTROL DEFEKASI/BAB',
            'MENGONTROL BERKEMIH/BAK',
        ];
        $nilais = $request->input('nilai', []);
        foreach ($arrNilaiName as $key => $name) {
            RanapAsesMoniStatusFungsionalDetail::create([
                'ranap_ases_moni_status_fungsional_patient_id' => $mainTb->id,
                'name' => $name,
                'skor' => $nilais[$key],
            ]);
        }

        return redirect()->route('monitoring/status/fungsional.detail', $mainTb->patient_id)->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'monitoringstatusfungsional',
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
        $item = RawatInapPatient::find($id);
        $mainTb = RanapAsesMoniStatusFungsionalPatient::where('rawat_inap_patient_id', $item->id)->where('isPulang', 'Selama Perawatan')->get();
        $isPulang = RanapAsesMoniStatusFungsionalPatient::where('rawat_inap_patient_id', $item->id)->where('isPulang', 'Saat Pulang')->first();
        return view('pages.ranapAsesmenMonitoringStatusFungsional.show', [
            "title" => "Asesmen Monitoring Status Fungsional",
            "menu" => "Rawat Inap",
            "mainTb" => $mainTb,
            "isPulang" => $isPulang,
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
        $item = RanapAsesMoniStatusFungsionalPatient::find($id);
        $details = RanapAsesMoniStatusFungsionalDetail::where('ranap_ases_moni_status_fungsional_patient_id', $item->id)->get();

        return view('pages.ranapAsesmenMonitoringStatusFungsional.edit', [
            "title" => "Asesmen Monitoring Status Fungsional",
            "menu" => "Rawat Inap",
            "item" => $item,
            "details" => $details,
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
        RanapAsesMoniStatusFungsionalPatient::find($id)->update([
            'user_id' => Auth::user()->id,
            'isPulang' => $request->input('isPulang'),
            'tanggal' => $request->input('tanggal'),
            'total_skor' => $request->input('total_skor'),
            'kategori_skor' => $request->input('kategori_skor'),
            'nama_perawat' => $request->input('nama_perawat'),
            'pelaksanaan_asesmen' => $request->input('pelaksanaan_asesmen')
        ]);
        $mainTb = RanapAsesMoniStatusFungsionalPatient::find($id);

        $ids = $request->input('id', []);
        $names = $request->input('name', []);
        $nilais = $request->input('nilai', []);
        foreach ($ids as $key => $id) {
            RanapAsesMoniStatusFungsionalDetail::find($id)->update([
                'ranap_ases_moni_status_fungsional_patient_id' => $mainTb->id,
                'name' => $names[$key],
                'skor' => $nilais[$key],
            ]);
        }

        return redirect()->route('monitoring/status/fungsional.detail', $mainTb->patient_id)->with([
            'success' => 'Berhasil Diedit',
            'btn' => 'monitoringstatusfungsional',
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
        $mainTb = RanapAsesMoniStatusFungsionalPatient::find($id);
        RanapAsesMoniStatusFungsionalDetail::where('ranap_ases_moni_status_fungsional_patient_id', $mainTb->id)->delete();
        $mainTb->delete();

        return redirect()->back()->with('success', 'Berhail Dihapus');
    }
}
