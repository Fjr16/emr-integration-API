<?php

namespace App\Http\Controllers;

use App\Helper\EncryptionHelper;
use App\Models\arg01\Seps;
use App\Models\claimCaseMixPatient;
use App\Models\DiagnosisPatient;
use App\Models\Patient;
use App\Models\PatientCategory;
use App\Models\Queue;
use App\Models\RawatInapPatient;
use App\Models\RawatJalanPatient;
use App\Models\SekunderSuratPengantarRawatJalanPatient;
use App\Models\Sep;
use App\Models\SuratBuktiPelayananPatient;
use App\Models\TarifInacbg;
use App\Models\TindakanIcd;
use Dflydev\DotAccessData\Data;
use App\Models\SuratPengantarRawatJalanPatient;
use App\Models\TerapiSuratPengantarRawatJalanPatient;
use App\Models\TindakanPatient;
use Illuminate\Http\Request;

class CasemixController extends Controller
{

    public function urlApi()
    {
        return 'http://192.168.98.22/E-klaim/ws.php?mode=debug';
        // return 'http://192.168.18.55/E-klaim/ws.php?mode=debug';
    }
    // done
    public function index()
    {
        $data = Patient::latest()->get();
        // $data = RawatInapPatient::where('status', 'SELESAI')->latest()->get();

        // $patients = SuratPengantarRawatJalanPatient::with(['patient', 'queue'])
        //     ->where('status', 'terima')
        //     ->select('patient_id')
        //     ->groupBy('patient_id')
        //     ->get();



        // dd($patients);

        return view('pages.casemix.index', [
            'title' => 'Casemix',
            'menu' => 'Laporan',
            'data' => $data
        ]);
    }

    // done
    public function queue($id)
    {
        $id = decrypt($id);
        $statusBpjs = PatientCategory::where('name', 'BPJS')->first();
        $item = Patient::find($id);
        return view('pages.casemix.queue_patient', [
            'title' => 'Casemix',
            'menu' => 'Laporan',
            'item' => $item,
            'statusBpjs' => $statusBpjs,
        ]);
    }

    // public function pendanaan(Request $request, $id)
    // {
    //     $suratPengantarRawatJalan = SuratPengantarRawatJalanPatient::where('queue_id', '=', $id)->first();
    //     $sep = Sep::where('patient_id', '=', $suratPengantarRawatJalan->patient_id)->select('no_sep')->first();

    //     $cekTindakanIcd = DB::table('tarif_inacbgs as a')
    //         ->join('tindakan_icds as b', 'a.id', '=', 'b.tarif_inacbg_id')
    //         ->join('detail_tarif_inacbgs as c', 'c.tindakan_icd_id', '=', 'b.id')
    //         ->where('a.queue_id', '=', $suratPengantarRawatJalan->queue_id)
    //         ->select('a.id as id_tarif_inacbgs', 'b.id as id_tindakan_icds', 'b.tarif_inacbg_id', 'c.id as id_detail_tarif_inacbgs')->first();
    //     $tarif = DB::table('rawat_jalan_patients as a')
    //         ->join('kasir_patients as b', 'b.rawat_jalan_patient_id', '=', 'a.id')
    //         ->join('detail_kasir_patients as c', 'c.kasir_patient_id', '=', 'b.id')
    //         ->where('a.queue_id', '=', $suratPengantarRawatJalan->queue_id)
    //         ->select('a.id', 'a.queue_id', 'b.id as id_kasir_patiens', 'b.rawat_jalan_patient_id', 'b.total as total_biaya_rumah_sakit', 'c.name', 'c.kasir_patient_id', 'c.tarif', 'c.id')
    //         ->where('b.status', '=', 'SELESAI')
    //         ->first();




    //     if (!is_null($tarif)) {
    //         if (is_null($cekTindakanIcd)) {
    //             $tarif_inacbgs = TarifInacbg::create([
    //                 'queue_id' => $suratPengantarRawatJalan->queue_id,
    //                 'kasir_patient_id' => $tarif->id_kasir_patiens,
    //                 'status_claim' => 'belum terkirim',
    //                 'sep_id' => $sep->no_sep

