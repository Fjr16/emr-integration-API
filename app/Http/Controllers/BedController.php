<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Bedroom;
use App\Models\BedroomRate;
use App\Models\BedroomType;
use Illuminate\Http\Request;
use App\Models\PatientCategory;

class BedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Bed::all();
        return view('pages.kamarRanjang.index', [
            'title' => 'Ranjang',
            'menu' => 'Setting',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bedrooms = Bedroom::all();
        $types = BedroomType::all();
        return view('pages.kamarRanjang.create', [
            'title' => 'Ranjang',
            'menu' => 'Setting',
            'bedrooms' => $bedrooms,
            'types' => $types,
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
        if(!$request['isAvailable']){
            $data['isAvailable'] = '0';
        }

        $categories = PatientCategory::all();
        if($b = Bed::create($data)){
            foreach($categories as $category){
                BedroomRate::create([
                    'bed_id' => $b->id,
                    'patient_category_id' => $category->id
                ]);
            }
        }

        return redirect()->route('kamar/ranjang.index')->with('success', 'Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Bed::all();
        return view('pages.kamarRanjang.show', [
            'title' => 'Status Ranjang',
            'menu' => 'Kamar',
            'data' => $data,
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
        $item = Bed::findOrFail($id);
        $bedrooms = Bedroom::all();
        $types = BedroomType::all();
        return view('pages.kamarRanjang.edit', [
            'title' => 'Ranjang',
            'menu' => 'Setting',
            'item' => $item,
            'bedrooms' => $bedrooms,
            'types' => $types,
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
        if(!$request['isAvailable']){
            $data['isAvailable'] = '0';
        }
        $item = Bed::findOrFail($id);
        $item->update($data);

        return redirect()->route('kamar/ranjang.index')->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Bed::findOrFail($id);
        $bedRates = BedroomRate::where('bed_id', $item->id)->get();
        foreach ($bedRates as $rate) {
            $rate->delete();
        }
        $item->delete();
        return back()->with('success', 'Berhasil Dihapus');

    }
}
