<?php

namespace App\Http\Controllers;

use App\Models\DaftarTilikVerifikasiPraOperasiPatient;
use App\Models\DetailDaftarTilikVerifikasiPraOperasiPatient;
use App\Models\DetailPetugasTilikVerifikasiPraOperasiPatient;
use App\Models\Patient;
use App\Models\RawatInapPatient;
use App\Models\RoomDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;

class DaftarTilikVerifikasiPasienPraOperasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DaftarTilikVerifikasiPraOperasiPatient::all();
        return view('pages.daftarTilik.index', [
            'title' => "Daftar Tilik Verifikasi Pasien Pra Operasi",
            'menu' => 'daftarTilik',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $rooms = RoomDetail::where('room_id', 2)->get();
        $item = RawatInapPatient::find($id);
        $data = Patient::all();
        return view('pages.daftarTilik.create   ', [
            'title' => "Daftar Tilik Verifikasi Pasien Pra Operasi",
            'menu' => 'daftarTilik',
            'data' => $data,
            'rooms' => $rooms,
            'item' => $item,
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
        $data = DaftarTilikVerifikasiPraOperasiPatient::create([
            'rawat_inap_patient_id' => $item->id,
            'patient_id' => $request->patient_id,
            'jam_tiba' => $request->jam_tiba,
            'ruang_rawat' => $request->ruang_rawat,
            'tanggal_operasi' => $request->tgl_operasi,
            'jam_keluar' => $request->jam_keluar,
            'tindakan_operasi' => $request->tindakan,
            'lokasi_sisi_operasi_tindakan' => $request->sisi_operasi,
        ]);


        $kategoriOperasi = [
            'PRE OPERASI',
            'PASCA OPERASI'
        ];

        $preOperasi = [
            'status Pasien (IGD/Poliklinik & Rawar inap)',
            'Informed Consent (Tindakan Bedah & tindakan Anestesi) Telah di tandangi',
            'Gelang Identitas Terpasang',
            'Asesment Prasedasi',
            'Konsul Kardiologi (Jantung)',
            'Konsul Penyakit Dalam (> 40 tahun)',
            'Konsul Anestesi',
            'Konsul Lainnya...',
            'Persiapan darah & darah Tersedia',
            'Hasil laboratorium Terlampir',
            'Hasil Radiologi - USG,RONTGEN, CT-Scan, MRI (terlampir)',
            'Penandaan (Site Marking)',
            'Area Operasi Dicukur',
            'Infus Terpasang',
            'Kateter terpasang',
            'Alat Khusus /Implan Tersedia',
            'Puasa',
            'Huknah',
            'Kebersihan Pasien (mandi dengan Antiseptik, cuci rambut, sikat gigi)',
            'Perhiasan, Gigi Palsu, Kacamata, kontak lensa, hearing aid, wig telah dilepas  & disimpan',
            'Tatarias & cat kuku dihapus',
            'ruangan ICU tersedia'
        ];
        $pascaOperasi = [
            'GCS (kesadaran) Nilai....',
            'Status Rekam medis dioverkan',
            'Hasil Radiologi - USG,RONTGEN, CT-Scan, MRI (terlampir)',
            'laporan operasi terisi',
            'laporan anestesi terisi',
            'resep pasien tersedia',
            'formulit pemeriksaan patologi tersedia',
            'hasil spesimen (Kultur,PA) tersedia',
            'Tranfusi darah'
        ];
        $statusPetugas = [
            'Pengantar',
            'Penerima',
        ];
        foreach ($kategoriOperasi as $kategori) {
            if ($kategori == 'PRE OPERASI') {
                foreach ($preOperasi as $pre) {
                    DetailDaftarTilikVerifikasiPraOperasiPatient::create([
                        'daftar_tilik_verifikasi_pra_operasi_patient_id' => $data->id,
                        'name' => $pre,
                        'category' => $kategori,
                        'ri' => 'check',
                    ]);
                }
                foreach ($statusPetugas as $status) {
                    DetailPetugasTilikVerifikasiPraOperasiPatient::create([
                        'daftar_tilik_verifikasi_pra_operasi_patient_id' => $data->id,
                        'user_id' => 1,
                        'category' => $kategori,
                        'status' => $status,
                    ]);
                }
            } else {
                foreach ($pascaOperasi as $pasca) {
                    DetailDaftarTilikVerifikasiPraOperasiPatient::create([
                        'daftar_tilik_verifikasi_pra_operasi_patient_id' => $data->id,
                        'name' => $pasca,
                        'category' => $kategori,
                        'ok' => 'check',
                    ]);
                }
                foreach ($statusPetugas as $status) {
                    DetailPetugasTilikVerifikasiPraOperasiPatient::create([
                        'daftar_tilik_verifikasi_pra_operasi_patient_id' => $data->id,
                        'user_id' => 1,
                        'category' => $kategori,
                        'status' => $status,
                    ]);
                }
            }
        }
        return redirect()->route('daftar-tilik.edit', [
            'id' => $data->id,
        ])->with('success', 'Data Berhasil Disimpan');
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
        $rooms = RoomDetail::where('room_id', 2)->get();
        $data = DaftarTilikVerifikasiPraOperasiPatient::find($id);
        $data2 = DetailDaftarTilikVerifikasiPraOperasiPatient::where('category', 'PRE OPERASI')->where('daftar_tilik_verifikasi_pra_operasi_patient_id', $data->id)->get();
        $data3 = DetailDaftarTilikVerifikasiPraOperasiPatient::where('category', 'PASCA OPERASI')->where('daftar_tilik_verifikasi_pra_operasi_patient_id', $data->id)->get();
        return view('pages.daftarTilik.edit   ', [
            'title' => "Daftar Tilik Verifikasi Pasien Pra Operasi",
            'menu' => 'daftarTilik',
            'rooms' => $rooms,
            'data' => $data,
            'data2' => $data2,
            'data3' => $data3,
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
        $data = DaftarTilikVerifikasiPraOperasiPatient::where('id', $id)->update([
            'jam_tiba' => $request->jam_tiba,
            'ruang_rawat' => $request->ruang_rawat,
            'tanggal_operasi' => $request->tgl_operasi,
            'jam_keluar' => $request->jam_keluar,
            'tindakan_operasi' => $request->tindakan,
            'lokasi_sisi_operasi_tindakan' => $request->sisi_operasi,
        ]);

        $statusPetugas = [
            'Penerima',
            'Pengantar',
        ];

        // dd($request->pasca_operasi);
        if ($request->pre_operasi) {
            $preOperasi = $request->pre_operasi;
            foreach ($preOperasi as $pre => $operasi) {
                $riValuePre = isset($operasi['ri']) && $operasi['ri'] === 'check' ? 'check' : null;
                $okValuePre = isset($operasi['ok']) && $operasi['ok'] === 'check' ? 'check' : null;
                DetailDaftarTilikVerifikasiPraOperasiPatient::where('daftar_tilik_verifikasi_pra_operasi_patient_id', $id)
                    ->where('name', $pre)
                    ->where('category', 'PRE OPERASI')
                    ->update([
                        'ri' => $riValuePre,
                        'ok' => $okValuePre,
                    ]);
            }
            foreach ($statusPetugas as $petugas) {
                DetailPetugasTilikVerifikasiPraOperasiPatient::where('daftar_tilik_verifikasi_pra_operasi_patient_id', $id)
                    ->where('status', $petugas)
                    ->where('category', 'PRE OPERASI')
                    ->update([
                        'user_id' => Auth::user()->id,
                    ]);
            }
        }
        if ($request->pasca_operasi) {
            $pascaOperasi = $request->pasca_operasi;
            foreach ($pascaOperasi as $pasca => $operasi) {
                $riValuePasca = isset($operasi['ri']) && $operasi['ri'] === 'check' ? 'check' : null;
                $okValuePasca = isset($operasi['ok']) && $operasi['ok'] === 'check' ? 'check' : null;
                $pacuValuePasca = isset($operasi['pacu']) && $operasi['pacu'] === 'check' ? 'check' : null;
                DetailDaftarTilikVerifikasiPraOperasiPatient::where('daftar_tilik_verifikasi_pra_operasi_patient_id', $id)
                    ->where('name', $pasca)
                    ->where('category', 'PASCA OPERASI')
                    ->update([
                        'ri' => $riValuePasca,
                        'ok' => $okValuePasca,
                        'pacu' => $pacuValuePasca,
                    ]);
            }

            foreach ($statusPetugas as $petugas) {
                DetailPetugasTilikVerifikasiPraOperasiPatient::where('daftar_tilik_verifikasi_pra_operasi_patient_id', $id)
                    ->where('status', $petugas)
                    ->where('category', 'PASCA OPERASI')
                    ->update([
                        'user_id' => Auth::user()->id,
                    ]);
            }
        }


        return back()->with('success', 'Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DaftarTilikVerifikasiPraOperasiPatient::find($id);
        $data->delete();
        return redirect()->route('daftar-tilik.index');
    }
}
