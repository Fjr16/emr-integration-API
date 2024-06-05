<?php

namespace App\Http\Controllers;

use App\Models\PatientCategory;
use App\Models\Surgery;
use App\Models\SurgeryCategory;
use App\Models\SurgeryRates;
use Illuminate\Http\Request;

class SurgeryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Surgery::all();
        return  view('pages.operasi.index', [
            'data' => $data,
            'menu' => 'Setting',
            'title' => 'Operasi',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.operasi.create', [
            'title' => 'Operasi',
            'menu' => 'Setting',
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
        $surgeryCategories = SurgeryCategory::all();
        $patientCategories = PatientCategory::all();
        $s = Surgery::create($data);
        foreach($surgeryCategories as $surgeryCategory){
            foreach($patientCategories as $patientCategory){
                SurgeryRates::create([
                    'surgery_id' => $s->id,
                    'surgery_category_id' => $surgeryCategory->id,
                    'patient_category_id' => $patientCategory->id,
                ]);
            }
        }
        return redirect()->route('surgery.index');
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
        $item = Surgery::find($id);
        return view('pages.operasi.edit', [
            'item' => $item,
            'title' => 'Operasi',
            'menu' => 'Setting,'
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
        $item = Surgery::find($id);
        $data = $request->all();
        $item->update($data);
        return redirect()->route('surgery/index')->with('success', 'SUKSES');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Surgery::find($id);
        $item->delete();
        return back()->with('success', 'SUKSES');
    }
}
