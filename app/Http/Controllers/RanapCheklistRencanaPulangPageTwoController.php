<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\RawatInapPatient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\RanapDischargePlanningPharmacy;
use App\Models\RanapDischargePlanningNutrition;
use App\Models\RanapDischargePlanningGiziPharmacy;

class RanapCheklistRencanaPulangPageTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient', function($query){
            $query->whereNot('status', 'WAITING')->whereNot('status', 'BATAL');
        })->get();
        return view('pages.dischargePlanningGizi.index', [
            "title" => "Discharge Planning Gizi",
            "menu" => "Rawat Inap",
            "data" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = RawatInapPatient::find($id);
        $medicines = Medicine::all();
        $arrDiet = [
            'Anjuran Pola Makan',
            'Makanan yang perlu dihindari',
        ];
        return view('pages.dischargePlanningGizi.create', [
            "title" => "Discharge Planning Gizi",
            "menu" => "Rawat Inap",
            "item" => $item,
            "medicines" => $medicines,
            "arrDiet" => $arrDiet,
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
        $item = RawatInapPatient::find($id);

        // paraf pasien / wali
        $folder_path = 'assets/paraf-pasien/';
        Storage::makeDirectory('public/' . $folder_path);

        $ttdImg = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd_wali')));
        $file_name = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name, $ttdImg);

        $main = RanapDischargePlanningGiziPharmacy::create([
            'rawat_inap_patient_id' => $item->id,
            'patient_id' => $item->queue->patient->id,
            'user_id' => Auth::user()->id,
            'keterangan_gizi' => $request->input('keterangan'),
            'nm_petugas_farmasi' => $request->input('nm_petugas_farmasi'),
            'ttd_petugas_farmasi' => $request->input('ttd_petugas_farmasi'),
            'nm_petugas_gizi' => $request->input('nm_petugas_gizi'),
            'ttd_petugas_gizi' => $request->input('ttd_petugas_gizi'),
            'nm_wali' => $request->input('nm_wali'),
            'ttd_wali' => $file_name,
        ]);

        $medicineIds = $request->input('medicine_id', []);
        $indikasis = $request->input('indikasi', []);
        $dosis = $request->input('dosis', []);
        $waktuPemberian = $request->input('waktu_pemberian', []);
        $caraPemberian = $request->input('cara_pemberian', []);
        foreach ($medicineIds as $key => $medicineId) {
            RanapDischargePlanningPharmacy::create([
                'ranap_discharge_planning_gizi_pharmacy_id' => $main->id,
                'medicine_id' => $medicineId,
                'indikasi' => $indikasis[$key],
                'dosis' => $dosis[$key],
                'waktu_pemberian' => $waktuPemberian[$key],
                'cara_pemberian' => $caraPemberian[$key],
            ]);
        }

        $diets = $request->input('diet', []);
        foreach ($diets as $diet) {
            RanapDischargePlanningNutrition::create([
                'ranap_discharge_planning_gizi_pharmacy_id' => $main->id,
                'diet' => $diet,
            ]);
        }

        return redirect()->route('checklist/rencana/pulang/page/two.show', $item->id)->with('success', 'Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = RawatInapPatient::find($id);
        return view('pages.dischargePlanningGizi.show', [
            "title" => "Discharge Planning Gizi",
            "menu" => "Rawat Inap",
            "item" => $item,
        ]);
    }

    public function print($id)
    {
        $item = RanapDischargePlanningGiziPharmacy::find($id);
        return view('pages.dischargePlanningGizi.print', [
            "title" => "Discharge Planning Gizi",
            "menu" => "Rawat Inap",
            "item" => $item,
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
        $item = RanapDischargePlanningGiziPharmacy::find($id);
        $medicines = Medicine::all();
        $arrDiet = [
            'Anjuran Pola Makan',
            'Makanan yang perlu dihindari',
        ];
        return view('pages.dischargePlanningGizi.edit', [
            "title" => "Discharge Planning Gizi",
            "menu" => "Rawat Inap",
            "item" => $item,
            "medicines" => $medicines,
            "arrDiet" => $arrDiet,
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
        $item = RanapDischargePlanningGiziPharmacy::find($id);

        $file_name = $request->ttd_wali;
        if ($request->ttd_wali != $item->ttd_wali) {
            // paraf pasien / wali
            $folder_path = 'assets/paraf-pasien/';
            Storage::makeDirectory('public/' . $folder_path);
    
            $ttdImg = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd_wali')));
            $file_name = $folder_path . uniqid() . '.png';
            Storage::put('public/' . $file_name, $ttdImg);
        }

        $item->update([
            'keterangan_gizi' => $request->input('keterangan'),
            'nm_petugas_farmasi' => $request->input('nm_petugas_farmasi'),
            'ttd_petugas_farmasi' => $request->input('ttd_petugas_farmasi'),
            'nm_petugas_gizi' => $request->input('nm_petugas_gizi'),
            'ttd_petugas_gizi' => $request->input('ttd_petugas_gizi'),
            'nm_wali' => $request->input('nm_wali'),
            'ttd_wali' => $file_name,
        ]);

        $item->ranapDischargePlanningPharmacies()->delete();
        $medicineIds = $request->input('medicine_id', []);
        $indikasis = $request->input('indikasi', []);
        $dosis = $request->input('dosis', []);
        $waktuPemberian = $request->input('waktu_pemberian', []);
        $caraPemberian = $request->input('cara_pemberian', []);
        foreach ($medicineIds as $key => $medicineId) {
            RanapDischargePlanningPharmacy::create([
                'ranap_discharge_planning_gizi_pharmacy_id' => $item->id,
                'medicine_id' => $medicineId,
                'indikasi' => $indikasis[$key],
                'dosis' => $dosis[$key],
                'waktu_pemberian' => $waktuPemberian[$key],
                'cara_pemberian' => $caraPemberian[$key],
            ]);
        }

        $item->ranapDischargePlanningNutritions()->delete();
        $diets = $request->input('diet', []);
        foreach ($diets as $diet) {
            RanapDischargePlanningNutrition::create([
                'ranap_discharge_planning_gizi_pharmacy_id' => $item->id,
                'diet' => $diet,
            ]);
        }

        return redirect()->route('checklist/rencana/pulang/page/two.show', $item->rawatInapPatient->id)->with('success', 'Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = RanapDischargePlanningGiziPharmacy::find($id);
        $item->ranapDischargePlanningPharmacies()->delete();
        $item->ranapDischargePlanningNutritions()->delete();
        $item->delete();
        
        return back()->with('success', 'Berhasil Dihapus');
    }
}