    //             ]);
    //             $tindakanIcd = TindakanIcd::create([
    //                 'tarif_inacbg_id' => $tarif_inacbgs->id,
    //                 'jumlah_tarif' => $request->jumlah_tarif_inacbgs,
    //                 'id_ina_cbg' => $request->id_ina_cbg
    //             ]);
    //             $detailTarif = DetailTarifInacbg::create([
    //                 'tindakan_icd_id' => $tindakanIcd->id,
    //                 'sumber_dana' => "Tanggungan BPJS",
    //                 'jumlah_tarif_inacbgs' => $request->jumlah_tarif_inacbgs,
    //                 'jumlah_tarif_rumah_sakit' => $tarif->total_biaya_rumah_sakit
    //             ]);
    //         } else {
    //             $tindakanIcd = TindakanIcd::where('id', '=', $cekTindakanIcd->id_tindakan_icds)->first();
    //             //update tindakan untuk memasukkan jumlah tarif inacbg
    //             $updateData = [
    //                 'jumlah_tarif' => $request->jumlah_tarif_inacbgs,
    //                 'id_ina_cbg' => $request->id_ina_cbg
    //             ];
    //             $tindakanIcd->update($updateData);

    //             $detailTarif = DetailTarifInacbg::where('id', '=', $cekTindakanIcd->id_detail_tarif_inacbgs)->first();
    //             $updateDetail = [
    //                 'jumlah_tarif_inacbgs' => $request->jumlah_tarif_inacbgs,
    //             ];
    //             $detailTarif->update($updateDetail);
    //         }
    //         $idEncrypt = EncryptionHelper::encrypt($suratPengantarRawatJalan->id);
    //         return redirect('/casemix/detail-queue/' . $idEncrypt);
    //     } else {
    //         $idEncrypt = EncryptionHelper::encrypt($suratPengantarRawatJalan->id);
    //         Alert::error('Gagal!', 'Tarif Harga Rumah Sakit Tidak Di Temukan');
    //         return redirect('/casemix/detail-queue/' . $idEncrypt);
    //     }
    // }

    // public function registerClaim(Request $request, $id)
    // {
       
    //     $suratPengantarRawatJalan = SuratPengantarRawatJalanPatient::where('queue_id', '=', $id)->first();
    //     $tarif = DB::table('rawat_jalan_patients as a')
    //         ->join('kasir_patients as b', 'b.rawat_jalan_patient_id', '=', 'a.id')
    //         ->join('detail_kasir_patients as c', 'c.kasir_patient_id', '=', 'b.id')
    //         ->where('a.queue_id', '=', $suratPengantarRawatJalan->queue_id)
    //         ->select('a.id', 'a.queue_id', 'b.id as id_kasir_patiens', 'b.rawat_jalan_patient_id', 'b.total as total_biaya_rumah_sakit', 'c.name', 'c.kasir_patient_id', 'c.tarif', 'c.id')
    //         ->where('b.status', '=', 'SELESAI')
    //         ->first();
    //     //register dilaksanakan jika tarif sudah diinput kasir
    //     if (!is_null($tarif)) {
    //         $tarif_inacbgs = TarifInacbg::create([
    //             'queue_id' => $item->id,
    //             'kasir_patient_id' => $tarif->id_kasir_patiens,
    //             'status_claim' => 'belum terkirim',
    //             'sep_id' => $request->nomor_sep
    //         ]);
    //         $tindakanIcd = TindakanIcd::create([
    //             'tarif_inacbg_id' => $tarif_inacbgs->id
    //         ]);

    //         $detailTarif = DetailTarifInacbg::create([
    //             'sumber_dana' => 'Tanggungan BPJS',
    //             'tindakan_icd_id' =>  $tindakanIcd->id,
    //             'jumlah_tarif_rumah_sakit' => $tarif->total_biaya_rumah_sakit
    //         ]);
    //     } else {
    //         $idEncrypt = EncryptionHelper::encrypt($suratPengantarRawatJalan->id);
    //         Alert::error('Gagal!', 'Tarif Harga Rumah Sakit Tidak Di Temukan');
    //         return redirect('/casemix/detail-queue/' . $idEncrypt);
    //     }
    // }

