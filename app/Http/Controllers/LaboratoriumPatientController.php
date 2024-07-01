<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LaboratoriumRequest;
use DateTime;

class LaboratoriumPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = LaboratoriumRequest::whereDate('created_at', date('Y-m-d'))->get();
        return view('pages.pasienLaboratoriumList.index', [
            "title" => "Laboratorium PK",
            "menu" => "Laboratorium PK",
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $today = new DateTime(date('Y-m-d H:i:s'));
        $item = LaboratoriumPatientResult::find($id);
        $categoryIds = [];
        foreach ($item->laboratoriumRequest->laboratoriumRequestDetails as $detail) {
            if($detail->laboratoriumRequestMasterVariable->laboratoriumRequestCategoryMaster){
                $categoryIds[] = $detail->laboratoriumRequestMasterVariable->laboratoriumRequestCategoryMaster->id;
            }
        }
        $dataKategori = LaboratoriumRequestCategoryMaster::all();

        //no reg lab
        $format = 'LAB-PK-RPS';
        $currentMonth = $today->format('m');
        $currentYear = $today->format('Y');
        $lastItem = LaboratoriumPatientResult::whereNot('status', 'WAITING')->latest()->first();
        if($lastItem){
            $arr = explode('/', $lastItem->nomor_reg_lab);
            $lastNumber = $arr[0] ?? '';
            $lastItemMonth = $arr[2] ?? '';
            $lastItemYear = $arr[3] ?? '';
            if($lastItemMonth == $currentMonth && $lastItemYear == $currentYear){
                $temp = $lastNumber+1;
                if(strlen($temp) == 1){
                    $newNumber = '00' . $temp;
                }elseif(strlen($temp) == 2){
                    $newNumber = '0' . $temp;
                }elseif(strlen($temp) == 3){
                    $newNumber = $temp;
                }else{
                    return 'NOMOR REGISTRASI LABOR OVERFLOW';
                }
            }else{
                $newNumber = '001';
            }
        }else{
            $newNumber = '001';
        }

        $noRegLab = '' .$newNumber . '/'. $format.'/'. $currentMonth. '/' .$currentYear;
      
        return view('pages.pasienLaboratorium.create', [
            "title" => "Antrian Laboratorium PK",
            "menu" => "Laboratorium PK",
            'item' => $item,
            'today' => $today,
            'categoryIds' => $categoryIds,
            'dataKategori' => $dataKategori,
            'noRegLab' => $noRegLab,
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
        //Update data laboratorium Patient Result
        $nomor = $request->input('nomor');
        $kesan = $request->input('kesan');
        $anjuran = $request->input('anjuran');
        $tglPeriksaSelesai = $request->input('tgl_periksa_selesai');
        $tglAmbilSampel = $request->input('tgl_ambil_sampel');
        $jam_kritis = $request->input('jam_pelaporan_kritis');

        $arrVariabelKritisIds = $request->input('nilai_kritis_variabel_id', []);

        $dumpData = $request->input('data', []);
        $newData = [];
        foreach ($dumpData as $input) {
            if($input['hasil']){
                $newData[] = [
                    'laboratorium_request_master_variable_id' => $input['laboratorium_request_master_variable_id'],
                    'value' => $input['hasil']
                ];
            }
        }

         ###create record##
         $item->update([
            'user_id' => Auth::user()->id,
            'nomor_reg_lab' => $nomor,
            'kesan' => $kesan,
            'anjuran' => $anjuran,
            'tgl_pengambilan_sampel' => $tglAmbilSampel,
            'tgl_pemeriksaan_selesai' => $tglPeriksaSelesai, 
            'jam_pelaporan_kritis' => $jam_kritis, 
            'status' => 'UNVALIDATED',
        ]);

        foreach ($newData as $itemDetail) {
                LaboratoriumPatientResultDetail::create([
                    'laboratorium_patient_result_id' => $item->id,
                    'laboratorium_request_master_variable_id' => $itemDetail['laboratorium_request_master_variable_id'],
                    'value' => $itemDetail['value'],
                    'kondisi_kritis' => (in_array($itemDetail['laboratorium_request_master_variable_id'], $arrVariabelKritisIds) ? true : false),
                ]);
        }

        return redirect()->route('laboratorium/patient/queue.index')->with('success', 'Berhasil Ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = LaboratoriumPatientResult::find($id);

        $categoryPemeriksaanIds = [];
        foreach($item->laboratoriumPatientResultDetails as $detail){
            if($detail->laboratoriumRequestMasterVariable->laboratorium_request_category_master_id){
                $categoryPemeriksaanIds[] = $detail->laboratoriumRequestMasterVariable->laboratorium_request_category_master_id;
            }
        }
        $dataCategoryPemeriksaan = LaboratoriumRequestCategoryMaster::whereIn('id', $categoryPemeriksaanIds)->get();

        return view('pages.surat.hasilpemeriksaanlabor', [
            "title" => "Laboratorium PK",
            "menu" => "Laboratorium PK",
            'item' => $item,
            'dataCategoryPemeriksaan' => $dataCategoryPemeriksaan,
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
        $today = new DateTime(date('Y-m-d H:i:s'));
        $item = LaboratoriumPatientResult::find($id);

        $categoryIds = [];
        foreach ($item->laboratoriumPatientResultDetails as $detail) {
            if($detail->laboratoriumRequestMasterVariable->laboratoriumRequestCategoryMaster){
                $categoryIds[] = $detail->laboratoriumRequestMasterVariable->laboratoriumRequestCategoryMaster->id;
            }
        }
        $dataKategori = LaboratoriumRequestCategoryMaster::all();

        return view('pages.pasienLaboratorium.edit', [
            "title" => "Laboratorium PK",
            "menu" => "Laboratorium PK",
            'item' => $item,
            'today' => $today,
            'categoryIds' => $categoryIds,
            'dataKategori' => $dataKategori,
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
        $item = LaboratoriumPatientResult::find($id);
        //Update data laboratorium Patient Result
        $kesan = $request->input('kesan');
        $anjuran = $request->input('anjuran');
        $tglPeriksaSelesai = $request->input('tgl_periksa_selesai');
        $tglAmbilSampel = $request->input('tgl_ambil_sampel');
        $jam_kritis = $request->input('jam_pelaporan_kritis');

        $arrVariabelKritisIds = $request->input('nilai_kritis_variabel_id', []);

        $dumpData = $request->input('data', []);
        $newData = [];
        foreach ($dumpData as $input) {
            $newData[] = [
                'laboratorium_patient_result_detail_id' => $input['laboratorium_patient_result_detail_id'],
                'value' => $input['hasil']
            ];
        }

        if($item->status == 'VALIDATED'){
            $old_data = $item;
        }

         ###update record##
         $item->update([
            'kesan' => $kesan,
            'anjuran' => $anjuran,
            'tgl_pengambilan_sampel' => $tglAmbilSampel,
            'tgl_pemeriksaan_selesai' => $tglPeriksaSelesai,
            'jam_pelaporan_kritis' => $jam_kritis, 
        ]);

        foreach ($newData as $newItem) {
            $itemDetail = LaboratoriumPatientResultDetail::find($newItem['laboratorium_patient_result_detail_id']);
            $itemDetail->update([
                'value' => $newItem['value'],
                'kondisi_kritis' => in_array($itemDetail->laboratorium_request_master_variable_id, $arrVariabelKritisIds) ? true : false,
            ]);
        }


        return redirect()->route('laboratorium/patient/queue.index')->with('success', 'Berhasil Ditambahkan');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($queue_id, $id)
    {
        //
    }

    public function reviewUlang($id){
        $item = LaboratoriumPatientResult::find($id);
        $today = date('Y-m-d H:i');
        return view('pages.reviewUlangLaborPk.create', [
            'title' => 'Review Ulang Labor PK',
            'menu' => 'Review Ulang Labor PK',
            'item' => $item,
            'today' => $today,
        ]);
    }
    public function reviewUlangStore(Request $request, $id){
        $data = $request->all();
        $item = LaboratoriumPatientResult::find($id);
        dd($data, $item);
    }
}
