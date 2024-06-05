<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Queue;
use Illuminate\Http\Request;
use App\Models\RawatInapPatient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\RanapDischargePlanningPerawatPatient;
use App\Models\RanapChildDetailDischargePlanningSurgery;
use App\Models\RanapDetailDischargePlanningPerawatPatient;
use App\Models\RanapGrandChildDetailDischargePlanningSurgery;

class RanapCheklistRencanaPulangPageOneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient', function ($query) {
            $query->whereNot('status', 'WAITING')->whereNot('status', 'BATAL');
        })->get();
        return view('pages.dischargePlanningPerawat.index', [
            "title" => "Discharge Planning Perawat",
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
        $arrAktivitas = [
            'Jenis aktifitas yang boleh dilakukan',
            'Alat bantu yang bisa digunakan',
            'Latihan melakukan aktifitas dan menggunakan alat bantu',
            'Informasi lain yang diperlukan untuk aktifitas',
            'Hygiene (mandi, bab, bak, dll)',
            'Cara perawatan luka',
            'Cara perawatan NGT, Kateter, Colostomi, dll',
            'Cara pencegahan dan kontrol adanya infeksi',
            'Pengobatan yang dapat dilakukan di rumah',
            'sebelum ke rumah sakit',
        ];
        $arrFasilitas = [
            'Petugas kesehatan dilingkungan sekitar tempat tinggal pasien',
            'Puskesmas, klinik, praktek dokter dilingkungan sekitar tempat tinggal pasien',
            'Rumah sakit yang mudah diakses',
        ];
        $arrRincian = [
            'Tanggal Kontrol',
            'Keadaan umum saat pemulangan',
            'Format ringkasan pulang/ resume medis yang sudah terisi',
            'Pengambilan Hasil Penunjang (Hasil Penunjang Jaringan)',
        ];
        $arrPendamping = [
            'Keluarga',
            'Perawat',
            'Dokter',
        ];
        $arrTrans = [
            'Mobil Pribadi',
            'Ambulance',
        ];
        $arrKelAdm = [
            'SKD',
            'Laboratorium',
            'ECG',
            'SKI',
            'Rontgen',
            'CT Scan',
        ];
        $item = RawatInapPatient::find($id);
        return view('pages.dischargePlanningPerawat.create', [
            "title" => "Discharge Planning Perawat",
            "menu" => "Rawat Inap",
            'item' => $item,
            'arrAktivitas' => $arrAktivitas,
            'arrFasilitas' => $arrFasilitas,
            'arrRincian' => $arrRincian,
            'arrPendamping' => $arrPendamping,
            'arrTrans' => $arrTrans,
            'arrKelAdm' => $arrKelAdm,
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
        // dd($request->all());
        $item = RawatInapPatient::find($id);

        // paraf pasien / wali
        $folder_path = 'assets/paraf-pasien/';
        Storage::makeDirectory('public/' . $folder_path);

        $ttdImg = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd_pasien')));
        $file_name = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name, $ttdImg);

        $mainTb = RanapDischargePlanningPerawatPatient::create([
            'rawat_inap_patient_id' => $item->id,
            'patient_id' => $item->queue->patient->id,
            'user_id' => Auth::user()->id,
            'ttd_petugas' => $request->ttd_petugas ?? '',
            'petugas_name' => $request->petugas_name ?? '',
            'ttd_pasien' => $file_name ?? '',
            'pasien_name' => $request->pasien_name ?? '',
            'tanggal' => $request->tanggal ?? date('Y-m-d H:i:s'),
        ]);

        //KEGIATAN
        //aktfitas
        $kegiatanAktifitas = $request->input('kegiatan_aktifitas');
        $aktifitas = RanapDetailDischargePlanningPerawatPatient::create([
            'ranap_discharge_planning_perawat_patient_id' => $mainTb->id,
            'kegiatan' => $kegiatanAktifitas,
            //'catatan' => $catatanAktifitas,
        ]);

        $kegiatanFasilitas = $request->input('kegiatan_fasilitas');
        // $catatanFasilitas = $request->input('catatan_fasilitas');
        $fasilitas = RanapDetailDischargePlanningPerawatPatient::create([
            'ranap_discharge_planning_perawat_patient_id' => $mainTb->id,
            'kegiatan' => $kegiatanFasilitas,
            //'catatan' => $catatanFasilitas,
        ]);

        $kegiatanRincian = $request->input('kegiatan_rincian');
        $additionalCatatan = $request->input('catatan_rincian', []);
        $catatanRincian = implode("#*", $additionalCatatan);
        $rincian = RanapDetailDischargePlanningPerawatPatient::create([
            'ranap_discharge_planning_perawat_patient_id' => $mainTb->id,
            'kegiatan' => $kegiatanRincian,
            'catatan' => $catatanRincian,
        ]);

        //detailAktfitas
        $detailAktifitas = $request->input('aktivitas', []);
        $catatanAktifitas = $request->input('catatan_aktifitas', []);
        foreach ($detailAktifitas as $key => $akt) {
            RanapChildDetailDischargePlanningSurgery::create([
                'ranap_detail_discharge_planning_perawat_patient_id' => $aktifitas->id,
                'name' => $akt,
                'value' => $catatanAktifitas[$key],
            ]);
        }

        $detailFasilitas = $request->input('fasilitas', []);
        $detailCatatanFasilitas = $request->input('catatan_fasilitas', []);
        foreach ($detailFasilitas as $key =>  $fas) {
            RanapChildDetailDischargePlanningSurgery::create([
                'ranap_detail_discharge_planning_perawat_patient_id' => $fasilitas->id,
                'name' => $fas,
                'value' => $detailCatatanFasilitas[$key],
            ]);
        }

        $detailRincian = $request->input('rincian', []);
        $detailCatatanRincian = $request->input('catatan_rincian', []);
        foreach ($detailRincian as $key => $rin) {
            RanapChildDetailDischargePlanningSurgery::create([
                'ranap_detail_discharge_planning_perawat_patient_id' => $rincian->id,
                'name' => $rin,
                'value' => $detailCatatanRincian[$key],
            ]);
        }

        //child and grandChild
        $pendampingValue = $request->input('pendamping');
        $pendaName = $request->input('pendamping_name');
        if ($pendampingValue) {
            $pendamping = RanapChildDetailDischargePlanningSurgery::create([
                'ranap_detail_discharge_planning_perawat_patient_id' => $rincian->id,
                'name' => $pendaName,
                'value' => $pendampingValue,
            ]);

            RanapGrandChildDetailDischargePlanningSurgery::create([
                'ranap_child_detail_discharge_planning_surgery_id' => $pendamping->id,
                'name' => $pendampingValue,
            ]);
        }

        $transportasiValue = $request->input('transportasi');
        $transName = $request->input('transportasi_name');
        if ($transportasiValue) {
            $transportasi = RanapChildDetailDischargePlanningSurgery::create([
                'ranap_detail_discharge_planning_perawat_patient_id' => $rincian->id,
                'name' => $transName,
                'value' => $transportasiValue,
            ]);

            RanapGrandChildDetailDischargePlanningSurgery::create([
                'ranap_child_detail_discharge_planning_surgery_id' => $transportasi->id,
                'name' => $transportasiValue,
            ]);
        }

        $admValue = $request->input('adm', []);
        $admName = $request->input('adm_name');
        if (!empty($admValue)) {
            $adm = RanapChildDetailDischargePlanningSurgery::create([
                'ranap_detail_discharge_planning_perawat_patient_id' => $rincian->id,
                'name' => $admName,
                // 'value' => ,
            ]);
            foreach ($admValue as $val) {
                RanapGrandChildDetailDischargePlanningSurgery::create([
                    'ranap_child_detail_discharge_planning_surgery_id' => $adm->id,
                    'name' => $val,
                ]);
            }
        }

        return redirect()->route('checklist/rencana/pulang/page/one.index')->with('success', 'Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = RawatInapPatient::find($id);
        return view('pages.dischargePlanningPerawat.show', [
            "title" => "Discharge Planning Perawat",
            "menu" => "Rawat Inap",
            "item" => $item,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $item = RanapDischargePlanningPerawatPatient::find($id);
        $tgl = new DateTime($item->tanggal);

        $pendampingId = '';
        $transportasiId = '';
        $kelAdmId = '';
        foreach ($item->ranapDetailDischargePlanningPerawatPatients as $detail) {
            $arrDetail[] = $detail->ranapChildDetailDischargePlanningSurgeries->pluck('name')->toArray();
            foreach ($detail->ranapChildDetailDischargePlanningSurgeries as $childDetail) {
                if ($childDetail->name == 'Pendamping:') {
                    $pendampingId = $childDetail->id;
                } else if ($childDetail->name == 'Transportasi Yang Digunakan:') {
                    $transportasiId = $childDetail->id;
                } else if ($childDetail->name == 'Kelengkapan Administrasi') {
                    $kelAdmId = $childDetail->id;
                }
            }
        }
        $grandChildPendamping = RanapGrandChildDetailDischargePlanningSurgery::where('ranap_child_detail_discharge_planning_surgery_id', $pendampingId)->pluck('name')->first();
        $grandChildTransportasi = RanapGrandChildDetailDischargePlanningSurgery::where('ranap_child_detail_discharge_planning_surgery_id', $transportasiId)->pluck('name')->first();
        $grandChildKelAdmArr = RanapGrandChildDetailDischargePlanningSurgery::where('ranap_child_detail_discharge_planning_surgery_id', $kelAdmId)->pluck('name')->toArray();

        return view('pages.dischargePlanningPerawat.print', [
            "title" => "Discharge Planning Perawat",
            "menu" => "Rawat Inap",
            "item" => $item,
            "arrDetail" => $arrDetail,
            "tgl" => $tgl,
            "grandChildPendamping" => $grandChildPendamping,
            "grandChildTransportasi" => $grandChildTransportasi,
            "grandChildKelAdmArr" => $grandChildKelAdmArr,
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
        $arrAktivitas = [
            'Jenis aktifitas yang boleh dilakukan',
            'Alat bantu yang bisa digunakan',
            'Latihan melakukan aktifitas dan menggunakan alat bantu',
            'Informasi lain yang diperlukan untuk aktifitas',
            'Hygiene (mandi, bab, bak, dll)',
            'Cara perawatan luka',
            'Cara perawatan NGT, Kateter, Colostomi, dll',
            'Cara pencegahan dan kontrol adanya infeksi',
            'Pengobatan yang dapat dilakukan di rumah',
            'sebelum ke rumah sakit',
        ];
        $arrFasilitas = [
            'Petugas kesehatan dilingkungan sekitar tempat tinggal pasien',
            'Puskesmas, klinik, praktek dokter dilingkungan sekitar tempat tinggal pasien',
            'Rumah sakit yang mudah diakses',
        ];
        $arrRincian = [
            'Tanggal Kontrol',
            'Keadaan umum saat pemulangan',
            'Format ringkasan pulang/ resume medis yang sudah terisi',
            'Pengambilan Hasil Penunjang (Hasil Penunjang Jaringan)',
        ];
        $arrPendamping = [
            'Keluarga',
            'Perawat',
            'Dokter',
        ];
        $arrTrans = [
            'Mobil Pribadi',
            'Ambulance',
        ];
        $arrKelAdm = [
            'SKD',
            'Laboratorium',
            'ECG',
            'SKI',
            'Rontgen',
            'CT Scan',
        ];


        $item = RanapDischargePlanningPerawatPatient::find($id);
        $tgl = new DateTime($item->tanggal);

        $pendampingId = '';
        $transportasiId = '';
        $kelAdmId = '';
        foreach ($item->ranapDetailDischargePlanningPerawatPatients as $detail) {
            $arrDetail[] = $detail->ranapChildDetailDischargePlanningSurgeries->pluck('name')->toArray();
            foreach ($detail->ranapChildDetailDischargePlanningSurgeries as $childDetail) {
                if ($childDetail->name == 'Pendamping:') {
                    $pendampingId = $childDetail->id;
                } else if ($childDetail->name == 'Transportasi Yang Digunakan:') {
                    $transportasiId = $childDetail->id;
                } else if ($childDetail->name == 'Kelengkapan Administrasi') {
                    $kelAdmId = $childDetail->id;
                }
            }
        }


        $grandChildPendamping = RanapGrandChildDetailDischargePlanningSurgery::where('ranap_child_detail_discharge_planning_surgery_id', $pendampingId)->pluck('name')->first();
        $grandChildTransportasi = RanapGrandChildDetailDischargePlanningSurgery::where('ranap_child_detail_discharge_planning_surgery_id', $transportasiId)->pluck('name')->first();
        $grandChildKelAdmArr = RanapGrandChildDetailDischargePlanningSurgery::where('ranap_child_detail_discharge_planning_surgery_id', $kelAdmId)->pluck('name')->toArray();
        return view('pages.dischargePlanningPerawat.edit', [
            "title" => "Discharge Planning Perawat",
            "menu" => "Rawat Inap",
            'item' => $item,
            'arrAktivitas' => $arrAktivitas,
            'arrFasilitas' => $arrFasilitas,
            'arrRincian' => $arrRincian,
            'arrPendamping' => $arrPendamping,
            'arrTrans' => $arrTrans,
            'arrDetail' => $arrDetail,
            'arrKelAdm' => $arrKelAdm,
            'tgl' => $tgl,
            'grandChildPendamping' => $grandChildPendamping,
            'grandChildTransportasi' => $grandChildTransportasi,
            'grandChildKelAdmArr' => $grandChildKelAdmArr,
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
        $item = RanapDischargePlanningPerawatPatient::find($id);

        $dataToUpdateMainTb = [
            'pasien_name' => $request->pasien_name ?? '',
            'tanggal' => $request->tanggal ?? date('Y-m-d H:i:s'),
        ];

        if ($request->ttd_pasien != $item->ttd_pasien) {
            // paraf pasien / wali
            $folder_path = 'assets/paraf-pasien/';
            Storage::makeDirectory('public/' . $folder_path);

            $ttdImg = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd_pasien')));
            $file_name = $folder_path . uniqid() . '.png';
            Storage::put('public/' . $file_name, $ttdImg);

            $dataToUpdateMainTb['ttd_pasien'] = $file_name ?? '';
        }
        if ($request->ttd_petugas != $item->ttd_petugas) {
            $dataToUpdateMainTb['petugas_name'] = $request->petugas_name ?? '';
            $dataToUpdateMainTb['ttd_petugas'] = $request->ttd_petugas ?? '';
        }

        $item->update($dataToUpdateMainTb);

        //KEGIATAN aktfitas
        foreach ($item->ranapDetailDischargePlanningPerawatPatients as $detail) {
            foreach ($detail->ranapChildDetailDischargePlanningSurgeries as $childDetail) {
                $childDetail->ranapGrandChildDetailDischargePlanningSurgeries()->delete();
            }
            $detail->ranapChildDetailDischargePlanningSurgeries()->delete();
        }
        $item->ranapDetailDischargePlanningPerawatPatients()->delete();

        $kegiatanAktifitas = $request->input('kegiatan_aktifitas');
        // $catatanAktifitas = $request->input('catatan_aktifitas');
        $aktifitas = RanapDetailDischargePlanningPerawatPatient::create([
            'ranap_discharge_planning_perawat_patient_id' => $item->id,
            'kegiatan' => $kegiatanAktifitas,
            //'catatan' => $catatanAktifitas,
        ]);

        $kegiatanFasilitas = $request->input('kegiatan_fasilitas');
        // $catatanFasilitas = $request->input('catatan_fasilitas');
        $fasilitas = RanapDetailDischargePlanningPerawatPatient::create([
            'ranap_discharge_planning_perawat_patient_id' => $item->id,
            'kegiatan' => $kegiatanFasilitas,
            // 'catatan' => $catatanFasilitas,
        ]);

        $kegiatanRincian = $request->input('kegiatan_rincian');
        $additionalCatatan = $request->input('catatan_rincian', []);
        $catatanRincian = implode("#*", $additionalCatatan);
        $rincian = RanapDetailDischargePlanningPerawatPatient::create([
            'ranap_discharge_planning_perawat_patient_id' => $item->id,
            'kegiatan' => $kegiatanRincian,
            'catatan' => $catatanRincian,
        ]);

        //detailAktfitas
        $detailAktifitas = $request->input('aktivitas', []);
        $catatanAktifitas = $request->input('catatan_aktifitas', []);
        foreach ($detailAktifitas as  $key => $akt) {
            RanapChildDetailDischargePlanningSurgery::create([
                'ranap_detail_discharge_planning_perawat_patient_id' => $aktifitas->id,
                'name' => $akt,
                'value' => $catatanAktifitas[$key],
            ]);
        }

        $detailFasilitas = $request->input('fasilitas', []);
        $detailCatatanFasilitas = $request->input('catatan_fasilitas', []);
        foreach ($detailFasilitas as $key => $fas) {
            RanapChildDetailDischargePlanningSurgery::create([
                'ranap_detail_discharge_planning_perawat_patient_id' => $fasilitas->id,
                'name' => $fas,
                'value' => $detailCatatanFasilitas[$key],
            ]);
        }

        $detailRincian = $request->input('rincian', []);
        $detailCatatanRincian = $request->input('catatan_rincian', []);
        foreach ($detailRincian as $key => $rin) {
            RanapChildDetailDischargePlanningSurgery::create([
                'ranap_detail_discharge_planning_perawat_patient_id' => $rincian->id,
                'name' => $rin,
                'value' => $detailCatatanRincian[$key],
            ]);
        }

        //child and grandChild
        $pendampingValue = $request->input('pendamping');
        $pendaName = $request->input('pendamping_name');
        if ($pendampingValue) {
            $pendamping = RanapChildDetailDischargePlanningSurgery::create([
                'ranap_detail_discharge_planning_perawat_patient_id' => $rincian->id,
                'name' => $pendaName,
                // 'value' => ,
            ]);

            RanapGrandChildDetailDischargePlanningSurgery::create([
                'ranap_child_detail_discharge_planning_surgery_id' => $pendamping->id,
                'name' => $pendampingValue,
            ]);
        }

        $transportasiValue = $request->input('transportasi');
        $transName = $request->input('transportasi_name');
        if ($transportasiValue) {
            $transportasi = RanapChildDetailDischargePlanningSurgery::create([
                'ranap_detail_discharge_planning_perawat_patient_id' => $rincian->id,
                'name' => $transName,
                // 'value' => ,
            ]);

            RanapGrandChildDetailDischargePlanningSurgery::create([
                'ranap_child_detail_discharge_planning_surgery_id' => $transportasi->id,
                'name' => $transportasiValue,
            ]);
        }

        $admValue = $request->input('adm', []);
        $admName = $request->input('adm_name');
        if (!empty($admValue)) {
            $adm = RanapChildDetailDischargePlanningSurgery::create([
                'ranap_detail_discharge_planning_perawat_patient_id' => $rincian->id,
                'name' => $admName,
                // 'value' => ,
            ]);
            foreach ($admValue as $val) {
                RanapGrandChildDetailDischargePlanningSurgery::create([
                    'ranap_child_detail_discharge_planning_surgery_id' => $adm->id,
                    'name' => $val,
                ]);
            }
        }

        return redirect()->route('checklist/rencana/pulang/page/one.show', $item->rawatInapPatient->id)->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = RanapDischargePlanningPerawatPatient::find($id);
        foreach ($item->ranapDetailDischargePlanningPerawatPatients as $detail) {
            foreach ($detail->ranapChildDetailDischargePlanningSurgeries as $childDetail) {
                $childDetail->ranapGrandChildDetailDischargePlanningSurgeries()->delete();
            }
            $detail->ranapChildDetailDischargePlanningSurgeries()->delete();
        }
        $item->ranapDetailDischargePlanningPerawatPatients()->delete();
        $item->delete();

        return back()->with('success', 'Berhasil Dihapus');
    }
}
