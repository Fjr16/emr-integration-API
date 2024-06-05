<?php

namespace App\Services\Bpjs;

use Bpjs\Bridging\Antrol\BridgeAntrol;
use Bpjs\Bridging\Vclaim\BridgeVclaim;

class Referensi {
    protected $serviceBpjs;
    protected $serviceVclaim;

    public function __construct()
    {
        $this->serviceBpjs = new BridgeAntrol;
        $this->serviceVclaim = new BridgeVclaim;
    }

    // Anteran RS GET
    
    public function getPoli(){
        $endpoint = "ref/poli";
        $poli = $this->serviceBpjs->getRequest($endpoint);
        return $poli;
    }

    public function getDokter(){
        $endpoint = "ref/dokter";
        $dokter = $this->serviceBpjs->getRequest($endpoint);
        return $dokter;
    }

    public function getDokterJadwal($kdPoli, $tgl){
        $endpoint = "jadwaldokter/kodepoli/{$kdPoli}/tanggal/{$tgl}";
        $dokterJadwal = $this->serviceBpjs->getRequest($endpoint);
        return $dokterJadwal;
    }

    // Vclaim GET

    public function getDiagnosa($diagnosa){
        $endpoint = "referensi/diagnosa/{$diagnosa}";
        $diagnosa = $this->serviceVclaim->getRequest($endpoint);
        return $diagnosa;
    }

    public function getSep($sep){
        $endpoint = "SEP/{$sep}";
        $sep = $this->serviceVclaim->getRequest($endpoint);
        return $sep;
    }

    public function postSep($dataJson){
        $endpoint = "SEP/2.0/insert";
        $createSep = $this->serviceVclaim->postRequest($endpoint, $dataJson); 
        return $createSep;
    }

    public function getNoka($noka, $tgl){
        $endpoint = "Peserta/nokartu/{$noka}/tglSEP/{$tgl}";
        $nokartu = $this->serviceVclaim->getRequest($endpoint);
        return $nokartu;
    }

    public function getNokaNik($nik, $tgl){
        $endpoint = "Peserta/nik/{$nik}/tglSEP/{$tgl}";
        $noNik = $this->serviceVclaim->getRequest($endpoint);
        return $noNik;
    }

    public function getPoliName($kdPoli){
        $endpoint = "referensi/poli/{$kdPoli}";
        $poli = $this->serviceVclaim->getRequest($endpoint);
        return $poli;
    }

    public function getFaskes($faskes1, $faskes2){
        $endpoint = "referensi/faskes/{$faskes1}/{$faskes2}";
        $faskes = $this->serviceVclaim->getRequest($endpoint);
        return $faskes;
    }

    public function getDokterDpjp($param1, $param2, $param3){
        $endpoint = "referensi/dokter/pelayanan/{$param1}/tglPelayanan/{$param2}/Spesialis/{$param3}";
        $dokterDpjp = $this->serviceVclaim->getRequest($endpoint);
        return $dokterDpjp;
    }

    public function getProvince(){
        $endpoint = "referensi/propinsi";
        $province = $this->serviceVclaim->getRequest($endpoint);
        return $province;
    }

    public function getKabupaten($param1){
        $endpoint = "referensi/kabupaten/propinsi/{$param1}";
        $kabupaten = $this->serviceVclaim->getRequest($endpoint);
        return $kabupaten;
    }

    public function getKecamatan($param1){
        $endpoint = "referensi/kecamatan/kabupaten/{$param1}";
        $kecamatan = $this->serviceVclaim->getRequest($endpoint);
        return $kecamatan;
    }

    public function getDiagnosaPrb(){
        $endpoint = "referensi/diagnosaprb";
        $diagnosaprb = $this->serviceVclaim->getRequest($endpoint);
        return $diagnosaprb;
    }

    public function getObatPrb($param1){
        $endpoint = "referensi/obatprb/{$param1}";
        $obatprb = $this->serviceVclaim->getRequest($endpoint);
        return $obatprb;
    }

    public function getProcedure($param1){
        $endpoint = "referensi/procedure/{$param1}";
        $procedure = $this->serviceVclaim->getRequest($endpoint);
        return $procedure;
    }

    public function getKelasRawat(){
        $endpoint = "referensi/kelasrawat";
        $kelasRawat = $this->serviceVclaim->getRequest($endpoint);
        return $kelasRawat;
    }

    public function getDokterDpjpClaim($param1){
        $endpoint = "referensi/dokter/{$param1}";
        $dokter = $this->serviceVclaim->getRequest($endpoint);
        return $dokter;
    }

    
}
