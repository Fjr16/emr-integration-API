<?php

namespace App\Services\Bpjs;

use Bpjs\Bridging\Antrol\BridgeAntrol;
use Bpjs\Bridging\Vclaim\BridgeVclaim;
use Request;

class VClaim {
    protected $serviceBpjs;
    protected $serviceVclaim;

    public function __construct()
    {
        $this->serviceBpjs = new BridgeAntrol;
        $this->serviceVclaim = new BridgeVclaim;
    }

    // UAT SEP VCLAIM Begin
    /**
     * Simpan SEP
     * VClaim > SEP > Pembuatan SEP
     */
    public function postSepInsert($dataJson){
      $endpoint = "SEP/2.0/insert";
      $createSep = $this->serviceVclaim->postRequest($endpoint, $dataJson); 
      return $createSep;
    }

    /**
     * Update SEP
     * VClaim > SEP > Pembuatan SEP
     */
    public function putSepUpdate($dataJson){
      $endpoint = "SEP/2.0/update";
      $updateSep = $this->serviceVclaim->putRequest($endpoint, $dataJson); 
      return $updateSep;
    }

    /**
     * Delete data SEP
     * VClaim > SEP > Pembuatan SEP
     */
    public function deleteSep($dataJson){
      $endpoint = "SEP/2.0/delete";
      $deleteSep = $this->serviceVclaim->deleteRequest($endpoint, $dataJson); 
      return $deleteSep;
    }

    public function cariSepVclaim($noSep){
      $endpoint = "SEP/{$noSep}";
      $cariSepVclaim = $this->serviceVclaim->getRequest($endpoint); 
      return $cariSepVclaim;
    }

    /**
     * Update tanggal pulang sep
     * VClaim > SEP > Update Tanggal 
     */
    public function putTglPulang($dataJson){
      $endpoint = "SEP/2.0/updtglplg";
      $updateTanggal = $this->serviceVclaim->putRequest($endpoint, $dataJson); 
      return $updateTanggal;
    }

    public function getListDataTglPulang($bulan, $tahun, $filter = null){
      $endpoint = "Sep/updtglplg/list/bulan/{$bulan}/tahun/{$tahun}/{$filter}";
      $listData = $this->serviceVclaim->getRequest($endpoint); 
      return $listData;
    }

    // UAT SEP VCLAIM End

    // Rencana Kontrol Begin
    public function getSearchSEPrk($noSep){
      $endpoint = "RencanaKontrol/nosep/{$noSep}";
      $resSearch = $this->serviceVclaim->getRequest($endpoint); 
      return $resSearch;
    }

    /**
     * Create Surat Perintah Rawat Inap
     */
    public function postSPRI($dataJson){
      $endpoint = "RencanaKontrol/InsertSPRI";
      $resSearch = $this->serviceVclaim->postRequest($endpoint, $dataJson); 
      return $resSearch;
    }

     /**
     * Update Surat Perintah Rawat Inap
     */
    public function putSPRI($dataJson){
      $endpoint = "RencanaKontrol/UpdateSPRI";
      $updateSPRI = $this->serviceVclaim->putRequest($endpoint, $dataJson); 
      return $updateSPRI;
    }

    /**
     * Create Rencana Kontrol Rawat Jalan
     */
    public function postRencanaKontrol($dataJson){
      $endpoint = "RencanaKontrol/insert";
      $rencanaKontrol = $this->serviceVclaim->postRequest($endpoint, $dataJson); 
      return $rencanaKontrol;
    }

    public function putRencanaKontrol($dataJson){
      $endpoint = "RencanaKontrol/Update";
      $updateRK = $this->serviceVclaim->putRequest($endpoint, $dataJson); 
      return $updateRK;
    }

    /**
     * Delete data kontrol (SPRI dan Surat Kontrol)
     * VClaim > Rencana Kontrol > Hapus Rencana Kontrol
     */
    public function deleteSuratKontrol($dataJson){
      $endpoint = "RencanaKontrol/Delete";
      $deleteRK = $this->serviceVclaim->deleteRequest($endpoint, $dataJson); 
      return $deleteRK;
    }

    /**
     * get untuk pencarian nomor surat rencana kontrol
     */
    public function getCariNomorSuratKontrol($noSurat){
      $endpoint = "RencanaKontrol/noSuratKontrol/{$noSurat}";
      $cariNomor = $this->serviceVclaim->getRequest($endpoint);
      return $cariNomor;
    }
    //Rencana Kontrol End


    // Referensi begin
    /**
     * Get data poli VCLAIM
     */
    public function getRefPoli($kdPoli){
      $endpoint = "referensi/poli/{$kdPoli}";
      $listPoli = $this->serviceVclaim->getRequest($endpoint); 
      return $listPoli;
    }

    public function getPoli(){
      $endpoint = "ref/poli";
      $poli = $this->serviceVclaim->getRequest($endpoint);
      return $poli;
    }

    public function getDokter(){
      $endpoint = "ref/dokter";
      $dokter = $this->serviceBpjs->getRequest($endpoint);
      return $dokter;
    }

