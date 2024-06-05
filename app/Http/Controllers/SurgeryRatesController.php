<?php

namespace App\Http\Controllers;

use App\Models\PatientCategory;
use App\Models\Surgery;
use App\Models\SurgeryRates;
use Illuminate\Http\Request;

class SurgeryRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $item = Surgery::find($id);
        $patientCategories = PatientCategory::all();
        $patientCategory = PatientCategory::inRandomOrder()->first();
        if(request('filter')){
            $data = SurgeryRates::where('surgery_id', $id)->where('patient_category_id', request('filter'))->get();
        }else{
            $data = SurgeryRates::where('surgery_id', $id)->where('patient_category_id', $patientCategory->id)->get();
        }
        return view('pages.tarifOperasi.index', [
            'data' => $data,
            'item' => $item,
            'patientCategories' => $patientCategories,
            'patientCategory' => $patientCategory,
            'title' => 'Operasi',
            'menu' => 'Operasi',
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
        $data = $request->all();
        $item = SurgeryRates::find($id);
        $item->update($data);
        return back()->with('success', 'SUKSES');
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
