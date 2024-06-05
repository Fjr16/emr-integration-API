<?php

namespace App\Http\Controllers;

use App\Models\ConsultingRates;
use App\Models\PatientCategory;
use App\Models\User;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::whereNot('room_detail_id', null)->get();
        return view('pages.konsultasi.index', [
            'data' => $data,
            'title' => 'Konsultasi',
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
        $data = User::whereNot('room_detail_id', null)->get();
        return view('pages.konsultasi.create', [
            'title' => 'Konsultasi',
            'menu' => 'Setting',
            'data' => $data
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
        $findRates = ConsultingRates::where('user_id', $data['user_id'])->get();
        if($findRates->isEmpty()){
            $item = User::find($data['user_id']);
            if($item){
                $categories = PatientCategory::all();
                foreach($categories as $category){
                    ConsultingRates::create([
                        'user_id' => $item->id,
                        'patient_category_id' => $category->id,
                    ]);
                }
            }
            return redirect()->route('konsultasi')->with('success', 'SUKSES');
        }
        return redirect()->route('konsultasi')->with('error', 'Data Telah Ada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = User::find($id);
        return view('pages.konsultasi.edit', [
            'title' => 'Konsultasi',
            'menu' => 'Setting',
            'item' => $item,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PatientCategory::all();
        $item = User::find($id);
        $rateIds = $item->consultingRates->pluck('patient_category_id')->toArray();
        foreach($data as $tanggungan){
            if(!in_array($tanggungan->id, $rateIds)){
                ConsultingRates::create([
                    'user_id' => $item->id,
                    'patient_category_id' => $tanggungan->id,
                ]);
            }   
        }

        return back()->with('success', 'Berhasil Diperbarui');
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
        $item = ConsultingRates::find($id);
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
        $item = User::find($id);
        if($item->consultingRates->isNotEmpty()){
            $item->consultingRates()->update([
                'tindakan' => null,
                'pembayaran' => null,
            ]);
        }
        return back()->with('success', 'SUKSES');
    }
}
