<?php

namespace App\Http\Controllers;

use App\Models\KemoterapiPatient;
use App\Models\KemoterapiRingkasanMasukDanKeluarPatient;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\RawatInapPatient;
use Carbon\Carbon;
use DateTime;

class KemoterapiRingkasanMasukdanKeluarController extends Controller
{
    public function create($id)
    {
        $item = KemoterapiPatient::find($id);
        $tahun = Carbon::now()->year;
        $data = Patient::all();
        // $arrRoleDokter = [
        //     'Dokter Poli',
        //     'DPJP Radiologi',
        //     'DPJP Labor PK',
        //     'Dokter Ranap',
        //     'DPJP Labor PA',
        //     'Dokter Jaga',
        // ];
        return view('pages.kemoterapiRingkasanMasukdanKeluar.create', [
            "menu" => "Kemoterapi",
            "title" => "Pasien Kemo",
            'data' => $data,
            'item' => $item,
            'tahun' => $tahun,
            // 'arrRoleDokter' => $arrRoleDokter,
        ]);
        //
    }

    public function store(Request $request, $id)
    {

        $item = KemoterapiPatient::find($id);
        // request Suku Bangsa
        if ($request->suku_bangsa == 'Lainnya_suku') {
            $sukuBangsa = $request->sukubangsa_lainnya;
        } else {
            $sukuBangsa = $request->suku_bangsa;
        }

        //request pekerjaan
        if ($request->pekerjaan == 'lainnya_pekerjaan') {
            $pekerjaan = $request->pekerjaan_lainnya;
        } else {
            $pekerjaan = $request->pekerjaan;
        }

        // request Bahasa

        if ($request->bahasa == 'bahasa_lainnya') {
            $bahasa = $request->lainnya_bahasa;
        } else {
            $bahasa = $request->bahasa;
        }

        // kedatangan Pasien
        if ($request->kedatangan_pasien == 'Dirujuk Oleh') {
            $kedatangan = $request->kedatangan_rujukan;
        } else {
            $kedatangan = $request->kedatangan_pasien;
        }
        KemoterapiRingkasanMasukDanKeluarPatient::create([
            'kemoterapi_patient_id' => $item->id,
            'patient_id' => $request->patient_id,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jam_masuk' => $request->jam_masuk,
            'tanggal_keluar' => $request->tanggal_keluar,
            'jam_keluar' => $request->jam_keluar,
            'lama_dirawat'  => $request->lama_dirawat,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'tahun_kunjungan' => $request->tahun_kunjungan,
            'dirawat_ke' => $request->dirawat_ke,
            'ruang_rawat' => $request->ruang_rawat,
            'alamat_sesuai_ktp'  => $request->alamat_sesuai_ktp,
            'alamat_sesuai_domisili' => $request->alamat_sesuai_domisili,
            'no_telphone' => $request->nomor_telephone,
            'email' => $request->email,
            'suku_bangsa' => $sukuBangsa,
            'agama' => $request->agama,
            'pekerjaan' => $pekerjaan,
            'keyakinan' => $request->keyakinan,
            'nilai_nilai_pribadi' => $request->nilai_nilai_pribadi,
            'bahasa' => $bahasa,
            'kedatangan_pasien' => $kedatangan,
            'hambatan_bahasa' => $request->hambatan_bahasa,
            'kebutuhan_penerjemah' => $request->kebutuhan_penerjemah,
            'kebutuhan_disabilitas' => $request->kebutuhan_disabilitas,
            'jalur_masuk_rumahsakit' => $request->jalur_masuk_rs,
            'mutasi_bangsal_1' => $request->mutasi_bangsal_1,
            'mutasi_pindah_bangsal_1' => $request->mutasi_pindah_bangsal_1,
            'tanggal_bangsal_1' => $request->tanggal_bangsal_1,
            'mutasi_bangsal_2' => $request->mutasi_bangsal_2,
            'mutasi_pindah_bangsal_2' => $request->mutasi_pindah_bangsal_2,
            'tanggal_bangsal_2' => $request->tanggal_bangsal_2,
            'keadaan_keluar' => $request->keadaan_keluar,
            'cara_keluar' => $request->cara_keluar,
            'meninggal' => $request->meninggal,
            'diagnosa_utama' => $request->diagnosa_utama,
            'diagnosa_sekunder' => $request->diagnosa_sekunder,
            'komplikasi_dan_resiko' => $request->komplikasi_dan_resiko,
            'tindakan_operasi' => $request->tindakan_operasi,
            'riwayat_alergi' => $request->riwayat_alergi,
            'riwayat_transfusi' => $request->riwayat_transfusi,
            'tanggal_aps' => $request->tanggal_aps,
            'jam_aps' => $request->jam_aps,
            'tanggal_kontrol' => $request->tanggal_kontrol,
            'jam_kontrol' => $request->jam_kontrol
        ]);
        return redirect()->route('kemoterapi/patient.show', $item->id)->with(
            [
                'success' => 'Data Berhasil  Ditambahkan',
                'active' => 'ringkasanMasukdanKeluar',
            ]
        );
    }

