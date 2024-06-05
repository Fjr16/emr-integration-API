<?php

namespace App\Http\Controllers;

use App\Models\IgdPatient;
use Illuminate\Http\Request;
use App\Models\IgdAseKepPatient;
use App\Models\IgdRencanaAsuhanAssKepPatient;
use DateTime;
use Illuminate\Support\Facades\Auth;

class IgdAsesmentKeperawatanRencanaAsuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $currentIgdPatientId = session('current_id', '');
        $item = IgdPatient::find($id);
        // dd($item->igdAseKepPatient);
        $rencanaAsuhan = [
            'Manajemen Nyeri',
            'Dukungan Mobilisasi',
            'Perawatan Luka',
            'Manajemen Jalan Napas',
            'Perawatan Retensi Urine',
        ];
        $detailRencana = IgdRencanaAsuhanAssKepPatient::where('igd_ase_kep_patient_id', $item->igdAseKepPatient->id ?? '')->get();

        return view('pages.igdAssKepPatient.rencanaAsuhan.index', [
            'title' => 'IGD',
            'menu' => 'IGD',
            'rencanaAsuhan' => $rencanaAsuhan,
            'item' => $item,
            'detailRencana' => $detailRencana,
            'currentIgdPatientId' => $currentIgdPatientId,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $item = IgdPatient::find($id);
        //input askep patient
        $ttdDokter = $request->input('ttd_dokter');
        $nmDokter = $request->input('nm_dokter');
        $ttdPerawat = $request->input('ttd_perawat');
        $nmPerawat = $request->input('nm_perawat');
        $tanggal = new DateTime($request->input('date'));

        // input asuhan
        $asuhan = $request->input('asuhan', []);

        $igdAssKep = IgdAseKepPatient::where('igd_patient_id', $item->id)->first();
        if ($igdAssKep == null) {
            $igdAssKep = IgdAseKepPatient::create([
                'igd_patient_id' => $item->id,
                'patient_id' => $item->queue->patient->id,
                'user_id' => Auth::user()->id,
                'ttdDokter' => $ttdDokter,
                'nm_dokter' => $nmDokter,
                'ttdPerawat' => $ttdPerawat,
                'nm_perawat' => $nmPerawat,
                'tgl_selesai_asesmen' => $tanggal,
            ]);
        }else{
            $igdAssKep->update([
                'ttdDokter' => $ttdDokter,
                'nm_dokter' => $nmDokter,
                'ttdPerawat' => $ttdPerawat,
                'nm_perawat' => $nmPerawat,
                'tgl_selesai_asesmen' => $tanggal,
            ]);
        }
        
        if ($igdAssKep->igdRencanaAsuhanAssKepPatients->isNotEmpty()) {
            $igdAssKep->igdRencanaAsuhanAssKepPatients()->delete();
        }
        foreach ($asuhan as $a) {
            if ($a != null) {
                IgdRencanaAsuhanAssKepPatient::create([
                    'igd_ase_kep_patient_id' => $igdAssKep->id,
                    'name' => $a,
                ]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
