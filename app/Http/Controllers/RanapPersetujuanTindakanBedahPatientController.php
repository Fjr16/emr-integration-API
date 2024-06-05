<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Queue;
use App\Models\RanapDetailPersetujuanTindakanBedahPatient;
use App\Models\RanapPersetujuanTindakanBedahPatient;
use Illuminate\Http\Request;
use App\Models\RawatInapPatient;
use DateTime;
use Illuminate\Support\Facades\Storage;

class RanapPersetujuanTindakanBedahPatientController extends Controller
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
        return view('pages.ranapPersetujuanTindakanBedah.index', [
            'title' => 'Persetujuan Tindakan Bedah',
            'menu' => 'Rawat Inap',
            'data' => $data,
        ]);
    }

    public function detail($id)
    {
        $item = RawatInapPatient::find($id);
        $data = RanapPersetujuanTindakanBedahPatient::where('rawat_inap_patient_id', $item->id)->get();

        return view('pages.ranapPersetujuanTindakanBedah.detail', [
            "item" => $item,
            "title" => "Persetujuan Tindakan Bedah",
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
        $jks = [
            'Pria',
            'Wanita',
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
        $data = User::whereNot('room_detail_id', null)->get();

        $tgl_lahir = new DateTime($item->queue->patient->tanggal_lhr);
        $today = new DateTime();
        $umur = $tgl_lahir->diff($today)->y;

        return view('pages.ranapPersetujuanTindakanBedah.create', [
            'title' => 'Persetujuan Tindakan Bedah',
            'menu' => 'Rawat Inap',
            'data' => $data,
            'item' => $item,
            'jks' => $jks,
            'jenisInformasi' => $jenisInformasi,
            'umur' => $umur,
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
        $itemBedah = RanapPersetujuanTindakanBedahPatient::create($data);

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

                RanapDetailPersetujuanTindakanBedahPatient::create([
                    'ranap_persetujuan_tindakan_bedah_patient_id' => $itemBedah->id,
                    'jenis' => $value,
                    'isi' => $isi[$key],
                    'ttd' => $file_name,
                ]);
            }
        }

        return redirect()->route('persetujuan/tindakan/bedah.detail', $item->id)->with('success', 'Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = RanapPersetujuanTindakanBedahPatient::find($id);
        $tgl_lahir = new DateTime($item->rawatInapPatient->queue->patient->tanggal_lhr);
        $today = new DateTime();
        $umur = $tgl_lahir->diff($today)->y;

        return view('pages.ranapPersetujuanTindakanBedah.show', [
            'title' => "Persetujuan Tindakan Bedah",
            'menu' => 'Rawat Inap',
            'item' => $item,
            'umur' => $umur,
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
        $item = RanapPersetujuanTindakanBedahPatient::find($id);
        $jks = [
            'Pria',
            'Wanita',
        ];
        $tgl_lahir = new DateTime($item->rawatInapPatient->queue->patient->tanggal_lhr);
        $today = new DateTime();
        $umur = $tgl_lahir->diff($today)->y;

        return view('pages.ranapPersetujuanTindakanBedah.edit', [
            'title' => 'Persetujuan Tindakan Bedah',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'jks' => $jks,
            'umur' => $umur,
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
        $item = RanapPersetujuanTindakanBedahPatient::find($id);
        $data = [
            'name' => $request->input('name'),
            'umur' => $request->input('umur'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'alamat' => $request->input('alamat'),
            'hubungan' => $request->input('hubungan'),
            'tanggal' => $request->input('date') . " " . $request->input('time'),
            'hub1' => $request->input('hub1'),
            'namaHub1' => $request->input('namaHub1'),
            'hub2' => $request->input('hub2'),
            'namaHub2' => $request->input('namaHub2'),
        ];

        $folder_path = 'assets/paraf-pasien/';
        Storage::makeDirectory('public/' . $folder_path);

        // paraf penerima informasi
        if ($item->ttdPenerimaInformasi != $request->input('ttdPenerimaInformasi')) {
            $ttdPenerimaInfoImg = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdPenerimaInformasi')));
            $file_name_penerima_info = $folder_path . uniqid() . '.png';
            Storage::put('public/' . $file_name_penerima_info, $ttdPenerimaInfoImg);
            $data['ttdPenerimaInformasi'] = $file_name_penerima_info;
        }

        if ($item->ttdHub1 != $request->input('ttdHub1')) {
            // paraf wali atau saksi 1
            $ttdHub1 = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdHub1')));
            $file_name_hub1 = $folder_path . uniqid() . '.png';
            Storage::put('public/' . $file_name_hub1, $ttdHub1);
            $data['ttdHub1'] = $file_name_hub1;
        }

        if ($item->ttdHub2 != $request->input('ttdHub2')) {
            // paraf wali atau saksi 2
            $ttdHub2 = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdHub2')));
            $file_name_hub2 = $folder_path . uniqid() . '.png';
            Storage::put('public/' . $file_name_hub2, $ttdHub2);
            $data['ttdHub2'] = $file_name_hub2;
        }

        if ($item->ttdKet1 != $request->input('ttdKet1')) {
            // paraf pernyataan petugas
            $ttdKet1 = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdKet1')));
            $file_name_ket1 = $folder_path . uniqid() . '.png';
            Storage::put('public/' . $file_name_ket1, $ttdKet1);
            $data['ttdKet1'] = $file_name_ket1;
        }

        if ($item->ttdKet2 != $request->input('ttdKet2')) {
            // paraf pernyataan wali /pasien
            $ttdKet2 = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttdKet2')));
            $file_name_ket2 = $folder_path . uniqid() . '.png';
            Storage::put('public/' . $file_name_ket2, $ttdKet2);
            $data['ttdKet2'] = $file_name_ket2;
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
                $ranapDetailPer = RanapDetailPersetujuanTindakanBedahPatient::find($id_detail[$i]);
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

        return redirect()->route('persetujuan/tindakan/bedah.detail', $item->rawat_inap_patient_id)->with('success', 'Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = RanapPersetujuanTindakanBedahPatient::find($id);
        $item->ranapDetailPersetujuanTindakanBedahPatients()->delete();
        $item->delete();

        return back()->with('success', 'Berhasil Dihapus');
    }
}
