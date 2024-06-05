<?php

namespace App\Http\Controllers;

use App\Models\LaboratoriumRequestCategoryMaster;
use App\Models\LaboratoriumRequestMasterDetail;
use App\Models\LaboratoriumRequestMasterRate;
use App\Models\LaboratoriumRequestMasterVariable;
use App\Models\PatientCategory;
use Illuminate\Http\Request;

class LaboratoriumMasterVariabelPemeriksaanController extends Controller
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
        $data = LaboratoriumRequestCategoryMaster::all();
        $counter = 0;
        return view('pages.masterVariabelPemeriksaanLaborPk.create', [
            'title' => 'Master Labor PK',
            'menu' => 'Setting',
            'data' => $data,
            'counter' => $counter
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
        $request->validate([
            'laboratorium_request_category_master_id' => 'required',
        ]);
        $category_id = $request->input('laboratorium_request_category_master_id');
        $variabels = $request->input('variable', []);

        foreach ($variabels as $variabel) {
            if(!empty($variabel)){
                $item = LaboratoriumRequestMasterVariable::create([
                    'laboratorium_request_category_master_id' => $category_id,
                    'name' => $variabel['name'],
                    'icd_code' => $variabel['icd_code'],
                ]);

                $categories = PatientCategory::all();
                foreach($categories as $category){
                    LaboratoriumRequestMasterRate::create([
                        'laboratorium_request_master_variable_id' => $item->id,
                        'patient_category_id' => $category->id,
                    ]);
                }
            }
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
        $item = LaboratoriumRequestMasterVariable::find($id);
        $data = LaboratoriumRequestMasterDetail::where('laboratorium_request_master_variable_id', $item->id)->get();
        $categories = LaboratoriumRequestCategoryMaster::all();

        return view('pages.masterVariabelPemeriksaanLaborPk.edit', [
            'title' => 'Master Labor PK',
            'menu' => 'Setting',
            'item' => $item,
            'data' => $data,
            'categories' => $categories,
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
        $request->validate([
            'laboratorium_request_category_master_id' => 'required',
            'name' => 'required',
        ]);

        $categoryId = $request->input('laboratorium_request_category_master_id');
        $name = $request->input('name');
        $item = LaboratoriumRequestMasterVariable::find($id);
        
        $item->update([
            'laboratorium_request_category_master_id' => $categoryId,
            'name' => $name
        ]);

        return redirect()->route('laboratorium/pk/variabel/pemeriksaan.create')->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = LaboratoriumRequestMasterVariable::find($id);
        
        $item->update([
            'isActive' => false,
        ]);

        return back()->with('success', 'Berhasil Dihapus');
    }
}
