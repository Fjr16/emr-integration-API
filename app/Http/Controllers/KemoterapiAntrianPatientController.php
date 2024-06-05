<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Queue;
use Illuminate\Http\Request;
use App\Models\KemoterapiPatient;
use Illuminate\Support\Facades\Auth;
use App\Models\CatatanPerjalanKemoterapiPatient;
use App\Models\AdministrasiCatatanPerjalananKemoterapiPatient;
use App\Models\DetailAdministrasiCatatanPerjalananKemoterapiPatient;

class KemoterapiAntrianPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::all();
        return view('pages.kemoterapiPermintaan.index', [
            'menu' => 'Kemoterapi',
            'title' => 'Antrian Kemo',
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
        $tgl = new DateTime($request->tanggal);
        $kemoterapi = KemoterapiPatient::where('queue_id', $queue->id)->first();
        $user_id = Auth::id();
        // $kemoterapi = KemoterapiPatient::create([
        //     'queue_id' => $queue->id,
        //     'user_id' => '10',
        //     'tanggal_periksa' => $tgl->format('Y-m-d'),
        // ]);

        // $kemoterapi = KemoterapiPatient::where('queue_id', $queue->id)->where('status', 'WAITING')->first();
        if ($kemoterapi == null) {
            $kemoterapi = KemoterapiPatient::create([
                'queue_id' => $queue->id,
                'user_id' => $user_id,
                'patient_id' => $queue->patient_id,
                'tanggal_periksa' => $tgl->format('Y-m-d'),
            ]);

            $data = CatatanPerjalanKemoterapiPatient::create([
                'patient_id' => $queue->patient->id,
                'kemoterapi_patient_id' => $kemoterapi->id,
            ]);

            $kategori = [
                'REKAM MEDIS',
                'PERAWAT KEMOTERAPI',
                'FARMASI KLINIS', // Corrected typo here
                'PERAWAT RUANGAN',
                'FARMASI',
                'KASIR',
            ];

            $rekamMedis = [
                'Rujukan',
                'Kartu BPJS',
                'KTP',
                'SURAT PENGANTAR RAWAT',
                'PROTOKOL KEMOTERAPI',
                'HASIL PEMERIKSAAN PA',
                'GELANG IDENTITAS',

            ];

            $perawatKemoterapi = [
                'KELENGKAPAN STATUS',
                'PROTOKOL KEMOTERAPI',
                'HASIL PEMERIKSAAN PA',
                'LABOR',
                'GELANG IDENTITAS/RISIKO JATUH/ALERGI',
                'RESUME PULANG',
                'SURAT PENGANTAR RAWAT SELANJUTNYA'
            ];

            $farmasiKlinis = [
                'RESEP KEMOTERAPI SELANJUTNYA',

            ];

            $perawatRuangan = [
                'KELENGKAPAN STATUS',
                'PROTOKOL KEMOTERAPI',
                'HASIL PEMERIKSAAN PA',
                'LABOR',
                'ECHOCARDIOGRAPHY',
                'GELANG IDENTITAS/RISIKO JATUH/ALERGI',

            ];

            $farmasi = [
                'JAM SERAH TERIMA OBAT',
                'RESEP PULANG'
            ];

            // $farmasiKasir = [

            // ];

            foreach ($kategori as $item) {
                $save = AdministrasiCatatanPerjalananKemoterapiPatient::create([
                    'catatan_perjalan_kemoterapi_patient_id' => $data->id,
                    'category' => $item,
                    'user_id' => 1,
                ]);

                $recordId = $save->id;

                if ($item === 'REKAM MEDIS') {
                    foreach ($rekamMedis as $medis) {
                        DetailAdministrasiCatatanPerjalananKemoterapiPatient::create([
                            'administrasi_cacatan_perjalanan_kemoterapi_patient_id' => $recordId,
                            'name' => $medis,
                            'value' => 'tidak',
                        ]);
                    }
                } elseif ($item === 'PERAWAT KEMOTERAPI') {
                    foreach ($perawatKemoterapi as $perawat) {
                        DetailAdministrasiCatatanPerjalananKemoterapiPatient::create([
                            'administrasi_cacatan_perjalanan_kemoterapi_patient_id' => $recordId,
                            'name' => $perawat,
                            'value' => 'tidak',
                        ]);
                    }
                } elseif ($item === 'FARMASI KLINIS') {
                    foreach ($farmasiKlinis as $farmasiklinis) {
                        DetailAdministrasiCatatanPerjalananKemoterapiPatient::create([
                            'administrasi_cacatan_perjalanan_kemoterapi_patient_id' => $recordId,
                            'name' => $farmasiklinis,
                            'value' => 'tidak',
                        ]);
                    }
                } elseif ($item === 'PERAWAT RUANGAN') {
                    foreach ($perawatRuangan as $perawatruangan) {
                        DetailAdministrasiCatatanPerjalananKemoterapiPatient::create([
                            'administrasi_cacatan_perjalanan_kemoterapi_patient_id' => $recordId,
                            'name' => $perawatruangan,
                            'value' => 'tidak',
                        ]);
                    }
                } elseif ($item === 'FARMASI') {
                    foreach ($farmasi as $farmasi) {
                        DetailAdministrasiCatatanPerjalananKemoterapiPatient::create([
                            'administrasi_cacatan_perjalanan_kemoterapi_patient_id' => $recordId,
                            'name' => $farmasi,
                            'value' => 'tidak',
                        ]);
                    }
                }
            }
        }


        return back()->with('success', 'Berhasil Didaftarkan');
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
