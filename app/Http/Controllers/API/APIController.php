<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APIController extends Controller
{

    public function PostData(Request $request)
    {
        $token = '#testingToken';
        $header = $request->header('token');
        $no_sep = $request->input('no_sep');
        // data
        $nomor_kartu = $request->input('nomor_kartu');
        $tgl_masuk =  $request->input('tgl_masuk');
        $tgl_pulang = $request->input('tgl_pulang');
        $jenis_rawat = $request->input('jenis_rawat');
        $kelas_rawat = $request->input('kelas_rawat');
        $adl_sub_acute = $request->input('adl_sub_acute');
        $adl_chronic = $request->input('adl_chronic');
        $icu_indikator = $request->input('icu_indikator');
        $icu_los = $request->input('icu_los');
        $ventilator_hour = $request->input('ventilator_hour');
        $upgrade_class_ind = $request->input('upgrade_class_ind');
        $upgrade_class_class = $request->input('upgrade_class_class');
        $upgrade_class_los = $request->input('upgrade_class_los');
        $add_payment_pct = $request->input('add_payment_pct');
        $birth_weight = $request->input('birth_weight');
        $discharge_status = $request->input('discharge_status');
        $diagnosa = $request->input('diagnosa');
        $procedure = $request->input('procedure');
        // tarifRS
        $prosedur_non_bedah = $request->input('prosedur_non_bedah');
        $prosedur_bedah = $request->input('prosedur_bedah');
        $konsultasi = $request->input('konsultasi');
        $tenaga_ahli = $request->input('tenaga_ahli');
        $keperawatan = $request->input('keperawatan');
        $penunjang = $request->input('penunjang');
        $radiologi = $request->input('radiologi');
        $laboratorium = $request->input('laboratorium');
        $pelayanan_darah = $request->input('pelayanan_darah');
        $rehabilitasi = $request->input('rehabilitasi');
        $kamar = $request->input('kamar');
        $rawat_intensif = $request->input('rawat_intensif');
        $obat = $request->input('obat');
        $obat_kronis = $request->input('obat_kronis');
        $obat_kemoterapi = $request->input('obat_kemoterapi');
        $alkes = $request->input('alkes');
        $bmhp = $request->input('bmhp');
        $sewa_alat = $request->input('sewa_alat');
        // ekternal
        $tarif_poli_eks = $request->input('tarif_poli_eks');
        $nama_dokter = $request->input('nama_dokter');
        $kode_tarif = $request->input('kode_tarif');
        $payor_id = $request->input('payor_id');
        $payor_cd = $request->input('payor_cd');
        $cob_cd = $request->input('cob_cd');
        $coder_nik = $request->input('coder_nik');


        $result = [
            'metadata' => [
                'method' => 'set_claim_data',
                'nomor_sep' => $no_sep
            ],
            'data' => [
                'nomor_sep' => $no_sep,
                'nomor_kartu' => $nomor_kartu,
                'tgl_masuk' => $tgl_masuk,
                'tgl_pulang' => $tgl_pulang,
                'jenis_rawat' => $jenis_rawat,
                'kelas_rawat' => $kelas_rawat,
                'adl_sub_acute' => $adl_sub_acute,
                'adl_chronic' => $adl_chronic,
                'icu_indikator' => $icu_indikator,
                'icu_los' => $icu_los,
                'ventilator_hour' => $ventilator_hour,
                'upgrade_class_ind' => $upgrade_class_ind,
                'upgrade_class_class' => $upgrade_class_class,
                'upgrade_class_los' => $upgrade_class_los,
                'add_payment_pct' => $add_payment_pct,
                'birth_weight' => $birth_weight,
                'discharge_status' => $discharge_status,
                'diagnosa' => $diagnosa,
                'procedure' => $procedure,
                'tarif_rs' => [
                    'prosedur_non_bedah' => $prosedur_non_bedah,
                    'prosedur_bedah' => $prosedur_bedah,
                    'konsultasi' => $konsultasi,
                    'tenaga_ahli' => $tenaga_ahli,
                    'keperawatan' => $keperawatan,
                    'penunjang' => $penunjang,
                    'radiologi' => $radiologi,
                    'laboratorium' => $laboratorium,
                    'pelayanan_darah' => $pelayanan_darah,
                    'rehabilitasi' => $rehabilitasi,
                    'kamar' => $kamar,
                    'rawat_intensif' => $rawat_intensif,
                    'obat' => $obat,
                    'obat_kronis' => $obat_kronis,
                    'obat_kemoterapi' => $obat_kemoterapi,
                    'alkes' => $alkes,
                    'bmhp' => $bmhp,
                    'sewa_alat' => $sewa_alat
                ],
                'tarif_poli_eks' => $tarif_poli_eks,
                'nama_dokter' => $nama_dokter,
                'kode_tarif' => $kode_tarif,
                'payor_id' => $payor_id,
                'payor_cd' => $payor_cd,
                'cob_cd' => $cob_cd,
                'coder_nik' => $coder_nik
            ]
        ];
        if ($token == $header) {
            return response()->json([
                'result' => $result,
                'message' => 'Berhasil'
            ]);
        } else {
            return response()->json([
                'status' => '400',
                'message' => 'Terjadi Kesalahan, Periksa Token Anda',
            ]);
        }
    }
}
