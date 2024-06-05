<?php

namespace App\Http\Controllers\arg01;

use App\Http\Controllers\Controller;
use App\Services\Bpjs\VClaim;
use Illuminate\Http\Request;
use App\Models\arg01\Seps;
use App\Models\arg01\SepUpdatePulangs;

class SepUpdatePulangController extends Controller
{
    protected $dataVclaim;

    public function __construct() {
        $this->dataVclaim = new VClaim;
    }

    /**
     * halaman create tanggal pulang
     */
    public function createTanggalPulang($idSep)
    {
        $idDec = decrypt($idSep);
        $dataSep = Seps::where('id', $idDec)->first();

        $status = [
            ['id' => 1, 'nama' => 'Atas Persetujuan Dokter'], 
            ['id' => 3, 'nama' => 'Atas Permintaan Sendiri'],
            ['id' => 4, 'nama' => 'Meninggal'],
            ['id' => 5, 'nama' => 'Lain-lain'],
        ];

        return view('arg01.update-pulang.form', [
            'title' => 'list-sep',
            'menu' => 'SEP',
            'dataSep' => $dataSep,
            'status' => $status,
        ]);
    }

    /**
     * simpan data update tanggal pulang
     * VClaim > SEP > Update Tgl Pulang SEP
     */
    public function simpanTanggalPulang(Request $request){
        try {
            $user = auth()->user();
            $dataRequest = [
                "request" => [
                    "t_sep" => [
                        "noSep" => $request->dataRequestSistem['noSep'],
                        "statusPulang" => $request->dataRequestSistem['kdStatusPulang'],
                        "noSuratMeninggal" => $request->dataRequestSistem['noSuratMeninggal'] ?? "",
                        "tglMeninggal" => $request->dataRequestSistem['tglMeninggal'] ?? "",
                        "tglPulang" => $request->dataRequestSistem['tglPulang'],
                        "noLPManual" => $request->dataRequestSistem['noLPManual'] ?? "",
                        "user" => $user->name,
                    ],
                ],
            ];
            $dataRequest = json_encode($dataRequest);
            $tglPulang = $this->dataVclaim->putTglPulang($dataRequest);
            
            if (!empty($tglPulang)) {
                $data = json_decode($tglPulang, true);
                $dataUpdatePulang = [];

                if($data['metaData']['code'] == 200){
                    $updatePulang = SepUpdatePulangs::where('id_seps', $request->dataRequestSistem['idSeps'])->first();
                    if($updatePulang){
                        $updatePulang->update([
                            'kd_status_pulang' => $request->dataRequestSistem['kdStatusPulang'],
                            'status_pulang' => $request->dataRequestSistem['namaStatusPulang'],
                            'no_surat_meninggal' => $request->dataRequestSistem['noSuratMeninggal'],
                            'tgl_meninggal' => $request->dataRequestSistem['tglMeninggal'],
                            'tgl_pulang' => $request->dataRequestSistem['tglPulang'],
                            'no_lp_manual' => $request->dataRequestSistem['noLPManual'],
                        ]);
                    }else{
                        $dataUpdatePulang = SepUpdatePulangs::create([
                            'id_seps' => $request->dataRequestSistem['idSeps'],
                            'no_sep' => $request->dataRequestSistem['noSep'],
                            'kd_status_pulang' => $request->dataRequestSistem['kdStatusPulang'],
                            'status_pulang' => $request->dataRequestSistem['namaStatusPulang'],
                            'no_surat_meninggal' => $request->dataRequestSistem['noSuratMeninggal'],
                            'tgl_meninggal' => $request->dataRequestSistem['tglMeninggal'],
                            'tgl_pulang' => $request->dataRequestSistem['tglPulang'],
                            'no_lp_manual' => $request->dataRequestSistem['noLPManual'],
                            'user' => $user->name,
                        ]);
                    }
                }

                return response()->json(['data' => $data, 'sepDataPulang' => $dataUpdatePulang], 200);
            } else {
                return response()->json(['error' => 'Data peserta tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }
}