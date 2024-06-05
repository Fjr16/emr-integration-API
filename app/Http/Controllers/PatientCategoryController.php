<?php

namespace App\Http\Controllers;

use App\Models\ActionMemberRates;
use App\Models\ActionMembers;
use App\Models\Bedroom;
use App\Models\BedroomRate;
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
        $item = PatientCategory::create($data);
        $kamar = Bedroom::all();
        $action = ActionMembers::all();
        foreach($kamar as $kamar){
            BedroomRate::create([
                'bedroom_id' => $kamar->id,
                'patient_category_id' => $item->id
            ]);
        }
        foreach($action as $action){
            ActionMemberRates::create([
                'action_members_id' => $action->id,
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
        $bedroomRates = BedroomRate::where('patient_category_id', $item->id)->get();
        foreach($bedroomRates as $rate){
            $rate->delete();
        }
        foreach ($item->actionMemberRates as $actionRate){
            $actionRate->delete();
        }
        $item->delete();
        return back()->with('success', 'SUKSES');
    }
}
