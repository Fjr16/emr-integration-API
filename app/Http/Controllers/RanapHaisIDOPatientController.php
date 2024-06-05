<?php

namespace App\Http\Controllers;

use App\Models\RanapDetailHaisPatient;
use App\Models\RanapHaisPatient;
use App\Models\RawatInapPatient;
use App\Models\RoomDetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RanapHaisIDOPatientController extends Controller
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
    public function create($id)
    {
        $item = RawatInapPatient::find($id);
        $today = new DateTime();
        $roomDetails = RoomDetail::where('isActive', true)->get();

        $preOperasis = [
            'Melakukan kebersihan tangan',
            'Kadar gula darah < 200 mg/dl',
            'Melakukan pencukuran jika mengganggu jalannya operasi dengan menggunakan pencukur listrik (cliper) jika tidak tersedia cliper gunakan silet baru',
            'Mengukur suhu tubuh dalam kondisi normal',
            'Mandi dengan menggunakan sabun antimikroba atau non-antimikroba',
            'Antibiotik profilaksis harus di berikan 1 jam sebelum insisi untuk semua antimikroba kecuali vankomisin dan fluoroquinolone yang harus di berikan 2 jam sebelumnya',
        ];

        $intraOperasis = [
            'Cuci tangan prabedah dengan Klorhexidine  4% (5 menit)',
            'Mempertahankan tekanan positif dalam kamar bedah',
            'Jumlah petugas maksimal 10 orang',
            'Menjaga pintu kamar bedah harus selalu tertutup, kecuali bila di butuhkan untuk lewatnya peralatan, petugas dan pasien',
            'Membersihkan dan mendesinfeksi permukaan lingkungan ruangan',
            'Sterilisasi instrumen kamar bedah',
            'Menggunakan apd yang benar',
            'Mempertahankan teknik aseptik'
        ];

        $postOperasis = [
            'Menjaga luka yang sudah di jahit dengan verban steril selama 48 jam paska bedah',
            'Melakukan kebersihan tangan sebelum dan sesudah mengganti verban atau bersentuhan dengan luka operasi',
            'Melakukan edukasi pada pasien dan keluarga mengenai perawatan luka operasi yang benar, gejala IDO dan pentingnya melaporkan gejala tersebut',
            'Merawat luka operasi dengan teknik aseptik'
        ];

        return view('pages.ranapPencegahaInfeksiDaerahOperasi.create', [
            "title" => "Pencegahan HAIs",
            "menu" => "Rawat Inap",
            "item" => $item,
            "today" => $today,
            "roomDetails" => $roomDetails,
            "preOperasis" => $preOperasis,
            "intraOperasis" => $intraOperasis,
            "postOperasis" => $postOperasis,
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
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        RanapHaisPatient::create($data);

        $item = RanapHaisPatient::all()->last();

        $kategori1 = $request->kategori1;
        $kategori2 = $request->kategori2;
        $kategori3 = $request->kategori3;
        $kategoris = array_merge($kategori1, $kategori2, $kategori3);

        $nama1 = $request->nama1;
        $nama2 = $request->nama2;
        $nama3 = $request->nama3;
        $namas = array_merge($nama1, $nama2, $nama3);

        $status1 = $request->status1;
        $status2 = $request->status2;
        $status3 = $request->status3;
        $statuss = array_merge($status1, $status2, $status3);

        $ket1 = $request->ket1;
        $ket2 = $request->ket2;
        $ket3 = $request->ket3;
        $kets = array_merge($ket1, $ket2, $ket3);

        for ($i = 0; $i < count($kategoris); $i++) {
            RanapDetailHaisPatient::create([
                'ranap_hais_patient_id' => $item->id,
                'kategori' => $kategoris[$i],
                'nama' => $namas[$i],
                'status' => $statuss[$i],
                'ket' => $kets[$i],
            ]);
        }

        return redirect()->route('hais.detail', $item->rawatInapPatient->queue->patient_id)->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'hais',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = RanapHaisPatient::find($id);
        $details = RanapDetailHaisPatient::where('ranap_hais_patient_id', $id)->get();

        return view('pages.ranapPencegahaInfeksiDaerahOperasi.show', [
            "title" => "HAIs IDO",
            "menu" => "Rawat Inap",
            'data' => $data,
            'details' => $details
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
        $data = RanapHaisPatient::find($id);
        $details = RanapDetailHaisPatient::where('ranap_hais_patient_id', $id)->get();
        $roomDetails = RoomDetail::where('isActive', true)->get();

        return view('pages.ranapPencegahaInfeksiDaerahOperasi.edit', [
            "title" => "Pencegahan HAIs",
            "menu" => "Rawat Inap",
            'data' => $data,
            'details' => $details,
            'roomDetails' => $roomDetails,
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
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        RanapHaisPatient::find($id)->update($data);
        $item = RanapHaisPatient::find($id);

        $kategoris = $request->input('kategori', []);
        $ids = $request->input('id', []);
        $namas = $request->input('nama', []);
        $statuss = $request->input('status', []);
        $kets = $request->input('ket', []);

        $total = $request->id_akhir - count($kategoris) + 1;

        for ($i = $total; $i < $request->id_akhir; $i++) {
            RanapDetailHaisPatient::find($ids[$i])->update([
                'kategori' => $kategoris[$i],
                'nama' => $namas[$i],
                'status' => $statuss[$i],
                'ket' => $kets[$i],
            ]);
        }

        return redirect()->route('hais.detail', $item->rawatInapPatient->queue->patient_id)->with([
            'success' => 'Berhasil Diedit',
            'btn' => 'hais',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = RanapHaisPatient::find($id);
        RanapDetailHaisPatient::where('ranap_hais_patient_id', $data->id)->delete();
        RanapHaisPatient::find($id)->delete();
        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'hais',
        ]);
    }
}
