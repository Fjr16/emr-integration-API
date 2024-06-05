<?php

namespace App\Http\Controllers;

use App\Models\AsesmentKeperawatanDiagnosisKeperawatanPatient;
use App\Models\DetailDiagnosisKeperawatanPatient;
use App\Models\DetailMasalahDiagnosisKeperawatanPatient;
use App\Models\DiagnosisKeperawatanPatient;
use App\Models\HubunganDiagnosaAwalPatient;
use App\Models\Patient;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsesmentKeperawatanDiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $item = Queue::find($id);
        $bdAnsietas = [
            'Kurang terpapar informasi',
            'Kurang mengalami kegagalan',
            'Ancaman terhadap konsep diri',
        ];

        $bdNyeri = [
            'Agen pencedera fisiologis' => ['Inflamasi', 'Iskemia', 'Neoplasma'],
            'Agen pencedera fisik' => ['Abses', 'Amputasi', 'Terpotong', 'Trauma', 'Fraktur', 'Prosedur Operasi', 'Latihan Fisik berlebihan', 'Mengangkat Berat'],
            'Agen pencedera kimia' => ['Terbakar', 'Bahan kimia iritan']
        ];



        $bdNyeriKronis = [
            'Agen pencedera  fisiologis' => ['Inflamasi', 'Iskemia', 'Neoplasma'],
            'Agen pencedera  fisik' => ['Abses', 'Amputasi', 'Terpotong', 'Trauma', 'Fraktur', 'Prosedur Operasi', 'Latihan Fisik berlebihan', 'Mengangkat Berat'],
            'Agen pencedera  kimia' => ['Terbakar', 'Bahan kimia iritan']
        ];

        $bdFisik = [
            'Kerusakan Struktur Tulang',
            'Kontraktur',
            'Penurunan kekuatan otot',
            'Kekakuan Sendi',
            'Program Pembatasan Gerak',
        ];


        $bdKulit = [
            'Faktor Mekanis' => ['Penekanan pada Tonjolan Tulang', 'Luka Operasi'],
            'Faktor elektris' => ['Energi listrik tinggi'],
            'Perubahan Sirkulasi' => [],
            'Efek Samping Terapi Radiasi' => [],
        ];
        $bdJaringan = [
            'Faktor  Mekanis' => ['Penekanan pada Tonjolan Tulang', 'Luka Operasi'],
            'Faktor  elektris' => ['Energi listrik tinggi'],
            'Perubahan  Sirkulasi' => [],
            'Efek Samping Terapi  Radiasi' => [],
        ];

        $bdUrine = [
            'Peningkatan Tekanan Uretra' => [],
            'Disfungsi Neurologis' => ['Trauma', 'Penyakit Syaraf'],
            'Efek Agen Farmakologis' => [],
        ];
        
        $masalahKeperawatan = [
            'Ansietas',
            'Nyeri Akut',
            'Nyeri Kronis',
            'Retensi Urine',
            'Gangguan Mobilitas Fisik',
            'Gangguan Integritas Kulit',
            'Gangguan Integritas Jaringan',
            
        ];
        $nyeriAkutMain = [];
        $nyeriAkutSub = [];
        $diagnosisPatient = DiagnosisKeperawatanPatient::where('queue_id', $item->id)->first();

        $asesmenDiagnosa = DetailDiagnosisKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->get();
        $detailDiagnosa = HubunganDiagnosaAwalPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->get();
        $masalah = DetailMasalahDiagnosisKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->get();

        return view('pages.asesmentKeperwatanPatient.diagnosisKeperawatan.index', [
            'title' => 'Interaksi Obat',
            'menu' => 'Obat',
            'bdAnsietas' => $bdAnsietas,
            'bdNyeri' => $bdNyeri,
            'bdNyeriKronis' => $bdNyeriKronis,
            'bdFisik' => $bdFisik,
            'bdKulit' => $bdKulit,
            'bdJaringan' => $bdJaringan,
            'bdUrine' => $bdUrine,
            'masalahKeperawatan' => $masalahKeperawatan,
            'item' => $item,
            'asesmenDiagnosa' => $asesmenDiagnosa,
            'masalah' => $masalah,
            'detailDiagnosa' => $detailDiagnosa,
            'nyeriAkutMain' => $nyeriAkutMain,
            'nyeriAkutSub' => $nyeriAkutSub,
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
        
        $diagnosisKeperawatan = $request->input('diagnosis-keperawatan', []);
        $ansietas = $request->input('ansietas', []);
        $nyeriAkut = $request->input('nyeri-akut', []);
        $detailnyeri = $request->input('detail-nyeri', []);
        $nyeriKronis = $request->input('nyeri-kronis', []);
        $gangguanMobilitasFisik = $request->input('gangguan-mobilitas-fisik', []);
        $gangguanIntegritasKulit = $request->input('gangguan-integritas-kulit', []);
        $gangguanIntegritasJaringan = $request->input('gangguan-integritas-jaringan', []);
        $retensiUrine = $request->input('retensi-urine', []);
        $masalahKeperawatan = $request->input('masalah-keperawatan', []);
        $diagnosisLainnya = $request->input('diagnosis-lainnya');
        $lainnya = $request->input('lainnya', []);

        $queue = Queue::find($id);
        $patient = Patient::find($queue->patient->id);

        $diagnosisKeperawatanPatient = DiagnosisKeperawatanPatient::where('queue_id', $queue->id)->first();

        if ($diagnosisKeperawatanPatient == null) {
            $diagnosisKeperawatanPatient = DiagnosisKeperawatanPatient::create([
                'no_rm' => $id,
                'patient_id' => $patient->id,
                'queue_id' => $queue->id,
                'user_id' => Auth::user()->id,
            ]);
        }
        $asesmentKeperawatanDiagnosisKeperawatanPatient = AsesmentKeperawatanDiagnosisKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisKeperawatanPatient->id)->first();
        if ($asesmentKeperawatanDiagnosisKeperawatanPatient == null) {
            $asesmentKeperawatanDiagnosisKeperawatanPatient = AsesmentKeperawatanDiagnosisKeperawatanPatient::create([
                'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id
            ]);
        } else {
            $detailDiagnosis = DetailDiagnosisKeperawatanPatient::where('asesment_keperawatan_diagnosis_keperawatan_patient_id', $asesmentKeperawatanDiagnosisKeperawatanPatient->id)->get();
            if ($detailDiagnosis) {
                foreach ($detailDiagnosis as $detail) {
                    HubunganDiagnosaAwalPatient::where('detail_diagnosis_keperawatan_patient_id', $detail->id)->delete();
                    $detail->delete();
                }
            }

            DetailMasalahDiagnosisKeperawatanPatient::where('asesment_keperawatan_diagnosis_keperawatan_patient_id', $asesmentKeperawatanDiagnosisKeperawatanPatient->id)->delete();
        }
        //detail diagnosis
        foreach ($diagnosisKeperawatan as $key => $diagnosis) {
            $detailDiagnosisKeperawatanPatient = DetailDiagnosisKeperawatanPatient::create([
                'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                'diagnosa' => $diagnosis,
                'asesment_keperawatan_diagnosis_keperawatan_patient_id' => $asesmentKeperawatanDiagnosisKeperawatanPatient->id,
            ]);

           
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Ansietas') {
                foreach ($ansietas as $key => $anse) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => 'Ansietas',
                        'name' => $anse,
                    ]);
                }
            }
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Lainnya') {
                foreach ($ansietas as $key => $anse) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => '',
                        'name' => $anse,
                    ]);
                }
            }

            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Nyeri Akut') {
                foreach ($nyeriAkut as $na) {
                    // Ambil detail_name yang sesuai dari $detailnyeri berdasarkan key $na
                    $detailName = isset($detailnyeri[$na]) ? $detailnyeri[$na] : null;

                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => $detailDiagnosisKeperawatanPatient->diagnosa,
                        'name' => $na,
                        'detail_name' => $detailName,
                    ]);
                }
            }
          
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Nyeri Kronis') {
                foreach ($nyeriKronis as $na) {
                    // Ambil detail_name yang sesuai dari $detailnyeri berdasarkan key $na
                    $detailName = isset($detailnyeri[$na]) ? $detailnyeri[$na] : null;

                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => $detailDiagnosisKeperawatanPatient->diagnosa,
                        'name' => $na,
                        'detail_name' => $detailName,
                    ]);
                }
            }
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Gangguan Mobilitas Fisik') {
                foreach ($gangguanMobilitasFisik as $key => $fisik) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => 'Gangguan Mobilitas Fisik',
                        'name' => $fisik,
                    ]);
                }
            }
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Gangguan Integritas Kulit') {
                foreach ($gangguanIntegritasKulit as $kulit) {
                    // Ambil detail_name yang sesuai dari $detailnyeri berdasarkan key $kulit
                    $detailName = isset($detailnyeri[$kulit]) ? $detailnyeri[$kulit] : null;

                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => $detailDiagnosisKeperawatanPatient->diagnosa,
                        'name' => $kulit,
                        'detail_name' => $detailName,
                    ]);
                }
            }
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Gangguan Integritas Jaringan') {
                foreach ($gangguanIntegritasJaringan as $jaringan) {
                    // Ambil detail_name yang sesuai dari $detailnyeri berdasarkan key $kulit
                    $detailName = isset($detailnyeri[$jaringan]) ? $detailnyeri[$jaringan] : null;

                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => $detailDiagnosisKeperawatanPatient->diagnosa,
                        'name' => $jaringan,
                        'detail_name' => $detailName,
                    ]);
                }
            }
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Retensi Urine') {
                
                foreach ($retensiUrine as $urine) {
                    // Ambil detail_name yang sesuai dari $detailnyeri berdasarkan key $urine
                    $detailName = isset($detailnyeri[$urine]) ? $detailnyeri[$urine] : null;

                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => $detailDiagnosisKeperawatanPatient->diagnosa,
                        'name' => $urine,
                        'detail_name' => $detailName,
                    ]);
                }
            }
            
        }
        if ($diagnosisLainnya) {
            $detailDiagnosisKeperawatanPatient = DetailDiagnosisKeperawatanPatient::create([
                'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                'asesment_keperawatan_diagnosis_keperawatan_patient_id' => $asesmentKeperawatanDiagnosisKeperawatanPatient->id,
                'diagnosa' => $diagnosisLainnya,
            ]);

            foreach ($lainnya as $l) {
                if ($l != null) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => $detailDiagnosisKeperawatanPatient->diagnosa,
                        'name' => $l,
                    ]);
                }
            }
        }

        foreach ($masalahKeperawatan as $mk) {
            DetailMasalahDiagnosisKeperawatanPatient::create([
                'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                'asesment_keperawatan_diagnosis_keperawatan_patient_id' => $asesmentKeperawatanDiagnosisKeperawatanPatient->id,
                'diagnosa' => $mk,
            ]);
        }
        return redirect(route('rajal/asesmen/rencana/asuhan.index', $queue->id))->with('success', 'SUKSES BERHASIL DI TAMBAHKAN');

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
