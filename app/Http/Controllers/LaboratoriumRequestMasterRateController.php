<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientCategory;
use App\Models\LaboratoriumRequestMasterRate;
use App\Models\LaboratoriumRequestMasterVariable;

class LaboratoriumRequestMasterRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = LaboratoriumRequestMasterVariable::where('isActive', true)->get();
        return view('pages.masterTarifPemeriksaanLabor.index', [
            'title' => 'Master Labor PK',
            'menu' => 'Setting',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = LaboratoriumRequestMasterVariable::find($id);
        $data = PatientCategory::all();
        foreach ($data as $category) {
            $find = false;
            foreach($item->laboratoriumRequestMasterRates as $tarif){
                if($tarif->patient_category_id == $category->id){
                    $find = true;
                    break;
                }
            }
            if($find == false){
                LaboratoriumRequestMasterRate::create([
                    'laboratorium_request_master_variable_id' => $item->id,
                    'patient_category_id' => $category->id,
                ]);
            }
        }

        return back()->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
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
        $item = LaboratoriumRequestMasterVariable::find($id);
        return view('pages.masterTarifPemeriksaanLabor.edit', [
            'title' => 'Master Labor PK',
            'menu' => 'Setting',
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
    public function update(Request $request, $id)
    {
        if($request->route()->action['as'] == 'laboratorium/pk/variabel/tarif/pemeriksaan.update'){
            $item = LaboratoriumRequestMasterVariable::find($id);
        }else{
            $item = LaboratoriumRequestMasterRate::find($id);
        }
        $data = $request->all();

        $item->update($data);

        return back()->with('success', 'Berhasil Diperbarui');
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
