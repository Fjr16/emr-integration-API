<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Queue;
use App\Models\RanapDetailPemberianInformasiTindakanAnestesiPatient;
use App\Models\RanapDetailPersetujuanTindakanAnestesiPatient;
use App\Models\RanapPemberianInformasiPersetujuanTindakanAnestesiPatient;
use App\Models\RanapPersetujuanTindakanAnestesiPatient;
use App\Models\RawatInapPatient;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RanapPemberianInformasiPersetujuanTindakanAnestesiController extends Controller
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
        return view('pages.informasiPersetujuanAnestesi.index', [
            "title" => "Persetujuan Anestesi",
            "menu" => "Rawat Inap",
            'data' => $data,
        ]);
    }

    public function detail($id)
    {
        $item = RawatInapPatient::find($id);
        $data = RanapPersetujuanTindakanAnestesiPatient::where('rawat_inap_patient_id', $id)->get();

        return view('pages.informasiPersetujuanAnestesi.detail', [
            "item" => $item,
            "title" => "Persetujuan Anestesi",
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
        $jks = [
            'Pria',
            'Wanita',
        ];
        $jenisAnestesis = [
            'Lokal',
            'Umum',
            'Spinal',
        ];
        $jenisInformasi = [
            'Diagnosis (WD & DD)',
            'Dasar Diagnosis',
            'Tindakan Kedokteran',
            'Indikasi Tindakan',
            'Tata Cara',
            'Tujuan',
            'Resiko',
            'Komplikasi',
            'Prognosis',
            'Alternatif & Resiko',
        ];
        $item = RawatInapPatient::find($id);
        $tgl_lahir = new DateTime($item->queue->patient->tanggal_lhr);
        $today = new DateTime();
        $umur = $tgl_lahir->diff($today)->y;
        $dokters = User::whereNot('room_detail_id', null)->get();
        return view('pages.informasiPersetujuanAnestesi.create', [
            "title" => "Persetujuan Anestesi",
            "menu" => "Rawat Inap",
            "jks" => $jks,
            "jenisAnestesis" => $jenisAnestesis,
            "item" => $item,
            "dokters" => $dokters,
            "umur" => $umur,
            "jenisInformasi" => $jenisInformasi,
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
        $data = $request->all();

        $folder_path = 'assets/paraf-pasien/';
        Storage::makeDirectory('public/' . $folder_path);

        // paraf penerima informasi
        $ttdPenerimaInfoImg = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdPenerimaInformasi')));
        $file_name_penerima_info = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name_penerima_info, $ttdPenerimaInfoImg);
        $data['ttdPenerimaInformasi'] = $file_name_penerima_info;

        // paraf wali atau saksi 1
        $ttdHub1 = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdHub1')));
        $file_name_hub1 = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name_hub1, $ttdHub1);
        $data['ttdHub1'] = $file_name_hub1;

        // paraf wali atau saksi 2
        $ttdHub2 = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdHub2')));
        $file_name_hub2 = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name_hub2, $ttdHub2);
        $data['ttdHub2'] = $file_name_hub2;

        // paraf pernyataan petugas
        $ttdKet1 = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdKet1')));
        $file_name_ket1 = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name_ket1, $ttdKet1);
        $data['ttdKet1'] = $file_name_ket1;

        // paraf pernyataan wali /pasien
        $ttdKet2 = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdKet2')));
        $file_name_ket2 = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name_ket2, $ttdKet2);
        $data['ttdKet2'] = $file_name_ket2;

        $data['rawat_inap_patient_id'] = $item->id;
        $data['patient_id'] = $item->queue->patient->id;
        $data['tanggal'] = $request->input('date') . " " . $request->input('time');
        $itemAnestesi = RanapPersetujuanTindakanAnestesiPatient::create($data);

        //detail persetujuan tindakan bedah
        $jenis = $request->input('jenis', []);
        $isi = $request->input('isi', []);
        $ttd = $request->input('ttd', []);
        foreach ($jenis as $key => $value) {
            if ($value) {
                if ($ttd[$key]) {
                    $ttd_save = base64_decode(str_replace('data:image/png;base64,', '', $ttd[$key]));
                    $file_name = $folder_path . uniqid() . '.png';
                    Storage::put('public/' . $file_name, $ttd_save);
                } else {
                    $file_name = null;
                }

                RanapDetailPersetujuanTindakanAnestesiPatient::create([
                    'ranap_persetujuan_tindakan_anestesi_patient_id' => $itemAnestesi->id,
                    'jenis' => $value,
                    'isi' => $isi[$key],
                    'ttd' => $file_name,
                ]);
            }
        }

        return redirect()->route('pemberian/informasi/persetujuan/tindakan/anestesi.detail', $item->id)->with('success', 'Berhasil Ditambahkan');
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
        $item = RanapPersetujuanTindakanAnestesiPatient::find($id);
        $jks = [
            'Pria',
            'Wanita',
        ];
        $jenisAnestesis = [
            'Lokal',
            'Umum',
            'Spinal',
        ];
        $tgl_lahir = new DateTime($item->rawatInapPatient->queue->patient->tanggal_lhr);
        $today = new DateTime();
        $umur = $tgl_lahir->diff($today)->y;
        $dokters = User::whereNot('room_detail_id', null)->get();

        return view('pages.informasiPersetujuanAnestesi.edit', [
            'title' => 'Persetujuan Anestesi',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'jks' => $jks,
            'jenisAnestesis' => $jenisAnestesis,
            'umur' => $umur,
            'dokters' => $dokters,
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
        $item = RanapPersetujuanTindakanAnestesiPatient::find($id);
        if ($request->input('jenis_anestesi')) {
            $jenis = $request->input('jenis_anestesi');
        } else {
            $jenis = $item->jenis_anestesi;
        }

        if ($request->input('hubungan')) {
            $hubungan = $request->input('hubungan');
        } else {
            $hubungan = $item->hubungan;
        }

        $data = [
            'name' => $request->input('name'),
            'umur' => $request->input('umur'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'alamat' => $request->input('alamat'),
            'jenis_anestesi' => $jenis,
            'hubungan' => $hubungan,
            'tanggal' => $request->input('date') . " " . $request->input('time'),
            'hub1' => $request->input('hub1'),
            'namaHub1' => $request->input('namaHub1'),
            'hub2' => $request->input('hub2'),
            'namaHub2' => $request->input('namaHub2'),
        ];

        $folder_path = 'assets/paraf-pasien/';
        Storage::makeDirectory('public/' . $folder_path);

        // paraf penerima informasi
        if ($request->input('ttdPenerimaInformasi')) {
            if ($item->ttdPenerimaInformasi != $request->input('ttdPenerimaInformasi')) {
                $ttdPenerimaInfoImg = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdPenerimaInformasi')));
                $file_name_penerima_info = $folder_path . uniqid() . '.png';
                Storage::put('public/' . $file_name_penerima_info, $ttdPenerimaInfoImg);
                $data['ttdPenerimaInformasi'] = $file_name_penerima_info;
            } else {
                $data['ttdKet2'] = $item->ttdPenerimaInformasi;
            }
        }

        if ($request->input('ttdHub1')) {
            if ($item->ttdHub1 != $request->input('ttdHub1')) {
                // paraf wali atau saksi 1
                $ttdHub1 = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdHub1')));
                $file_name_hub1 = $folder_path . uniqid() . '.png';
                Storage::put('public/' . $file_name_hub1, $ttdHub1);
                $data['ttdHub1'] = $file_name_hub1;
            } else {
                $data['ttdKet2'] = $item->ttdHub1;
            }
        }

        if ($request->input('ttdHub2')) {
            if ($item->ttdHub2 != $request->input('ttdHub2')) {
                // paraf wali atau saksi 2
                $ttdHub2 = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdHub2')));
                $file_name_hub2 = $folder_path . uniqid() . '.png';
                Storage::put('public/' . $file_name_hub2, $ttdHub2);
                $data['ttdHub2'] = $file_name_hub2;
            } else {
                $data['ttdKet2'] = $item->ttdHub2;
            }
        }

        if ($request->input('ttdKet1')) {
            if ($item->ttdKet1 != $request->input('ttdKet1')) {
                // paraf pernyataan petugas
                $ttdKet1 = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdKet1')));
                $file_name_ket1 = $folder_path . uniqid() . '.png';
                Storage::put('public/' . $file_name_ket1, $ttdKet1);
                $data['ttdKet1'] = $file_name_ket1;
            } else {
                $data['ttdKet2'] = $item->ttdKet1;
            }
        }

        if ($request->input('ttdKet2')) {
            if ($item->ttdKet2 != $request->input('ttdKet2')) {
                // paraf pernyataan wali /pasien
                $ttdKet2 = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdKet2')));
                $file_name_ket2 = $folder_path . uniqid() . '.png';
                Storage::put('public/' . $file_name_ket2, $ttdKet2);
                $data['ttdKet2'] = $file_name_ket2;
            } else {
                $data['ttdKet2'] = $item->ttdKet2;
            }
        }
        $item->update($data);

        //detail persetujuan tindakan bedah
        $id_detail = $request->input('id', []);
        $jenis = $request->input('jenis', []);
        $isi = $request->input('isi', []);
        $ttd = $request->input('ttd', []);
        // foreach ($jenis as $key => $value) {
        for ($i = 0; $i < count($jenis); $i++) {
            if ($i < count($id_detail)) {
                $ranapDetailPer = RanapDetailPersetujuanTindakanAnestesiPatient::find($id_detail[$i]);
                if ($ttd[$i]) {
                    if ($ttd[$i] != $ranapDetailPer->ttd) {
                        $ttd_save = base64_decode(str_replace('data:image/png;base64,', '', $ttd[$i]));
                        $file_name = $folder_path . uniqid() . '.png';
                        Storage::put('public/' . $file_name, $ttd_save);
                    } else {
                        $file_name = $ranapDetailPer->ttd;
                    }
                } else {
                    $file_name = null;
                }
                $ranapDetailPer->update([
                    'jenis' => $jenis[$i],
                    'isi' => $isi[$i],
                    'ttd' => $file_name,
                ]);
            }
        }

        return redirect()->route('pemberian/informasi/persetujuan/tindakan/anestesi.detail', $item->rawat_inap_patient_id)->with('success', 'Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RanapPersetujuanTindakanAnestesiPatient::find($id)->delete();
        RanapDetailPersetujuanTindakanAnestesiPatient::where('id', $id)->delete();
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
