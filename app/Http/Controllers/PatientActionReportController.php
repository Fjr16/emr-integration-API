<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientActionRequest;
use App\Models\Action;
use App\Models\Queue;
use App\Models\KasirPatient;
use Illuminate\Http\Request;
use App\Models\DetailKasirPatient;
use App\Models\PatientActionReport;
use Illuminate\Support\Facades\Auth;
use App\Models\PatientActionReportDetail;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PatientActionReportController extends Controller
{

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientActionRequest $request, $id)
    {
        DB::beginTransaction();
        $errors = [];
        try {
            $item = Queue::findOrFail($id);
            if ($item->patientActionReport) {
                $itemTindakan = $item->patientActionReport;
                $itemTindakan->update([
                    'tgl_tindakan' => $request->input('tgl_tindakan', date('Y-m-d H:i:s')),
                    'laporan_tindakan' => $request->input('laporan_tindakan'),
                ]);
            }else{
                $ttd = null;
                if ($item->dpjp->id == auth()->user()->id) {
                    $ttd = $item->dpjp->paraf;
                }
                $itemTindakan = PatientActionReport::create([
                    'user_id' => $item->dpjp->id,
                    'queue_id' => $item->id,
                    'tgl_tindakan' => $request->input('tgl_tindakan', date('Y-m-d H:i:s')),
                    'laporan_tindakan' => $request->input('laporan_tindakan'),
                    'ttd' => $ttd,
                ]);
            }
            $itemTindakan->patientActionReportDetails()->delete();
            $actionIds = $request->input('action_id', []);
            $jumlah = $request->input('jumlah_tindakan', []);
            $harga = $request->input('tarif_tindakan', []);
            $subTotal = $request->input('sub_total_tindakan', []);
            
            foreach ($actionIds as $key => $actionId) {
                PatientActionReportDetail::create([
                    'patient_action_report_id' => $itemTindakan->id,
                    'action_id' => $actionId,
                    'jumlah' => $jumlah[$key],
                    'harga_satuan' => $harga[$key],
                    'sub_total' => $subTotal[$key],
                ]);
            }

            if (!empty($errors)) {
                DB::rollBack();
                return back()->with([
                    'exceptions' => $errors,
                    'btn' => 'tindakan',
                ]);
            }

            DB::commit();
            return back()->with([
                'success' => 'Berhasil Diperbarui',
                'btn' => 'tindakan',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with([
                'error' => $e->getMessage(),
                'btn' => 'tindakan',
            ]);
        } catch (ValidationException $th) {
            DB::rollBack();
            return back()->with([
                'error' => $th->getMessage(),
                'btn' => 'tindakan',
            ]);
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
        $item = PatientActionReport::findOrFail($id);
        $item->patientActionReportDetails()->delete();
        $item->delete();
        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'tindakan',
        ]);
    }
}
