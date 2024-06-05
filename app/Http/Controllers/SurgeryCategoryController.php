<?php

namespace App\Http\Controllers;

use App\Models\PatientCategory;
use App\Models\Surgery;
use App\Models\SurgeryCategory;
use App\Models\SurgeryRates;
use Illuminate\Http\Request;

class SurgeryCategoryController extends Controller
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
    public function create()
    {
        $data = SurgeryCategory::all();
        return view('pages.jasaOperasi.create', [
            'title' => 'Operasi',
            'menu' => 'Operasi',
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $surgeries = Surgery::all();
        $patientCategories = PatientCategory::all();
        $c = SurgeryCategory::create($data);
        foreach($surgeries as $surgery){
            foreach($patientCategories as $patientCategory){
                SurgeryRates::create([
                    'surgery_id' => $surgery->id,
                    'surgery_category_id' => $c->id,
                    'patient_category_id' => $patientCategory->id,
                ]);
            }
        }
        return back()->with('success', 'SUKSES');

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
        $item = SurgeryCategory::find($id);
        return view('pages.jasaOperasi.edit', [
            'item' => $item,
            'title' => 'Operasi',
            'menu' => 'Operasi',
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
        $item = SurgeryCategory::find($id);
        $data = $request->all();
        $item->update($data);
        return redirect()->route('surgery/category.create')->with('success', 'SUKSES');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = SurgeryCategory::find($id);
        $surgeryRates = SurgeryRates::where('surgery_category_id', $item->id)->get();
        foreach($surgeryRates as $surgeryRate){
            $surgeryRate->delete();
        }
        $item->delete();
        return back()->with('success', 'SUKSES');
    }
}
