<?php

namespace App\Http\Controllers;

use DateTime;

use App\Models\ConsultingRates;
use App\Models\DetailKasirPatient;
use App\Models\Queue;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\MedicineReceipt;
use App\Models\InitialAssesment;
use App\Models\InitialAsessmentPlan;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicineReceiptDetail;
use App\Models\InitialAssesmentEducationalNeed;
use App\Models\InitialAssesmentPhysicalExamination;
use App\Models\InitialAssesmentSupportingExaminationResult;
use App\Models\KasirPatient;
use App\Models\LaboratoriumRequest;
use App\Models\RadiologiFormRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class InitialAssesmentController extends Controller
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

    public function edit($id)
    {
        if (!session('penunjang')) {
            session(['penunjang' => 'radiologi']);
        } else {
            session(['penunjang' => session('penunjang')]);
        }

        $item = Queue::findOrFail($id);
        $data = InitialAssesment::findOrFail($id);
        $dataPemeriksaan = ['KEPALA', 'MATA', 'THT', 'MULUT', 'LEHER', 'THORAKS', 'ABDOMEN', 'UROGENITAL & ANUS', 'EKSTREMITAS', 'NEUROLOGIS'];
        $dataObat = Medicine::all();
        $arrEdukasi = ['Penggunaan obat secara efektif dan aman', 'Penggunaan peralatan medis yang aman', 'Potensi interaksi obat dan makanan', 'Teknik Rehabilitasi'];
        // dd($data);
        $radiologiResults = RadiologiFormRequest::where('queue_id', $item->id)->where('status', 'FINISHED')->get();
        $laborResults = LaboratoriumRequest::where('queue_id', $item->id)->where('status', 'FINISHED')->get();
        return view('pages.assesmenAwal.edit', [
            'title' => 'Edit Assesmen',
            'menu' => 'Rawat Jalan',
            'arrEdukasi' => $arrEdukasi,
            'item' => $item,
            'data' => $data,
            'dataPemeriksaan' => $dataPemeriksaan,
            'dataObat' => $dataObat,
            'radiologiResults' => $radiologiResults,
            'laborResults' => $laborResults,
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = InitialAssesment::findOrFail($id);
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



        if ($request->input('change_ttd') === 'true') {
            $file_to_delete = 'public/' . $item->ttd_pasien;
            if (Storage::exists($file_to_delete)) {
                Storage::delete($file_to_delete);
            }
            // Menyimpan ttd
            $folder_path = 'assets/paraf-pasien/';
            Storage::makeDirectory('public/' . $folder_path);
            $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd')));
            $file_name_ttd = $folder_path . uniqid() . '.png';
            Storage::put('public/' . $file_name_ttd, $ttd);
            $data['ttd_pasien'] = $file_name_ttd;
        }
        

        if (!is_null($request->input('name'))) {
            $data['nm_pasien'] = $request->input('name');
        } else {
            $data['nm_pasien'] = $item->patient->name;
        }

        if ($item->update($data)) {
            $dataFisik = $request->input('fisik', []);
            $item->initialAssesmentPhysicalExaminations()->each(function ($physicalExamination) {
                $physicalExamination->delete();
            });
            foreach ($dataFisik as $new) {
                if (isset($new['isNormal'])) {
                    $pemeriksaan['initial_assesment_id'] = $item->id;
                    $pemeriksaan['name'] = $new['name'];
                    $pemeriksaan['isNormal'] = $new['isNormal'];
                    if (isset($new['alasan'])) {
                        $pemeriksaan['keterangan'] = $new['alasan'];
                    } else {
                        $pemeriksaan['keterangan'] = null;
                    }
                    InitialAssesmentPhysicalExamination::create($pemeriksaan);
                }
            }

            //Hasil Pemeriksaan Penunjang
            $dataHasilPemeriksaanName = $request->input('hasil_pemeriksaan', []);
            $item->initialAssesmentSupportingExaminationResults()->each(function ($data) {
                $data->delete();
            });
            foreach ($dataHasilPemeriksaanName as $penunjang) {
                if ($penunjang == null) {
                    continue;
                }
                $newPenunjang  = [
                    'initial_assesment_id' => $item->id,
                    'name' => $penunjang,
                ];
                InitialAssesmentSupportingExaminationResult::create($newPenunjang);
            }

            //rencana
            $dataRencana = $request->input('rencana', []);
            $item->initialAssesmentPlan()->each(function ($data) {
                $data->delete();
            });
            foreach ($dataRencana as $plan) {
                if ($plan == null) {
                    continue;
                }
                $newPlan = [
                    'initial_assesment_id' => $item->id,
                    'name' => $plan,
                ];
                InitialAsessmentPlan::create($newPlan);
            }

            //edukasi
            $dataEdukasi = $request->input('edukasi', []);
            $item->initialAssesmentEducationalNeeds()->each(function ($data) {
                $data->delete();
            });
            foreach ($dataEdukasi as $edukasi) {
                if ($edukasi == null) {
                    continue;
                }
                $newEdukasi = [
                    'initial_assesment_id' => $item->id,
                    'name' => $edukasi,
                ];
                InitialAssesmentEducationalNeed::create($newEdukasi);
            }
        }
        $dataReturn = InitialAssesment::with(['rawatJalanPoliPatient'])->where('id', '=', $item->id)->first();
        return redirect()->route('rajal/show', ['id' => $dataReturn->rawatJalanPoliPatient->queue_id, 'title' => 'Rawat Jalan'])->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'dokter',
            'dokter' => 'assesmen',
        ]);
    }


    public function create($id)
    {
        if (!session('penunjang')) {
            session(['penunjang' => 'radiologi']);
        } else {
            session(['penunjang' => session('penunjang')]);
        }
        $item = Queue::with('patient')->findOrFail($id);
        $dataPemeriksaan = ['KEPALA', 'MATA', 'THT', 'MULUT', 'LEHER', 'THORAKS', 'ABDOMEN', 'UROGENITAL & ANUS', 'EKSTREMITAS', 'NEUROLOGIS'];
        $dataObat = Medicine::all();
        return view('pages.assesmenAwal.create', [
            'title' => 'Create Assesmen',
            'menu' => 'Rawat Jalan',
            'item' => $item,
            'dataPemeriksaan' => $dataPemeriksaan,
            'dataObat' => $dataObat,
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
        // dd($request);
        $item = Queue::with('patient')->findOrFail($id);

        // $medicineIds = $request->input('medicine_id', []);
        $data = $request->all();
        $data['rawat_jalan_poli_patient_id'] = $item->rawatJalanPoliPatient->id;
        $data['patient_id'] = $item->patient->id;
        $data['user_id'] = Auth::user()->id;
        //menyimpan ttd
        $folder_path = 'assets/paraf-pasien/';
        Storage::makeDirectory('public/' . $folder_path);
        $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd')));
        $file_name_ttd = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name_ttd, $ttd);
        $data['ttd_pasien'] = $file_name_ttd;
        if (!is_null($request->input('name'))) {
            $data['nm_pasien'] = $request->input('name');
        } else {
            $data['nm_pasien'] = $item->patient->name;
        }
        if ($assesmen = InitialAssesment::create($data)) {
            foreach ($data['fisik'] as $new) {
                if (isset($new['isNormal'])) {
                    $pemeriksaan['initial_assesment_id'] = $assesmen->id;
                    $pemeriksaan['name'] = $new['name'];
                    $pemeriksaan['isNormal'] = $new['isNormal'];
                    if (isset($new['alasan'])) {
                        $pemeriksaan['keterangan'] = $new['alasan'];
                    } else {
                        $pemeriksaan['keterangan'] = null;
                    }
                    InitialAssesmentPhysicalExamination::create($pemeriksaan);
                }
            }
            foreach ($data['hasil_pemeriksaan'] as $penunjang) {
                if ($penunjang == null) {
                    continue;
                }
                $newPenunjang  = [
                    'initial_assesment_id' => $assesmen->id,
                    'name' => $penunjang,
                ];
                InitialAssesmentSupportingExaminationResult::create($newPenunjang);
            }
            foreach ($data['rencana'] as $plan) {
                if ($plan == null) {
                    continue;
                }
                $newPlan = [
                    'initial_assesment_id' => $assesmen->id,
                    'name' => $plan,
                ];
                InitialAsessmentPlan::create($newPlan);
            }
            foreach ($data['edukasi'] as $edukasi) {
                if ($edukasi == null) {
                    continue;
                }
                $newEdukasi = [
                    'initial_assesment_id' => $assesmen->id,
                    'name' => $edukasi,
                ];
                InitialAssesmentEducationalNeed::create($newEdukasi);
            }

            //create tagihan konsultasi
            $patient_category_id = $item->patientCategory->id;
            $dpjp_id = $item->doctorPatient->user->id;
            $tarifKonsultasi = ConsultingRates::where('user_id', $dpjp_id)->where('patient_category_id', $patient_category_id)->first();
            if ($item->kasirPatient) {
                $itemKasirPatient = KasirPatient::find($item->kasirPatient->id);

                $total = $itemKasirPatient->total;
                $detailKasirPatient = false;
                foreach ($itemKasirPatient->detailKasirPatients as $detail) {
                    if ($detailKasirPatient == true) {
                        break;
                    }
                    if ($detail->name == 'Konsultasi' && $detail->category == 'Konsultasi') {
                        $detailKasirPatient = true;
                    }
                }
                if ($detailKasirPatient == false) {
                    $newDetail =  DetailKasirPatient::create([
                        'kasir_patient_id' => $itemKasirPatient->id,
                        'name' => 'Konsultasi',
                        'tanggal' => date('Y-m-d H:i:s'),
                        'category' => 'Konsultasi',
                        'jumlah' => '1',
                        'tarif' => $tarifKonsultasi->pembayaran ?? 0,
                    ]);
                    $total += $newDetail->tarif;
                }

                $itemKasirPatient->update([
                    'total' => $total,
                ]);
            } else {
                $total = $tarifKonsultasi->pembayaran;
                $itemKasirPatient = KasirPatient::create([
                    'queue_id' => $item->id,
                    'user_id' => null,
                    'total' => $total,
                    'status' => 'PENDING',
                ]);
                DetailKasirPatient::create([
                    'kasir_patient_id' => $itemKasirPatient->id,
                    'name' => 'Konsultasi',
                    'tanggal' => date('Y-m-d H:i:s'),
                    'category' => 'Konsultasi',
                    'jumlah' => '1',
                    'tarif' => $tarifKonsultasi->pembayaran ?? 0,
                ]);
            }
        }

        // if (!empty($medicineIds)) {
        //     $resep['user_id'] = $data['user_id'];
        //     $resep['patient_id'] = $item->patient->id;
        //     $resep['rawat_jalan_poli_patient_id'] = $item->rawatJalanPatient->rawatJalanPoliPatient->id;
        //     if ($itemResep = MedicineReceipt::create($resep)) {
        //         foreach ($medicineIds as $index => $medicine_id) {
        //             $resepDetail['medicine_receipt_id'] = $itemResep->id;
        //             $resepDetail['medicine_id'] = $medicine_id;
        //             $resepDetail['jumlah'] = $request['jumlah'][$index] ?? '';
        //             $resepDetail['aturan_pakai'] = $request['aturan_pakai'][$index] ?? '';
        //             $resepDetail['keterangan'] = $request['keterangan'][$index] ?? '';
        //             $resepDetail['other'] = $request['other'][$index] ?? '';
        //             MedicineReceiptDetail::create($resepDetail);
        //         }
        //     }
        // }
        return redirect()->route('rajal/show', ['id' => $id, 'title' => 'Rawat Jalan'])->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'dokter',
            'dokter' => 'assesmen',
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
        $item = InitialAssesment::findOrFail($id);
        $mresep = MedicineReceipt::with([
            'medicineReceiptDetails',
            'medicineReceiptDetails.medicine'
        ])
            ->where('rawat_jalan_poli_patient_id', '=', $item->rawat_jalan_poli_patient_id)
            ->get();


        return view('pages.assesmenAwal.show', [
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
            'item' => $item,
            'medicines' => $mresep
        ]);
    }



    public function print($id)
    {
        $item = InitialAssesment::findOrFail($id);
        $waktu = new DateTime($item->tanggal);
        $formatId = Carbon::parse($item->tanggal);
        $arrEdukasi = ['Penggunaan obat secara efektif dan aman', 'Penggunaan peralatan medis yang aman', 'Potensi interaksi obat dan makanan', 'Teknik Rehabilitasi'];
        // dd($item);
        return view('pages.rawatjalan.assesmen_rawat_jalan', [
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
            'item' => $item,
            'waktu' => $waktu,
            'formatId' => $formatId,
            'arrEdukasi' => $arrEdukasi
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
