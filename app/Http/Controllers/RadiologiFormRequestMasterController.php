<?php

namespace App\Http\Controllers;

use App\Models\PatientCategory;
use App\Models\RadiologiFormRequestMaster;
use App\Models\RadiologiFormRequestMasterCategory;
use App\Models\RadiologiFormRequestMasterDetail;
use App\Models\RadiologiFormRequestMasterRate;
use Illuminate\Http\Request;

class RadiologiFormRequestMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = RadiologiFormRequestMasterDetail::where('isActive', true)->get();
        $data = RadiologiFormRequestMasterCategory::where('isActive', true)->get();
        return view('pages.RadiologiMaster.index', [
            'title' => 'Master Radiologi',
            'menu' => 'Setting',
            'data' => $data,
            'details' => $details,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detail_ids = $request->input('radiologi_form_request_master_detail_id', []);
        $data = $request->all();
        if(!$request->input('input_type')){
            $data['input_type'] = 'checkbox';
        }

        $item = RadiologiFormRequestMaster::create($data);
        $item->radiologiFormRequestMasterDetails()->attach($detail_ids);

        $patientCategories = PatientCategory::all();
        foreach ($patientCategories as $tanggungan) {
            RadiologiFormRequestMasterRate::create([
                'radiologi_form_request_master_id' => $item->id,
                'patient_category_id' => $tanggungan->id,
            ]);
        }

        return back()->with('success', 'Berhasil Ditambahkan');
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
        $item = RadiologiFormRequestMaster::findOrFail($id);
        $categories = RadiologiFormRequestMasterCategory::all();
        $details = RadiologiFormRequestMasterDetail::where('isActive', true)->get();
        return view('pages.RadiologiMaster.edit', [
            'title' => 'Master Radiologi',
            'menu' => 'Setting',
            'categories' => $categories,
            'item' => $item,
            'details' => $details,
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
        $item = RadiologiFormRequestMaster::findOrFail($id);
        $data = $request->all();
        $detail_ids = $request->input('radiologi_form_request_master_detail_id', []);

        if(!$request->input('input_type')){
            $data['input_type'] = 'checkbox';
        }
        
        $item->update($data);
        $item->radiologiFormRequestMasterDetails()->sync($detail_ids);
        
        return back()->with('success', 'Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = RadiologiFormRequestMaster::find($id);
        $item->update([
            'isActive' => false,
        ]);
        return back()->with('success', 'Berhasil Dihapus');
    }
}