    // public function groupingDataBase(Request $request, $id)
    // {
    //     $suratPengantarRawatJalan = SuratPengantarRawatJalanPatient::where('queue_id', '=', $id)->first();
    //     $sep = Sep::where('patient_id', '=', $suratPengantarRawatJalan->patient_id)->select('no_sep')->first();
    //     $tarif = DB::table('rawat_jalan_patients as a')
    //         ->join('kasir_patients as b', 'b.rawat_jalan_patient_id', '=', 'a.id')
    //         ->join('detail_kasir_patients as c', 'c.kasir_patient_id', '=', 'b.id')
    //         ->where('a.queue_id', '=', $suratPengantarRawatJalan->queue_id)
    //         ->select('a.id', 'a.queue_id', 'b.id as id_kasir_patiens', 'b.rawat_jalan_patient_id', 'b.total as total_biaya_rumah_sakit', 'c.name', 'c.kasir_patient_id', 'c.tarif', 'c.id')
    //         ->where('b.status', '=', 'SELESAI')
    //         ->first();
    //     $cekTindakanIcd = DB::table('tarif_inacbgs as a')
    //         ->join('tindakan_icds as b', 'a.id', '=', 'b.tarif_inacbg_id')
    //         ->where('a.queue_id', '=', $suratPengantarRawatJalan->queue_id)
    //         ->select('a.id as id_tarif_inacbgs', 'b.id as id_tindakan_icds', 'b.tarif_inacbg_id')->first();
    //     if (!is_null($tarif)) {
    //         if ($request['diagnosa'][0] !== "-") {
    //             foreach ($request['diagnosa'] as $item) {
    //                 $detail_tindakan_inacbgs = DetailTindakanIcd::create([
    //                     'tindakan_icd_id' => $cekTindakanIcd->id_tindakan_icds,
    //                     'diagnosis_patient_id' => $item,

    //                 ]);
    //             }
    //         }
    //         if ($request['tindakan'][0] !== "-") {
    //             foreach ($request['tindakan'] as $item) {
    //                 $detail_tindakan_inacbgs = DetailTindakanIcd::create([
    //                     'tindakan_icd_id' =>  $cekTindakanIcd->id_tindakan_icds,
    //                     'tindakan_patient_id' => $item
    //                 ]);
    //             }
    //         }
    //         $idEncrypt = EncryptionHelper::encrypt($suratPengantarRawatJalan->id);
    //         Alert::success('Berhasil!', 'Coding Berhasil Ditambahkan');
    //         return redirect('/casemix/detail-queue/' . $idEncrypt);
    //     } else {
    //         $idEncrypt = EncryptionHelper::encrypt($suratPengantarRawatJalan->id);
    //         Alert::error('Gagal Grouping!', 'Tarif Harga Rumah Sakit Tidak Di Temukan');
    //         return redirect('/casemix/detail-queue/' . $idEncrypt);
    //     }
    // }

    // public function grouping(Request $request, $id)
    // {
    //     $item = Queue::find($id);
    //     // $suratPengantarRawatJalan = SuratPengantarRawatJalanPatient::with(['patient', 'queue'])->where('queue_id', '=', $id)->first();
    //     // $sep = Sep::where('patient_id', '=', $suratPengantarRawatJalan->patient_id)->select('no_sep')->first();
    //     // dd($sep);
    //     // dd($suratPengantarRawatJalan->queue_id);
    //     // $queue = Queue::with('patient')->where('id', '=', $id)->first();
    //     //cek tarif

