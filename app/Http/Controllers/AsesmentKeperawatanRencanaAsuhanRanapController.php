<?php

namespace App\Http\Controllers;

use App\Models\AsesmentKeperawatanRencanaAsuhanPatient;
use App\Models\DetailAsesmentKeperawatanRencanaAsuhanPatient;
use App\Models\DiagnosisKeperawatanPatient;
use App\Models\Patient;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AsesmentKeperawatanRencanaAsuhanRanapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $item = Queue::find($id);
        $rencanaAsuhan = [
            'Reduksi Kecemasan',
            'Manajemen Nyeri',
            'Manajemen Eliminasi',
            'Dukungan Mobilitas',
            'Pencegahan Penularan',
            'Manajemen Mual',
            'Manajemen Muntah',
        ];

        return view('pages.ranapAsesmentKeperawatanPatient.rencanaAsuhan.index', [
            'title' => 'Asesmen Awal Keperawatan Pasien Rawat Inap',
            'menu' => 'Rawat Inap',
            'rencanaAsuhan' => $rencanaAsuhan,
            'item' => $item,
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
        $tanggal = $request->input('date') . " " . $request->input('time');
        //dpjp
        $folder_dpjp = 'assets/paraf-dpjp/';
        Storage::makeDirectory('public/' . $folder_dpjp);

        if ($request->input('ttdDPJP')) {
            $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdDPJP')));
            $filedpjp = $folder_dpjp . uniqid() . '.png';
            Storage::put('public/' . $filedpjp, $ttd);
            $ttddpjp = $filedpjp;
        } else {
            $diagnosisKeperawatanPatient = DiagnosisKeperawatanPatient::where('queue_id', $queue->id)->first();
            $asesmentKeperawatanRencanaAsuhan = AsesmentKeperawatanRencanaAsuhanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisKeperawatanPatient->id)->first();
            $ttddpjp = $asesmentKeperawatanRencanaAsuhan->ttddpjp;
        }
        $namadpjp = $request->input('namadpjp');

        // ppja
        $folder_ppja = 'assets/paraf-ppja/';
        Storage::makeDirectory('public/' . $folder_ppja);

        if ($request->input('ttdPPJA')) {
            $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdPPJA')));
            $fileppja = $folder_ppja . uniqid() . '.png';
            Storage::put('public/' . $fileppja, $ttd);
            $ttdppja = $fileppja;
        } else {
            $diagnosisKeperawatanPatient = DiagnosisKeperawatanPatient::where('queue_id', $queue->id)->first();
            $asesmentKeperawatanRencanaAsuhan = AsesmentKeperawatanRencanaAsuhanPatient::where('diagnosis_keperawatan_patient_id', $diagnosisKeperawatanPatient->id)->first();
            $ttdppja = $asesmentKeperawatanRencanaAsuhan->ttdppja;
        }
        $namappja = $request->input('namappja');

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
        $asesmentKeperawatanRencanaAsuhan = AsesmentKeperawatanRencanaAsuhanPatient::where('diagnosis_keperawatan_patient_id', $item->id)->first();
        if ($asesmentKeperawatanRencanaAsuhan) {
            $detailRencanaAsuhan = DetailAsesmentKeperawatanRencanaAsuhanPatient::where('asesment_keperawatan_rencana_asuhan_patient_id', $asesmentKeperawatanRencanaAsuhan->id)->get();
        } else {
            $detailRencanaAsuhan = DetailAsesmentKeperawatanRencanaAsuhanPatient::where('asesment_keperawatan_rencana_asuhan_patient_id', 0)->get();
        }

        $rencanaAsuhan = [
            'Reduksi Kecemasan',
            'Manajemen Nyeri',
            'Manajemen Eliminasi',
            'Dukungan Mobilitas',
            'Pencegahan Penularan',
            'Manajemen Mual',
            'Manajemen Muntah',
        ];

        return view('pages.ranapAsesmentKeperawatanPatient.rencanaAsuhan.edit', [
            'title' => 'Asesmen Awal Keperawatan Pasien Rawat Inap',
            'menu' => 'Rawat Inap',
            'rencanaAsuhan' => $rencanaAsuhan,
            'item' => $item,
            'asesmentKeperawatanRencanaAsuhan' => $asesmentKeperawatanRencanaAsuhan,
            'detailRencanaAsuhan' => $detailRencanaAsuhan,
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
