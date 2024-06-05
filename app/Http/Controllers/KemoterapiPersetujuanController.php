<?php

namespace App\Http\Controllers;

use App\Models\KemoterapiPatient;
use App\Models\KemoterapiPersetujuan;
use App\Models\KemoterapiPersetujuanDetail;
use App\Models\KemoterapiSbpkPatientDetail;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KemoterapiPersetujuanController extends Controller
{
    public function create($id)
    {
        $item = KemoterapiPatient::find($id);
        $jks = ['Pria', 'Wanita'];
        $jenisInformasi = ['Diagnosis (WD & DD)', 'Dasar Diagnosis', 'Tindakan Kedokteran', 'Indikasi Tindakan', 'Tata Cara', 'Tujuan', 'Resiko', 'Komplikasi', 'Prognosis', 'Alternatif & Resiko'];
        // $data = User::whereNot('room_detail_id', null)->get();

        $tgl_lahir = new DateTime($item->queue->patient->tanggal_lhr);
        $today = new DateTime();
        $umur = $tgl_lahir->diff($today)->y;

        return view('pages.kemoterapiPersetujuan.create', [
            'menu' => 'Kemoterapi',
            'title' => 'Pasien Kemo',
            // 'data' => $data,
            'item' => $item,
            'jks' => $jks,
            'jenisInformasi' => $jenisInformasi,
            'umur' => $umur,
        ]);
    }

    public function store(Request $request, $id)
    {
        $item = KemoterapiPatient::find($id);
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

        $data['kemoterapi_patient_id'] = $item->id;
        $data['patient_id'] = $item->queue->patient->id;
        $data['tanggal'] = $request->input('date') . ' ' . $request->input('time');
        if ($request->input('inputTindakan')) {
            $data['tindakan'] = $request->input('inputTindakan');
        } else {
            $data['tindakan'] = $request->input('tindakan');
        }
        // dd($data);die;
        $itemKemoterapi = KemoterapiPersetujuan::create($data);

        // Simpan detail persetujuan tindakan bedah
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

                KemoterapiPersetujuanDetail::create([
                    'kemoterapi_persetujuan_id' => $itemKemoterapi->id,
                    'jenis' => $value,
                    'isi' => $isi[$key],
                    'ttd' => $file_name,
                ]);
            }
        }

        // return redirect()->route('persetujuan/tindakan/kemoterapi.detail', $item->id)->with('success', 'Berhasil Ditambahkan');
        return redirect()
            ->route('kemoterapi/patient.show', ['id' => $item->id, 'title' => 'Pasien Kemo'])
            ->with([
                'success' => 'Berhasil Ditambahkan',
                'btn' => 'persetujuan kemoterapi',
            ]);
    }

    public function show($id)
    {
        $item = KemoterapiPersetujuan::find($id);
        $tgl_lahir = new DateTime($item->kemoterapiPatient->queue->patient->tanggal_lhr);
        $today = new DateTime();
        $umur = $tgl_lahir->diff($today)->y;

        return view('pages.kemoterapiPersetujuan.show', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'umur' => $umur,
        ]);
    }

    public function edit($id)
    {
        $item = KemoterapiPersetujuan::find($id);
        $jks = ['Pria', 'Wanita'];
        $tgl_lahir = new DateTime($item->kemoterapiPatient->queue->patient->tanggal_lhr);
        $today = new DateTime();
        $umur = $tgl_lahir->diff($today)->y;

        return view('pages.kemoterapiPersetujuan.edit', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'jks' => $jks,
            'umur' => $umur,
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = KemoterapiPersetujuan::find($id);
        $data = [
            'name' => $request->input('name'),
            'umur' => $request->input('umur'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'alamat' => $request->input('alamat'),
            'hubungan' => $request->input('hubungan'),
            'tanggal' => $request->input('date') . ' ' . $request->input('time'),
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
                $kemoterapiDetailPersetujuan = KemoterapiPersetujuanDetail::find($id_detail[$i]);
                if ($ttd[$i]) {
                    if ($ttd[$i] != $kemoterapiDetailPersetujuan->ttd) {
                        $ttd_save = base64_decode(str_replace('data:image/png;base64,', '', $ttd[$i]));
                        $file_name = $folder_path . uniqid() . '.png';
                        Storage::put('public/' . $file_name, $ttd_save);
                    } else {
                        $file_name = $kemoterapiDetailPersetujuan->ttd;
                    }
                } else {
                    $file_name = null;
                }
                $kemoterapiDetailPersetujuan->update([
                    'jenis' => $jenis[$i],
                    'isi' => $isi[$i],
                    'ttd' => $file_name,
                ]);
            }
        }

        // return redirect()->route('persetujuan/tindakan/bedah.detail', $item->rawat_inap_patient_id)->with('success', 'Berhasil Diupdate');
        return redirect()
            ->route('kemoterapi/patient.show', ['id' => $item->kemoterapiPatient->id, 'title' => 'Pasien Kemo'])
            ->with([
                'success' => 'Berhasil Diupdate',
                'btn' => 'persetujuan kemoterapi',
            ]);
    }

    public function destroy($id)
    {
        KemoterapiPersetujuan::destroy($id);
        KemoterapiPersetujuanDetail::where('kemoterapi_persetujuan_id', $id)->delete();
        return back()->with([
            'success' => 'Data Berhasil Dihapus',
            'btn' => 'persetujuan kemoterapi',
        ]);
    }
}
