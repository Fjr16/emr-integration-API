<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\RanapDetailHaisPatient;
use App\Models\RanapHaisPatient;
use App\Models\RawatInapPatient;
use App\Models\RoomDetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RanapHaisISKPatientController extends Controller
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
        return view('pages.ranapPencegahaInfeksiSaluranKemih.index', [
            "title" => "Pencegahan HAIs",
            "menu" => "Rawat Inap",
            'data' => $data,
        ]);
    }

    public function detail($id)
    {
        $item = RawatInapPatient::find($id);
        $data = RanapHaisPatient::where('rawat_inap_patient_id', $id)->get();

        return view('pages.ranapPencegahaInfeksiSaluranKemih.detail', [
            "item" => $item,
            "title" => "Pencegahan HAIs",
            "menu" => "Rawat Inap",
            "data" => $data,
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
        $today = new DateTime();
        $roomDetails = RoomDetail::where('isActive', true)->get();

        $insersis = [
            'Melakukan kebersihan tangan',
            'Teknik isersi',
            'Memakai teknik aseptik',
            'Memakai peralatan steril',
            'Pemakaian spesimen',
            'Dengan teknik aseptik',
            'Di ambil bila ada indikasi',
            'Tidak membuka kateter'
        ];

        $maintenances = [
            'Melakukan kebersihan tangan',
            'Volume urine bag 3/4 wajib di buang',
            'Hindari melakukan buka tutup kateter',
            'Posisi urine bag rendah dari kandung kemih dan tidak di letakan di lantai',
            'Hindari irigasi rutin',
            'Melakukan perawatan meatus 2x sehari',
            'Segera lepas jika tidak ada indikasi'
        ];

        return view('pages.ranapPencegahaInfeksiSaluranKemih.create', [
            "title" => "Pencegahan HAIs",
            "menu" => "Rawat Inap",
            "item" => $item,
            "today" => $today,
            "insersis" => $insersis,
            "maintenances" => $maintenances,
            "roomDetails" => $roomDetails,
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
        $kategoris = array_merge($kategori1, $kategori2);

        $nama1 = $request->nama1;
        $nama2 = $request->nama2;
        $namas = array_merge($nama1, $nama2);

        $status1 = $request->status1;
        $status2 = $request->status2;
        $statuss = array_merge($status1, $status2);

        $ket1 = $request->ket1;
        $ket2 = $request->ket2;
        $kets = array_merge($ket1, $ket2);

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

        return view('pages.ranapPencegahaInfeksiSaluranKemih.show', [
            "title" => "HAIs ISK",
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

        return view('pages.ranapPencegahaInfeksiSaluranKemih.edit', [
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
        $data->ranapDetailHaisPatient()->delete();
        $data->delete();
        // RanapDetailHaisPatient::where('ranap_hais_patient_id', $data->id)->delete();
        // RanapHaisPatient::find($id)->delete();
        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'hais',
        ]);
    }
}
