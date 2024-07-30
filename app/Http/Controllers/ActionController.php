<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;
use App\Models\ActionRate;
use App\Models\PatientCategory;

class ActionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Action::all();
        return view('pages.tindakan.index', [
            "title" => "Tindakan",
            "menu" => "Setting",
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'Tindakan Pelayanan Medis',
            'Radiologi',
            'Laboratorium',
        ];
        $patientCategories = PatientCategory::all();
        return view('pages.tindakan.create', [
            "title" => "Tindakan",
            "menu" => "Setting",
            "data" => $data,
            "patientCategories" => $patientCategories
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
        $patientCategoryIds = $request->input('patient_category_id');
        $tarifs = $request->input('tarif');
        if($item = Action::create($data)){
            foreach($patientCategoryIds as $index => $category){
                ActionRate::create([
                    'action_id' => $item->id,
                    'patient_category_id' => $category,
                    'tarif' => $tarifs[$index]
                ]);
            }
        }
        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'Tindakan Pelayanan Medis',
            'Radiologi',
            'Laboratorium',
        ];
        $item = Action::find($id);
        $patientCategories = PatientCategory::all();
        return view('pages.tindakan.edit', [
            "title" => "Jenis Tindakan",
            "menu" => "Tindakan",
            "item" => $item,
            "data" => $data,
            "patientCategories" => $patientCategories
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
        $item = Action::find($id);
        $item->update($data);

        $rateIds = $request->input('action_rate_id', []);
        $tarifs = $request->input('tarif', []);

        foreach ($rateIds as $key => $rateId) {
            $itemRate = ActionRate::find($rateId);
            if ($itemRate) {
                $itemRate->update([
                    'tarif' => $tarifs[$key],
                ]);
            }
        }
        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Action::find($id);
        foreach ($item->actionRates as $rate) {
            $rate->delete();
        }
        $item->delete();
        return back()->with('success', 'Tindakan Berhasil Dihapus');
    }
}