    //     $latestSep = DB::table('seps')
    //         ->join('patients', function ($join) {
    //             $join->on('seps.noka', '=', DB::raw('patients.noka COLLATE utf8mb4_unicode_ci'));
    //         })
    //         ->where(DB::raw('seps.noka COLLATE utf8mb4_unicode_ci'), '=', $suratPengantarRawatJalan->patient->noka)
    //         ->select('seps.no_sep', 'seps.id')
    //         ->latest('seps.created_at')
    //         ->first();
    //     $tarif = DB::table('rawat_jalan_patients as a')
    //         ->join('kasir_patients as b', 'b.rawat_jalan_patient_id', '=', 'a.id')
    //         ->join('detail_kasir_patients as c', 'c.kasir_patient_id', '=', 'b.id')
    //         ->where('a.queue_id', '=', $suratPengantarRawatJalan->queue_id)
    //         ->select('a.id', 'a.queue_id', 'b.id as id_kasir_patiens', 'b.rawat_jalan_patient_id', 'b.total as total_biaya_rumah_sakit', 'c.name', 'c.kasir_patient_id', 'c.tarif', 'c.id')
    //         ->where('b.status', '=', 'SELESAI')
    //         ->first();
    //     $cekTindakanIcd = DB::table('tarif_inacbgs as a')
    //         ->join('tindakan_icds as b', 'a.id', '=', 'b.tarif_inacbg_id')
    //         ->where('a.queue_id', '=', $suratPengantarRawatJalan->queue_id)
    //         ->select('a.id as id_tarif_inacbgs', 'b.id as id_tindakan_icds', 'b.tarif_inacbg_id')->first();
    //     if (!is_null($tarif)) {
    //         if (is_null($cekTindakanIcd)) {

    //             $tarif_inacbgs = TarifInacbg::create([
    //                 'queue_id' => $item->id,
    //                 'kasir_patient_id' => $tarif->id_kasir_patiens,
    //                 'status_claim' => 'belum terkirim',
    //                 'sep_id' => $data->no_sep
    //             ]);
    //             $tindakanIcd = TindakanIcd::create([
    //                 'tarif_inacbg_id' => $tarif_inacbgs->id
    //             ]);

    //             $detailTarif = DetailTarifInacbg::create([
    //                 'sumber_dana' => 'Tanggungan BPJS',
    //                 'tindakan_icd_id' =>  $tindakanIcd->id,
    //                 'jumlah_tarif_rumah_sakit' => $tarif->total_biaya_rumah_sakit
    //             ]);

    //             //add detail tindakan dan cek ada ga yg di input
    //             if ($request['diagnosa'][0] !== "-") {
    //                 foreach ($request['diagnosa'] as $item) {
    //                     $detail_tindakan_inacbgs = DetailTindakanIcd::create([
    //                         'tindakan_icd_id' => $tindakanIcd->id,
    //                         'diagnosis_patient_id' => $item
    //                     ]);
    //                 }
    //             }
    //             if ($request['tindakan'][0] !== "-") {
    //                 foreach ($request['tindakan'] as $item) {
    //                     $detail_tindakan_inacbgs = DetailTindakanIcd::create([
    //                         'tindakan_icd_id' => $tindakanIcd->id,
    //                         'tindakan_patient_id' => $item
    //                     ]);
    //                 }
    //             }
    //         } else {
    //             //hanya menambah detail tindakan icd
    //             if ($request['diagnosa'][0] !== "-") {
    //                 foreach ($request['diagnosa'] as $item) {
    //                     $detail_tindakan_inacbgs = DetailTindakanIcd::create([
    //                         'tindakan_icd_id' => $cekTindakanIcd->id_tindakan_icds,
    //                         'diagnosis_patient_id' => $item,

    //                     ]);
    //                 }
    //             }
    //             if ($request['tindakan'][0] !== "-") {
    //                 foreach ($request['tindakan'] as $item) {
    //                     $detail_tindakan_inacbgs = DetailTindakanIcd::create([
    //                         'tindakan_icd_id' =>  $cekTindakanIcd->id_tindakan_icds,
    //                         'tindakan_patient_id' => $item
    //                     ]);
    //                 }
    //             }
    //         }
    //         $idEncrypt = EncryptionHelper::encrypt($suratPengantarRawatJalan->id);

    //         return redirect('/casemix/detail-queue/' . $idEncrypt);
    //     } else {
    //         $idEncrypt = EncryptionHelper::encrypt($suratPengantarRawatJalan->id);
    //         Alert::error('Gagal!', 'Tarif Harga Rumah Sakit Tidak Di Temukan');
    //         return redirect('/casemix/detail-queue/' . $idEncrypt);
    //     }
    // }

