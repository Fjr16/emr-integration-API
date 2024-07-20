<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ActionRate;
use App\Models\PatientCategory;
use Illuminate\Http\Request;

class PatientCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PatientCategory::all();
        return view('pages.kategoriPasien.index', [
            'data' => $data,
            'title' => 'Kategori Pasien',
            'menu' => 'Setting',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.kategoriPasien.create', [
            'title' => 'Kategori Pasien',
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
        $data['include_pajak_obt'] = $request->include_pajak_obt ?? false;
        $data['include_disc_obt'] = $request->include_disc_obt ?? false;
        $data['include_margin_obt'] = $request->include_margin_obt ?? false;
        $item = PatientCategory::create($data);
        $action = Action::all();
        foreach($action as $action){
            ActionRate::create([
                'action_id' => $action->id,
                'patient_category_id' => $item->id
            ]);
        }
        return redirect()->route('pasien/category')->with('success', 'SUKSES');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = PatientCategory::find($id);
        return view('pages.kategoriPasien.edit', [
            'item' => $item,
            'title' => 'Kategori Pasien',
            'menu' => 'Setting',
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
        $item = PatientCategory::find($id);
        $data = $request->all();
        $data['include_pajak_obt'] = $request->include_pajak_obt ?? false;
        $data['include_disc_obt'] = $request->include_disc_obt ?? false;
        $data['include_margin_obt'] = $request->include_margin_obt ?? false;
        $item->update($data);
        return redirect()->route('pasien/category')->with('success' , 'SUKSES');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = PatientCategory::find($id);
        foreach ($item->actionRates as $rate){
            $rate->delete();
        }
        $item->delete();
        return back()->with('success', 'SUKSES');
    }
}
