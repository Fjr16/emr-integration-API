<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Queue;
use App\Models\IgdPatient;
use Illuminate\Http\Request;
use App\Models\RawatInapPatient;
use App\Models\RanapDpjpPatientDetail;
use App\Models\CatatanPerjalanRanapPatient;
use App\Models\AdministrasiCacatanPerjalananRanapPatient;
use App\Models\DetailAdministrasiCacatanPerjalananRanapPatient;

class IgdPatientRmeController extends Controller
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
    public function store(Request $request)
    {
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
        if(!session('active')){
            session(['active' => 'dashboard']);
        }else{
            session(['active' => session('active')]);
        }

     
        $item = IgdPatient::findOrFail($id);
        $tanggal_lhr = new DateTime($item->queue->patient->tanggal_lhr);
        $today = new DateTime();
        $usia = $tanggal_lhr->diff($today)->y;
        return view('pages.igdpasien.show', [
            "title" => "IGD",
            "menu" => "IGD",
            "item" => $item,
            "usia" => $usia,
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
        $item = IgdPatient::find($id);
        
        $item->update([
            'status' => $request->status,
        ]);

        if ($item->status == 'SELESAI') {
            $flash = 'Data Antrian Tidak Ditemukan';
            $queue = Queue::find($item->queue_id);
            // create ranap
            if($queue){
                $flash = 'Surat Pengantar Tidak Ditemukan';
                if($queue->suratPengantarRawatJalanPatient){
                    $flash = 'Pasien Telah Terdaftar Rawat Inap';
                    $ranap = RawatInapPatient::where('queue_id', $queue->id)->where('surat_pengantar_rawat_jalan_patient_id', $queue->suratPengantarRawatJalanPatient->id)->first();
                    if($ranap == null){
                        $flash = 'success';
                        $pasienRanap = RawatInapPatient::create([
                            'queue_id' => $queue->id,
                            'surat_pengantar_rawat_jalan_patient_id' => $queue->suratPengantarRawatJalanPatient->id,
                            'status' => 'WAITING',
                        ]);
                        $dpjpDetail = RanapDpjpPatientDetail::create([
                            'user_id' => $queue->suratPengantarRawatJalanPatient->user->id,
                            'rawat_inap_patient_id' => $pasienRanap->id,
                            'start' => $pasienRanap->created_at->format('Y-m-d H:i:s'),
                            'end' => null,
                            'status' => true,
                        ]);
                        $data = CatatanPerjalanRanapPatient::create([
                            'patient_id' => $queue->patient->id,
                            'rawat_inap_patient_id' => $pasienRanap->id,
                        ]);
            
                        $kategori = [
                            'REKAM MEDIS',
                            'ASURANSI LAIN',
                            'PERAWAT : REGISTRASI/RANAP', // Corrected typo here
                            'PERAWAT : RANAP/KAMAR BEDAH/PACU',
                            'LABORATORIUM',
                            'RANAP/FARMASI/KASIR',
                        ];
                
                        $rekamMedis = [
                            'Rujukan',
                            'Kartu BPJS',
                            'KTP/KARTU KELUARGA',
                            'SUDI MERAWAT',
                            'CLINICAL PATHWAY',
                            'ANGKET',
                            'NAME TAG',
                            'PRIVATE/RPS',
                            'PINDAH RUANGAN',
                        ];
                
                        $asuransiLain = [
                            'JASA RAHARJA',
                            'BPJS KETENAGAKERJAAN',
                            'BLANKO KRONOLOGIS',
                        ];
                
                        $perawatRegistrasi = [
                            'KELENGKAPAN STATUS',
                            'RONTGEN',
                            'LABOR',
                            'ECG',
                            'USG/CT SCAN',
                            'PASANG GELANG',
                            'IDENTITAS/RISIKO JATUH/ALERGI',
                            'KONFIRMASI OPERASI DPJP/OK',
                            'PUASA MULAI JAM',
                            'KONSULTASI',
                            'HASIL BACAAN PA/BAJAH',
                            'FOTO PRE OPERASI'
                        ];
                
                        $kamarbedah = [
                            'INFORMED CONSENT PASIEN',
                            'KONSUL INTERNE',
                            'VISITE ANESTESI',
                            'SITE MARKING',
                            'SP DARAH',
                            'FOEBRIDING',
                            'GIGI PALSU/PERHIASAN',
                            'KLISMA',
                            'PASIEN MANDI',
                            'PEMBERIAN ANTIBIOTIKA',
                            'KELENGKAPAN STATUS OLEH DPJP & ANESTESI',
                            'RESEP OBAT POST OP',
                            'PLATE/SCREWIK/K-WIRE',
                            'ANTIBIOTIKA',
                            'ANALGETIK',
                        ];
                
                        $laboratorium = [
                            'SEDIAAN PA',
                        ];
                
                        $farmasiKasir = [
                            'JAM VISITE DOKTER',
                            'JAM PENYERAHAN STATUS',
                            'RESEP PULANG',
                            'JAM PENYERAHAN STATUS',
                            'OBAT PULANG',
                            'COST SHARING',
                        ];
                
                        foreach ($kategori as $item) {
                            $save = AdministrasiCacatanPerjalananRanapPatient::create([
                                'catatan_perjalan_ranap_patient_id' => $data->id,
                                'category' => $item,
                                'user_id' => 1,
                            ]);
                
                            $recordId = $save->id;
                
                            if ($item === 'REKAM MEDIS') {
                                foreach ($rekamMedis as $medis) {
                                    DetailAdministrasiCacatanPerjalananRanapPatient::create([
                                        'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
                                        'name' => $medis,
                                        'value' => 'tidak',
                                    ]);
                                }
                            } elseif ($item === 'ASURANSI LAIN') {
                                foreach ($asuransiLain as $asuransi) {
                                    DetailAdministrasiCacatanPerjalananRanapPatient::create([
                                        'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
                                        'name' => $asuransi,
                                        'value' => 'tidak',
                                    ]);
                                }
                            } elseif ($item === 'PERAWAT : REGISTRASI/RANAP') {
                                foreach ($perawatRegistrasi as $perawat) {
                                    DetailAdministrasiCacatanPerjalananRanapPatient::create([
                                        'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
                                        'name' => $perawat,
                                        'value' => 'tidak',
                                    ]);
                                }
                            } elseif ($item === 'PERAWAT : RANAP/KAMAR BEDAH/PACU') {
                                foreach ($kamarbedah as $kamar) {
                                    DetailAdministrasiCacatanPerjalananRanapPatient::create([
                                        'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
                                        'name' => $kamar,
                                        'value' => 'tidak',
                                    ]);
                                }
                            } elseif ($item === 'LABORATORIUM') {
                                foreach ($laboratorium as $lab) {
                                    DetailAdministrasiCacatanPerjalananRanapPatient::create([
                                        'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
                                        'name' => $lab,
                                        'value' => 'tidak',
                                    ]);
                                }
                            } elseif ($item === 'RANAP/FARMASI/KASIR') {
                                foreach ($farmasiKasir as $farmasi) {
                                    DetailAdministrasiCacatanPerjalananRanapPatient::create([
                                        'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
                                        'name' => $farmasi,
                                        'value' => 'tidak',
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }

        return redirect()->route('igd/patient.index')->with($flash == 'success' ? $flash : 'error', $flash == 'success' ? 'Status Berhasil Diperbarui' : $flash);
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
