<?php

namespace App\Http\Controllers;

use App\Models\IgdPatient;
use Illuminate\Http\Request;
use App\Models\IgdAseKepPatient;
use App\Models\IgdDiagnosisKeperawatanAssKepPatient;
use App\Models\IgdHubDiagnosisKepAssKepPatient;
use App\Models\IgdMasalahKeperawatanAssKepPatient;
use Illuminate\Support\Facades\Auth;

class IgdAsesmentKeperawatanDiagnosisController extends Controller
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
        $bdNyeriAkut = [
            'Agen pencedera fisiologis *(Inflamasi/Iskemia/Neoplasma)',
            'Agen pencedera fisik *(Abses/Amputasi/Terpotong/Trauma/Fraktur/Prosedur Operasi/Latihan Fisik berlebihan/Mengangkat Berat)',
            'Agen pencedera kimia *(terbakar/bahan kimia iritan)',
        ];

        $bdFisik = [
            'Kerusakan Struktur Tulang',
            'Kontraktur',
            'Penurunan kekuatan otot',
            'Kekakuan Sendi',
            'Program Pembatasan Gerak',
        ];

        $bdIntegritas = [
            'Faktor Mekanis *(Penekanan pada Tonjolan Tulang/Luka Operasi)',
            'Faktor elektris (energi listrik tinggi)',
            'Perubahan Sirkulasi',
            'Efek Samping Terapi Radiasi',
        ];
        $bdUrine = [
            'Peningkatan Tekanan Uretra',
            'Disfungsi Neurologis *(Trauma / Penyakit Syaraf)',
            'Efek Agen Farmakologis',
        ];
        $bdJalanNafas = [
            'Spasme Jalan Napas',
            'Sekresi yang tertahan',
            'Benda asing dalam jalan napas',
        ];
        $bdPolaNafas = [
            'Efek Agen Farmakologis',
            'Hambatan Upaya Napas',
        ];
        $masalahKeperawatan = [
            'Nyeri Akut / Kronis',
            'Retensi Urine',
            'Bersihan Jalan Napas',
            'Gangguan Mobilitas Fisik',
            'Gangguan Integritas Kulit',
            'Pola Napas Tidak Efektif',
        ];

        $asesmenDiagnosa = IgdDiagnosisKeperawatanAssKepPatient::where('igd_ase_kep_patient_id', $item->igdAseKepPatient->id ?? '')->get();
        $masalah = IgdMasalahKeperawatanAssKepPatient::where('igd_ase_kep_patient_id', $item->igdAseKepPatient->id ?? '')->get();

        return view('pages.igdAssKepPatient.diagnosisKeperawatan.index', [
            'title' => 'IGD',
            'menu' => 'IGD',
            'bdNyeriAkut' => $bdNyeriAkut,
            'bdFisik' => $bdFisik,
            'bdIntegritas' => $bdIntegritas,
            'bdUrine' => $bdUrine,
            'bdJalanNafas' => $bdJalanNafas,
            'bdPolaNafas' => $bdPolaNafas,
            'masalahKeperawatan' => $masalahKeperawatan,
            'asesmenDiagnosa' => $asesmenDiagnosa,
            'masalah' => $masalah,
            'item' => $item,
            'currentIgdPatientId' => $currentIgdPatientId
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
        // input diagnosa keperawatan
        $diagnosisKeperawatan = $request->input('diagnosis-keperawatan', []);
        $nyeriAkut = $request->input('nyeri-akut', []);
        $gangguanMobilitasFisik = $request->input('gangguan-mobilitas-fisik', []);
        $gangguanIntegritasKulit = $request->input('gangguan-integritas-kulit', []);
        $retensiUrine = $request->input('retensi-urine', []);
        $bersihanJalanNapas = $request->input('bersihan-jalan-napas', []);
        $polaNafas = $request->input('pola-nafas', []);
        $diagnosisLainnya = $request->input('diagnosis-lainnya');
        $lainnya = $request->input('lainnya', []);

        // input masalah keperawatan
        $masalahKeperawatan = $request->input('masalah-keperawatan', []);

        $item = IgdPatient::find($id);

        $igdAsskep = IgdAseKepPatient::where('igd_patient_id', $item->id)->first();
        if ($igdAsskep == null) {
            $igdAsskep = IgdAseKepPatient::create([
                'igd_patient_id' => $item->id,
                'patient_id' => $item->queue->patient->id,
                'user_id' => Auth::user()->id,
            ]);
        }

        if ($igdAsskep->igdDiagnosisKeperawatanAssKepPatients->isNotEmpty()) {
            foreach ($igdAsskep->igdDiagnosisKeperawatanAssKepPatients as $detail) {
                if ($detail->igdHubDiagnosisKepAssKepPatients->isNotEmpty()) {
                    $detail->igdHubDiagnosisKepAssKepPatients()->delete();
                }
            }
            $igdAsskep->igdDiagnosisKeperawatanAssKepPatients()->delete();
        }
        if ($igdAsskep->igdMasalahKeperawatanAssKepPatients->isNotEmpty()) {
            foreach ($igdAsskep->igdMasalahKeperawatanAssKepPatients as $detail) {
                $detail->delete();
            }
        }

        //diagnosis keperawatan
        foreach ($diagnosisKeperawatan as $dk) {
            $diagnosisKep = IgdDiagnosisKeperawatanAssKepPatient::create([
                'igd_ase_kep_patient_id' => $igdAsskep->id,
                'diagnosa' => $dk,
            ]);
            //nyeri akut
            if ($diagnosisKep->diagnosa == '*) Nyeri Akut / Kronis') {
                foreach ($nyeriAkut as $na) {
                    IgdHubDiagnosisKepAssKepPatient::create([
                        'igd_diagnosis_keperawatan_ass_kep_patient_id' => $diagnosisKep->id,
                        'name' => $na,
                    ]);
                }
            }
            //gangguan mobilitas fisik
            if ($diagnosisKep->diagnosa == 'Gangguan Mobilitas Fisik') {
                foreach ($gangguanMobilitasFisik as $gmf) {
                    IgdHubDiagnosisKepAssKepPatient::create([
                        'igd_diagnosis_keperawatan_ass_kep_patient_id' => $diagnosisKep->id,
                        'name' => $gmf,
                    ]);
                }
            }
            //Gangguan Integritas Kulit/jaringan
            if ($diagnosisKep->diagnosa == '*) Gangguan Integritas Kulit/jaringan') {
                foreach ($gangguanIntegritasKulit as $gik) {
                    IgdHubDiagnosisKepAssKepPatient::create([
                        'igd_diagnosis_keperawatan_ass_kep_patient_id' => $diagnosisKep->id,
                        'name' => $gik,
                    ]);
                }
            }
            //Retensi Urine
            if ($diagnosisKep->diagnosa == 'Retensi Urine') {
                foreach ($retensiUrine as $ru) {
                    IgdHubDiagnosisKepAssKepPatient::create([
                        'igd_diagnosis_keperawatan_ass_kep_patient_id' => $diagnosisKep->id,
                        'name' => $ru,
                    ]);
                }
            }
            //Bersihan Jalan Napas Tidak Efektif
            if ($diagnosisKep->diagnosa == 'Bersihan Jalan Napas Tidak Efektif') {
                foreach ($bersihanJalanNapas as $brn) {
                    IgdHubDiagnosisKepAssKepPatient::create([
                        'igd_diagnosis_keperawatan_ass_kep_patient_id' => $diagnosisKep->id,
                        'name' => $brn,
                    ]);
                }
            }
            //Pola Napas Tidak Efektif
            if ($diagnosisKep->diagnosa == 'Pola Napas Tidak Efektif') {
                foreach ($polaNafas as $pn) {
                    if ($pn != null) {
                        IgdHubDiagnosisKepAssKepPatient::create([
                            'igd_diagnosis_keperawatan_ass_kep_patient_id' => $diagnosisKep->id,
                            'name' => $pn,
                        ]);
                    }
                }
            }
        }
        //diagnosis keperawatan lainnya
        if ($diagnosisLainnya) {
            $diagnosisKepLain = IgdDiagnosisKeperawatanAssKepPatient::create([
                'igd_ase_kep_patient_id' => $igdAsskep->id,
                'diagnosa' => $diagnosisLainnya,
            ]);

            foreach ($lainnya as $l) {
                if ($l != null) {
                    IgdHubDiagnosisKepAssKepPatient::create([
                        'igd_diagnosis_keperawatan_ass_kep_patient_id' => $diagnosisKepLain->id,
                        'name' => $l,
                    ]);
                }
            }
        }

        //masalah keperawatan
        foreach ($masalahKeperawatan as $mk) {
            IgdMasalahKeperawatanAssKepPatient::create([
                'igd_ase_kep_patient_id' => $igdAsskep->id,
                'diagnosa' => $mk,
            ]);
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
