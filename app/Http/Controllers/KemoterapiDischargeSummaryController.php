<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\KemoterapiPatient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\KemoterapiDischargeSummary;
use App\Models\KemoterapiDetailObatDirawatPatient;
use App\Models\KemoterapiDetailObatDirumahPatient;
use App\Models\KemoterapiDetailKarmobiditasPatient;
use App\Models\KemoterapiDetailDiagnosaUtamaPatient;
use App\Models\KemoterapiDetailProsedurTerapiPatient;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KemoterapiDischargeSummaryController extends Controller
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
        $item = KemoterapiPatient::find($id);
        $medicines = Medicine::all();

        $arrKondisiPasien = [
            'Sembuh dan meneruskan dengan rawat jalan',
            'Rujuk',
            'Pulang atas permintaan sendiri (APS)',
            'Meninggal',
        ];
        $arrNextPlace = [
            'RSK Bedah Ropanasuri, Poliklinik:',
            'Puskesmas / Klinik Pratama',
            'Dokter Luar',
            'Rumah Sakit Lain',
        ];
        return view('pages.kemoterapiRingkasanCatatanMedis.index', [
            'title' => 'Kemoterapi',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'arrKondisiPasien' => $arrKondisiPasien,
            'arrNextPlace' => $arrNextPlace,
            'medicines' => $medicines,
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
        $item = KemoterapiPatient::find($id);
        $folder_path = 'assets/paraf-pasien/';
        Storage::makeDirectory('public/' . $folder_path);

        // paraf keluarga pasien
        $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd')));
        $file_name_ttd = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name_ttd, $ttd);
        $data['ttd'] = $file_name_ttd;
        //discharge Summary
        $data = [
            'kemoterapi_patient_id' => $item->id,
            'patient_id' => $item->queue->patient->id,
            'user_id' => Auth::user()->id,
            'tanggal_masuk' => $request->input('tanggal_masuk', ''),
            'tanggal_keluar' => $request->input('tanggal_keluar', ''),
            'anamnesis' => $request->input('anamnesis', ''),
            'indikasi' => $request->input('indikasi', ''),
            'riwayat_penyakit' => $request->input('riwayat_penyakit', ''),
            'pemeriksaan_fisik' => $request->input('pemeriksaan_fisik', ''),
            'pemeriksaan_diagnostik' => $request->input('pemeriksaan_diagnostik', ''),
            'kondisi_pasien' => $request->input('kondisi', ''),
            'intruksi' => $request->input('intruksi', ''),
            'tindak_lanjut' => $request->input('tindak_lanjut', ''),
            'dokter_pengirim' => $request->input('dokter_pengirim', ''),
            'ttd' => $file_name_ttd,
        ];

        $discharge = KemoterapiDischargeSummary::create($data);

        //detail diagnosa
        $diagnosaUtama = $request->input('diagnosa_utama');
        $IcdDiagnosaUtama = $request->input('icdD', []);

        //detail kormobiditas
        $karmobiditas = $request->input('karmobiditas');
        $icdKormobiditas = $request->input('icdK', []);

        //detail terapi
        $terapi = $request->input('terapi');
        $icdTerapi = $request->input('icdT', []);

        //obat selama di rs
        $obatRanap = $request->input('medicine_id_ranap', []);
        $jumlahRanap = $request->input('jumlah_ranap', []);
        $aturanPakaiRanap = $request->input('aturan_pakai_ranap', []);
        $keteranganRanap = $request->input('keterangan_ranap', []);
        $otherRanap = $request->input('other_ranap', []);

        //obat  untuk di rumah
        $obatRumah = $request->input('medicine_id', []);
        $jumlahRumah = $request->input('jumlah', []);
        $aturanPakaiRumah = $request->input('aturan_pakai', []);
        $keteranganRumah = $request->input('keterangan', []);
        $otherRumah = $request->input('other', []);

        $combinedICDDiagnosaUtama = '';
        $combinedICDKarmobiditas = '';
        $combinedICDProsedurTerapi = '';
        // foreach ($IcdDiagnosaUtama as $index => $icdD) {
        //     if ($icdD) {
        //         KemoterapiDetailDiagnosaUtamaPatient::create([
        //             'kemoterapi_discharge_summary_id' => $discharge->id,
        //             'diagnosa_utama' => $diagnosaUtama,
        //             'icd' => $icdD,
        //         ]);
        //     }
        // }

        foreach ($IcdDiagnosaUtama as $index => $icdD) {
            if ($icdD) {
                // Menggabungkan ICD untuk Diagnosa Utama menjadi satu string
                $combinedICDDiagnosaUtama .= $icdD . ' ';
            }
        }

        foreach ($icdKormobiditas as $index => $icdK) {
            if ($icdK) {
                // Menggabungkan ICD untuk Kormobiditas menjadi satu string
                $combinedICDKarmobiditas .= $icdK . ' ';
            }
        }

        foreach ($icdTerapi as $index => $icdT) {
            if ($icdT) {
                // Menggabungkan ICD untuk Prosedur Terapi menjadi satu string
                $combinedICDProsedurTerapi .= $icdT . ' ';
            }
        }

        // Simpan data ke dalam database
        KemoterapiDetailDiagnosaUtamaPatient::create([
            'kemoterapi_discharge_summary_id' => $discharge->id,
            'diagnosa_utama' => $diagnosaUtama,
            'icd' => trim($combinedICDDiagnosaUtama), // Menghapus spasi ekstra dari akhir string
        ]);

        KemoterapiDetailKarmobiditasPatient::create([
            'kemoterapi_discharge_summary_id' => $discharge->id,
            'karmobiditas' => $karmobiditas,
            'icd' => trim($combinedICDKarmobiditas), // Menghapus spasi ekstra dari akhir string
        ]);

        KemoterapiDetailProsedurTerapiPatient::create([
            'kemoterapi_discharge_summary_id' => $discharge->id,
            'terapi' => $terapi,
            'icd' => trim($combinedICDProsedurTerapi), // Menghapus spasi ekstra dari akhir string
        ]);
        foreach ($obatRanap as $index => $medicine_id) {
            KemoterapiDetailObatDirawatPatient::create([
                'kemoterapi_discharge_summary_id' => $discharge->id,
                'medicine_id' => $medicine_id,
                'jumlah' => $jumlahRanap[$index],
                'aturan_pakai' => $aturanPakaiRanap[$index],
                'keterangan' => $keteranganRanap[$index],
                'other' => $otherRanap[$index],
            ]);
        }
        foreach ($obatRumah as $index => $medicine_id) {
            KemoterapiDetailObatDirumahPatient::create([
                'kemoterapi_discharge_summary_id' => $discharge->id,
                'medicine_id' => $medicine_id,
                'jumlah' => $jumlahRumah[$index],
                'aturan_pakai' => $aturanPakaiRumah[$index],
                'keterangan' => $keteranganRumah[$index],
                'other' => $otherRumah[$index],
            ]);
        }

        return redirect()->route('kemoterapi/patient.show', $item->id)->with('success', 'Berhasil Ditambahkan');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = KemoterapiDischargeSummary::find($id);
        $discharge = KemoterapiDischargeSummary::where('kemoterapi_patient_id', $id)->first();
        $medicines = Medicine::all();
        // Ambil data lama diagnosa utama berdasarkan ID discharge

        $diagnosaUtama = KemoterapiDetailDiagnosaUtamaPatient::where('kemoterapi_discharge_summary_id', $discharge->id)->first();
        $karmobiditas = KemoterapiDetailKarmobiditasPatient::where('kemoterapi_discharge_summary_id', $discharge->id)->first();
        $terapi = KemoterapiDetailProsedurTerapiPatient::where('kemoterapi_discharge_summary_id', $discharge->id)->first();
       
        $diagnosaUtamaLama = KemoterapiDetailDiagnosaUtamaPatient::where('kemoterapi_discharge_summary_id', $id)->pluck('diagnosa_utama')->toArray();

        // Ambil data lama kormobiditas berdasarkan ID discharge
        $karmobiditasLama = KemoterapiDetailKarmobiditasPatient::where('kemoterapi_discharge_summary_id', $id)->pluck('karmobiditas')->toArray();

        // Ambil data lama terapi berdasarkan ID discharge
        $terapiLama = KemoterapiDetailProsedurTerapiPatient::where('kemoterapi_discharge_summary_id', $id)->pluck('terapi')->toArray();

        // Ambil data lama obat selama di rumah sakit berdasarkan ID discharge
        $obatRanapLama = KemoterapiDetailObatDirawatPatient::where('kemoterapi_discharge_summary_id', $id)->get();

        // Ambil data lama obat untuk di rumah berdasarkan ID discharge
        $obatRumahLama = KemoterapiDetailObatDirumahPatient::where('kemoterapi_discharge_summary_id', $id)->get();

        $arrKondisiPasien = [
            'Sembuh dan meneruskan dengan rawat jalan',
            'Rujuk',
            'Pulang atas permintaan sendiri (APS)',
            'Meninggal',
        ];
        $arrNextPlace = [
            'RSK Bedah Ropanasuri, Poliklinik:',
            'Puskesmas / Klinik Pratama',
            'Dokter Luar',
            'Rumah Sakit Lain',
        ];
        return view('pages.kemoterapiRingkasanCatatanMedis.edit', [
            'title' => 'Kemoterapi',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'arrKondisiPasien' => $arrKondisiPasien,
            'arrNextPlace' => $arrNextPlace,
            'medicines' => $medicines,
            'discharge' => $discharge,
            'diagnosaUtamaLama' => $diagnosaUtamaLama,
            'diagnosaUtama' => $diagnosaUtama,
            'karmobiditasLama' => $karmobiditasLama,
            'karmobiditas' => $karmobiditas,
            'terapiLama' => $terapiLama,
            'terapi' => $terapi,
            'obatRanapLama' => $obatRanapLama,
            'obatRumahLama' => $obatRumahLama,
        ]);
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
        // Ambil data yang akan diedit
        $discharge = KemoterapiDischargeSummary::findOrFail($id);
    
        // Bandingkan data yang diberikan dengan data yang tersimpan
        $data = $request->only([
            'tanggal_masuk',
            'tanggal_keluar',
            'anamnesis',
            'indikasi',
            'riwayat_penyakit',
            'pemeriksaan_fisik',
            'pemeriksaan_diagnostik',
            'kondisi',
            'intruksi',
            'tindak_lanjut',
            'dokter_pengirim',
            'ttd',
        ]);
        $diagnosaUtama = $request->input('diagnosa_utama');
        $IcdDiagnosaUtama = $request->input('icdD', []);

        //detail kormobiditas
        $karmobiditas = $request->input('karmobiditas');
        $icdKormobiditas = $request->input('icdK', []);

        //detail terapi
        $terapi = $request->input('terapi');
        $icdTerapi = $request->input('icdT', []);

        //obat selama di rs
        $obatRanap = $request->input('medicine_id_ranap', []);
        $jumlahRanap = $request->input('jumlah_ranap', []);
        $aturanPakaiRanap = $request->input('aturan_pakai_ranap', []);
        $keteranganRanap = $request->input('keterangan_ranap', []);
        $otherRanap = $request->input('other_ranap', []);

        //obat  untuk di rumah
        $obatRumah = $request->input('medicine_id', []);
        $jumlahRumah = $request->input('jumlah', []);
        $aturanPakaiRumah = $request->input('aturan_pakai', []);
        $keteranganRumah = $request->input('keterangan', []);
        $otherRumah = $request->input('other', []);

        $combinedICDDiagnosaUtama = '';
        $combinedICDKarmobiditas = '';
        $combinedICDProsedurTerapi = '';
       
        foreach ($IcdDiagnosaUtama as $index => $icdD) {
            if ($icdD) {
                // Menggabungkan ICD untuk Diagnosa Utama menjadi satu string
                $combinedICDDiagnosaUtama .= $icdD . ' ';
            }
        }

        foreach ($icdKormobiditas as $index => $icdK) {
            if ($icdK) {
                // Menggabungkan ICD untuk Kormobiditas menjadi satu string
                $combinedICDKarmobiditas .= $icdK . ' ';
            }
        }

        foreach ($icdTerapi as $index => $icdT) {
            if ($icdT) {
                // Menggabungkan ICD untuk Prosedur Terapi menjadi satu string
                $combinedICDProsedurTerapi .= $icdT . ' ';
            }
        }

        $diagnosaUtama = KemoterapiDetailDiagnosaUtamaPatient::where('kemoterapi_discharge_summary_id', $discharge->id)->first();
        $diagnosaUtama->diagnosa_utama = $request->input('diagnosa_utama');
        $diagnosaUtama->icd = $combinedICDDiagnosaUtama;

        $diagnosaUtama->save();

        $karmobiditas = KemoterapiDetailKarmobiditasPatient::where('kemoterapi_discharge_summary_id', $discharge->id)->first();
        $karmobiditas->karmobiditas = $request->input('karmobiditas');
        $karmobiditas->icd = $combinedICDKarmobiditas;
        $karmobiditas->save();

        $terapi = KemoterapiDetailProsedurTerapiPatient::where('kemoterapi_discharge_summary_id', $discharge->id)->first();
        $terapi->terapi = $request->input('terapi');
        $terapi->icd = $combinedICDProsedurTerapi;
        $terapi->save();

        foreach ($obatRanap as $index => $medicine_id) {
            $detailObatDirawat = KemoterapiDetailObatDirawatPatient::where('kemoterapi_discharge_summary_id', $discharge->id)
                ->where('medicine_id', $medicine_id)
                ->first();
        
            if ($detailObatDirawat) {
                $detailObatDirawat->update([
                    'jumlah' => $jumlahRanap[$index],
                    'aturan_pakai' => $aturanPakaiRanap[$index],
                    'keterangan' => $keteranganRanap[$index],
                    'other' => $otherRanap[$index],
                ]);
            } else {
                KemoterapiDetailObatDirawatPatient::create([
                    'kemoterapi_discharge_summary_id' => $discharge->id,
                    'medicine_id' => $medicine_id,
                    'jumlah' => $jumlahRanap[$index],
                    'aturan_pakai' => $aturanPakaiRanap[$index],
                    'keterangan' => $keteranganRanap[$index],
                    'other' => $otherRanap[$index],
                ]);
            }
        }
        
        foreach ($obatRumah as $index => $medicine_id) {
            $detailObatDirumah = KemoterapiDetailObatDirumahPatient::where('kemoterapi_discharge_summary_id', $discharge->id)
                ->where('medicine_id', $medicine_id)
                ->first();
        
            if ($detailObatDirumah) {
                $detailObatDirumah->update([
                    'jumlah' => $jumlahRumah[$index],
                    'aturan_pakai' => $aturanPakaiRumah[$index],
                    'keterangan' => $keteranganRumah[$index],
                    'other' => $otherRumah[$index],
                ]);
            } else {
                KemoterapiDetailObatDirumahPatient::create([
                    'kemoterapi_discharge_summary_id' => $discharge->id,
                    'medicine_id' => $medicine_id,
                    'jumlah' => $jumlahRumah[$index],
                    'aturan_pakai' => $aturanPakaiRumah[$index],
                    'keterangan' => $keteranganRumah[$index],
                    'other' => $otherRumah[$index],
                ]);
            }
        }
        


        // Update hanya data yang berubah
        $discharge->update($data);
    
        // Redirect kembali ke halaman detail dengan pesan sukses
        return redirect()->route('kemoterapi/patient.show', $discharge->kemoterapi_patient_id)->with('success', 'Data berhasil diperbarui');
    }
    
    



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = KemoterapiPatient::find($id);
        try {
            // Temukan entitas KemoterapiDischargeSummary berdasarkan ID
            $dischargeSummary = KemoterapiDischargeSummary::findOrFail($id);
            // $dischargeSummary->KemoterapiDetailKarmobiditasPatient()->delete();
            // Lakukan penghapusan
            $dischargeSummary->delete();

            // Redirect kembali dengan pesan sukses
            return redirect()->route('kemoterapi/patient.show', $item->id)->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, tangani di sini
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
