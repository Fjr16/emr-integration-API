<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\MedicineReceipt;
use App\Models\Queue;
use App\Models\RawatInapPatient;
use App\Models\RanapMedicineReceipt;
use Illuminate\Support\Facades\Auth;
use App\Models\RanapInitialAssesment;
use App\Models\RanapMedicineReceiptDetail;
use App\Models\RanapRencanaInitialAssesment;
use App\Models\RanapKebutuhanEdukasiInitialAssesment;
use App\Models\RanapPemeriksaanFisikInitialAssesment;
use App\Models\RanapRencanaPemulanganPasienInitialAssesment;
use App\Models\RanapHasilPemeriksaanPenunjangInitialAssesment;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class RanapInitialAssesmentController extends Controller
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
        return view('pages.ranapAssesmenAwal.index', [
            "title" => "Assesmen Awal Medis",
            "menu" => "Rawat Inap",
            'data' => $data,
        ]);
    }

    public function detail($id)
    {
        $item = RawatInapPatient::find($id);
        $data = RanapInitialAssesment::where('rawat_inap_patient_id', $id)->get();

        return view('pages.ranapAssesmenAwal.detail', [
            "item" => $item,
            "title" => "Assesmen Awal Medis",
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
        if (!session('penunjang')) {
            session(['penunjang' => 'radiologi']);
        } else {
            session(['penunjang' => session('penunjang')]);
        }
        $item = RawatInapPatient::findOrFail($id);
        $arrPemeriksaan = ['KEPALA', 'MATA', 'THT', 'MULUT', 'LEHER', 'THORAKS', 'ABDOMEN', 'UROGENITAL & ANUS', 'EKSTREMITAS', 'NEUROLOGIS'];
        $arrRencana = ['Tindakan', 'Dirawat di ruang', 'Diet'];
        $arrEdukasi = ['Penggunaan obat secara efektif dan aman', 'Penggunaan peralatan alat medis yang aman', 'Potensi interaksi obat dan makanan', 'Teknik rehabilitasi'];
        $arrPemulangan = ['Lansia dengan dimensia', 'Keterbatasan Mobilitas', 'Perlu bantuan medik dan perawatan terus menerus', 'Bantuan untuk melakukan aktifitas sehari-hari', 'Bantuan pelayanan psikososial'];
        $dataObat = Medicine::all();
        // $radiologiResults = RadiologiPatient::where('queue_id', $item->id)->where('status', 'SELESAI')->get();
        // $laborResults = LaboratoriumPatientResult::where('queue_id', $item->id)->where('status', 'SELESAI')->get();
        return view('pages.ranapAssesmenAwal.create', [
            'title' => 'Assesmen Awal Medis',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'arrPemeriksaan' => $arrPemeriksaan,
            'arrRencana' => $arrRencana,
            'arrEdukasi' => $arrEdukasi,
            'arrPemulangan' => $arrPemulangan,
            'dataObat' => $dataObat,

            // 'radiologiResults' => $radiologiResults,
            // 'laborResults' => $laborResults,
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

        $data['rawat_inap_patient_id'] = $item->id;
        $data['patient_id'] = $item->queue->patient->id;
        $data['user_id'] = Auth::user()->id;
        $data['tanggal'] = date('Y-m-d H:i:s');
        $data['isPasien'] = $request->input('isPasien');
        $data['name'] = $request->input('name');
        $data['hubungan'] = $request->input('hubungan');
        $data['keluhan_utama'] = $request->input('keluhan');
        $data['riwayat_penyakit_sekarang'] = $request->input('riwayat_penyakit_sekarang');
        $data['riwayat_penyakit_dahulu'] = $request->input('riwayat_penyakit_dahulu');
        $data['riwayat_penggunaan_obat'] = $request->input('riwayat_penggunaan_obat');
        $data['riwayat_penyakit_keluarga'] = $request->input('riwayat_penyakit_keluarga');
        $data['status_lokalis'] = $request->input('status_lokalis');
        $data['diagnosa_kerja'] = $request->input('diagnosa_kerja');
        $data['diagnosa_banding'] = $request->input('diagnosa_banding');
        $data['terapi'] = $request->input('terapi');
        $data['dijelaskan_kepada'] = $request->input('nm_wali');


        // if ($data['isPasien'] == 1) {
        //     $data['dijelaskan_kepada'] = 'Pasien';
        // } else {
        //     $data['dijelaskan_kepada'] = 'Keluarga, hubungan ' . $data['hubungan'] ?? '';
        // }


        // $dataFisik = $request->input('fisik', []);
        // if (isset($dataFisik[1]['alasan'])) {
        //     dd('berhasil');
        // }else{
        //     dd('gagal');
        // }

        if ($assesmen = RanapInitialAssesment::create($data)) {
            //pemeriksaan fisik
            $dataFisik = $request->input('fisik', []);
            foreach ($dataFisik as $index => $new) {
                if (isset($new['isNormal'])) {
                    $pemeriksaan['ranap_initial_assesment_id'] = $assesmen->id;
                    $pemeriksaan['name'] = $new['name'];
                    $pemeriksaan['isNormal'] = $new['isNormal'];
                    if (isset($new['alasan'])) {
                        $pemeriksaan['keterangan'] = $new['alasan'];
                    } else {
                        $pemeriksaan['keterangan'] = null;
                    }
                    RanapPemeriksaanFisikInitialAssesment::create($pemeriksaan);
                }
            }
            //Hasil Pemeriksaan Penunjang
            $dataHasilPemeriksaanName = $request->input('nama_hasil_pemeriksaan', []);
            $dataHasilPemeriksaanValue = $request->input('hasil_pemeriksaan', []);
            foreach ($dataHasilPemeriksaanName as $index => $name) {
                if ($name) {
                    RanapHasilPemeriksaanPenunjangInitialAssesment::create([
                        'ranap_initial_assesment_id' => $assesmen->id,
                        'name' => $name,
                        'hasil' => $dataHasilPemeriksaanValue[$index],
                    ]);
                }
            }

            //Rencana
            $dataRencana = $request->input('rencana', []);
            foreach ($dataRencana as $plan) {
                if ($plan == null) {
                    continue;
                }
                $newPlan = [
                    'ranap_initial_assesment_id' => $assesmen->id,
                    'name' => $plan,
                ];
                RanapRencanaInitialAssesment::create($newPlan);
            }

            //edukasi
            $dataEdukasi = $request->input('edukasi', []);
            foreach ($dataEdukasi as $edukasi) {
                if ($edukasi == null) {
                    continue;
                }
                $newEdukasi = [
                    'ranap_initial_assesment_id' => $assesmen->id,
                    'name' => $edukasi,
                ];
                RanapKebutuhanEdukasiInitialAssesment::create($newEdukasi);
            }

            //rencana Pemulangan
            $dataPemulanganName = $request->input('pemulangan_name', []);
            $dataPemulanganValue = $request->input('pemulangan_value', []);
            foreach ($dataPemulanganName as $index => $pemulangan) {
                if ($pemulangan == null) {
                    continue;
                }
                $newPemulangan = [
                    'ranap_initial_assesment_id' => $assesmen->id,
                    'name' => $pemulangan,
                    'isYes' => $dataPemulanganValue[$index],
                ];
                RanapRencanaPemulanganPasienInitialAssesment::create($newPemulangan);
            }

            //create tagihan konsultasi
            // $patient_category_id = $item->patientCategory->id;
            // $dpjp_id = $item->doctorPatient->user->id;
            // $tarifKonsultasi = ConsultingRates::where('user_id', $dpjp_id)->where('patient_category_id', $patient_category_id)->first();
            // if($item->rawatJalanPatient->kasirPatient){
            //     $itemKasirPatient = KasirPatient::find($item->rawatJalanPatient->kasirPatient->id);

            //     $total = $itemKasirPatient->total;
            //     $detailKasirPatient = false;
            //     foreach($itemKasirPatient->detailKasirPatients as $detail){
            //         if($detailKasirPatient == true){
            //             break;
            //         }
            //         if($detail->name == 'Konsultasi' && $detail->category == 'Konsultasi'){
            //             $detailKasirPatient = true;
            //         }
            //     }
            //     if($detailKasirPatient == false){
            //        $newDetail =  DetailKasirPatient::create([
            //             'kasir_patient_id' => $itemKasirPatient->id,
            //             'name' => 'Konsultasi',
            //             'tanggal' => date('Y-m-d H:i:s'),
            //             'category' => 'Konsultasi',
            //             'jumlah' => '1',
            //             'tarif' => $tarifKonsultasi->pembayaran ?? 0,
            //         ]);
            //         $total += $newDetail->tarif;
            //     }

            //     $itemKasirPatient->update([
            //         'total' => $total,
            //     ]);
            // }else{
            //     $total = $tarifKonsultasi->pembayaran;
            //     $itemKasirPatient = KasirPatient::create([
            //         'rawat_jalan_patient_id' => $item->rawatJalanPatient->id,
            //         'user_id' => null,
            //         'total' => $total,
            //         'status' => 'PENDING',
            //     ]);
            //     DetailKasirPatient::create([
            //         'kasir_patient_id' => $itemKasirPatient->id,
            //         'name' => 'Konsultasi',
            //         'tanggal' => date('Y-m-d H:i:s'),
            //         'category' => 'Konsultasi',
            //         'jumlah' => '1',
            //         'tarif' => $tarifKonsultasi->pembayaran ?? 0,
            //     ]);
            // }

        }

        $medicineIds = $request->input('medicine_id', []);
        $jumlahObat = $request->input('jumlah', []);
        $aturanObat = $request->input('aturan_pakai', []);
        $keteranganObat = $request->input('keterangan', []);
        $otherObat = $request->input('other', []);
        if (!empty($medicineIds)) {
            $resep['user_id'] = $data['user_id'];
            $resep['patient_id'] = $item->queue->patient->id;
            $resep['rawat_inap_patient_id'] = $item->id;
            if ($itemResep = RanapMedicineReceipt::create($resep)) {
                foreach ($medicineIds as $index => $medicine_id) {
                    $resepDetail['ranap_medicine_receipt_id'] = $itemResep->id;
                    $resepDetail['medicine_id'] = $medicine_id;
                    $resepDetail['jumlah'] = $jumlahObat[$index];
                    $resepDetail['aturan_pakai'] = $aturanObat[$index];
                    $resepDetail['keterangan'] = $keteranganObat[$index];
                    $resepDetail['other'] = $otherObat[$index];
                    RanapMedicineReceiptDetail::create($resepDetail);
                }
            }
        }
        return redirect()->route('assesmen/awal/medis/ranap.detail', $item->queue->patient_id)->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'asesmen-awal',
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
        $item = RanapInitialAssesment::findOrFail($id);
        $waktu = new DateTime($item->tanggal);
        $formatId = Carbon::parse($item->tanggal);
        return view('pages.ranapAssesmenAwal.show', [
            "title" => "Assesmen Awal Medis",
            "menu" => "Rawat Inap",
            'item' => $item,
            'waktu' => $waktu,
            'formatId' => $formatId
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
        if (!session('penunjang')) {
            session(['penunjang' => 'radiologi']);
        } else {
            session(['penunjang' => session('penunjang')]);
        }
        $item = RanapInitialAssesment::findOrFail($id);
        $arrRencana = ['Tindakan', 'Dirawat di ruang', 'Diet'];
        $arrEdukasi = ['Penggunaan obat secara efektif dan aman', 'Penggunaan peralatan alat medis yang aman', 'Potensi interaksi obat dan makanan', 'Teknik rehabilitasi'];
        $arrPemulangan = ['Lansia dengan dimensia', 'Keterbatasan Mobilitas', 'Perlu bantuan medik dan perawatan terus menerus', 'Bantuan untuk melakukan aktifitas sehari-hari', 'Bantuan pelayanan psikososial'];
        $dataObat = Medicine::all();
        // $radiologiResults = RadiologiPatient::where('queue_id', $item->id)->where('status', 'SELESAI')->get();
        // $laborResults = LaboratoriumPatientResult::where('queue_id', $item->id)->where('status', 'SELESAI')->get();
        return view('pages.ranapAssesmenAwal.edit', [
            'title' => 'Rawat Inap',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'arrRencana' => $arrRencana,
            'arrEdukasi' => $arrEdukasi,
            'arrPemulangan' => $arrPemulangan,
            'dataObat' => $dataObat,
            // 'radiologiResults' => $radiologiResults,
            // 'laborResults' => $laborResults,
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
        $item = RanapInitialAssesment::find($id);

        $data['tanggal'] = date('Y-m-d H:i:s');
        $data['isPasien'] = $request->input('isPasien');
        $data['name'] = $request->input('name');
        $data['hubungan'] = $request->input('hubungan');
        $data['keluhan_utama'] = $request->input('keluhan');
        $data['riwayat_penyakit_sekarang'] = $request->input('riwayat_penyakit_sekarang');
        $data['riwayat_penyakit_dahulu'] = $request->input('riwayat_penyakit_dahulu');
        $data['riwayat_penggunaan_obat'] = $request->input('riwayat_penggunaan_obat');
        $data['riwayat_penyakit_keluarga'] = $request->input('riwayat_penyakit_keluarga');
        $data['status_lokalis'] = $request->input('status_lokalis');
        $data['diagnosa_kerja'] = $request->input('diagnosa_kerja');
        $data['diagnosa_banding'] = $request->input('diagnosa_banding');
        $data['terapi'] = $request->input('terapi');
        $data['dijelaskan_kepada'] = $request->input('nm_wali');

        // if ($data['isPasien'] == 1) {
        //     $data['dijelaskan_kepada'] = 'Pasien';
        // } else {
        //     $data['dijelaskan_kepada'] = 'Keluarga, hubungan ' . $data['hubungan'] ?? '';
        // }


        // $dataFisik = $request->input('fisik', []);
        // if (isset($dataFisik[1]['alasan'])) {
        //     dd('berhasil');
        // }else{
        //     dd('gagal');
        // }

        if ($item->update($data)) {
            //pemeriksaan fisik
            $dataFisik = $request->input('fisik', []);
            $item->ranapPemeriksaanFisikInitialAssesments()->delete();
            foreach ($dataFisik as $index => $new) {
                if (isset($new['isNormal'])) {
                    $pemeriksaan['ranap_initial_assesment_id'] = $item->id;
                    $pemeriksaan['name'] = $new['name'];
                    $pemeriksaan['isNormal'] = $new['isNormal'];
                    if (isset($new['alasan'])) {
                        $pemeriksaan['keterangan'] = $new['alasan'];
                    } else {
                        $pemeriksaan['keterangan'] = null;
                    }
                    $item->ranapPemeriksaanFisikInitialAssesments()->create($pemeriksaan);
                }
            }
            //Hasil Pemeriksaan Penunjang
            $dataHasilPemeriksaanName = $request->input('nama_hasil_pemeriksaan', []);
            $dataHasilPemeriksaanValue = $request->input('hasil_pemeriksaan', []);
            $item->ranapHasilPemeriksaanPenunjangInitialAssesment()->delete();
            foreach ($dataHasilPemeriksaanName as $index => $name) {
                if ($name) {
                    $item->ranapHasilPemeriksaanPenunjangInitialAssesment()->create([
                        'ranap_initial_assesment_id' => $item->id,
                        'name' => $name,
                        'hasil' => $dataHasilPemeriksaanValue[$index],
                    ]);
                }
            }

            //Rencana
            $dataRencana = $request->input('rencana', []);
            $item->ranapRencanaInitialAssesments()->delete();
            foreach ($dataRencana as $plan) {
                if ($plan == null) {
                    continue;
                }
                $newPlan = [
                    'ranap_initial_assesment_id' => $item->id,
                    'name' => $plan,
                ];
                $item->ranapRencanaInitialAssesments()->create($newPlan);
            }

            //edukasi
            $dataEdukasi = $request->input('edukasi', []);
            $item->ranapKebutuhanEdukasiInitialAssesments()->delete();
            foreach ($dataEdukasi as $edukasi) {
                if ($edukasi == null) {
                    continue;
                }
                $newEdukasi = [
                    'ranap_initial_assesment_id' => $item->id,
                    'name' => $edukasi,
                ];
                $item->ranapKebutuhanEdukasiInitialAssesments()->create($newEdukasi);
            }

            //rencana Pemulangan
            $dataPemulanganName = $request->input('pemulangan_name', []);
            $dataPemulanganValue = $request->input('pemulangan_value', []);
            $item->ranapRencanaPemulanganPasienInitialAssesments()->delete();
            foreach ($dataPemulanganName as $index => $pemulangan) {
                if ($pemulangan == null) {
                    continue;
                }
                $newPemulangan = [
                    'ranap_initial_assesment_id' => $item->id,
                    'name' => $pemulangan,
                    'isYes' => $dataPemulanganValue[$index],
                ];
                $item->ranapRencanaPemulanganPasienInitialAssesments()->create($newPemulangan);
            }

            //create tagihan konsultasi
            // $patient_category_id = $item->patientCategory->id;
            // $dpjp_id = $item->doctorPatient->user->id;
            // $tarifKonsultasi = ConsultingRates::where('user_id', $dpjp_id)->where('patient_category_id', $patient_category_id)->first();
            // if($item->rawatJalanPatient->kasirPatient){
            //     $itemKasirPatient = KasirPatient::find($item->rawatJalanPatient->kasirPatient->id);

            //     $total = $itemKasirPatient->total;
            //     $detailKasirPatient = false;
            //     foreach($itemKasirPatient->detailKasirPatients as $detail){
            //         if($detailKasirPatient == true){
            //             break;
            //         }
            //         if($detail->name == 'Konsultasi' && $detail->category == 'Konsultasi'){
            //             $detailKasirPatient = true;
            //         }
            //     }
            //     if($detailKasirPatient == false){
            //        $newDetail =  DetailKasirPatient::create([
            //             'kasir_patient_id' => $itemKasirPatient->id,
            //             'name' => 'Konsultasi',
            //             'tanggal' => date('Y-m-d H:i:s'),
            //             'category' => 'Konsultasi',
            //             'jumlah' => '1',
            //             'tarif' => $tarifKonsultasi->pembayaran ?? 0,
            //         ]);
            //         $total += $newDetail->tarif;
            //     }

            //     $itemKasirPatient->update([
            //         'total' => $total,
            //     ]);
            // }else{
            //     $total = $tarifKonsultasi->pembayaran;
            //     $itemKasirPatient = KasirPatient::create([
            //         'rawat_jalan_patient_id' => $item->rawatJalanPatient->id,
            //         'user_id' => null,
            //         'total' => $total,
            //         'status' => 'PENDING',
            //     ]);
            //     DetailKasirPatient::create([
            //         'kasir_patient_id' => $itemKasirPatient->id,
            //         'name' => 'Konsultasi',
            //         'tanggal' => date('Y-m-d H:i:s'),
            //         'category' => 'Konsultasi',
            //         'jumlah' => '1',
            //         'tarif' => $tarifKonsultasi->pembayaran ?? 0,
            //     ]);
            // }

        }

        // $medicineIds = $request->input('medicine_id', []);
        // $jumlahObat = $request->input('jumlah', []);
        // $aturanObat = $request->input('aturan_pakai', []);
        // $keteranganObat = $request->input('keterangan', []);
        // $otherObat = $request->input('other', []);
        // if (!empty($medicineIds)) {
        //     $resep['user_id'] = $data['user_id'];
        //     $resep['patient_id'] = $item->queue->patient->id;
        //     $resep['rawat_inap_patient_id'] = $item->id;
        //     if($itemResep = RanapMedicineReceipt::create($resep)){
        //         foreach($medicineIds as $index => $medicine_id){
        //             $resepDetail['ranap_medicine_receipt_id'] = $itemResep->id;
        //             $resepDetail['medicine_id'] = $medicine_id;
        //             $resepDetail['jumlah'] = $jumlahObat[$index];
        //             $resepDetail['aturan_pakai'] = $aturanObat[$index];
        //             $resepDetail['keterangan'] = $keteranganObat[$index];
        //             $resepDetail['other'] = $otherObat[$index];
        //             RanapMedicineReceiptDetail::create($resepDetail);
        //         }
        //     }
        // }
        $rawatInapPatientId = $item->rawatInapPatient->id;
        return redirect()->route('assesmen/awal/medis/ranap.detail', $$item->rawatInapPatient->queue->patien_id)->with([
            'success' => 'Berhasil Diperbarui',
            'btn' => 'asesmen-awal',
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
        $item = RanapInitialAssesment::find($id);
        $item->ranapPemeriksaanFisikInitialAssesments()->delete();
        $item->ranapRencanaInitialAssesments()->delete();
        $item->ranapKebutuhanEdukasiInitialAssesments()->delete();
        $item->ranapRencanaPemulanganPasienInitialAssesments()->delete();
        $item->ranapHasilPemeriksaanPenunjangInitialAssesment()->delete();
        $item->delete();

        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'asesmen-awal',
        ]);
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
