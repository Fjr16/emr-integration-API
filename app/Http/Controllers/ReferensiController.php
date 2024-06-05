<?php

namespace App\Http\Controllers;

use App\Services\Bpjs\Referensi;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReferensiController extends Controller
{

    protected $serviceReferensi;

    public function __construct() {
        $this->serviceReferensi = new Referensi;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Antrean RS  GET

    public function getPoli()
    {
        $poli = $this->serviceReferensi->getPoli();
        return $poli;
    }

    public function getDokter()
    {
        $dokter = $this->serviceReferensi->getDokter();
        return $dokter;
    }

    public function getDokterJadwal($kdPoli, $tgl)
    {
        $dokterJadwal = $this->serviceReferensi->getDokterJadwal($kdPoli, $tgl);
        return $dokterJadwal;
    }

    // Vclaim GET

    public function getDiagnosa($diagnosa)
    {
        $diagnosa = $this->serviceReferensi->getDiagnosa($diagnosa);
        return $diagnosa;
    }

    public function getSep($sep)
    {
        $sep = $this->serviceReferensi->getSep($sep);
        return $sep;
    }

    public function postSep(Request $request)
    {
        $dataRequest = $request->all();
        // $dataReq1 = $request->input('request.t_sep');
        
        // dd($dataReq1['noKartu']);

        $dataRequest = json_encode($dataRequest);
        // dd($dataRequest); 
        $createSep = $this->serviceReferensi->postSep($dataRequest);
        return $createSep;
    }

    public function getNoka($noka, $tgl)
    {
        $nokartu = $this->serviceReferensi->getNoka($noka, $tgl);
        return $nokartu;
    }

    public function getNokaNik($nik, $tgl)
    {
        $noNik = $this->serviceReferensi->getNokaNik($nik, $tgl);

        // Decode string JSON menjadi array
        $data = json_decode($noNik, true);

        // Convert array ke JSON dengan format yang rapi (pretty-print)
        $jsonResponse = json_encode($data, JSON_PRETTY_PRINT);

        // Return JSON response
        return response($jsonResponse, 200)->header('Content-Type', 'application/json');
        
    }

    public function getPoliName($kdPoli)
    {
        $poli = $this->serviceReferensi->getPoliName($kdPoli);
        return $poli;
    }

    public function getFaskes($faskes1, $faskes2)
    {
        $faskes = $this->serviceReferensi->getPoliName($faskes1, $faskes2);
        return $faskes;
    }

    public function getDokterDpjp($param1, $param2, $param3)
    {
        $dokterDpjp = $this->serviceReferensi->getDokterDpjp($param1, $param2, $param3);
        return $dokterDpjp;
    }

    public function getProvince()
    {
        $province = $this->serviceReferensi->getProvince();
        return $province;
    }

    public function getKabupaten($param1)
    {
        $kabupaten = $this->serviceReferensi->getKabupaten($param1);
        return $kabupaten;
    }

    public function getKecamatan($param1)
    {
        $kecamatan = $this->serviceReferensi->getKecamatan($param1);
        return $kecamatan;
    }

    public function getDiagnosaPrb()
    {
        $diagnosaprb = $this->serviceReferensi->getDiagnosaPrb();
        return $diagnosaprb;
    }

    public function getObatPrb($param1)
    {
        $obatprb = $this->serviceReferensi->getObatPrb($param1);
        return $obatprb;
    }

    public function getProcedure($param1)
    {
        $procedure = $this->serviceReferensi->getProcedure($param1);
        return $procedure;
    }

    public function getKelasRawat()
    {
        $kelasRawat = $this->serviceReferensi->getKelasRawat();
        return $kelasRawat;
    }

    public function getDokterDpjpClaim($param1)
    {
        $dokter = $this->serviceReferensi->getDokterDpjpClaim($param1);
        return $dokter;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}