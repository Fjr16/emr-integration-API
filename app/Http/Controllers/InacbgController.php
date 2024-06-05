<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Queue;
use App\Models\arg01\Seps;
use App\Models\TarifInacbg;
use App\Models\TindakanIcd;
use Illuminate\Http\Request;
use App\Models\DetailTarifInacbg;
use App\Traits\InaCbgRequestTrait;
use App\Models\claimCaseMixPatient;
use App\Models\SuratPengantarRawatJalanPatient;

class InacbgController extends Controller
{
    use InaCbgRequestTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getCrsf()
    {
        $data = csrf_token();
        return response()->json($data);
    }

    public function registerClaim(Request $request, $id)
    {
        $data = $this->validate($request, [
            'nomor_kartu' => 'required',
            'nomor_sep' => 'required',
            'nama_pasien' => 'required',
            'nomor_rm' => 'required',
            'tgl_lahir' => 'required',
            'gender' => 'required',
        ]);

        $dump = new DateTime($data['tgl_lahir']);
        $tgl_lhr = $dump->format('Y-m-d h:i:s');

        $payload = [
            'metadata' => [
                'method' => 'new_claim',
            ],
            'data' => [
                'nomor_kartu' => $data['nomor_kartu'],
                'nomor_sep' => $data['nomor_sep'],
                'nomor_rm' => $data['nomor_rm'],
                'nama_pasien' => $data['nama_pasien'],
                'tgl_lahir' => $tgl_lhr,
                'gender' => $data['gender'],
            ]
        ];

        $json_request = json_encode($payload);
        $response = $this->makeRequestToInacbg($json_request);

        if ($response['metadata']['code'] == 200) {
            claimCaseMixPatient::create([
                'queue_id' => $id,
                'patient_id' => $request->patient_id,
                'admission_id' => $response['response']['admission_id'],
                'hospital_admission_id' => $response['response']['hospital_admission_id'],
                'nomor_sep' => $request->nomor_sep,
                'nomor_rm' => $request->nomor_rm,
                'nama_pasien' => $request->nama_pasien,
                'tgl_lahir' => $request->tgl_lahir,
                'gender' => $request->gender,
                'nomor_kartu' => $request->nomor_kartu,
            ]);
            // return $response;
            // return $response['metadata']['code'];
            return back()->with('success', 'Berhasil Register Claim');
        } else {
            // return $response;
            // return $response['metadata']['code'];
            return back()->with('error', 'Gagal Register Claim, SEP Duplicate');
        }
    }

    public function updateClaim(Request $request, $id)
    {
        $item = Queue::find($id);
        $itemSep = Seps::where('noka', $item->patient->noka)->latest()->first();

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

        // if ($request->obat_kemoterapi) {
        //     $obat_kemoterapi = array_sum($request->obat_kemoterapi);
        // }
        // if ($request->non_bedah) {
        //     $non_bedah = array_sum($request->non_bedah);
        // }
        // if ($request->bedah) {
        //     $bedah = array_sum($request->bedah);
        // }
        // if ($request->konsultasi) {
        //     $konsultasi = array_sum($request->konsultasi);
        // }
        // if ($request->tenaga_ahli) {
        //     $tenaga_ahli = array_sum($request->tenaga_ahli);
        // }
        // if ($request->keperawatan) {
        //     $keperawatan = array_sum($request->keperawatan);
        // }
        // if ($request->penunjang) {
        //     $penunjang = array_sum($request->penunjang);
        // }
        // if ($request->radiologi) {
        //     $radiologi = array_sum($request->radiologi);
        // }
        // if ($request->laboratorium) {
        //     $laboratorium = array_sum($request->laboratorium);
        // }
        // if ($request->pelayanan_darah) {
        //     $pelayanan_darah = array_sum($request->pelayanan_darah);
        // }
        // if ($request->rehabilitas) {
        //     $rehabilitas = array_sum($request->rehabilitas);
        // }
        // if ($request->kamar) {
        //     $kamar = array_sum($request->kamar);
        // }
        // if ($request->sewa_alat) {
        //     $sewa_alat = array_sum($request->sewa_alat);
        // }
        // if ($request->rawat_intensif) {
        //     $rawat_intensif = array_sum($request->rawat_intensif);
        // }
        // if ($request->obat) {
        //     $obat = array_sum($request->obat);
        // }
        // if ($request->obat_kronis) {
        //     $obat_kronis = array_sum($request->obat_kronis);
        // }
        // if ($request->alkes) {
        //     $alkes = array_sum($request->alkes);
        // }
        // if ($request->bmhp) {
        //     $bmhp = array_sum($request->bmhp);
        // }

        $data = [
            "metadata" => [
                "method" => "set_claim_data",
                "nomor_sep" => $item->claimCaseMixPatient->nomor_sep ?? $itemSep->no_sep
            ],
            "data" => [
                "nomor_sep" => $item->claimCaseMixPatient->nomor_sep ?? $itemSep->no_sep,
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
        ];

        $json_request = json_encode($data);
        dd($data);
        $response = $this->makeRequestToInacbg($json_request);

        if ($response['metadata']['code'] == 200) {
            return redirect()->back()->with('success', 'Berhasil Update Claim');
        } else {
            return redirect()->back()->with('error', 'Gagal Update Claim');
        }
    }
}
