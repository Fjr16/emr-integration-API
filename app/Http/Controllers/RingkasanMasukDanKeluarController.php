<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Queue;
use App\Models\RawatInapPatient;
use App\Models\RingkasanMasukDanKeluarPatient;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RingkasanMasukDanKeluarController extends Controller
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
        return view('pages.ringkasanMasukDanKeluar.index', [
            "title" => "Ringkasan Masuk Dan Keluar",
            "menu" => "Rawat Inap",
            'data' => $data,
        ]);
    }

    public function detail($id)
    {
        $item = RawatInapPatient::find($id);
        $data = RingkasanMasukDanKeluarPatient::where('rawat_inap_patient_id', $id)->get();

        return view('pages.ringkasanMasukDanKeluar.detail', [
            "item" => $item,
            "title" => "Ringkasan Masuk Dan Keluar",
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
        $tahun = Carbon::now()->year;
        $data = Patient::all();
        $arrRoleDokter = [
            'Dokter Poli',
            'DPJP Radiologi',
            'DPJP Labor PK',
            'Dokter Ranap',
            'DPJP Labor PA',
            'Dokter Jaga',
        ];
        return view('pages.ringkasanMasukdanKeluar.create', [
            "title" => "Ringkasan Masuk Dan Keluar",
            "menu" => "Rawat Inap",
            'data' => $data,
            'item' => $item,
            'tahun' => $tahun,
            'arrRoleDokter' => $arrRoleDokter,
        ]);
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

        $item = RawatInapPatient::find($id);
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
        RingkasanMasukDanKeluarPatient::create([
            'rawat_inap_patient_id' => $item->id,
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
        return redirect()->route('ringkasan-masuk-keluar.detail', $item->id)->with('success', 'Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = RingkasanMasukDanKeluarPatient::find($id);
        $masuk = new DateTime($data->tanggal_masuk);
        $keluar = new DateTime($data->tanggal_keluar);
        $total = $masuk->diff($keluar)->d;

        return view('pages.ringkasanMasukdanKeluar.show', [
            "title" => "Ringkasan Masuk Dan Keluar",
            "menu" => "Rawat Inap",
            'data' => $data,
            'total' => $total,
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
        $data = RingkasanMasukDanKeluarPatient::find($id);
        return view('pages.ringkasanMasukdanKeluar.edit', [
            "title" => "Ringkasan Masuk Dan Keluar",
            "menu" => "Rawat Inap",
            'data' => $data,
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
        RingkasanMasukDanKeluarPatient::where('id', $id)->update([
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

        $item = RingkasanMasukDanKeluarPatient::find($id);

        return redirect()->route('ringkasan-masuk-keluar.detail', $item->rawat_inap_patient_id)->with('success', 'Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = RingkasanMasukDanKeluarPatient::find($id);
        $data = RingkasanMasukDanKeluarPatient::find($id);
        $data->delete();
        return redirect()->route('ringkasan-masuk-keluar.detail', $item->rawat_inap_patient_id)->with('success', 'Berhasil Menghapus Data');
    }

    public function ttd(Request $request)
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
