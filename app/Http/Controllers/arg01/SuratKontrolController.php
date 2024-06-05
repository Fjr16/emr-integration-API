<?php

namespace App\Http\Controllers\arg01;

use App\Models\arg01\LogVclaims;
use App\Models\arg01\SuratKontrols;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Bpjs\VClaim;

class SuratKontrolController extends Controller
{
    protected $dataVclaim;

    public function __construct() {
        $this->dataVclaim = new VClaim;
    }

    /**
     * halaman index surat kontrol
     */
    public function indexKontrol()
    {
        $dataKontrol = SuratKontrols::where('jenis_surat', 'kontrol')->orderBy('id', 'desc')->get();

        return view('arg01.kontrol.index', [
            'title' => 'Kontrol Rawat Jalan',
            'menu' => 'Kontrol',
            'models' => $dataKontrol,
        ]);
    }

    /**
     * halaman create form surat kontrol
     */
    public function createKontrol()
    {
        return view('arg01.kontrol.create', [
            'title' => 'Kontrol Rawat Jalan',
            'menu' => 'Kontrol',
        ]);
    }

    /**
     * Get data poli tujuan 
     * VClaim > Rencana Kontrol > Data Poli/Spesialistik
     */
    public function dataPoliRencanaKontrol(Request $request) {
        try {
            $poliRencanaKontrol = $this->dataVclaim->getDataPoliRencanaKontrol($request->jenis, $request->nomor, $request->tgl);
            
            if (!empty($poliRencanaKontrol)) {
                $data = json_decode($poliRencanaKontrol, true);
                return response()->json(['data' => $data], 200);
            } else {
                return response()->json(['error' => 'Data peserta tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Get data dokter penanggung jawab kontrol 
     * VClaim > Rencana Kontrol > Data Dokter
     */
    public function dataDokterRencanaKontrol(Request $request) {
        try {
            $dokter = $this->dataVclaim->getDataDokterRencanaKontrol($request->jenis, $request->kodePoli, $request->tgl);
            
            if (!empty($dokter)) {
                $data = json_decode($dokter, true);
                return response()->json(['data' => $data], 200);
            } else {
                return response()->json(['error' => 'Data peserta tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Create surat kontrol rawat jalan
     */
    public function suratKontrol(Request $request) {
        try {
            $user = auth()->user();
            $dataRequest = [
                "request" => [
                    "noSEP" => $request->dataRequest['noSEP'],
                    "kodeDokter" => $request->dataRequest['kodeDokter'],
                    "poliKontrol" => $request->dataRequest['poliKontrol'],
                    "tglRencanaKontrol" => $request->dataRequest['tglRencanaKontrol'],
                    "user" => $user->name
                ],
            ];
            $dataRequest = json_encode($dataRequest);
            $kontrol = $this->dataVclaim->postRencanaKontrol($dataRequest);
            
            if (!empty($kontrol)) {
                $data = json_decode($kontrol, true);
                $suratKontrol = [];

                if($data['metaData']['code'] == 200){
                    $jenisKelamin = "";
                    if($data['response']['kelamin'] == "L"){
                        $jenisKelamin = "Laki-laki";
                    }else if($data['response']['kelamin'] == "P"){
                        $jenisKelamin = "Perempuan";
                    }else{
                        $jenisKelamin = $data['response']['kelamin'];
                    }

                    $kodeDiagnosa = "";
                    $kode = explode(' - ', $data['response']['namaDiagnosa']);
                    $kodeDiagnosa = $kode[0];
                    
                    $suratKontrol = SuratKontrols::create([
                        'no_surat' => $data['response']['noSuratKontrol'],
                        'jenis_surat' => "kontrol",
                        'no_sep' => $request->dataRequest['noSEP'],
                        'noka' => $data['response']['noKartu'],
                        'tgl_kontrol' => $request->dataRequest['tglRencanaKontrol'],
                        'kd_dokter' => $request->dataRequest['kodeDokter'],
                        'nama_dokter' => $request->dataRequest['nama_dokter'],
                        'kd_poli' => $request->dataRequest['poliKontrol'],
                        'poli_kontrol' => $request->dataRequest['nm_poli_tujuan'],
                        'nama_pasien' => $data['response']['nama'],
                        'jns_kelamin' => $jenisKelamin,
                        'tgl_lahir' => $data['response']['tglLahir'],
                        'kd_diagnosa' => $kodeDiagnosa,
                        'diagnosa' => $data['response']['namaDiagnosa'],
                        'user' => $user->name,
                    ]);
    
                }

                return response()->json([
                    'data' => $data,
                    'surat_kontrol' => $suratKontrol,
                ], 200);
            } else {
                return response()->json(['error' => 'Data peserta tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }

    /**
     * halaman edit surat kontrol
     */
    public function editKontrol($id)
    {
        $dataKontrol = SuratKontrols::where('id', decrypt($id))->first();

        return view('arg01.kontrol.edit', [
            'title' => 'Kontrol Rawat Jalan',
            'menu' => 'Kontrol',
            'model' => $dataKontrol,
        ]);
    }

    /**
     * Update surat kontrol rawat jalan
     */
    public function updateData(Request $request) {
        try {
            $user = auth()->user();
            $dataRequest = [
                "request" => [
                    "noSuratKontrol" => $request->dataRequest['noSuratKontrol'],
                    "noSEP" => $request->dataRequest['noSEP'],
                    "kodeDokter" => $request->dataRequest['kodeDokter'],
                    "poliKontrol" => $request->dataRequest['poliKontrol'],
                    "tglRencanaKontrol" => $request->dataRequest['tglRencanaKontrol'],
                    "user" => $user->name
                ],
            ];
            $dataRequest = json_encode($dataRequest);
            $kontrol = $this->dataVclaim->putRencanaKontrol($dataRequest);
            
            if (!empty($kontrol)) {
                $data = json_decode($kontrol, true);
                $suratKontrol = [];

                if($data['metaData']['code'] == 200){
                    $jenisKelamin = "";
                    if($data['response']['kelamin'] == "L"){
                        $jenisKelamin = "Laki-laki";
                    }else if($data['response']['kelamin'] == "P"){
                        $jenisKelamin = "Perempuan";
                    }else{
                        $jenisKelamin = $data['response']['kelamin'];
                    }

                    $kodeDiagnosa = "";
                    $kode = explode(' - ', $data['response']['namaDiagnosa']);
                    $kodeDiagnosa = $kode[0];

                    $suratKontrol = SuratKontrols::find($request->dataRequest['id']);
                    $suratKontrol->update([
                        'no_sep' => $request->dataRequest['noSEP'],
                        'noka' => $data['response']['noKartu'],
                        'tgl_kontrol' => $request->dataRequest['tglRencanaKontrol'],
                        'kd_dokter' => $request->dataRequest['kodeDokter'],
                        'nama_dokter' => $request->dataRequest['nama_dokter'],
                        'kd_poli' => $request->dataRequest['poliKontrol'],
                        'poli_kontrol' => $request->dataRequest['nm_poli_tujuan'],
                        'nama_pasien' => $data['response']['nama'],
                        'jns_kelamin' => $jenisKelamin,
                        'tgl_lahir' => $data['response']['tglLahir'],
                        'kd_diagnosa' => $kodeDiagnosa,
                        'diagnosa' => $data['response']['namaDiagnosa'],
                        'user' => $user->name,
                    ]);
    
                }

                return response()->json([
                    'data' => $data,
                    'surat_kontrol' => $suratKontrol,
                ], 200);
            } else {
                return response()->json(['error' => 'Data peserta tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }


    /**
     * halaman index SPRI
     */
    public function indexSPRI()
    {
        $dataKontrol = SuratKontrols::where('jenis_surat', 'spri')->orderBy('id', 'desc')->get();

        return view('arg01.kontrol.index', [
            'title' => 'SPRI',
            'menu' => 'Kontrol',
            'models' => $dataKontrol,
        ]);
    }

    /**
     * halaman create form SPRI
     */
    public function createSPRI()
    {
        return view('arg01.kontrol.create', [
            'title' => 'SPRI',
            'menu' => 'Kontrol',
        ]);
    }


    /**
     * Create SPRI
     */
    public function suratSPRI(Request $request) {
        try {
            $user = auth()->user();
            $dataRequest = [
                "request" => [
                    "noKartu" => $request->dataRequest['noSEP'],
                    "kodeDokter" => $request->dataRequest['kodeDokter'],
                    "poliKontrol" => $request->dataRequest['poliKontrol'],
                    "tglRencanaKontrol" => $request->dataRequest['tglRencanaKontrol'],
                    "user" => $user->name,
                ],
            ];
            $dataRequest = json_encode($dataRequest);
            $spri = $this->dataVclaim->postSPRI($dataRequest);
            
            if (!empty($spri)) {
                $data = json_decode($spri, true);
                $suratSPRI = [];

                if($data['metaData']['code'] == 200){
                    $jenisKelamin = "";
                    if($data['response']['kelamin'] == "L"){
                        $jenisKelamin = "Laki-laki";
                    }else if($data['response']['kelamin'] == "P"){
                        $jenisKelamin = "Perempuan";
                    }else{
                        $jenisKelamin = $data['response']['kelamin'];
                    }

                    $kodeDiagnosa = "";
                    $kode = explode(' - ', $data['response']['namaDiagnosa']);
                    $kodeDiagnosa = $kode[0];
                    
                    $suratSPRI = SuratKontrols::create([
                        'no_surat' => $data['response']['noSPRI'],
                        'jenis_surat' => "spri",
                        'noka' => $data['response']['noKartu'],
                        'tgl_kontrol' => $request->dataRequest['tglRencanaKontrol'],
                        'kd_dokter' => $request->dataRequest['kodeDokter'],
                        'nama_dokter' => $request->dataRequest['nama_dokter'],
                        'kd_poli' => $request->dataRequest['poliKontrol'],
                        'poli_kontrol' => $request->dataRequest['nm_poli_tujuan'],
                        'nama_pasien' => $data['response']['nama'],
                        'jns_kelamin' => $jenisKelamin,
                        'tgl_lahir' => $data['response']['tglLahir'],
                        'kd_diagnosa' => $kodeDiagnosa,
                        'diagnosa' => $data['response']['namaDiagnosa'],
                        'user' => $user->name,
                    ]);
    
                }

                return response()->json([
                    'data' => $data,
                    'surat_kontrol' => $suratSPRI,
                ], 200);
            } else {
                return response()->json(['error' => 'Data tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }

    /**
     * halaman edit SPRI
     */
    public function editSPRI($id)
    {
        $dataSPRI = SuratKontrols::where('id', $id)->first();

        return view('arg01.kontrol.edit', [
            'title' => 'SPRI',
            'menu' => 'Kontrol',
            'model' => $dataSPRI,
        ]);
    }

    /**
     * Update SPRI
     */
    public function spriUpdate(Request $request) {
        try {
            $user = auth()->user();
            $dataRequest = [
                "request" => [
                    "noSPRI" => $request->dataRequest['noSuratKontrol'],
                    "kodeDokter" => $request->dataRequest['kodeDokter'],
                    "poliKontrol" => $request->dataRequest['poliKontrol'],
                    "tglRencanaKontrol" => $request->dataRequest['tglRencanaKontrol'],
                    "user" => $user->name
                ],
            ];
            $dataRequest = json_encode($dataRequest);
            $spriUpdate = $this->dataVclaim->putSPRI($dataRequest);
            
            if (!empty($spriUpdate)) {
                $data = json_decode($spriUpdate, true);
                $spriData = [];

                if($data['metaData']['code'] == 200){
                    $jenisKelamin = "";
                    if($data['response']['kelamin'] == "L"){
                        $jenisKelamin = "Laki-laki";
                    }else if($data['response']['kelamin'] == "P"){
                        $jenisKelamin = "Perempuan";
                    }else{
                        $jenisKelamin = $data['response']['kelamin'];
                    }

                    $kodeDiagnosa = "";
                    $kode = explode(' - ', $data['response']['namaDiagnosa']);
                    $kodeDiagnosa = $kode[0];

                    $spriData = SuratKontrols::find($request->dataRequest['id']);
                    $spriData->update([
                        'noka' => $data['response']['noKartu'],
                        'tgl_kontrol' => $request->dataRequest['tglRencanaKontrol'],
                        'kd_dokter' => $request->dataRequest['kodeDokter'],
                        'nama_dokter' => $request->dataRequest['nama_dokter'],
                        'kd_poli' => $request->dataRequest['poliKontrol'],
                        'poli_kontrol' => $request->dataRequest['nm_poli_tujuan'],
                        'nama_pasien' => $data['response']['nama'],
                        'jns_kelamin' => $jenisKelamin,
                        'tgl_lahir' => $data['response']['tglLahir'],
                        'kd_diagnosa' => $kodeDiagnosa,
                        'diagnosa' => $data['response']['namaDiagnosa'],
                        'user' => $user->name,
                    ]);
                }

                return response()->json([
                    'data' => $data,
                    'surat_kontrol' => $spriData,
                ], 200);
            } else {
                return response()->json(['error' => 'Data peserta tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Delete data rencana kontrol
     */
    public function delDataKontrol($nomor) {
        try { 
            $user = auth()->user();
            $dataRequest = [
                "request" => [
                    "t_suratkontrol" => [
                        "noSuratKontrol" => decrypt($nomor),
                        "user" => $user->name,
                    ],
                ],
            ];
            $dataRequest = json_encode($dataRequest);
            $deleteSurat = $this->dataVclaim->deleteSuratKontrol($dataRequest);
            
            if (!empty($deleteSurat)) {
                $data = json_decode($deleteSurat, true);
                $logVclaim = [];

                if($data['metaData']['code'] == 200){
                    $logVclaim = LogVclaims::create([
                        'no_surat' => decrypt($nomor),
                        'kategori' => "Rencana Kontrol",
                        'user' => $user->name,
                    ]);
                    
                    $dataKontrol = SuratKontrols::where('no_surat', decrypt($nomor))->first();
                    $dataKontrol->delete();
                }
                return response()->json(['data' => $data, 'log_vlaim' => $logVclaim], 200);
            } else {
                return response()->json(['error' => 'Data tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi galat: ' . $e->getMessage()], 500);
        }
    }
}