<?php

namespace App\Http\Controllers;

use App\Models\PatientCategory;
use Illuminate\Http\Request;
use App\Models\RadiologiFormRequestMaster;
use App\Models\RadiologiFormRequestMasterRate;

class RadiologiFormRequestMasterRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RadiologiFormRequestMaster::where('isActive', true)->get();
        return view('pages.radiologiMasterTarif.index', [
            'title' => 'Master Radiologi',
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
        $item = RadiologiFormRequestMaster::find($id);
        $data = PatientCategory::all();
        foreach ($data as $category) {
            $find = false;
            foreach($item->radiologiFormRequestMasterRates as $tarif){
                if($tarif->patient_category_id == $category->id){
                    $find = true;
                    break;
                }
            }
            if($find == false){
                RadiologiFormRequestMasterRate::create([
                    'radiologi_form_request_master_id' => $item->id,
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
    public function store(Request $request)
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
        $item = RadiologiFormRequestMaster::find($id);
        return view('pages.radiologiMasterTarif.edit', [
            'title' => 'Master Radiologi',
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
        $data = $request->all();
        $item = RadiologiFormRequestMasterRate::find($id);

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