    // public function getDokter($kdDokter){
    //   $endpoint = "dokter/{$kdDokter}";
    //   $dokter = $this->serviceVclaim->getRequest($endpoint);
    //   return $dokter;
    // }

    /**
     * get untuk pencarian faskes
     */
    public function getFaskes($nama, $jenis){
      $endpoint = "referensi/faskes/{$nama}/{$jenis}";
      $faskes = $this->serviceVclaim->getRequest($endpoint);
      return $faskes;
    }

    /**
     * get untuk pencarian data diagnosa
     */
    public function getDiagnosa($diagnosa){
      $endpoint = "referensi/diagnosa/{$diagnosa}";
      $diagnosa = $this->serviceVclaim->getRequest($endpoint);
      return $diagnosa;
    }

    /**
     * get data untuk menampilkan dokter DPJP
     * Vclaim > Referensi > Dokter DPJP
     */
    public function getDokterDPJP($jenisPelayanan, $tglSep, $kodeDokter){
      $endpoint = "referensi/dokter/pelayanan/{$jenisPelayanan}/tglPelayanan/{$tglSep}/Spesialis/{$kodeDokter}";
      $dpjp = $this->serviceVclaim->getRequest($endpoint);
      return $dpjp;
    }
    // Referensi End


    // RUjukan begin
    public function getCariRujukan($dataJson){
      $endpoint = "Rujukan/RS/{$nomorRujukan}";
      $cariRujukan = $this->serviceVclaim->getRequest($endpoint);
      return $cariRujukan;
    }

    public function postRujukanInsert($dataJson){
      $endpoint = "Rujukan/insert";
      $insertRujukan = $this->serviceVclaim->postRequest($endpoint, $dataJson);
      return $insertRujukan;
    }
    
    // RUjukan end


    /**
     * Cari rujukan PCare/Faskes berdasarkan nomor rujukan
     */
    public function getCariRujukanBerdasarkanNomorRujukanFaskes($nomorRujukan){
      $endpoint = "Rujukan/{$nomorRujukan}";
      $cariRujukan = $this->serviceVclaim->getRequest($endpoint);
      return $cariRujukan;
    }

    /**
     * Cari rujukan Rumah Sakit berdasarkan nomor rujukan Rumah Sakit
     */
    public function getCariRujukanBerdasarkanNomorRujukanRS($nomorRujukan){
      $endpoint = "Rujukan/RS/{$nomorRujukan}";
      $cariRujukan = $this->serviceVclaim->getRequest($endpoint);
      return $cariRujukan;
    }

    /**
     * Cari rujukan PCare/Faskes berdasarkan nomor kartu
     */
    public function getCariRujukanBerdasarkanNokaFaskes($noka){
      $endpoint = "Rujukan/Peserta/{$noka}";
      $cariRujukan = $this->serviceVclaim->getRequest($endpoint);
      return $cariRujukan;
    }

    /**
     * Cek data peserta BPJS berdasarkan NOKA
     */
    public function getCekPesertaNoka($noka, $tglSep){
      $endpoint = "Peserta/nokartu/{$noka}/tglSEP/{$tglSep}";
      $cariPeserta = $this->serviceVclaim->getRequest($endpoint);
      return $cariPeserta;
    }

    /**
     * Cek data peserta BPJS berdasarkan NIK
     */
    public function getCekPesertaNik($nik, $tglSep){
      $endpoint = "Peserta/nik/{$nik}/tglSEP/{$tglSep}";
      $cariPeserta = $this->serviceVclaim->getRequest($endpoint);
      return $cariPeserta;
    }

    /**
     * Cek data poli/spesialistik untuk surat kontrol
     * VClaim > Rencana Kontrol > Data Poli/Spesialistik
     */
    public function getDataPoliRencanaKontrol($jenisKontrol, $nomor, $tgl){
      $endpoint = "RencanaKontrol/ListSpesialistik/JnsKontrol/{$jenisKontrol}/nomor/{$nomor}/TglRencanaKontrol/{$tgl}";
      $dataPoliRencanaKontrol = $this->serviceVclaim->getRequest($endpoint);
      return $dataPoliRencanaKontrol;
    }

    /**
     * Cek data dokter untuk surat kontrol
     * VClaim > Rencana Kontrol > Data Dokter
     */
    public function getDataDokterRencanaKontrol($jenisKontrol, $kodePoli, $tgl){
      $endpoint = "RencanaKontrol/JadwalPraktekDokter/JnsKontrol/{$jenisKontrol}/KdPoli/{$kodePoli}/TglRencanaKontrol/{$tgl}";
      $dataPoliRencanaKontrol = $this->serviceVclaim->getRequest($endpoint);
      return $dataPoliRencanaKontrol;
    }


    /**
     * Cek data integrasi SEP ke INACBG
     * VClaim > SEP > Integrasi SEP ke Inacbg
     */
    public function getIntegrasiInacbg($noSep){
      $endpoint = "sep/cbg/{$noSep}";
      $inacbg = $this->serviceVclaim->getRequest($endpoint);
      return $inacbg;
    }
}