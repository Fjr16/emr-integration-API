<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\RanapJawabanKonsulDetailLainnyaPatient;
use App\Models\RanapJawabanKonsulDetailPenemuanPatient;
use App\Models\RanapJawabanKonsulDetailSkriningCovidPatient;
use App\Models\RanapJawabanKonsulPenyakitDalamPatient;
use DateTime;
use App\Models\User;
use App\Models\RoomDetail;
use Illuminate\Http\Request;
use App\Models\RawatInapPatient;
use Illuminate\Support\Facades\Auth;
use App\Models\RanapPermintaanKonsulPenyakitDalamPatient;

class RanapLembarKonsultasiPenyakitDalamPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient', function($query){
            $query->whereNot('status', 'WAITING')->whereNot('status', 'BATAL');
        })->get();
        return view('pages.ranapLembarKonsulPenyakitDalam.index', [
            "title" => "Konsultasi Penyakit Dalam",
            "menu" => "Rawat Inap",
            'data' => $data,
        ]);
    }

    public function detail($id)
    {
        $item = RawatInapPatient::find($id);
        $konsultasi = RanapPermintaanKonsulPenyakitDalamPatient::where('rawat_inap_patient_id', $id)->get();

        return view('pages.ranapLembarKonsulPenyakitDalam.detail', [
            "item" => $item,
            "title" => "Konsultasi Penyakit Dalam",
            "menu" => "Rawat Inap",
            "konsultasi" => $konsultasi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = RawatInapPatient::find($id);
        $dokters = User::whereNot('room_detail_id', null)->get();
        $arrPermintaan = [
            'Konsultasi / tindakan masalah medis saat ini',
            'Perawatan bersama untuk selanjutnya',
            'Alih rawat untuk selanjutnya',
        ];
        $roomDetails = RoomDetail::where('isActive', true)->get();
        return view('pages.ranapLembarKonsulPenyakitDalam.create', [
            'title' => 'Konsultasi Penyakit Dalam',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'dokters' => $dokters,
            'arrPermintaan' => $arrPermintaan,
            'roomDetails' => $roomDetails,
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
        $item = RawatInapPatient::find($id);
        $today = new DateTime;

        $dataPermintaan = [
            'rawat_inap_patient_id' => $item->id,
            'patient_id' => $item->queue->patient->id,
            'room_detail_id' => $request->input('room_detail_id'),
            'user_id' => Auth::user()->id,
            'permintaan' => $request->input('permintaan'),
            'ket_pasien' => $request->input('ket_pasien'),
            'pemeriksaan_ditemukan' => $request->input('pemeriksaan_ditemukan'),
            'tanggal' => $today->format('Y-m-d H:i:s'),
        ];
        $reqKonsul = RanapPermintaanKonsulPenyakitDalamPatient::create($dataPermintaan);

        RanapJawabanKonsulPenyakitDalamPatient::create([
            'ranap_permintaan_konsul_penyakit_dalam_patient_id' => $reqKonsul->id,
            'user_id' => $request->input('user_id'),
        ]);

        return redirect()->route('lembar/konsultasi/penyakit/dalam.detail', $item->id)->with([
            'success' => 'Data Berhasil Ditambahkan',
            'btn' => 'lembar-konsul',
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
        $item = RanapPermintaanKonsulPenyakitDalamPatient::find($id);
        $jawaban = RanapJawabanKonsulPenyakitDalamPatient::where('ranap_permintaan_konsul_penyakit_dalam_patient_id', $item->id)->first();
        $penemuans = RanapJawabanKonsulDetailPenemuanPatient::where('ranap_jawaban_konsul_penyakit_dalam_patient_id', $jawaban->id)->get();
        $lainnyas = RanapJawabanKonsulDetailLainnyaPatient::where('ranap_jawaban_konsul_penyakit_dalam_patient_id', $jawaban->id)->get();
        $covids = RanapJawabanKonsulDetailSkriningCovidPatient::where('ranap_jawaban_konsul_penyakit_dalam_patient_id', $jawaban->id)->get();

        return view('pages.ranapLembarKonsulPenyakitDalam.show', [
            'title' => 'Rawat Inap',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'jawaban' => $jawaban,
            'penemuans' => $penemuans,
            'lainnyas' => $lainnyas,
            'covids' => $covids,
            // 'dokters' => $dokters,
            // 'arrPermintaan' => $arrPermintaan,
            // 'roomDetails' => $roomDetails,
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
        $item = RanapPermintaanKonsulPenyakitDalamPatient::find($id);
        $dokters = User::whereNot('room_detail_id', null)->get();
        $arrPermintaan = [
            'Konsultasi / tindakan masalah medis saat ini',
            'Perawatan bersama untuk selanjutnya',
            'Alih rawat untuk selanjutnya',
        ];
        $roomDetails = RoomDetail::where('isActive', true)->get();

        return view('pages.ranapLembarKonsulPenyakitDalam.edit', [
            'title' => 'Konsultasi Penyakit Dalam',
            'menu' => 'generalConsent',
            'dokters' => $dokters,
            'arrPermintaan' => $arrPermintaan,
            'roomDetails' => $roomDetails,
            'item' => $item,
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
        $item = RanapPermintaanKonsulPenyakitDalamPatient::find($id);
        $parameter = $item->rawat_inap_patient_id;
        $today = new DateTime;

        $dataPermintaan = [
            'rawat_inap_patient_id' => $item->rawat_inap_patient_id,
            'patient_id' => $item->patient_id,
            'room_detail_id' => $request->input('room_detail_id'),
            'user_id' => Auth::user()->id,
            'permintaan' => $request->input('permintaan'),
            'ket_pasien' => $request->input('ket_pasien'),
            'pemeriksaan_ditemukan' => $request->input('pemeriksaan_ditemukan'),
            'tanggal' => $today->format('Y-m-d H:i:s'),
        ];
        RanapPermintaanKonsulPenyakitDalamPatient::where('rawat_inap_patient_id', $item->rawat_inap_patient_id)->update($dataPermintaan);
        $reqKonsul = RanapPermintaanKonsulPenyakitDalamPatient::where('rawat_inap_patient_id', $item->rawat_inap_patient_id)->first();

        RanapJawabanKonsulPenyakitDalamPatient::where('ranap_permintaan_konsul_penyakit_dalam_patient_id',)->create([
            'ranap_permintaan_konsul_penyakit_dalam_patient_id' => $reqKonsul->id,
            'user_id' => $request->input('user_id'),
        ]);

        return redirect()->route('lembar/konsultasi/penyakit/dalam.detail', $parameter)->with([
            'success' => 'Data Berhasil Ditambahkan',
            'btn' => 'lembar-konsul',
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
        $item = RanapPermintaanKonsulPenyakitDalamPatient::find($id);
        $parameter = $item->rawat_inap_patient_id;
        $jawaban = RanapJawabanKonsulPenyakitDalamPatient::where('ranap_permintaan_konsul_penyakit_dalam_patient_id', $item->id)->first();
        RanapJawabanKonsulDetailPenemuanPatient::where('ranap_jawaban_konsul_penyakit_dalam_patient_id', $jawaban->id)->delete();
        RanapJawabanKonsulDetailLainnyaPatient::where('ranap_jawaban_konsul_penyakit_dalam_patient_id', $jawaban->id)->delete();
        RanapJawabanKonsulDetailSkriningCovidPatient::where('ranap_jawaban_konsul_penyakit_dalam_patient_id', $jawaban->id)->delete();

        RanapJawabanKonsulPenyakitDalamPatient::where('ranap_permintaan_konsul_penyakit_dalam_patient_id', $item->id)->delete();
        RanapPermintaanKonsulPenyakitDalamPatient::find($id)->delete();

        return redirect()->route('lembar/konsultasi/penyakit/dalam.detail', $parameter)->with([
            'success' => 'Data Berhasil Dihapus',
            'btn' => 'lembar-konsul',
        ]);
    }
}