    // public function removeDetailTindakan($id)
    // {
    //     $data = DetailTindakanIcd::where('id', '=', $id)->first();
    //     $data->delete();
    //     return redirect()->back()->with('success', 'Berhasil Terhapus');
    // }



   

    // public function codingGrouping()
    // {
    //     $coding = TindakanIcd::with('detailTindakan')->get();
    //     dd($coding);
    //     return view('pages.casemix.coding_group', [
    //         'title' => 'Casemix',
    //         'menu' => 'Laporan',
    //         'coding' => $coding
    //     ]);
    // }


// done
    public function showQueue($id)
    {
        $id = decrypt($id);
        $item = Queue::find($id);
        $itemSep = Seps::where('noka', $item->patient->noka)->latest()->first();

        if ($item->rawatJalanPatient) {
            if ($item->rawatJalanPatient->kasirPatient && $item->rawatJalanPatient->kasirPatient->status == 'SELESAI') {
                $itemKasirPatient = $item->rawatJalanPatient->kasirPatient;
            }
        }

        $icd9s = TindakanPatient::all();
        $icd10s = DiagnosisPatient::all();
        return view('pages.casemix.icd_page', [
            'title' => 'Casemix',
            'menu' => 'Laporan',
            'icd9s' => $icd9s,
            'icd10s' => $icd10s,
            'itemKasirPatient' => $itemKasirPatient,
            'item' => $item,
            'itemSep' => $itemSep
        ]);
    }

    public function tarif(Request $request, $id)
    {
        $non_bedah = 0;
        $bedah = 0;
        $konsultasi = 0;
        $tenaga_ahli = 0;
        $keperawatan = 0;
        $penunjang = 0;
        $radiologi = 0;
        $laboratorium = 0;
        $pelayanan_darah = 0;
        $rehabilitas = 0;
        $kamar = 0;
        $sewa_alat = 0;
        $rawat_intensif = 0;
        $obat = 0;
        $obat_kronis = 0;
        $obat_kemoterapi = 0;
        $alkes = 0;
        $bmhp = 0;

        if ($request->obat_kemoterapi) {
            $obat_kemoterapi = array_sum($request->obat_kemoterapi);
        }
        if ($request->non_bedah) {
            $non_bedah = array_sum($request->non_bedah);
        }
        if ($request->bedah) {
            $bedah = array_sum($request->bedah);
        }
        if ($request->konsultasi) {
            $konsultasi = array_sum($request->konsultasi);
        }
        if ($request->tenaga_ahli) {
            $tenaga_ahli = array_sum($request->tenaga_ahli);
        }
        if ($request->keperawatan) {
            $keperawatan = array_sum($request->keperawatan);
        }
        if ($request->penunjang) {
            $penunjang = array_sum($request->penunjang);
        }
        if ($request->radiologi) {
            $radiologi = array_sum($request->radiologi);
        }
        if ($request->laboratorium) {
            $laboratorium = array_sum($request->laboratorium);
        }
        if ($request->pelayanan_darah) {
            $pelayanan_darah = array_sum($request->pelayanan_darah);
        }
        if ($request->rehabilitas) {
            $rehabilitas = array_sum($request->rehabilitas);
        }
        if ($request->kamar) {
            $kamar = array_sum($request->kamar);
        }
        if ($request->sewa_alat) {
            $sewa_alat = array_sum($request->sewa_alat);
        }
        if ($request->rawat_intensif) {
            $rawat_intensif = array_sum($request->rawat_intensif);
        }
        if ($request->obat) {
            $obat = array_sum($request->obat);
        }
        if ($request->obat_kronis) {
            $obat_kronis = array_sum($request->obat_kronis);
        }
        if ($request->alkes) {
            $alkes = array_sum($request->alkes);
        }
        if ($request->bmhp) {
            $bmhp = array_sum($request->bmhp);
        }

        $data = DB::table('tarif_inacbgs as a')->join('queues as b', 'b.id', '=', 'a.queue_id')
            ->join('patients as c', 'b.patient_id', '=', 'c.id')
            ->join('surat_pengantar_rawat_jalan_patients as d', 'd.patient_id', '=', 'c.id')
            ->join('users as e', 'e.id', '=', 'd.user_id')
            ->where('b.id', '=', $id)
            ->select('e.id', 'e.name', 'e.nik', 'a.sep_id')->get();


        $client = new \GuzzleHttp\Client();
        $response = $client->post($this->urlApi(), [
            'json' => [
                "metadata" => [
                    "method" => "set_claim_data",
                    "nomor_sep" => $data[0]->sep_id
                ],
                "data" => [
                    "nomor_sep" => $data[0]->sep_id,
                    "tarif_rs" => [
                        "prosedur_non_bedah" => $non_bedah,
                        "prosedur_bedah" => $bedah,
                        "konsultasi" => $konsultasi,
                        "tenaga_ahli" => $tenaga_ahli,
                        "keperawatan" => $keperawatan,
                        "penunjang" => $penunjang,
                        "radiologi" => $radiologi,
                        "laboratorium" => $laboratorium,
                        "pelayanan_darah" => $pelayanan_darah,
                        "rehabilitasi" => $rehabilitas,
                        "kamar" => $kamar,
                        "rawat_intensif" => $rawat_intensif,
                        "obat" => $obat,
                        "obat_kronis" => $obat_kronis,
                        "obat_kemoterapi" => $obat_kemoterapi,
                        "alkes" => $alkes,
                        "bmhp" => $bmhp,
                        "sewa_alat" => $sewa_alat
                    ],
                    "payor_id" => "3",
                    "payor_cd" => "JKN",
                    "coder_nik" => "123123123123"
                ]
            ]
        ]);

        $responseBody = json_decode($response->getBody()->getContents(), true);
        if ($responseBody['metadata']['code'] == 200) {
            return redirect()->back()->with('success', 'Tarif Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal Menambahkan Tarif');
        }
    }

