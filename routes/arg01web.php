<?php

use App\Http\Controllers\arg01\SepController;
use App\Http\Controllers\arg01\SepUpdatePulangController;
use App\Http\Controllers\arg01\SuratKontrolController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('images/{filename}', function ($filename) {
  $path = storage_path('app/images/' . $filename);

  if (!file_exists($path)) {
      abort(500);
  }

  $file = file_get_contents($path);
  $type = mime_content_type($path);

  return response($file)->header('Content-Type', $type);
})->name('show-image');

Route::get('sep/beranda', [SepController::class, 'berandaSep'])->name('sep.beranda');
Route::get('halaman/sep', [SepController::class, 'index'])->name('sep.index');
Route::post('cek-peserta', [SepController::class, 'cekDataPeserta'])->name('sep.cek-peserta');
Route::post('data-faskes', [SepController::class, 'getDataFaskes'])->name('sep.faskes');
Route::post('data-diagnosa', [SepController::class, 'getDataDiagnosa'])->name('sep.diagnosa');
Route::post('data-dpjp-layanan', [SepController::class, 'getDataDokterDPJP'])->name('sep.dpjp-layanan');
Route::get('data-dokter', [SepController::class, 'getDataDokter'])->name('sep.dokter');
Route::post('data-poli', [SepController::class, 'getDataPoli'])->name('sep.poli');
Route::post('create-sep', [SepController::class, 'createSEP'])->name('sep.create-sep');
Route::get('cetak/sep/{noSep}', [SepController::class, 'getCetakSEP'])->name('sep.cetak-sep');
Route::post('cek-rujukan', [SepController::class, 'cekDataRujukan'])->name('sep.cek-rujukan');
Route::post('cek-data-kontrol', [SepController::class, 'cekDataKontrol'])->name('sep.cek-kontrol');
Route::get('sep/view/{idSep}', [SepController::class, 'viewSep'])->name('sep.view');
Route::get('sep/form-update/{id}', [SepController::class, 'formUpdateSEP'])->name('sep.form-update'); //id encrypt
Route::put('update-sep', [SepController::class, 'updateSEP'])->name('sep.update-sep');
Route::delete('delete-sep', [SepController::class, 'deleteSEP'])->name('sep.delete-sep');

Route::post('poli-rencana-kontrol', [SuratKontrolController::class, 'dataPoliRencanaKontrol'])->name('kontrol.poli');
Route::post('dokter-rencana-kontrol', [SuratKontrolController::class, 'dataDokterRencanaKontrol'])->name('kontrol.dokter');
Route::get('surat-kontrol', [SuratKontrolController::class, 'indexKontrol'])->name('kontrol.rawatJalan');
Route::get('surat-kontrol/create', [SuratKontrolController::class, 'createKontrol'])->name('kontrol.create');
Route::post('surat-kontrol/simpan', [SuratKontrolController::class, 'suratKontrol'])->name('kontrol.simpan-data');
Route::get('surat-kontrol/edit/{id}', [SuratKontrolController::class, 'editKontrol'])->name('kontrol.edit');
Route::put('surat-kontrol/update-data', [SuratKontrolController::class, 'updateData'])->name('kontrol.update-data');

Route::get('surat-spri', [SuratKontrolController::class, 'indexSPRI'])->name('kontrol.spri');
Route::get('spri/create', [SuratKontrolController::class, 'createSPRI'])->name('spri.create');
Route::post('spri/simpan', [SuratKontrolController::class, 'suratSPRI'])->name('spri.simpan-data');
Route::get('spri/update/{id}', [SuratKontrolController::class, 'editSPRI'])->name('spri.update');
Route::put('spri/update-data', [SuratKontrolController::class, 'spriUpdate'])->name('spri.update-data');
Route::delete('rencana-kontrol/delete/{nomor}', [SuratKontrolController::class, 'delDataKontrol'])->name('kontrol.delete'); //id_encrypt

Route::get('sep/pulang/{idSep}', [SepUpdatePulangController::class, 'createTanggalPulang'])->name('update-pulang.create'); //id_encript
Route::put('update-tanggal/pulang', [SepUpdatePulangController::class, 'simpanTanggalPulang'])->name('pulang.update-tanggal');

Route::get('sep/{antrian}/{layanan}/{noka}/{noRujukan?}', [SepController::class, 'sepRajal'])->name('sep.rajal');
Route::post('sep/batal/antrian', [SepController::class, 'batalAntrianSep'])->name('sep.batal-antrian');