<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;
use App\Models\ActionCategory;
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
        $data = ActionCategory::all();
        return view('pages.tindakan.create', [
            "title" => "Jenis Tindakan",
            "menu" => "Tindakan",
            "data" => $data
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
        $patientCategories = PatientCategory::all();
        if($item = Action::create($data)){
            foreach($patientCategories as $category){
                ActionRate::create([
                    'action_id' => $item->id,
                    'patient_category_id' => $category->id
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
        $data = ActionCategory::all();
        $item = Action::find($id);
        return view('pages.tindakan.edit', [
            "title" => "Jenis Tindakan",
            "menu" => "Tindakan",
            "item" => $item,
            "data" => $data
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