    public function showClaim($id)
    {
        // $biodata = DB::table('tarif_inacbgs as a')->join('queues as b', 'a.queue_id', '=', 'b.id')
        //     ->join('patients as c', 'c.id', '=', 'b.patient_id')
        //     ->join('rawat_inap_patients as d', 'd.queue_id', '=', 'b.id')
        //     ->where('a.id', '=', $id)
        //     ->select('a.queue_id', 'b.id', 'c.id', 'b.patient_id', 'c.name', 'd.queue_id', 'c.jenis_kelamin', 'c.alamat', 'c.no_rm', 'd.mulai', 'd.selesai',  'd.queue_id')->first();
        
        $data = DB::table('tarif_inacbgs as a')->join('kasir_patients as b', 'a.kasir_patient_id', '=', 'b.id')
            ->join('detail_kasir_patients as c', 'c.kasir_patient_id', '=', 'b.id')->where('a.id', '=', $id)
            ->select('a.sep_id','a.id', 'a.kasir_patient_id', 'b.id', 'b.rawat_jalan_patient_id', 'c.id', 'c.kasir_patient_id', 'c.name', 'c.tarif', 'b.total', 'c.category')->get();
        

        $client = new \GuzzleHttp\Client();
        $response = $client->post($this->urlApi(), [
            'json' => [
                "metadata" => [
                    "method" => "get_claim_data",
                ],
                "data" => [
                    "nomor_sep" => $data[0]->sep_id,
                ]
            ]
        ]);

        $responseBody = json_decode($response->getBody()->getContents(), true);
        dd($responseBody['response']['data']['tgl_masuk']);
        dd($responseBody);
        if ($responseBody['metadata']['code'] == 200) {
            return view('pages.eKlaim.create', [
                'title' => 'Casemix',
                'menu' => 'Laporan',
                'data' => $data,
                'response' => $responseBody
            ])->with('success', 'Tarif Berhasil Ditambahkan');
        } else {
            return view('pages.eKlaim.create', [
                'title' => 'Casemix',
                'menu' => 'Laporan',
                'data' => $data,
            ])->with('error', 'Gagal Menambahkan Tarif');
            // return redirect()->back()->with('error', 'Gagal Menambahkan Tarif');
        }

    }

