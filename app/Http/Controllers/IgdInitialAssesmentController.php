<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\IgdPatient;
use Illuminate\Http\Request;
use App\Models\IgdPlanDetail;
use App\Models\IgdInitialAssesment;
use Illuminate\Support\Facades\Auth;
use App\Models\IgdEducationNeedDetail;
use App\Models\IgdStatusPresentDetail;
use Illuminate\Support\Facades\Storage;
use App\Models\IgdPhysicalExaminationDetail;
use App\Models\IgdSupportingExaminationDetail;

class IgdInitialAssesmentController extends Controller
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
        if (!session('penunjang')) {
            session(['penunjang' => 'radiologi']);
        } else {
            session(['penunjang' => session('penunjang')]);
        }
        $item = IgdPatient::findOrFail($id);
        $arrPemeriksaan = ['KEPALA', 'MATA', 'THT', 'MULUT', 'LEHER', 'THORAKS', 'ABDOMEN', 'UROGENITAL & ANUS', 'EKSTREMITAS', 'NEUROLOGIS'];
        $arrRencana = ['Tindakan', 'Dirawat di ruang', 'Diet'];
        $arrEdukasi = ['Penggunaan obat secara efektif dan aman', 'Penggunaan peralatan alat medis yang aman', 'Potensi interaksi obat dan makanan', 'Teknik rehabilitasi'];
        $arrPemulangan = ['Sembuh dan meneruskan dengan rawat jalan', 'Rujuk', 'Pulang atas permintaan sendiri (APS)', 'Meninggal'];
        $dataObat = Medicine::all();

        // $radiologiResults = RadiologiPatient::where('queue_id', $item->id)->where('status', 'SELESAI')->get();
        // $laborResults = LaboratoriumPatientResult::where('queue_id', $item->id)->where('status', 'SELESAI')->get();
        return view('pages.assesmenAwalIGD.create', [
            'title' => 'IGD',
            'menu' => 'In Patient',
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
        $item = IgdPatient::find($id);

        // $dpjp = $item->ranapDpjpPatientDetails->where('status', true)->first();

        $folder_path = 'assets/paraf-pasien/';
        Storage::makeDirectory('public/' . $folder_path);
        // paraf keluarga pasien
        $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd')));
        $file_name_ttd = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name_ttd, $ttd);

        $data['igd_patient_id'] = $item->id;
        $data['patient_id'] = $item->queue->patient->id;
        $data['user_id'] = Auth::user()->id; //$dpjp->user->id
        $data['tanggal'] = date('Y-m-d H:i:s');
        $data['isPasien'] = $request->input('isPasien');
        $data['name'] = $request->input('name');
        $data['hubungan'] = $request->input('hubungan');
        $data['keluhan'] = $request->input('keluhan');
        $data['riwayat_penyakit_sekarang'] = $request->input('riwayat_penyakit_sekarang');
        $data['riwayat_penyakit_dahulu'] = $request->input('riwayat_penyakit_dahulu');
        $data['riwayat_penggunaan_obat'] = $request->input('riwayat_penggunaan_obat');
        $data['riwayat_penyakit_keluarga'] = $request->input('riwayat_penyakit_keluarga');
        $data['status_lokalis'] = $request->input('status_lokalis');
        $data['diagnosa_kerja'] = $request->input('diagnosa_kerja');
        $data['diagnosa_banding'] = $request->input('diagnosa_banding');
        $data['terapi'] = $request->input('terapi');
        if ($data['isPasien'] == 1) {
            $data['dijelaskan_kepada'] = 'Pasien';
        } else {
            $data['dijelaskan_kepada'] = 'Keluarga, hubungan ' . $data['hubungan'] ?? '';
        }
        $data['ttd_penerima_info'] = $file_name_ttd;
        $data['nama_dpjp'] = auth()->user()->name; //$dpjp->user->name
        $data['ttd_dpjp'] = auth()->user()->paraf; //$dpjp->user->paraf




        // $dataFisik = $request->input('fisik', []);
        // if (isset($dataFisik[1]['alasan'])) {
        //     dd('berhasil');
        // }else{
        //     dd('gagal');
        // }

        if ($assesmen = IgdInitialAssesment::create($data)) {
            //pemeriksaan fisik
            $dataFisik = $request->input('fisik', []);
            foreach ($dataFisik as $index => $new) {
                if (isset($new['isNormal'])) {
                    $pemeriksaan['igd_initial_assesment_id'] = $assesmen->id;
                    $pemeriksaan['name'] = $new['name'];
                    $pemeriksaan['isNormal'] = $new['isNormal'];
                    if (isset($new['alasan'])) {
                        $pemeriksaan['keterangan'] = $new['alasan'];
                    } else {
                        $pemeriksaan['keterangan'] = null;
                    }
                    IgdPhysicalExaminationDetail::create($pemeriksaan);
                }
            }
            //Hasil Pemeriksaan Penunjang
            $dataHasilPemeriksaanName = $request->input('nama_hasil_pemeriksaan', []);
            $dataHasilPemeriksaanValue = $request->input('hasil_pemeriksaan', []);
            foreach ($dataHasilPemeriksaanName as $index => $name) {
                if ($name) {
                    IgdSupportingExaminationDetail::create([
                        'igd_initial_assesment_id' => $assesmen->id,
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
                    'igd_initial_assesment_id' => $assesmen->id,
                    'name' => $plan,
                ];
                IgdPlanDetail::create($newPlan);
            }

            //edukasi
            $dataEdukasi = $request->input('edukasi', []);
            foreach ($dataEdukasi as $edukasi) {
                if ($edukasi == null) {
                    continue;
                }
                $newEdukasi = [
                    'igd_initial_assesment_id' => $assesmen->id,
                    'name' => $edukasi,
                ];
                IgdEducationNeedDetail::create($newEdukasi);
            }

            //rencana Pemulangan
            $dataPemulangan = $request->input('stts_present', []);
            foreach ($dataPemulangan as $index => $pemulangan) {
                if ($pemulangan == null) {
                    continue;
                }
                $newPemulangan = [
                    'igd_initial_assesment_id' => $assesmen->id,
                    'name' => $pemulangan,
                ];
                IgdStatusPresentDetail::create($newPemulangan);
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
        //     if ($itemResep = RanapMedicineReceipt::create($resep)) {
        //         foreach ($medicineIds as $index => $medicine_id) {
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
        return redirect()->route('igd/patient/rme.show', $item->id)->with([
            'success' => 'Berhasil Ditambahkan',
            'active' => 'assesmen_medis',
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
        $item = IgdInitialAssesment::findOrFail($id);
        $waktu = new DateTime($item->tanggal);
        $formatId = Carbon::parse($item->tanggal);
        return view('pages.assesmenAwalIGD.show', [
            "title" => "IGD",
            "menu" => "In Patient",
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item =IgdInitialAssesment::find($id);
        $item->update([
            'isActive' => false
        ]);
        return back()->with([
            'success' => 'Berhasil Dihapus',
            'active' => 'assesmen_medis',
        ]);
    }
}
