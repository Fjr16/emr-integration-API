<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\DiagnosisKeperawatanPatient;
use App\Models\AsesmentKeperawatanRencanaAsuhanPatient;
use App\Models\DetailMasalahDiagnosisKeperawatanPatient;
use App\Models\DetailAsesmentKeperawatanRencanaAsuhanPatient;

class AsesmentKeperawatanRencanaAsuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $item = Queue::find($id);
        $diagnosisPatient = DiagnosisKeperawatanPatient::where('queue_id', $item->id)->first();

        $rencanaAsuhan = [
            'Reduksi Ansietas',
            'Manajemen Nyeri',
            'Dukungan Mobilitas',
            'Perawatan Luka',
            'Perawatan Retensi Urine',
            'Perawatan Kateter Urine'
        ];

        // if ($asesmentKeperawatanRencanaAsuhan) {
        //     // Data ditemukan, lanjutkan
        //     $rencanaAsuhan = [
        //         'Reduksi Ansietas',
        //         'Manajemen Nyeri',
        //         'Dukungan Mobilitas',
        //         'Perawatan Luka',
        //         'Perawatan Retensi Urine',
        //         'Perawatan Kateter Urine',
        //     ];
        //     $detailRencana = DetailAsesmentKeperawatanRencanaAsuhanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id)->get();
        // } else {
        //     // Data tidak ditemukan, atur $rencanaAsuhan dan $detailRencana menjadi null atau koleksi kosong sesuai kebutuhan
        //     $rencanaAsuhan = [];
        //     $detailRencana = collect();
        // }
        $detailRencana = DetailAsesmentKeperawatanRencanaAsuhanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->get();
        $asesmentKeperawatanRencanaAsuhan = AsesmentKeperawatanRencanaAsuhanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->first();
        $masalah = DetailMasalahDiagnosisKeperawatanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id ?? '')->get();
        $userMasalahKeperawatan = DB::table('detail_masalah_diagnosis_keperawatan_patients')
            ->where('diagnosis_keperawatan_patient_id', $diagnosisPatient->id)
            ->pluck('diagnosa')
            ->toArray();

        // Mapping masalah keperawatan ke rencana asuhan
        $mapping = [
            'Ansietas' => ['Reduksi Ansietas'],
            'Nyeri Akut' => ['Manajemen Nyeri'],
            'Nyeri Kronis' => ['Manajemen Nyeri'],
            'Retensi Urine' => ['Perawatan Retensi Urine'],
            'Gangguan Mobilitas Fisik' => ['Dukungan Mobilitas'],
            'Gangguan Integritas Kulit' => ['Perawatan Luka'],
            'Gangguan Integritas Jaringan' => ['Perawatan Luka'],
        ];

        // Tentukan rencana asuhan yang perlu dicentang
        $selectedAsuhan = [];
        foreach ($userMasalahKeperawatan as $masalah) {
            if (isset($mapping[$masalah])) {
                foreach ($mapping[$masalah] as $mappedAsuhan) {
                    if (!in_array($mappedAsuhan, $selectedAsuhan)) {
                        $selectedAsuhan[] = $mappedAsuhan;
                    }
                }
            }
        }
        return view('pages.asesmentKeperwatanPatient.rencanaAsuhan.index', [
            'title' => 'Interaksi Obat',
            'menu' => 'Obat',
            'rencanaAsuhan' => $rencanaAsuhan,
            'item' => $item,
            'detailRencana' => $detailRencana,
            'asesmentKeperawatanRencanaAsuhan' => $asesmentKeperawatanRencanaAsuhan,
            'masalah' => $masalah,
            'selectedAsuhan' => $selectedAsuhan,
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

        $queue = Queue::find($id);
        $patient = Patient::find($queue->patient->id);

        $asuhan = $request->input('asuhan', []);
        $ttddpjp = $request->input('ttddpjp');
        $namadpjp = $request->input('namadpjp');
        $ttdppja = $request->input('ttdppja');
        $namappja = $request->input('namappja');
        $tanggal = $request->input('date') . " " . $request->input('time');
        //dpjp




        $diagnosisKeperawatanPatient = DiagnosisKeperawatanPatient::where('queue_id', $queue->id)->first();

        if ($diagnosisKeperawatanPatient == null) {
            $diagnosisKeperawatanPatient = DiagnosisKeperawatanPatient::create([
                'no_rm' => $id,
                'patient_id' => $patient->id,
                'queue_id' => $queue->id,
                'user_id' => Auth::user()->id,
            ]);
        } else {
            $asesmentKeperawatanRencanaAsuhan = AsesmentKeperawatanRencanaAsuhanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisKeperawatanPatient->id)->first();
            if ($asesmentKeperawatanRencanaAsuhan) {
                DetailAsesmentKeperawatanRencanaAsuhanPatient::where('asesment_keperawatan_rencana_asuhan_patient_id', $asesmentKeperawatanRencanaAsuhan->id)->delete();
                $asesmentKeperawatanRencanaAsuhan->delete();
            }
        }

        $asesmentKeperawatanRencanaAsuhan = AsesmentKeperawatanRencanaAsuhanPatient::create([
            'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
            'ttddpjp' => $ttddpjp,
            'namadpjp' => $namadpjp,
            'ttdppja' => $ttdppja,
            'namappja' => $namappja,
            'tanggal' => $tanggal,
        ]);

        foreach ($asuhan as $a) {
            DetailAsesmentKeperawatanRencanaAsuhanPatient::create([
                'diagnosis_keperawatan_patient_id' => $diagnosisKeperawatanPatient->id,
                'asesment_keperawatan_rencana_asuhan_patient_id' => $asesmentKeperawatanRencanaAsuhan->id,
                'name' => $a,
            ]);
        }

        return redirect(route('rajal/show', ['id' => $queue->id, 'title' => 'Rawat Jalan']))->with([
            'success' => 'SUKSES BERHASIL DI TAMBAHKAN',
            'btn' => 'perawat'
        ]);

        //
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
