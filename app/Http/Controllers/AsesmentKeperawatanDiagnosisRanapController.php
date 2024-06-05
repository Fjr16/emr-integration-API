<?php

namespace App\Http\Controllers;

use App\Models\AsesmentKeperawatanDiagnosisKeperawatanPatient;
use App\Models\DetailAsesmentKeperawatanRencanaAsuhanPatient;
use App\Models\DetailDiagnosisKeperawatanPatient;
use App\Models\DetailMasalahDiagnosisKeperawatanPatient;
use App\Models\DiagnosisKeperawatanPatient;
use App\Models\HubunganDiagnosaAwalPatient;
use App\Models\Patient;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsesmentKeperawatanDiagnosisRanapController extends Controller
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
            'Tindakan Pembedahan',
            'Kurangi Terpapar Informasi',
        ];
        $bdNyeriAkut = [
            'Agen pencedera fisiologis *(Inflamasi/Neoplasma)',
            'Agen pencedera fisik *(Abses/Trauma/Fraktur/Prosedur Operasi',
            'Agen pencedera kimia *(terbakar/bahan kimia iritan)',
        ];

        $bdNyeriKronis = [
            'Pasca Trauma/Fraktur',
            'Infiltrasi Tumor',
        ];

        $bdFisik = [
            'Kerusakan Struktur Tulang',
            'Kontraktur',
        ];

        $bdNausea = [
            'Distensi Lambung',
            'Efek Farmakologis (anestesi, kemoterapi',
            'Penekanan Tekanan Intraabominal (keganasan)',
        ];
        $bdPendarahan = [
            'Tindakan Pembedahan',
            'Trauma',
            'Efek Agen Farmakologis',
            'Proses Keganasan',
            'Gangguan Koagulasi',
        ];
        $masalahKeperawatan = [
            'Ansietas',
            'Nyeri Akut',
            'Nyeri Kronis',
            'Gangguan Mobilitas Fisik',
            'Nausea',
            'Risiko Pendarahan',
        ];
        return view('pages.ranapAsesmentKeperawatanPatient.diagnosisKeperawatan.index', [
            'title' => 'Asesmen Awal Keperawatan Pasien Rawat Inap',
            'menu' => 'Rawat Inap',
            'bdAnsietas' => $bdAnsietas,
            'bdNyeriAkut' => $bdNyeriAkut,
            'bdNyeriKronis' => $bdNyeriKronis,
            'bdFisik' => $bdFisik,
            'bdNausea' => $bdNausea,
            'bdPendarahan' => $bdPendarahan,
            'masalahKeperawatan' => $masalahKeperawatan,
            'item' => $item
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
        $ansietas = $request->input('ansietas', []);
        $nyeriAkut = $request->input('nyeri-akut', []);
        $nyeriKronis = $request->input('nyeri-kronis', []);
        $gangguanMobilitasFisik = $request->input('gangguan-mobilitas-fisik', []);
        $nausea = $request->input('nausea', []);
        $risikoPendarahan = $request->input('risiko-pendarahan', []);
        $diagnosisLainnya = $request->input('diagnosis-lainnya');
        $lainnya = $request->input('lainnya', []);

        // input masalah keperawatan
        $masalahKeperawatan = $request->input('masalah-keperawatan', []);

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
        foreach ($diagnosisKeperawatan as $dk) {
            $detailDiagnosisKeperawatanPatient = DetailDiagnosisKeperawatanPatient::create([
                'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                'asesment_keperawatan_diagnosis_keperawatan_patient_id' => $asesmentKeperawatanDiagnosisKeperawatanPatient->id,
                'diagnosa' => $dk,
            ]);

            //ansietas
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Ansietas') {
                foreach ($ansietas as $a) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => $detailDiagnosisKeperawatanPatient->diagnosa,
                        'name' => $a,
                    ]);
                }
            }

            //nyeri akut
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Nyeri Akut') {
                foreach ($nyeriAkut as $na) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => $detailDiagnosisKeperawatanPatient->diagnosa,
                        'name' => $na,
                    ]);
                }
            }

            //nyeri kronis
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Nyeri Kronis') {
                foreach ($nyeriKronis as $nk) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => $detailDiagnosisKeperawatanPatient->diagnosa,
                        'name' => $nk,
                    ]);
                }
            }

            //gangguan mobilitas fisik
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Gangguan Mobilitas Fisik') {
                foreach ($gangguanMobilitasFisik as $gmf) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => $detailDiagnosisKeperawatanPatient->diagnosa,
                        'name' => $gmf,
                    ]);
                }
            }

            //nausea
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Nausea') {
                foreach ($nausea as $n) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => $detailDiagnosisKeperawatanPatient->diagnosa,
                        'name' => $n,
                    ]);
                }
            }

            //risiko pendarahan
            if ($detailDiagnosisKeperawatanPatient->diagnosa == 'Risiko Pendarahan') {
                foreach ($risikoPendarahan as $rp) {
                    HubunganDiagnosaAwalPatient::create([
                        'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                        'detail_diagnosis_keperawatan_patient_id' => $detailDiagnosisKeperawatanPatient->id,
                        'diagnosa' => $detailDiagnosisKeperawatanPatient->diagnosa,
                        'name' => $rp,
                    ]);
                }
            }
        }

        //lainnya
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

        //masalah keperawatan
        foreach ($masalahKeperawatan as $mk) {
            DetailMasalahDiagnosisKeperawatanPatient::create([
                'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                'asesment_keperawatan_diagnosis_keperawatan_patient_id' => $asesmentKeperawatanDiagnosisKeperawatanPatient->id,
                'diagnosa' => $mk,
            ]);
        }

        return back()->with('success', 'SUKSES DI TAMBAHKAN');
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
        $item = DiagnosisKeperawatanPatient::find($id);
        $asesmentKeperawatanDiagnosisKeperawatanPatient = AsesmentKeperawatanDiagnosisKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        $ansietas = DetailDiagnosisKeperawatanPatient::where('asesment_keperawatan_diagnosis_keperawatan_patient_id', $asesmentKeperawatanDiagnosisKeperawatanPatient->id)->where('diagnosa', 'Ansietas')->first();
        if ($ansietas) {
            $detailAnsietas = HubunganDiagnosaAwalPatient::where('detail_diagnosis_keperawatan_patient_id', $ansietas->id)->get();
        } else {
            $detailAnsietas = HubunganDiagnosaAwalPatient::where('detail_diagnosis_keperawatan_patient_id', 0)->get();
        }
        $nyeriAkut = DetailDiagnosisKeperawatanPatient::where('asesment_keperawatan_diagnosis_keperawatan_patient_id', $asesmentKeperawatanDiagnosisKeperawatanPatient->id)->where('diagnosa', 'Nyeri Akut')->first();
        if ($nyeriAkut) {
            $detailNyeriAkut = HubunganDiagnosaAwalPatient::where('detail_diagnosis_keperawatan_patient_id', $nyeriAkut->id)->get();
        } else {
            $detailNyeriAkut = HubunganDiagnosaAwalPatient::where('detail_diagnosis_keperawatan_patient_id', 0)->get();
        }
        $nyeriKronis = DetailDiagnosisKeperawatanPatient::where('asesment_keperawatan_diagnosis_keperawatan_patient_id', $asesmentKeperawatanDiagnosisKeperawatanPatient->id)->where('diagnosa', 'Nyeri Kronis')->first();
        if ($nyeriKronis) {
            $detailNyeriKronis = HubunganDiagnosaAwalPatient::where('detail_diagnosis_keperawatan_patient_id', $nyeriKronis->id)->get();
        } else {
            $detailNyeriKronis = HubunganDiagnosaAwalPatient::where('detail_diagnosis_keperawatan_patient_id', 0)->get();
        }
        $gangguanMobilitasFisik = DetailDiagnosisKeperawatanPatient::where('asesment_keperawatan_diagnosis_keperawatan_patient_id', $asesmentKeperawatanDiagnosisKeperawatanPatient->id)->where('diagnosa', 'Gangguan Mobilitas Fisik')->first();
        if ($gangguanMobilitasFisik) {
            $detailGangguanMobilitasFisik = HubunganDiagnosaAwalPatient::where('detail_diagnosis_keperawatan_patient_id', $gangguanMobilitasFisik->id)->get();
        } else {
            $detailGangguanMobilitasFisik = HubunganDiagnosaAwalPatient::where('detail_diagnosis_keperawatan_patient_id', 0)->get();
        }
        $nausea = DetailDiagnosisKeperawatanPatient::where('asesment_keperawatan_diagnosis_keperawatan_patient_id', $asesmentKeperawatanDiagnosisKeperawatanPatient->id)->where('diagnosa', 'Nausea')->first();
        if ($nausea) {
            $detailNausea = HubunganDiagnosaAwalPatient::where('detail_diagnosis_keperawatan_patient_id', $nausea->id)->get();
        } else {
            $detailNausea = HubunganDiagnosaAwalPatient::where('detail_diagnosis_keperawatan_patient_id', 0)->get();
        }
        $risikoPendarahan = DetailDiagnosisKeperawatanPatient::where('asesment_keperawatan_diagnosis_keperawatan_patient_id', $asesmentKeperawatanDiagnosisKeperawatanPatient->id)->where('diagnosa', 'Risiko Pendarahan')->first();
        if ($risikoPendarahan) {
            $detailRisikoPendarahan = HubunganDiagnosaAwalPatient::where('detail_diagnosis_keperawatan_patient_id', $risikoPendarahan->id)->get();
        } else {
            $detailRisikoPendarahan = HubunganDiagnosaAwalPatient::where('detail_diagnosis_keperawatan_patient_id', 0)->get();
        }
        $lainnya = DetailDiagnosisKeperawatanPatient::where('asesment_keperawatan_diagnosis_keperawatan_patient_id', $asesmentKeperawatanDiagnosisKeperawatanPatient->id)
            ->where('diagnosa', '!=', 'Ansietas')->where('diagnosa', '!=', 'Nyeri Akut')->where('diagnosa', '!=', 'Nyeri Kronis')->where('diagnosa', '!=', 'Gangguan Mobilitas Fisik')->where('diagnosa', '!=', 'Nausea')->where('diagnosa', '!=', 'Risiko Pendarahan')->where('diagnosa', '!=', 'Risiko Pendarahan')->first();
        if ($lainnya) {
            $detailLainnya = HubunganDiagnosaAwalPatient::where('detail_diagnosis_keperawatan_patient_id', $lainnya->id)->get();
        } else {
            $detailLainnya = HubunganDiagnosaAwalPatient::where('detail_diagnosis_keperawatan_patient_id', 0)->get();
        }
        $detailMasalahKeperawatan = DetailMasalahDiagnosisKeperawatanPatient::where('asesment_keperawatan_diagnosis_keperawatan_patient_id', $asesmentKeperawatanDiagnosisKeperawatanPatient->id)->get();

        $bdAnsietas = [
            'Tindakan Pembedahan',
            'Kurangi Terpapar Informasi',
        ];
        $bdNyeriAkut = [
            'Agen pencedera fisiologis *(Inflamasi/Neoplasma)',
            'Agen pencedera fisik *(Abses/Trauma/Fraktur/Prosedur Operasi',
            'Agen pencedera kimia *(terbakar/bahan kimia iritan)',
        ];

        $bdNyeriKronis = [
            'Pasca Trauma/Fraktur',
            'Infiltrasi Tumor',
        ];

        $bdFisik = [
            'Kerusakan Struktur Tulang',
            'Kontraktur',
        ];

        $bdNausea = [
            'Distensi Lambung',
            'Efek Farmakologis (anestesi, kemoterapi',
            'Penekanan Tekanan Intraabominal (keganasan)',
        ];
        $bdPendarahan = [
            'Tindakan Pembedahan',
            'Trauma',
            'Efek Agen Farmakologis',
            'Proses Keganasan',
            'Gangguan Koagulasi',
        ];
        $masalahKeperawatan = [
            'Ansietas',
            'Nyeri Akut',
            'Nyeri Kronis',
            'Gangguan Mobilitas Fisik',
            'Nausea',
            'Risiko Pendarahan',
        ];
        return view('pages.ranapAsesmentKeperawatanPatient.diagnosisKeperawatan.edit', [
            'title' => 'Asesmen Awal Keperawatan Pasien Rawat Inap',
            'menu' => 'Rawat Inap',
            'bdAnsietas' => $bdAnsietas,
            'bdNyeriAkut' => $bdNyeriAkut,
            'bdNyeriKronis' => $bdNyeriKronis,
            'bdFisik' => $bdFisik,
            'bdNausea' => $bdNausea,
            'bdPendarahan' => $bdPendarahan,
            'masalahKeperawatan' => $masalahKeperawatan,
            'item' => $item,
            'ansietas' => $ansietas,
            'detailAnsietas' => $detailAnsietas,
            'nyeriAkut' => $nyeriAkut,
            'detailNyeriAkut' => $detailNyeriAkut,
            'nyeriKronis' => $nyeriKronis,
            'detailNyeriKronis' => $detailNyeriKronis,
            'gangguanMobilitasFisik' => $gangguanMobilitasFisik,
            'detailGangguanMobilitasFisik' => $detailGangguanMobilitasFisik,
            'nausea' => $nausea,
            'detailNausea' => $detailNausea,
            'risikoPendarahan' => $risikoPendarahan,
            'detailRisikoPendarahan' => $detailRisikoPendarahan,
            'lainnya' => $lainnya,
            'detailLainnya' => $detailLainnya,
            'detailMasalahKeperawatan' => $detailMasalahKeperawatan,
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
