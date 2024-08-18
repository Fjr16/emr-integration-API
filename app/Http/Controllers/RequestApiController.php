<?php

namespace App\Http\Controllers;

use App\Services\SatuSehat\BaseUrlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RequestApiController extends Controller
{
    private $apiSatuSehat;
    public function __construct(BaseUrlService $apiSatuSehat) {
        $this->apiSatuSehat = $apiSatuSehat;
    }
    
    public function postDataPatient(Request $request) {
        
        $res = Http::post('http://127.0.0.1:3000/data/pasien/registrasi', [
            "nik" => $request->nik,
            "no_rm" => $request->no_rm,
            "noka" => $request->noka,
            "name" => $request->name,
            "tempat_lhr" => $request->tempat_lhr,
            "tanggal_lhr" => $request->tanggal_lhr,
            "jenis_kelamin" => $request->jenis_kelamin,
            "telp" => $request->telp,
            "agama" => $request->agama,
            "alamat"=> $request->alamat,
            "desa" => $request->village,
            "kecamatan" => $request->district,
            "kota" => $request->city,
            "provinsi" => $request->province,
            "rt" => $request->rt,
            "rw" => $request->rw,
            "pendidikan" => $request->pendidikan,
            "status_kawin" => $request->status_kawin,
            "nm_ayah" => $request->nm_ayah,
            "nm_ibu" => $request->nm_ibu,
            "nm_wali" => $request->nm_wali,
            "alergi_makanan" => $request->alergi_makanan,
            "alergi_obat" => $request->alergi_obat,
            "suku" => $request->suku,
            "bangsa"=> $request->bangsa,
            "pekerjaan"=> $request->pekerjaan,
            "penjamin"=> $request->penjamin,
            "kode_dokter"=> $request->kode_dokter,
            "nama_dokter"=> $request->nama_dokter,
            "poliklinik"=> $request->poliklinik,
            "sip"=> $request->sip,
            "status"=> $request->status,
            "suhu"=> $request->suhu,
            "kesadaran"=> $request->kesadaran,
            // "psikologis"=> $request->psikologis,
            "kode_prosedur"=> $request->kode_prosedur,
            "nama_prosedur"=> $request->nama_prosedur,
            "kode_diagnosa_primer"=> $request->kode_diagnosa_primer,
            "nama_diagnosa_primer"=> $request->nama_diagnosa_primer,
            // "kode_diagnosa_sekunder"=> $request->kode_diagnosa_sekunder,
            // "nama_diagnosa_sekunder"=> $request->nama_diagnosa_sekunder,
            "tgl_tindakan"=> $request->tgl_tindakan,
            "laporan_tindakan"=> $request->laporan_tindakan,
            "petugas"=> $request->petugas,
            // "kode_tindakan"=> $request->kode_tindakan,
            // "nama_tindakan"=> $request->nama_tindakan,
        ]);
        $data = json_decode($res, true);
        dd($data);
    }
    public function getDataByNik() {
        $url = "data/pasien/get/1301072107920002";
        $res = $this->apiSatuSehat->getRequest($url);

        return $res;
    }
    public function getRiwayatByRm() {
        $res = Http::get('http://127.0.0.1:3000/data/riwayat/pengobatan/get');
        $data = json_decode($res, true);
        dd($res);
    }
}