    // public function updateDataClaim($id)
    // {
    //     $data = DB::table('tarif_inacbgs as a')->join('queues as b', 'b.id', '=', 'a.queue_id')
    //         ->join('patients as c', 'b.patient_id', '=', 'c.id')
    //         ->join('surat_pengantar_rawat_jalan_patients as d', 'd.patient_id', '=', 'c.id')
    //         ->join('users as e', 'e.id', '=', 'd.user_id')
    //         ->where('b.id', '=', $id)
    //         ->select('e.id', 'e.name', 'e.nik', 'a.sep_id')->get();
    //     $diagnosis = DB::table('tarif_inacbgs as a')->join('tindakan_icds as b', 'b.tarif_inacbg_id', '=', 'a.id')
    //         ->join('detail_tindakan_icds as c', 'c.tindakan_icd_id', '=', 'b.id')
    //         ->join('diagnosis_patients as d', 'd.id', '=', 'c.diagnosis_patient_id')
    //         ->where('a.queue_id', '=', $id)
    //         ->where('c.tindakan_patient_id', '=', null)
    //         ->select('d.code', 'd.name', 'a.sep_id')
    //         ->get();
    //     $tindakan = DB::table('tarif_inacbgs as a')->join('tindakan_icds as b', 'b.tarif_inacbg_id', '=', 'a.id')
    //         ->join('detail_tindakan_icds as c', 'c.tindakan_icd_id', '=', 'b.id')
    //         ->join('tindakan_patients as d', 'd.id', '=', 'c.tindakan_patient_id')
    //         ->where('a.queue_id', '=', $id)
    //         ->where('c.diagnosis_patient_id', '=', null)
    //         ->select('d.icd', 'd.name')
    //         ->get();
    //     $data_tindakan = "";
    //     $data_diagnosis = "";
    //     if ($tindakan->isEmpty()) {
    //         $data_tindakan = "#";
    //     } else {
    //         $data_tindakan = implode('#', array_column($tindakan->toArray(), 'icd'));
    //     }
    //     if ($diagnosis->isEmpty()) {
    //         $data_diagnosis = "#";
    //     } else {
    //         $data_diagnosis = implode('#', array_column($diagnosis->toArray(), 'code'));
    //     }

    //     $client = new \GuzzleHttp\Client();
    //     $response = $client->post($this->urlApi(), [
    //         'json' => [
    //             "metadata" => [
    //                 "method" => "set_claim_data",
    //                 "nomor_sep" => $data[0]->sep_id
    //             ],
    //             "data" => [
    //                 "nomor_sep" => $data[0]->sep_id,
    //                 "nomor_kartu" => "12345678",
    //                 "tgl_masuk" => "2017-11-20 12:55:00",
    //                 "tgl_pulang" => "2017-12-01 09:55:00",
    //                 "jenis_rawat" => "1",
    //                 "diagnosa" =>  $data_diagnosis,
    //                 "procedure" => $data_tindakan,
    //                 "nama_dokter" => $data[0]->nik,
    //                 "payor_id" => "3",
    //                 "payor_cd" => "JKN",
    //                 "coder_nik" => "123123123123"
    //             ]
    //         ]
    //     ]);
    //     $responseBody = json_decode($response->getBody()->getContents(), true);
    //     if ($responseBody['metadata']['code'] == 200) {
    //         return redirect()->back()->with('success', 'Coding Berhasil DItambahkan');
    //     } else {
    //         return redirect()->back()->with('error', 'Gagal Menambahkan Coding');
    //     }
    // }



