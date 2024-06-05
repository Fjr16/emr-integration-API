<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\ChangeLog;
use App\Models\IgdPatient;
use App\Models\IgdRmeCppt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IgdRmeCpptController extends Controller
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
    public function create(Request $request, $id)
    {
        $igd_patient = IgdPatient::find($id);
        
        $item = Patient::findOrFail($request->patient_id);
        $today = now()->format('Y-m-d H:i');
        return view('pages.igdCppt.create', [
            'title' => 'IGD',
            'menu' => 'In Patient',
            'item' => $item,
            'today' => $today,
            'igd_patient' => $igd_patient,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $igd_patient = IgdPatient::find($id);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['igd_patient_id'] = $id;
        
        IgdRmeCppt::create($data);
        
        return back()->with([
            'success' => 'Berhasil Ditambahkan',
            'active' => 'cppt',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Patient::findOrFail($id);
        return view('pages.igdCppt.show', [
            'title' => 'IGD',
            'menu' => 'In Patient',
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
        $item = IgdRmeCppt::findOrFail($id);
        $today = now()->format('Y-m-d H:i');
        return view('pages.igdCppt.edit', [
            'title' => 'IGD',
            'menu' => 'In Patient',
            'item' => $item,
            'today' => $today,
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
        $item = IgdRmeCppt::findOrFail($id);

        //changeLog
        $old_data = json_encode($item);
        
        $item->update($data);

        //create change Log
        $log_data = [
            'user_id' => Auth::user()->id,
            'record_id' => $item->id,
            'record_type' => IgdRmeCppt::class,
            'old_data' => $old_data,
            'new_data' => json_encode($item),
        ];
        ChangeLog::create($log_data);

        return back()->with([
            'success' => 'Berhasil Diperbarui',
            'active' => 'cppt',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = IgdRmeCppt::findOrFail($id);
        $item->delete();
        return back()->with([
            'success' => 'Berhasil Dihapus',
            'active' => 'cppt',
        ]);
    }
}
