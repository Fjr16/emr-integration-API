<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientCategory;
use App\Models\LaboratoriumRequest;
use App\Models\LaboratoriumRequestDetail;
use App\Models\LaboratoriumRequestTypeMaster;
use App\Models\LaboratoriumRequestCategoryMaster;

class LaboratoriumRequestRekamMedisController extends Controller
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
        $item = LaboratoriumRequest::find($id);
        $data = LaboratoriumRequestCategoryMaster::all();
        $types = LaboratoriumRequestTypeMaster::all();
        $patientCategories = PatientCategory::all();
        return view('pages.permintaanLaboratoriumRM.create', [
            "title" => "Laboratorium PK",
            "menu" => "Laboratorium PK",
            'item' => $item,
            'data' => $data,
            'types' => $types,
            'patientCategories' => $patientCategories,
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
        //get data for Laboratorium Request from request post
        $diagnosa = $request->input('diagnosa');
        $ruang = $request->input('ruang');
        $tanggal = $request->input('tanggal');
        $tipe = $request->input('laboratorium_request_type_master_id');
        $patient_category_id = $request->input('patient_category_id');
        $item = LaboratoriumRequest::find($id);

        //get data for request detail
        $laboratoriumReqIds = $request->input('laboratorium_request_master_variable_id', []);

        $addDetails = [];

        foreach ($laboratoriumReqIds as $reqId) {
            $addDetails[] = [
                'laboratorium_request_master_variable_id' => $reqId,
                'value' => null,
            ];
        }

        // update Laboratorium Request
        $item->update([
        'laboratorium_request_type_master_id' => $tipe,
        'patient_category_id' => $patient_category_id,
        'diagnosa' => $diagnosa,
        'ruang' => $ruang,
        'tanggal' => $tanggal,
        ]);

        //create Laboratorium Request Detail
        foreach($addDetails as $new){
            LaboratoriumRequestDetail::create([
                'laboratorium_request_id' => $item->id, 
                'laboratorium_request_master_variable_id' => $new['laboratorium_request_master_variable_id'], 
                'value' => $new['value'], 
            ]);
        }
        
        return redirect()->route('laboratorium/patient.index')->with('success', 'Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