    // public function delete($id)
    // {
    //     $tindakanInaCbg = TindakanIcd::select('id', 'tarif_inacbg_id')->where('id', '=', $id)->first();
    //     $tarifInaCbg = TarifInacbg::select('id', 'queue_id')->where('id', '=', $tindakanInaCbg->id)->first();
    //     $detailTarif = DetailTarifInacbg::select('id', 'tindakan_icd_id')->where('tindakan_icd_id', '=', $tindakanInaCbg->id)->first();
    //     $detailTindakan = DetailTindakanIcd::select('id', 'tindakan_icd_id')->where('tindakan_icd_id', '=', $tindakanInaCbg->id)->get();
    //     $suratPengantarRawatJalan = SuratPengantarRawatJalanPatient::with(['patient', 'user'])->where('queue_id', '=', $tarifInaCbg->queue_id)->first();
    //     $client = new \GuzzleHttp\Client();
    //     if ($tindakanInaCbg && $tarifInaCbg &&  $detailTarif && $detailTindakan) {
    //         $response = $client->post($this->urlApi(), [
    //             'json' => [
    //                 "metadata" => [
    //                     "method" => "delete_patient",
    //                 ],
    //                 "data" => [
    //                     "nomor_rm" => $suratPengantarRawatJalan->patient->no_rm,
    //                     "coder_nik" => $suratPengantarRawatJalan->user->nik
    //                 ]
    //             ]
    //         ]);
    //         $responseBody = json_decode($response->getBody()->getContents(), true);
    //         if ($responseBody['metadata']['code'] == 200) {
    //             $tindakanInaCbg->delete();
    //             $tarifInaCbg->delete();
    //             $detailTarif->delete();
    //             if (!is_null($detailTindakan)) {
    //                 foreach ($detailTindakan as $item) {
    //                     $item->delete();
    //                 }
    //             }
    //             return redirect()->back()->with('success', 'Coding Berhasil DItambahkan');
    //         } else {
    //             return redirect()->back()->with('error', 'Gagal Menambahkan Coding');
    //         }
    //     }
    // }





    // public function updateClaim(Request $request)
    // {
    //     $client = new \GuzzleHttp\Client();
    //     $response = $client->post($this->urlApi(), [
    //         'json' => [
    //             "metadata" => [
    //                 "method" => "set_claim_data",
    //                 "nomor_sep" => $request->nomor_sep
    //             ],
    //             "data" => [
    //                 "nomor_sep" => $request->nomor_sep,
    //                 "nomor_kartu" => $request->nomor_kartu,
    //                 "tgl_masuk" => "2017-11-20 12:55:00",
    //                 "tgl_pulang" => "2017-12-01 09:55:00",
    //                 "jenis_rawat" => "1",
    //                 "kelas_rawat" => "1",
    //                 "adl_sub_acute" => "15",
    //                 "adl_chronic" => "12",
    //                 "icu_indikator" => "1",
    //                 "icu_los" => "2",
    //                 "ventilator_hour" => "5",
    //                 "upgrade_class_ind" => "1",
    //                 "upgrade_class_class" => "vip",
    //                 "upgrade_class_los" => "5",
    //                 "add_payment_pct" => "35",
    //                 "birth_weight" => "0",
    //                 "discharge_status" => "1",
    //                 "diagnosa" => "S71.0#A00.1",
    //                 "procedure" => "81.52#88.38",
    //                 "tarif_rs" => [
    //                     "prosedur_non_bedah" => "300000",
    //                     "prosedur_bedah" => "20000000",
    //                     "konsultasi" => "300000",
    //                     "tenaga_ahli" => "200000",
    //                     "keperawatan" => "80000",
    //                     "penunjang" => "1000000",
    //                     "radiologi" => "500000",
    //                     "laboratorium" => "600000",
    //                     "pelayanan_darah" => "150000",
    //                     "rehabilitasi" => "100000",
    //                     "kamar" => "6000000",
    //                     "rawat_intensif" => "2500000",
    //                     "obat" => "100000",
    //                     "obat_kronis" => "1000000",
    //                     "obat_kemoterapi" => "5000000",
    //                     "alkes" => "500000",
    //                     "bmhp" => "400000",
    //                     "sewa_alat" => "210000"
    //                 ],
    //                 "tarif_poli_eks" => "100000",
    //                 "nama_dokter" => "RUDY, DR",
    //                 "kode_tarif" => "CS",
    //                 "payor_id" => "3",
    //                 "payor_cd" => "JKN",
    //                 "cob_cd" => "0001",
    //                 "coder_nik" => "123123123123"
    //             ]
    //         ]
    //     ]);
    //     $responseBody = json_decode($response->getBody()->getContents(), true);
    //     if ($responseBody['metadata']['code'] == 200) {
    //         return redirect()->back()->with('success', 'Berhasil Update Claim');
    //     } else {
    //         return redirect()->back()->with('error', 'Gagal Update Claim');
    //     }
    // }
}
