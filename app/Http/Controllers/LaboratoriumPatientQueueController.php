<?php

namespace App\Http\Controllers;

use App\Models\KasirPatient;
use Illuminate\Http\Request;
use App\Models\DetailKasirPatient;
use Illuminate\Support\Facades\Auth;
use App\Models\LaboratoriumPatientResult;
use App\Models\LaboratoriumUserValidator;
use App\Models\LaboratoriumRequestMasterRate;
use App\Models\LaboratoriumRequestMasterVariable;

class LaboratoriumPatientQueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date('Y-m-d');
        $filter = request('filter', $today);
        $data = LaboratoriumPatientResult::leftJoin('laboratorium_requests', 'laboratorium_patient_results.laboratorium_request_id', '=', 'laboratorium_requests.id')
                ->leftJoin('laboratorium_request_type_masters', 'laboratorium_requests.laboratorium_request_type_master_id', '=', 'laboratorium_request_type_masters.id')
                ->orderByDesc('laboratorium_request_type_masters.isPrioritas') 
                ->whereDate('laboratorium_patient_results.tanggal_periksa', '=', $filter)
                ->select('laboratorium_patient_results.*')
                ->get();
                // dd($data);
        return view('pages.pasienLaboratorium.index', [
            'title' => 'Antrian Laboratorium PK',
            'menu' => 'Laboratorium PK',
            'today' => $today,
            'data' => $data,
            'filter' => $filter,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $today = date('Y-m-d');
        $item = LaboratoriumPatientResult::find($id);
        return view('pages.pasienLaboratoriumList.create', [
            'title' => 'Laboratorium PK',
            'menu' => 'Laboratorium PK',
            'today' => $today,
            'item' => $item,
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
        $item = LaboratoriumPatientResult::find($id);
        $tanggal = $request->input('tanggal');

        $lastQueue = LaboratoriumPatientResult::whereDate('tanggal_periksa', $tanggal)->orderBy('nomor_antrian_lab', 'desc')->first();
        $nextQueue = $lastQueue ? $lastQueue->nomor_antrian_lab + 1 : 1;
        $item->update([
            'nomor_antrian_lab' => $nextQueue,
            'tanggal_periksa' => $request->tanggal,
        ]);
        LaboratoriumUserValidator::create([
            'laboratorium_patient_result_id' => $item->id,
            'user_id' => null,
        ]);

        //create Tagihan
        $patientCategoryId = $item->queue->patientCategory->id ?? '';
        if($patientCategoryId){
            $kasirPatient = KasirPatient::where('rawat_jalan_patient_id', $item->queue->rawatJalanPatient->id)->first();
            if($kasirPatient){
                $total = $kasirPatient->total;
                foreach ($item->laboratoriumRequest->laboratoriumRequestDetails as $detail) {
                    $tarif = LaboratoriumRequestMasterRate::where('laboratorium_request_master_variable_id', $detail->laboratoriumRequestMasterVariable->id)->where('patient_category_id', $patientCategoryId)->first();
                    DetailKasirPatient::create([
                        'kasir_patient_id' => $kasirPatient->id,
                        'name' => $detail->laboratoriumRequestMasterVariable->name,
                        'tanggal' => date('Y-m-d H:i:s'),
                        'category' => 'Pemeriksaan Laboratorium PK',
                        'jumlah' => 1,
                        'tarif' => $tarif->tarif_umum ?? 0,
                    ]);
                    $total += $tarif->tarif_umum ?? 0;
                }
                $kasirPatient->update([
                    'total' => $total,
                ]);
            }else{
                $total = 0;
                $itemKasirPatient =  KasirPatient::create([
                    'rawat_jalan_patient_id' => $item->queue->rawatJalanPatient->id,
                    'total' => $total,
                    'status' => 'PENDING',
                ]);
                foreach ($item->laboratoriumRequest->laboratoriumRequestDetails as $detail) {
                    $tarif = LaboratoriumRequestMasterRate::where('laboratorium_request_master_variable_id', $detail->laboratoriumRequestMasterVariable->id)->where('patient_category_id', $patientCategoryId)->first();
                    DetailKasirPatient::create([
                        'kasir_patient_id' => $itemKasirPatient->id,
                        'name' => $detail->laboratoriumRequestMasterVariable->name,
                        'tanggal' => date('Y-m-d H:i:s'),
                        'category' => 'Pemeriksaan Laboratorium PK',
                        'jumlah' => 1,
                        'tarif' => $tarif->tarif_umum ?? 0,
                    ]);
                    $total += $tarif->tarif_umum ?? 0; 
                }
                $itemKasirPatient->update([
                    'total' => $total,
                ]);
            }
        }

        return back()->with('success', 'Berhasil Memperbarui Antrian Pasien laboratorium');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $item = LaboratoriumRequestMasterVariable::where('id', $id)->with(['laboratoriumRequestMasterDetails'])->first();
        $item = LaboratoriumRequestMasterVariable::with(['laboratoriumRequestMasterDetails'])->find($id);
        // laboratorium_request_master_details
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $item = LaboratoriumPatientResult::find($id);
        $item->update([
            'status' => 'VALIDATED',
        ]);
        $item->laboratoriumUserValidator()->update([
            'user_id' => Auth::user()->id,
        ]);
        
        return back()->with('success', 'Berhasil Validasi');
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
}