    public function show($id)
    {
        $data = kemoterapiRingkasanMasukDanKeluarPatient::find($id);
        $masuk = new DateTime($data->tanggal_masuk);
        $keluar = new DateTime($data->tanggal_keluar);
        $total = $masuk->diff($keluar)->d;

        return view('pages.kemoterapiRingkasanMasukdanKeluar.show', [
            "menu" => "Kemoterapi",
            "title" => "Pasien Kemo",
            'data' => $data,
            'total' => $total,
        ]);
    }
    public function edit($id)
    {
        $data = KemoterapiRingkasanMasukDanKeluarPatient::find($id);
        return view('pages.kemoterapiRingkasanMasukdanKeluar.edit', [
            "menu" => "Kemoterapi",
            "title" => "Pasien Kemo",
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        // request Suku Bangsa
        if ($request->suku_bangsa == 'Lainnya_suku') {
            $sukuBangsa = $request->sukubangsa_lainnya;
        } else {
            $sukuBangsa = $request->suku_bangsa;
        }

        //request pekerjaan
        if ($request->pekerjaan == 'lainnya_pekerjaan') {
            $pekerjaan = $request->pekerjaan_lainnya;
        } else {
            $pekerjaan = $request->pekerjaan;
        }

        // request Bahasa

        if ($request->bahasa == 'bahasa_lainnya') {
            $bahasa = $request->lainnya_bahasa;
        } else {
            $bahasa = $request->bahasa;
        }

        // kedatangan Pasien
        if ($request->kedatangan_pasien == 'Dirujuk Oleh') {
            $kedatangan = $request->kedatangan_rujukan;
        } else {
            $kedatangan = $request->kedatangan_pasien;
        }
        KemoterapiRingkasanMasukDanKeluarPatient::where('id', $id)->update([
            'tanggal_masuk' => $request->tanggal_masuk,
            'jam_masuk' => $request->jam_masuk,
            'tanggal_keluar' => $request->tanggal_keluar,
            'jam_keluar' => $request->jam_keluar,
            'lama_dirawat'  => $request->lama_dirawat,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'tahun_kunjungan' => $request->tahun_kunjungan,
            'dirawat_ke' => $request->dirawat_ke,
            'ruang_rawat' => $request->ruang_rawat,
            'alamat_sesuai_ktp'  => $request->alamat_sesuai_ktp,
            'alamat_sesuai_domisili' => $request->alamat_sesuai_domisili,
            'no_telphone' => $request->nomor_telephone,
            'email' => $request->email,
            'suku_bangsa' => $sukuBangsa,
            'agama' => $request->agama,
            'pekerjaan' => $pekerjaan,
            'keyakinan' => $request->keyakinan,
            'nilai_nilai_pribadi' => $request->nilai_nilai_pribadi,
            'bahasa' => $bahasa,
            'kedatangan_pasien' => $kedatangan,
            'hambatan_bahasa' => $request->hambatan_bahasa,
            'kebutuhan_penerjemah' => $request->kebutuhan_penerjemah,
            'kebutuhan_disabilitas' => $request->kebutuhan_disabilitas,
            'jalur_masuk_rumahsakit' => $request->jalur_masuk_rs,
            'mutasi_bangsal_1' => $request->mutasi_bangsal_1,
            'mutasi_pindah_bangsal_1' => $request->mutasi_pindah_bangsal_1,
            'tanggal_bangsal_1' => $request->tanggal_bangsal_1,
            'mutasi_bangsal_2' => $request->mutasi_bangsal_2,
            'mutasi_pindah_bangsal_2' => $request->mutasi_pindah_bangsal_2,
            'tanggal_bangsal_2' => $request->tanggal_bangsal_2,
            'keadaan_keluar' => $request->keadaan_keluar,
            'cara_keluar' => $request->cara_keluar,
            'meninggal' => $request->meninggal,
            'diagnosa_utama' => $request->diagnosa_utama,
            'diagnosa_sekunder' => $request->diagnosa_sekunder,
            'komplikasi_dan_resiko' => $request->komplikasi_dan_resiko,
            'tindakan_operasi' => $request->tindakan_operasi,
            'riwayat_alergi' => $request->riwayat_alergi,
            'riwayat_transfusi' => $request->riwayat_transfusi,
            'tanggal_aps' => $request->tanggal_aps,
            'jam_aps' => $request->jam_aps,
            'tanggal_kontrol' => $request->tanggal_kontrol,
            'jam_kontrol' => $request->jam_kontrol
        ]);

        $item = KemoterapiRingkasanMasukDanKeluarPatient::find($id);

        return redirect()->route('kemoterapi/patient.show', $item->kemoterapi_patient_id)->with(
            [
                'success' => 'Data Berhasil  Diupdate',
                'active' => 'ringkasanMasukdanKeluar',
            ]
        );
    }

    public function destroy($id)
    {
        $item = KemoterapiRingkasanMasukDanKeluarPatient::find($id);
        $data = KemoterapiRingkasanMasukDanKeluarPatient::find($id);
        $data->delete();
        return redirect()->route('kemoterapi/patient.show', $item->kemoterapi_patient_id)->with(
            [
                'success' => 'Data Berhasil  Dihapus',
                'active' => 'ringkasanMasukdanKeluar',
            ]
        );
    }
}
