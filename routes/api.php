<?php

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\ReferensiController;
use App\Http\Controllers\API\RencanaKontrolController;
use App\Http\Controllers\API\SepController;
use App\Http\Controllers\RequestApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('sep/insert', [SepController::class, 'postSep'])->name('sep.insertSep');
Route::put('sep/update', [SepController::class, 'putSep'])->name('sep.updateSep');
Route::delete('sep/delete', [SepController::class, 'deleteSep'])->name('sep.deleteSep');
Route::get('sep/search/{noSep}', [SepController::class, 'searchSep'])->name('sep.searchSep');

Route::put('sep/tgl-pulang-update', [SepController::class, 'tglPulangSep'])->name('sep.tglPulangUp');
Route::get('sep/list-data-pulang/{bulan}/{tahun}/{filter?}', [SepController::class, 'listDataTanggalPulang'])->name('sep.listDataPulang');

Route::get('rencana-kontrol/search-sep/{noSep}', [RencanaKontrolController::class, 'searchSepRencanaKontrol'])->name('rk.cariSep');
Route::post('rencana-kontrol/SPRI/insert', [RencanaKontrolController::class, 'postSPRI'])->name('rk.spriInsert');
Route::put('rencana-kontrol/SPRI/update', [RencanaKontrolController::class, 'putSPRI'])->name('rk.spriUpdate');

Route::post('rencana-kontrol/insert', [RencanaKontrolController::class, 'postRencanaKontrol'])->name('rk.insert');
Route::put('rencana-kontrol/update', [RencanaKontrolController::class, 'updateSuratKontrol'])->name('rk.update');
Route::delete('rencana-kontrol/delete', [RencanaKontrolController::class, 'deleteSuratKontrol'])->name('rk.delete');
Route::get('rencana-kontrol/cari-surat/{noSuart}', [RencanaKontrolController::class, 'cariSuratKontrol'])->name('rk.cari');

Route::get('referensi/poli', [SepController::class, 'listDataPoli'])->name('ref.listPoli');
Route::get('referensi/list-dokter/{kdDokter?}', [SepController::class, 'getDokterList'])->name('ref.listDokter');

Route::get('referensi/faskes/{nama}/{jenis}', [SepController::class, 'getFaskes'])->name('ref.faskes');

Route::get('rujukan/cari/{nomorRujukan}', [SepController::class, 'getCariRujukan'])->name('rujukan.cari');
Route::post('rujukan/insert', [SepController::class, 'postRujukan'])->name('rujukan.insert');

Route::get('referensi/diagnosa/{diagnosa}', [ReferensiController::class, 'getDiagnosa']);
Route::get('referensi/poli/{kdPoli}', [ReferensiController::class, 'getPoliName']);
Route::get('referensi/dokter', [ReferensiController::class, 'getDokter']);
Route::get('referensi/dpjp/{jenisLayanan}/{tglSep}/{kode}', [SepController::class, 'getDpjp']);
Route::get('rencana-kontrol/poli/{jenisKontrol}/{nomor}/{tgl}', [SepController::class, 'getDataPoliRencanaKontrol']);
Route::get('rencana-kontrol/dokter/{jenisKontrol}/{kodePoli}/{tgl}', [SepController::class, 'getDataDokterRencanaKontrol']);

Route::get('rujukan-dari-faskes/{nomorRujukan}', [SepController::class, 'cariRujukanBerdasarkanNomorRujukanFaskes'])->name('rujukan-faskes.cari');
Route::get('rujukan-faskes-noka/{noka}', [SepController::class, 'cariRujukanBerdasarkanNokaFaskes'])->name('rujukan.fakses-noka');
Route::get('cek-peserta/{noka}/{tglSep?}', [SepController::class, 'cekPesertaNoka'])->name('sep.cekPesertaNoka');
Route::get('cek-peserta-nik/{nik}/{tglSep?}', [SepController::class, 'cekPesertaNik'])->name('sep.cekPesertaNik');
Route::post('sep-igd/insert', [SepController::class, 'postSepIgd'])->name('sep.insertSepIgd');
Route::post('sep-rujukan/insert', [SepController::class, 'postSepRujukan'])->name('sep.insertSepRujukan');
Route::post('sep-kontrol-prosedur/berkelanjutan/insert', [SepController::class, 'postSepRujukanKontrolRajalProsedureBerkelanjutan'])->name('sep.insertSepRujukanProsedurLanjut');
Route::post('sep-kontrol-prosedur/tidak-berkelanjutan/insert', [SepController::class, 'postSepRujukanKontrolRajalProsedureTidakBerkelanjutan'])->name('sep.insertSepRujukanProsedurTidakLanjut');
Route::post('sep-kontrol-konsul/insert', [SepController::class, 'postSepRujukanKontrolRajalKonsul'])->name('sep.insertSepRujukanKonsul');
Route::post('sep-rawat-inap/insert', [SepController::class, 'postSepRawatInap'])->name('sep.insertSepRanap');
Route::post('sep-post-ranap/insert', [SepController::class, 'postSepKontrolRanap'])->name('sep.insertSepPost');
Route::get('integrasi-inacbg/sep/{noSep}', [SepController::class, 'getInaCBGIntegrasi'])->name('sep.inacbg');


// route untuk api dummy
Route::get('post/data/pasien', [RequestApiController::class, 'postDataPatient'])->name('post/data.pasien');
Route::get('get/data/pasien', [RequestApiController::class, 'getDataByNik'])->name('get/data.pasien');
Route::get('get/riwayat/pengobatan', [RequestApiController::class, 'getRiwayatByRm'])->name('get/riwayat.pengobatan');
