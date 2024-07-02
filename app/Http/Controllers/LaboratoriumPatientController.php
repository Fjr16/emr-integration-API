<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LaboratoriumRequest;
use App\Models\LaboratoriumRequestDetail;
use DateTime;
use Illuminate\Validation\ValidationException;

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
        $item = LaboratoriumRequest::find($id);
        return view('pages.pasienLaboratorium.create', [
            "title" => "Antrian Laboratorium PK",
            "menu" => "Laboratorium PK",
            'item' => $item,
            'today' => $today,
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
        try {
            $this->validate($request, [
                'detail_id' => 'required|array',
                'detail_id.*' => 'required|integer',
            ]); 
        } catch (ValidationException $message) {
            return back()->with('error', 'Terdapat pemeriksaan yang tidak terdaftar, mohon hubungi staff admin untuk melakukan perbaikan');
        }  

        // update request detail
        $detail_ids = $request->input('detail_id');
        $hasilArr = $request->input('hasil', []);
        $kritisArr = $request->input('kritis', []);
        foreach ($detail_ids as $key => $detail_id) {
            LaboratoriumRequestDetail::firstwhere('id', $detail_id)->update([
                'hasil' => $hasilArr[$key],
                'kritis' => $kritisArr[$key],
            ]);
        }
        // update data labor request
        $item = LaboratoriumRequest::find($id);
        $item->update([
            'petugas_id' => auth()->user()->id,
            'kesan_anjuran' => $request->input('kesan_anjuran'),
            'status' => 'UNVALIDATE',
            'tanggal_periksa_selesai' => $request->input('tanggal_periksa', date('Y-m-d')),
        ]);

        return redirect()->route('laboratorium/patient/queue.index')->with('success', 'Berhasil Diperbarui');
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
}
