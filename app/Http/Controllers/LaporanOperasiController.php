<?php

namespace App\Http\Controllers;

use App\Models\DetailLaporanOperasiPatient;
use App\Models\LaporanOperasiPatient;
use App\Models\Queue;
use App\Models\RawatInapPatient;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LaporanOperasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient')->get();
        return view('pages.laporanOperasi.index', [
            "title" => "Laporan Operasi",
            "menu" => "Rawat Inap",
            'data' => $data,
        ]);
    }
    public function detail($id)
    {
        $item = RawatInapPatient::find($id);
        $data = LaporanOperasiPatient::where('rawat_inap_patient_id', $id)->get();
        return view('pages.laporanOperasi.detail', [
            "title" => "Laporan Operasi",
            "menu" => "Poliklinik",
            'data' => $data,
            'item' => $item,
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
        $perencanaanDiets = [
            'Maka biasa',
            'Diet rendah lemak',
            'Makan lunak',
            'Diet rendah protein I / II / III',
            'Makan saring',
            'Diet rendah purin',
            'Makan cair',
            'Diet jantung I / II / III',
            'Diet diabetes 1500 kkal / 1700 kkal / 1900 kkal',
            'Diet TKTP 1750 kkal / 2000 kkal / 2500 kkal',
            'Diet rendah garam I / II / III',
            'Diet lambung I / II',
            'Diet hati I / II / III',
        ];
        return view('pages.laporanOperasi.create', [
            "title" => "Laporan Operasi",
            "menu" => "Rawat Inap",
            "perencanaanDiets" => $perencanaanDiets,
            "item" => $item,
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
        $perencanaanDiets = $request->input('perencanaan-diet', []);
        // dd($perencanaanDiets);

        // parafpasien
        $folder_path = 'assets/paraf-pasien/';
        Storage::makeDirectory('public/' . $folder_path);

        // paraf penerima informasi
        $ttdPenerimaInfoImg = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd_pasien')));
        $file_name_penerima_info = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name_penerima_info, $ttdPenerimaInfoImg);
        $data['ttd_pasien'] = $file_name_penerima_info;


        $data = $request->all();
        $data['rawat_inap_patient_id'] = $item->id;
        $data['diJelaskan'] = $request->nm_wali;
        $item2 = LaporanOperasiPatient::create($data);

        foreach ($perencanaanDiets as $perencanaanDiet) {
            DetailLaporanOperasiPatient::create([
                'laporan_operasi_patient_id' => $item2->id,
                'name'   => $perencanaanDiet,
            ]);
        }

        //  dd($item->id);
        if ($request->spesimen_operasi_pemeriksaan_pa != 'Kultur') {
            return redirect()->route('permintaan/laboratorium/patologi/anatomik.create', $item->queue_id)->with('success', 'Berhasil Menyimpan Data Laporan Operasi');
        } else {
            return redirect()->route('laboratorium/pk/tipe/permintaan.create')->with('success', 'Berhasil Menyimpan Data Laporan Operasi ');
        }
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
        $item = LaporanOperasiPatient::find($id);
        $detail = DetailLaporanOperasiPatient::where('laporan_operasi_patient_id', $item->id)->get();
        $perencanaanDiets = [
            'Maka biasa',
            'Diet rendah lemak',
            'Makan lunak',
            'Diet rendah protein I / II / III',
            'Makan saring',
            'Diet rendah purin',
            'Makan cair',
            'Diet jantung I / II / III',
            'Diet diabetes 1500 kkal / 1700 kkal / 1900 kkal',
            'Diet TKTP 1750 kkal / 2000 kkal / 2500 kkal',
            'Diet rendah garam I / II / III',
            'Diet lambung I / II',
            'Diet hati I / II / III',
        ];
        return view('pages.laporanOperasi.edit', [
            "title" => "Laporan Operasi",
            "menu" => "Setting",
            "item" => $item,
            "detail" => $detail,
            "perencanaanDiets" => $perencanaanDiets
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


        $perencanaanDiets = $request->input('perencanaan-diet', []);
        $item = LaporanOperasiPatient::find($id);


        // parafpasien
        $folder_path = 'assets/paraf-pasien/';
        Storage::makeDirectory('public/' . $folder_path);

        // paraf penerima informasi
        $ttdPenerimaInfoImg = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd_pasien')));
        $file_name_penerima_info = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name_penerima_info, $ttdPenerimaInfoImg);
        $data['ttd_pasien'] = $file_name_penerima_info;
        $data['diJelaskan'] = $request->nm_wali;
        $data = $request->all();
        $item->update($data);

        $detailDiets = DetailLaporanOperasiPatient::where('laporan_operasi_patient_id', $item->id)->get();
        foreach ($detailDiets as $detailDiet) {
            $detailDiet->delete();
        }
        foreach ($perencanaanDiets as $perencanaanDiet) {
            DetailLaporanOperasiPatient::create([
                'laporan_operasi_patient_id' => $item->id,
                'name'   => $perencanaanDiet,
            ]);
        }

        return redirect()->route('rawat/inap.show', $item->rawatInapPatient->id)->with([
            'success' => 'Berhasil Diperbarui',
            'btn' => 'lo',
        ]);
        // return redirect()->route('laporan/operasi.index')->with('success', 'Laporan Operasi Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = LaporanOperasiPatient::find($id);
        $item->delete();

        return back()->with('success', 'Laporan Operasi Berhasil Dihapus');
    }

    public function getTtd(Request $request)
    {

        try {
            $item = User::findOrFail($request->user_id);
            if (Hash::check($request->password, $item->password)) {
                return response()->json($item->paraf);
            } else {
                throw new Exception("Terjadi Kesalahan, Mohon Periksa Kembali Password Yang Anda Masukkan", 500);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Terjadi Kesalahan, User Tidak Ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
}
