<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\CpptRanap;
use App\Models\RanapHaisPatient;
use App\Models\RawatInapPatient;
use App\Models\RoomBooking;
use App\Models\SuratPengantarRawatJalanPatient;
use DateTime;
use Illuminate\Http\Request;

class RawatInapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = RawatInapPatient::where('status', 'WAITING')->get();
        $data = RawatInapPatient::latest()->get();
        return view('pages.rawatInap.index', [
            "title" => "Rawat Inap",
            'menu' => 'Rawat Inap',
            'data' => $data
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
        // $ranap = RawatInapPatient::where('queue_id', $id)->first();
        // $queue = Queue::find($id);
        // if($ranap == null){
        //     $pasienRanap = RawatInapPatient::create([
        //         'queue_id' => $id,
        //         'status' => 'WAITING',
        //     ]);
        //     $data = CatatanPerjalanRanapPatient::create([
        //         'patient_id' => $queue->patient->id,
        //         'rawat_inap_patient_id' => $pasienRanap->id,
        //     ]);

        //     $kategori = [
        //         'REKAM MEDIS',
        //         'ASURANSI LAIN',
        //         'PERAWAT : REGISTRASI/RANAP', // Corrected typo here
        //         'PERAWAT : RANAP/KAMAR BEDAH/PACU',
        //         'LABORATORIUM',
        //         'RANAP/FARMASI/KASIR',
        //     ];

        //     $rekamMedis = [
        //         'Rujukan',
        //         'Kartu BPJS',
        //         'KTP/KARTU KELUARGA',
        //         'SUDI MERAWAT',
        //         'CLINICAL PATHWAY',
        //         'ANGKET',
        //         'NAME TAG',
        //         'PRIVATE/RPS',
        //         'PINDAH RUANGAN',
        //     ];

        //     $asuransiLain = [
        //         'JASA RAHARJA',
        //         'BPJS KETENAGAKERJAAN',
        //         'BLANKO KRONOLOGIS',
        //     ];

        //     $perawatRegistrasi = [
        //         'KELENGKAPAN STATUS',
        //         'RONTGEN',
        //         'LABOR',
        //         'ECG',
        //         'USG/CT SCAN',
        //         'PASANG GELANG',
        //         'IDENTITAS/RISIKO JATUH/ALERGI',
        //         'KONFIRMASI OPERASI DPJP/OK',
        //         'PUASA MULAI JAM',
        //         'KONSULTASI',
        //         'HASIL BACAAN PA/BAJAH',
        //         'FOTO PRE OPERASI'
        //     ];

        //     $kamarbedah = [
        //         'INFORMED CONSENT PASIEN',
        //         'KONSUL INTERNE',
        //         'VISITE ANESTESI',
        //         'SITE MARKING',
        //         'SP DARAH',
        //         'FOEBRIDING',
        //         'GIGI PALSU/PERHIASAN',
        //         'KLISMA',
        //         'PASIEN MANDI',
        //         'PEMBERIAN ANTIBIOTIKA',
        //         'KELENGKAPAN STATUS OLEH DPJP & ANESTESI',
        //         'RESEP OBAT POST OP',
        //         'PLATE/SCREWIK/K-WIRE',
        //         'ANTIBIOTIKA',
        //         'ANALGETIK',
        //     ];

        //     $laboratorium = [
        //         'SEDIAAN PA',
        //     ];

        //     $farmasiKasir = [
        //         'JAM VISITE DOKTER',
        //         'JAM PENYERAHAN STATUS',
        //         'RESEP PULANG',
        //         'JAM PENYERAHAN STATUS',
        //         'OBAT PULANG',
        //         'COST SHARING',
        //     ];

        //     foreach ($kategori as $item) {
        //         $save = AdministrasiCacatanPerjalananRanapPatient::create([
        //             'catatan_perjalan_ranap_patient_id' => $data->id,
        //             'category' => $item,
        //             'user_id' => 1,
        //         ]);

        //         $recordId = $save->id;

        //         if ($item === 'REKAM MEDIS') {
        //             foreach ($rekamMedis as $medis) {
        //                 DetailAdministrasiCacatanPerjalananRanapPatient::create([
        //                     'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
        //                     'name' => $medis,
        //                     'value' => 'tidak',
        //                 ]);
        //             }
        //         } elseif ($item === 'ASURANSI LAIN') {
        //             foreach ($asuransiLain as $asuransi) {
        //                 DetailAdministrasiCacatanPerjalananRanapPatient::create([
        //                     'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
        //                     'name' => $asuransi,
        //                     'value' => 'tidak',
        //                 ]);
        //             }
        //         } elseif ($item === 'PERAWAT : REGISTRASI/RANAP') {
        //             foreach ($perawatRegistrasi as $perawat) {
        //                 DetailAdministrasiCacatanPerjalananRanapPatient::create([
        //                     'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
        //                     'name' => $perawat,
        //                     'value' => 'tidak',
        //                 ]);
        //             }
        //         } elseif ($item === 'PERAWAT : RANAP/KAMAR BEDAH/PACU') {
        //             foreach ($kamarbedah as $kamar) {
        //                 DetailAdministrasiCacatanPerjalananRanapPatient::create([
        //                     'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
        //                     'name' => $kamar,
        //                     'value' => 'tidak',
        //                 ]);
        //             }
        //         } elseif ($item === 'LABORATORIUM') {
        //             foreach ($laboratorium as $lab) {
        //                 DetailAdministrasiCacatanPerjalananRanapPatient::create([
        //                     'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
        //                     'name' => $lab,
        //                     'value' => 'tidak',
        //                 ]);
        //             }
        //         } elseif ($item === 'RANAP/FARMASI/KASIR') {
        //             foreach ($farmasiKasir as $farmasi) {
        //                 DetailAdministrasiCacatanPerjalananRanapPatient::create([
        //                     'administrasi_cacatan_perjalanan_ranap_patient_id' => $recordId,
        //                     'name' => $farmasi,
        //                     'value' => 'tidak',
        //                 ]);
        //             }
        //         }
        //     }
        //     $pesan = 'SUKSES';
        // } else {
        //     $pesan = 'Pasien Sudah Terdaftar';
        // }
        // return back()->with('success', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!session('btn')) {
            session(['btn' => 'dashboard']);
        } else {
            session(['btn' => session('btn')]);
        }
        $item = RawatInapPatient::find($id);
        $tglLhr = new DateTime($item->queue->patient->tanggal_lhr);
        $today = new DateTime();
        $usia = $tglLhr->diff($today)->y;

        // Cppt Ranap Filter
        $findUserInDpjp = $item->ranapDpjpPatientDetails->where('user_id', auth()->user()->id)->first();
        $isNotNull = $findUserInDpjp->end ?? null;
        if ($isNotNull) {
            $limited_date = date('Y-m-d', strtotime($findUserInDpjp->end));
        } else {
            $limited_date = date('Y-m-d');
        }
        $cpptRanaps = CpptRanap::where('patient_id', $item->queue->patient->id)->whereDate('created_at', '<=', $limited_date)->get();

        // Hais
        $haiss = RanapHaisPatient::where('rawat_inap_patient_id', $id)->get();
        // dd($haiss);

        return view('pages.rawatInap.show', [
            "item" => $item,
            "title" => "Rawat Inap",
            "menu" => "Rawat Inap",
            "usia" => $usia,
            "haiss" => $haiss,
            "cpptRanaps" => $cpptRanaps,
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

    //update status cancel
    public function cancel($id)
    {
        $item = RawatInapPatient::find($id);
        $item->update([
            'status' => 'BATAL',
        ]);
        $item->suratPengantarRawatJalanPatient->update([
            'status' => 'cancel',
        ]);
        return redirect()->route('rawat/inap.index')->with(['success', 'Rawat Inap Telah dibatalkan!']);
    }



    //melakukan fungsi untuk meilihik kamar
    public function room($id)
    {
        // dd(Auth::user());
        $bed = Bed::get();
        $rawatInap = RawatInapPatient::find($id);
        return view('pages.rawatInap.room', [
            "title" => "Rawat Inap",
            'menu' => 'Rawat Inap',
            'bed' => $bed,
            'rawatInap' => $rawatInap,
        ]);
    }


    // function booking kamar
    public function bookingKamar(Request $request, $id, $bed_id)
    {
        // update rawat inap patient
        $rawatInap = RawatInapPatient::find($id);
        $rawatInap->update([
            'status' => 'BOOKING',
            'bed_id' => $bed_id,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
        ]);

        // update bed
        $bed = Bed::find($bed_id);
        $bed->update([
            'isAvailable' => 0,
        ]);

        // update surat Pengantar rawnap
        $suratPengantarRanap = SuratPengantarRawatJalanPatient::where('queue_id', $rawatInap->queue_id)->first();
        $suratPengantarRanap->update([
            'status' => 'terima'
        ]);

        // input tabel booking
        RoomBooking::create([
            'rawat_inap_patient_id' => $id,
            'bed_id' => $bed_id,
            'tanggal_masuk' => $request->mulai,
            'tanggal_selesai' => $request->selesai,
            'status' => 'WAITING',
        ]);
        return redirect()->route('rawat/inap.room', $id)->with('success', 'Berhasil Booking Kamar ' . $bed->name . ' Pada Tanggal ' . $request->mulai . ' s/d ' . $request->selesai);
    }

    // function untuk masuk kamar
    public function masukKamar(Request $request, $id, $bed_id,)
    {
        // update rawat inap patient
        $rawatInap = RawatInapPatient::find($id);
        $rawatInap->update([
            'status' => 'MASUK KAMAR',
            'bed_id' => $bed_id,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
        ]);

        // update bed
        $bed = Bed::find($bed_id);
        $bed->update([
            'isAvailable' => 0,
        ]);

        // update surat Pengantar rawnap
        $suratPengantarRanap = SuratPengantarRawatJalanPatient::where('queue_id', $rawatInap->queue_id)->first();
        $suratPengantarRanap->update([
            'status' => 'terima'
        ]);
        return redirect()->route('rawat/inap.room', $id)->with('success', 'Berhasil Masuk Kamar ' . $bed->name . ' Pada Tanggal ' . $request->mulai . ' s/d ' . $request->selesai);
    }
    // function untuk titipKamar
    public function titipKamar(Request  $request, $id, $bed_id)
    {
        // update rawat inap patient
        $rawatInap = RawatInapPatient::find($id);
        $rawatInap->update([
            'status' => 'TITIPKAN',
            'bed_id' => $bed_id,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
        ]);

        // update bed
        $bed = Bed::find($bed_id);
        $bed->update([
            'isAvailable' => 0,
        ]);

        // update surat Pengantar rawnap
        $suratPengantarRanap = SuratPengantarRawatJalanPatient::where('queue_id', $rawatInap->queue_id)->first();
        $suratPengantarRanap->update([
            'status' => 'terima'
        ]);
        return redirect()->route('rawat/inap.room', $id)->with('success', 'Berhasil Dititipkan Pada Kamar ' . $bed->name . ' Pada Tanggal ' . $request->mulai . ' s/d ' . $request->selesai);
    }


    //Pembatalan Pilih kamar
    public function cancelKamar($id, $bed_id)
    {
        // update rawat inap patient
        $rawatInap = RawatInapPatient::find($id);
        $rawatInap->update([
            'status' => 'WAITING',
            'bed_id' => null,
            'mulai' => null,
            'selesai' => null,
        ]);

        // update bed
        $bed = Bed::find($bed_id);
        $bed->update([
            'isAvailable' => 1,
        ]);

        // update surat Pengantar rawnap
        $suratPengantarRanap = SuratPengantarRawatJalanPatient::where('queue_id', $rawatInap->queue_id)->first();
        $suratPengantarRanap->update([
            'status' => 'waiting'
        ]);

        //Update tabel booking
        $booking = RoomBooking::where('rawat_inap_patient_id', $id)->first();
        if ($booking) {
            $booking->update([
                'status' => 'BATAL'
            ]);
        }
        return redirect()->route('rawat/inap.room', $id)->with('success', 'Membatalkan Memilih Kamar');
    }
}
