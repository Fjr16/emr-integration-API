<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetConversion;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\GetStokController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RmeCpptController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\DoctorPoliController;
use App\Http\Controllers\GetWilayahController;
use App\Http\Controllers\RawatJalanController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\KontrolUlangController;
use App\Http\Controllers\MedicineFormController;
use App\Http\Controllers\MedicineStokController;
use App\Http\Controllers\MedicineTypeController;
use App\Http\Controllers\QueueConfirmController;
use App\Http\Controllers\ReportCashierController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\KonsulInternalController;
use App\Http\Controllers\AsesmentPerawatController;
use App\Http\Controllers\MedicineReceiptController;
use App\Http\Controllers\PatientCategoryController;
use App\Http\Controllers\ReportDrugUsageController;
use App\Http\Controllers\ReportPenunjangController;
use App\Http\Controllers\MedicineCategoryController;
use App\Http\Controllers\RadiologiPatientController;
use App\Http\Controllers\RawatJalanFarmasiController;
use App\Http\Controllers\LaboratoriumPatientController;
use App\Http\Controllers\PatientActionReportController;
use App\Http\Controllers\RajalGeneralConsentController;
use App\Http\Controllers\MedicineDistributionController;
use App\Http\Controllers\RadiologiFormRequestController;
use App\Http\Controllers\RekamMedisElektronikController;
use App\Http\Controllers\RadiologiPatientQueueController;
use App\Http\Controllers\DoctorInitialAssesmentController;
use App\Http\Controllers\LaboratoriumFormRequestController;
use App\Http\Controllers\LaboratoriumPatientQueueController;
use App\Http\Controllers\DiagnosticProcedurePatientController;
use App\Http\Controllers\MedicineTransactionPembelianController;
use App\Http\Controllers\PoliklinikController;

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


Route::get('clear/user/tabel', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2014_10_12_000000_create_users_table.php');
    Artisan::call('db:seed --class=UserSeeder');
    return back()->with('success', 'SUKSES RESET');
})->name('clear/tabel.user');

Route::get('clear/permission', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_08_185341_create_permission_tables.php');
    Artisan::call('db:seed --class=PermissionSeeder');
    Artisan::call('db:seed --class=RoleSeeder');
    // Artisan::call('db:seed --class=UserHasPermissionSeeder');
    // Artisan::call('db:seed --class=PatientCategorySeeder'); //patient category
    return back()->with('success', 'SUKSES RESET');
})->name('clear.permission');


// migrate refresh rajal
Route::get('/rajal/clear/database', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_09_141259_create_rajal_farmasi_obat_details_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_09_125456_create_rajal_farmasi_patients_table.php');
    // resep dokter
    Artisan::call('migrate:refresh --path=/database/migrations/2023_09_09_122838_create_medicine_receipts_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_09_21_030025_create_medicine_receipt_details_table.php');
    //rajal road patient
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_25_014621_create_rajal_road_patients_table.php');
    return back()->with('success', 'Berhasil Di Reset');
    //assesmen awal medis
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_10_170103_create_initial_assesments_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_10_165825_create_initial_assesment_physical_examinations_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_10_171249_create_initial_assesment_supporting_examination_results_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_10_171824_create_initial_asessment_plans_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_10_172247_create_initial_assesment_educational_needs_table.php');

    return back()->with('success', 'SUKSES RESET');
})->name('clear/rajal');

//migrate refresh radiologi
Route::get('/radiologi/clear/database', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_15_190333_create_radiologi_form_requests_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_15_191411_create_radiologi_form_request_details_table.php');
    return back()->with('success', 'SUKSES RESET');
})->name('clear/radiologi/request/hasil');

//migrate refresh labor pk
Route::get('/labor/clear/database', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_26_172251_create_laboratorium_requests_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_26_173042_create_laboratorium_request_details_table.php');
    return back()->with('success', 'SUKSES RESET');
})->name('clear/labor/request/hasil');

//Clear SBPK
Route::get('/sbpk/clear', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2023_10_29_130314_create_surat_bukti_pelayanan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_10_29_131100_create_surat_bukti_pelayanan_sekunder_diagnoses_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_10_29_131122_create_surat_bukti_pelayanan_sekunder_actions_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_10_29_131214_create_surat_bukti_pelayanan_patient_details_table.php');
    return back()->with('success', 'SUKSES RESET');
})->name('sbpk/clear');

Route::get('/farmasi/gudang/clear/database', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2023_06_14_150904_create_medicine_stoks_table.php');
    return back()->with('success', 'Berhasil Di Reset');
})->name('clear/farmasi/medicine');

// Migrate tabel diagnosis_patients, medicine_categories, medicines, units
Route::get('/db/lama/migrate/database', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_17_000520_create_diagnosis_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_05_30_153110_create_medicine_categories_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_05_29_092250_create_medicines_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_06_02_081836_create_units_table.php');
    // Artisan::call('migrate:refresh --path=/database/migrations/2023_07_08_185341_create_permission_tables.php');
    return back()->with('success', 'SUKSES MIGRATE');
})->name('migrate/db/lama');

// Seeder untuk tabel diagnosis_patients, medicine_categories, medicines, roles, units
Route::get('/db/lama/seed/database', function () {
    Artisan::call('db:seed --class=DiagnosisPatientSeeder');
    Artisan::call('db:seed --class=MedicineCategorieSeeder');
    Artisan::call('db:seed --class=MedicineSeeder');
    Artisan::call('db:seed --class=RoleSeeder');
    Artisan::call('db:seed --class=UnitSeeder');
    return back()->with('success', 'SUKSES SEED');
})->name('seed/db/lama');


// get TTD User
Route::get('/get/Ttd', [OtherController::class, 'getTtdUser'])->name('ranap/cppt.getTtd');

Route::group(['middleware' => 'auth'], function () {
    //Konsultasi dan Tarif Konsultasi
    Route::get('/konsultasi', [ConsultationController::class, 'index'])->name('konsultasi');
    Route::get('/konsultasi/create', [ConsultationController::class, 'create'])->name('konsultasi.create');
    Route::post('/konsultasi/store', [ConsultationController::class, 'store'])->name('konsultasi.store');
    Route::get('/konsultasi/show/{id}', [ConsultationController::class, 'show'])->name('konsultasi.show');
    Route::get('/konsultasi/edit/{id}', [ConsultationController::class, 'edit'])->name('konsultasi.edit');
    Route::put('/konsultasi/update/{id}', [ConsultationController::class, 'update'])->name('konsultasi.update');
    Route::delete('/konsultasi/destroy/{id}', [ConsultationController::class, 'destroy'])->name('konsultasi.destroy');

    //User
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    //Specialist
    Route::get('/user/specialist', [SpecialistController::class, 'index'])->name('user/specialist.index');
    Route::get('/user/specialist/create', [SpecialistController::class, 'create'])->name('user/specialist.create');
    Route::get('/user/specialist/edit/{id}', [SpecialistController::class, 'edit'])->name('user/specialist.edit');
    Route::post('/user/specialist/store', [SpecialistController::class, 'store'])->name('user/specialist.store');
    Route::put('/user/specialist/update/{id}', [SpecialistController::class, 'update'])->name('user/specialist.update');
    Route::delete('/user/specialist/destroy/{id}', [SpecialistController::class, 'destroy'])->name('user/specialist.destroy');

    //Role
    Route::get('/user/role/create', [RolesController::class, 'create'])->name('user/role.create');
    Route::post('/user/role/store', [RolesController::class, 'store'])->name('user/role.store');
    Route::get('/user/role/edit/{id}', [RolesController::class, 'edit'])->name('user/role.edit');
    Route::put('/user/role/update/{id}', [RolesController::class, 'update'])->name('user/role.update');
    Route::delete('/user/role/destroy/{id}', [RolesController::class, 'destroy'])->name('user/role.destroy');

    //List Pekerjaan
    Route::get('/job', [JobController::class, 'index'])->name('job.index');
    Route::get('/job/create', [JobController::class, 'create'])->name('job.create');
    Route::post('/job/store', [JobController::class, 'store'])->name('job.store');
    Route::get('/job/edit/{id}', [JobController::class, 'edit'])->name('job.edit');
    Route::put('/job/update/{id}', [JobController::class, 'update'])->name('job.update');
    Route::delete('/job/destroy/{id}', [JobController::class, 'destroy'])->name('job.destroy');

    //Poliklinik
    Route::get('/poliklinik/index', [PoliklinikController::class, 'index'])->name('poliklinik.index');
    Route::get('/poliklinik/create', [PoliklinikController::class, 'create'])->name('poliklinik.create');
    Route::post('/poliklinik/store', [PoliklinikController::class, 'store'])->name('poliklinik.store');
    Route::get('/poliklinik/edit/{id}', [PoliklinikController::class, 'edit'])->name('poliklinik.edit');
    Route::put('/poliklinik/update/{id}', [PoliklinikController::class, 'update'])->name('poliklinik.update');
    Route::delete('/poliklinik/destroy/{id}', [PoliklinikController::class, 'destroy'])->name('poliklinik.destroy');

    //Unit
    Route::get('/unit', [UnitController::class, 'index'])->name('unit.index');
    Route::get('/unit/create', [UnitController::class, 'create'])->name('unit.create');
    Route::post('/unit/store', [UnitController::class, 'store'])->name('unit.store');
    Route::get('/unit/edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
    Route::put('/unit/update/{id}', [UnitController::class, 'update'])->name('unit.update');
    Route::delete('/unit/destroy/{id}', [UnitController::class, 'destroy'])->name('unit.destroy');

    //Supplier
    Route::get('/farmasi/supplier', [SupplierController::class, 'index'])->name('farmasi/supplier.index');
    Route::get('/farmasi/supplier/create', [SupplierController::class, 'create'])->name('farmasi/supplier.create');
    Route::post('/farmasi/supplier/store', [SupplierController::class, 'store'])->name('farmasi/supplier.store');
    Route::get('/farmasi/supplier/edit/{id}', [SupplierController::class, 'edit'])->name('farmasi/supplier.edit');
    Route::put('/farmasi/supplier/update/{id}', [SupplierController::class, 'update'])->name('farmasi/supplier.update');
    Route::delete('/farmasi/supplier/destroy/{id}', [SupplierController::class, 'destroy'])->name('farmasi/supplier.destroy');

    //Pabrik
    Route::get('/farmasi/pabrik/create', [FactoryController::class, 'create'])->name('farmasi/pabrik.create');
    Route::post('/farmasi/pabrik/store', [FactoryController::class, 'store'])->name('farmasi/pabrik.store');
    Route::get('/farmasi/pabrik/edit/{id}', [FactoryController::class, 'edit'])->name('farmasi/pabrik.edit');
    Route::put('/farmasi/pabrik/update/{id}', [FactoryController::class, 'update'])->name('farmasi/pabrik.update');
    Route::delete('/farmasi/pabrik/destroy/{id}', [FactoryController::class, 'destroy'])->name('farmasi/pabrik.destroy');

    //Obat
    Route::get('/farmasi/obat', [MedicineController::class, 'index'])->name('farmasi/obat.index');
    Route::get('/farmasi/obat/create', [MedicineController::class, 'create'])->name('farmasi/obat.create');
    Route::post('/farmasi/obat/store', [MedicineController::class, 'store'])->name('farmasi/obat.store');
    Route::get('/farmasi/obat/edit/{id}', [MedicineController::class, 'edit'])->name('farmasi/obat.edit');
    Route::put('/farmasi/obat/update/{id}', [MedicineController::class, 'update'])->name('farmasi/obat.update');
    Route::delete('/farmasi/obat/destroy/{id}', [MedicineController::class, 'destroy'])->name('farmasi/obat.destroy');

    //Jenis Obat
    Route::get('/farmasi/obat/jenis/create', [MedicineTypeController::class, 'create'])->name('farmasi/obat/jenis.create');
    Route::post('/farmasi/obat/jenis/store', [MedicineTypeController::class, 'store'])->name('farmasi/obat/jenis.store');
    Route::get('/farmasi/obat/jenis/edit/{id}', [MedicineTypeController::class, 'edit'])->name('farmasi/obat/jenis.edit');
    Route::put('/farmasi/obat/jenis/update/{id}', [MedicineTypeController::class, 'update'])->name('farmasi/obat/jenis.update');
    Route::delete('/farmasi/obat/jenis/destroy/{id}', [MedicineTypeController::class, 'destroy'])->name('farmasi/obat/jenis.destroy');

    //Golongan Obat
    Route::get('/farmasi/obat/golongan/create', [MedicineCategoryController::class, 'create'])->name('farmasi/obat/golongan.create');
    Route::post('/farmasi/obat/golongan/store', [MedicineCategoryController::class, 'store'])->name('farmasi/obat/golongan.store');
    Route::get('/farmasi/obat/golongan/edit/{id}', [MedicineCategoryController::class, 'edit'])->name('farmasi/obat/golongan.edit');
    Route::put('/farmasi/obat/golongan/update/{id}', [MedicineCategoryController::class, 'update'])->name('farmasi/obat/golongan.update');
    Route::delete('/farmasi/obat/golongan/destroy/{id}', [MedicineCategoryController::class, 'destroy'])->name('farmasi/obat/golongan.destroy');

    //bentuk Sediaan Obat
    Route::get('/farmasi/obat/bentuk/create', [MedicineFormController::class, 'create'])->name('farmasi/obat/bentuk.create');
    Route::post('/farmasi/obat/bentuk/store', [MedicineFormController::class, 'store'])->name('farmasi/obat/bentuk.store');
    Route::get('/farmasi/obat/bentuk/edit/{id}', [MedicineFormController::class, 'edit'])->name('farmasi/obat/bentuk.edit');
    Route::put('/farmasi/obat/bentuk/update/{id}', [MedicineFormController::class, 'update'])->name('farmasi/obat/bentuk.update');
    Route::delete('/farmasi/obat/bentuk/destroy/{id}', [MedicineFormController::class, 'destroy'])->name('farmasi/obat/bentuk.destroy');

    //Diagnosa
    Route::get('/diagnosa', [DiagnosticController::class, 'index'])->name('diagnosa.index');
    Route::get('/diagnosa/create', [DiagnosticController::class, 'create'])->name('diagnosa.create');
    Route::post('/diagnosa/store', [DiagnosticController::class, 'store'])->name('diagnosa.store');
    Route::get('/diagnosa/edit/{id}', [DiagnosticController::class, 'edit'])->name('diagnosa.edit');
    Route::put('/diagnosa/update/{id}', [DiagnosticController::class, 'update'])->name('diagnosa.update');
    Route::delete('/diagnosa/destroy/{id}', [DiagnosticController::class, 'destroy'])->name('diagnosa.destroy');

    //Get Wilayah (Provinsi, kota, kecamatan, kelurahan)
    Route::post('/get/wilayah/kota', [GetWilayahController::class, 'kota'])->name('get/wilayah.kota');
    Route::post('/get/wilayah/kecamatan', [GetWilayahController::class, 'kecamatan'])->name('get/wilayah.kecamatan');
    Route::post('/get/wilayah/kelurahan', [GetWilayahController::class, 'kelurahan'])->name('get/wilayah.kelurahan');

    //dokter poli
    Route::get('/dokter/poli', [DoctorPoliController::class, 'index'])->name('dokter/poli.index');
    Route::put('/dokter/poli/update/{id}', [DoctorPoliController::class, 'update'])->name('dokter/poli.update');

    //tindakan dan tarif tindakan (done)
    Route::get('/tindakan/index', [ActionController::class, 'index'])->name('tindakan.index');
    Route::get('/tindakan/create', [ActionController::class, 'create'])->name('tindakan.create');
    Route::post('/tindakan/store', [ActionController::class, 'store'])->name('tindakan.store');
    Route::get('/tindakan/edit/{id}', [ActionController::class, 'edit'])->name('tindakan.edit');
    Route::put('/tindakan/update/{id}', [ActionController::class, 'update'])->name('tindakan.update');
    Route::delete('/tindakan/destroy/{id}', [ActionController::class, 'destroy'])->name('tindakan.destroy');

    //Jadwal Dokter
    Route::get('/dokter/jadwal/create/{id}', [DoctorScheduleController::class, 'create'])->name('dokter/jadwal.create');
    Route::get('/dokter/jadwal/all', [DoctorScheduleController::class, 'all'])->name('dokter/jadwal.all');
    Route::post('/dokter/jadwal/store/{id}', [DoctorScheduleController::class, 'store'])->name('dokter/jadwal.store');

    //PembelianObat
    Route::get('/farmasi/obat/pembelian', [MedicineTransactionPembelianController::class, 'index'])->name('farmasi/obat/pembelian.index');
    Route::get('/farmasi/obat/pembelian/create', [MedicineTransactionPembelianController::class, 'create'])->name('farmasi/obat/pembelian.create');
    Route::post('/farmasi/obat/pembelian/store', [MedicineTransactionPembelianController::class, 'store'])->name('farmasi/obat/pembelian.store');
    Route::get('/farmasi/obat/pembelian/edit/{id}', [MedicineTransactionPembelianController::class, 'edit'])->name('farmasi/obat/pembelian.edit');
    Route::get('/farmasi/obat/pembelian/update/{id}', [MedicineTransactionPembelianController::class, 'update'])->name('farmasi/obat/pembelian.update');
    Route::delete('/farmasi/obat/pembelian/destroy/{id}', [MedicineTransactionPembelianController::class, 'destroy'])->name('farmasi/obat/pembelian.destroy');

    // amprahan atau distribusi Obat (DONE, create, store, retur, show, fitur update tidak ada)
    Route::get('/farmasi/obat/amprahan', [MedicineDistributionController::class, 'index'])->name('farmasi/obat/amprahan.index');
    Route::post('/farmasi/obat/amprahan/store', [MedicineDistributionController::class, 'store'])->name('farmasi/obat/amprahan.store');
    Route::get('/farmasi/obat/amprahan/show/{id}', [MedicineDistributionController::class, 'show'])->name('farmasi/obat/amprahan.show');
    Route::delete('/farmasi/obat/amprahan/destroy/{id}', [MedicineDistributionController::class, 'destroy'])->name('farmasi/obat/amprahan.destroy');

    //Stock Obat
    Route::get('/farmasi/obat/stock', [MedicineStokController::class, 'index'])->name('farmasi/obat/stock.index');
    Route::get('/farmasi/obat/stock/show/{id}', [MedicineStokController::class, 'show'])->name('farmasi/obat/stock.show');
    Route::get('/farmasi/obat/stock/all', [MedicineStokController::class, 'all'])->name('farmasi/obat/stock.all');

    //getStok
    Route::post('/farmasi/obat/get/stok', [GetStokController::class, 'index'])->name('farmasi/obat/get/stok.index');
    Route::post('/farmasi/obat/get/medicineStok/all', [GetStokController::class, 'create'])->name('farmasi/obat/get/medicineStok/all.create');

    //getConversion
    Route::post('/konversi/obat/get/satuan/awal', [GetConversion::class, 'create'])->name('konversi/obat/get/satuan/awal.create');
});

//Antrian
    //Antrian
    Route::get('/antrian/create', [QueueController::class, 'create'])->name('antrian.create');
    Route::post('/antrian/store', [QueueController::class, 'store'])->name('antrian.store');
    Route::get('/antrian/show/{id}', [QueueController::class, 'show'])->name('antrian.show');
    Route::get('/antrian/edit/{id}', [QueueController::class, 'edit'])->name('antrian.edit');
    Route::get('/antrian/jadwalDokter/{dokterID}', [QueueController::class, 'jadwalDokter'])->name('antrian.jadwal-dokter');
    //getDataPasien pada antrian
    Route::post('/antrian/get/pasien', [QueueController::class, 'getPasien'])->name('antrian/get/pasien.getPasien');
    //konfirmasi antrian
    Route::get('/antrian/konfirmasi/create/{id}', [QueueConfirmController::class, 'create'])->name('antrian/konfirmasi.create');
    Route::post('/antrian/konfirmasi/store/{id}', [QueueConfirmController::class, 'store'])->name('antrian/konfirmasi.store');
    //list antrian untuk registrasi ulang
    Route::get('/antrian', [QueueController::class, 'index'])->name('antrian.index');
    Route::get('/antrian/konfirmasi/edit/{id}', [QueueConfirmController::class, 'edit'])->name('antrian/konfirmasi.edit');
    Route::get('/antrian/konfirmasi/update/{id}', [QueueConfirmController::class, 'update'])->name('antrian/konfirmasi.update');

//Pasien (done)
    Route::get('/pasien', [PatientController::class, 'index'])->name('pasien.index');
    Route::get('/pasien/detail/{id}', [PatientController::class, 'detail'])->name('pasien.detail');
    Route::get('/pasien/create', [PatientController::class, 'create'])->name('pasien.create');
    Route::post('/pasien/store', [PatientController::class, 'store'])->name('pasien.store');
    Route::get('/pasien/edit/{id}', [PatientController::class, 'edit'])->name('pasien.edit');
    Route::put('/pasien/update/{id}', [PatientController::class, 'update'])->name('pasien.update');
    Route::delete('/pasien/destroy/{id}', [PatientController::class, 'destroy'])->name('pasien.destroy');

//Kategori Pasien
    Route::get('/pasien/category', [PatientCategoryController::class, 'index'])->name('pasien/category');
    Route::get('/pasien/category/create', [PatientCategoryController::class, 'create'])->name('pasien/category.create');
    Route::post('/pasien/category/store', [PatientCategoryController::class, 'store'])->name('pasien/category.store');
    Route::get('/pasien/category/edit/{id}', [PatientCategoryController::class, 'edit'])->name('pasien/category.edit');
    Route::put('/pasien/category/update/{id}', [PatientCategoryController::class, 'update'])->name('pasien/category.update');
    Route::delete('/pasien/category/destroy/{id}', [PatientCategoryController::class, 'destroy'])->name('pasien/category.destroy');

//rajal
    Route::get('/rajal', [RawatJalanController::class, 'index'])->name('rajal/index');  //index rajal poli
    Route::get('/rajal/show/{id}/{title}', [RawatJalanController::class, 'show'])->name('rajal/show');

//status Pelayanan Poli
    Route::put('/rajal/status/pelayanan/update/{id}', [RawatJalanController::class, 'update'])->name('rajal/status/pelayanan.update');

//Rajal General Consent
Route::get('rajal/general/consent/create/{id}', [RajalGeneralConsentController::class, 'create'])->name('rajal/general/consent.create');
Route::post('rajal/general/consent/store/{id}', [RajalGeneralConsentController::class, 'store'])->name('rajal/general/consent.store');
Route::get('rajal/general/consent/show/{id}', [RajalGeneralConsentController::class, 'show'])->name('rajal/general/consent.show');
Route::get('rajal/general/consent/showtatatertib/{id}', [RajalGeneralConsentController::class, 'showTataTertib'])->name('rajal/general/consent.showtatatertib');
Route::get('rajal/general/consent/showhakdankewajiban/{id}', [RajalGeneralConsentController::class, 'showHakDanKewajiban'])->name('rajal/general/consent.showhakdankewajiban');
Route::get('rajal/general/consent/edit/{id}', [RajalGeneralConsentController::class, 'edit'])->name('rajal/general/consent.edit');
Route::put('rajal/general/consent/update/{id}', [RajalGeneralConsentController::class, 'update'])->name('rajal/general/consent.update');
Route::delete('rajal/general/consent/destroy/{id}', [RajalGeneralConsentController::class, 'destroy'])->name('rajal/general/consent.destroy');


//assesmen Awal baru
    Route::put('/assesmen/awal/dokter/update/{id}', [DoctorInitialAssesmentController::class, 'update'])->name('assesmen/awal/dokter.update');
// belum selesai
    Route::get('/assesmen/awal/dokter/print/{id}', [DoctorInitialAssesmentController::class, 'print'])->name('assesmen/awal/dokter.print');

// diagnosa dan prosedure
Route::put('/diagnosa/patient/update/{id}', [DiagnosticProcedurePatientController::class, 'updateDiagnosis'])->name('diagnosa/patient.update');
Route::put('/procedure/patient/update/{id}', [DiagnosticProcedurePatientController::class, 'updateProcedure'])->name('procedure/patient.update');

//rajal CPPT
Route::post('/rajal/cppt/store/{id}', [RmeCpptController::class, 'store'])->name('rajal/cppt.store');
    Route::get('/rajal/cppt/show/{id}', [RmeCpptController::class, 'show'])->name('rajal/cppt.show');
    Route::get('/rajal/cppt/print/{id}', [RmeCpptController::class, 'print'])->name('rajal/cppt.print');
Route::get('/rajal/cppt/update/ttd', [RmeCpptController::class, 'updateTtd'])->name('rajal/cppt/update.ttd');

//rajal request Radiologi
    Route::get('/rajal/permintaan/radiologi/create/{id}', [RadiologiFormRequestController::class, 'create'])->name('rajal/permintaan/radiologi.create');
    Route::post('/rajal/permintaan/radiologi/store/{id}', [RadiologiFormRequestController::class, 'store'])->name('rajal/permintaan/radiologi.store');
    Route::get('/rajal/permintaan/radiologi/show/{queue_id}/{radiologi_id}', [RadiologiFormRequestController::class, 'show'])->name('rajal/permintaan/radiologi.show');
    Route::get('/rajal/permintaan/radiologi/edit/{queue_id}/{radiologi_id}', [RadiologiFormRequestController::class, 'edit'])->name('rajal/permintaan/radiologi.edit');
    Route::put('/rajal/permintaan/radiologi/update/{id}', [RadiologiFormRequestController::class, 'update'])->name('rajal/permintaan/radiologi.update');
    Route::delete('/rajal/permintaan/radiologi/destroy/{id}', [RadiologiFormRequestController::class, 'destroy'])->name('rajal/permintaan/radiologi.destroy');

//rajal request labor PK
    Route::get('/rajal/laboratorium/request/create/{id}', [LaboratoriumFormRequestController::class, 'index'])->name('rajal/laboratorium/request.index');
    Route::post('rajal/laboratorium/request/store/{id}', [LaboratoriumFormRequestController::class, 'store'])->name('rajal/laboratorium/request.store');
    Route::get('/rajal/laboratorium/request/edit/{id}', [LaboratoriumFormRequestController::class, 'edit'])->name('rajal/laboratorium/request.edit');
    Route::put('rajal/laboratorium/request/update/{id}', [LaboratoriumFormRequestController::class, 'update'])->name('rajal/laboratorium/request.update');
    Route::get('/rajal/laboratorium/request/show/{queue_id}/{labor_id}', [LaboratoriumFormRequestController::class, 'show'])->name('rajal/laboratorium/request.show');
    Route::delete('/rajal/laboratorium/request/destroy/{id}', [LaboratoriumFormRequestController::class, 'destroy'])->name('rajal/laboratorium/request.destroy');


//rajal tindakan
    Route::post('/rajal/laporan/tindakan/store', [PatientActionReportController::class, 'store'])->name('rajal/laporan/tindakan.store');
    Route::put('/rajal/laporan/tindakan/update/{id}', [PatientActionReportController::class, 'update'])->name('rajal/laporan/tindakan.update');
    Route::get('/rajal/laporan/tindakan/show/{id}', [PatientActionReportController::class, 'show'])->name('rajal/laporan/tindakan.show');
    Route::delete('/rajal/laporan/tindakan/destroy/{id}', [PatientActionReportController::class, 'destroy'])->name('rajal/laporan/tindakan.destroy');

//resep dokter (done)
Route::post('/rajal/resep/dokter/store/{id}', [MedicineReceiptController::class, 'store'])->name('rajal/resep/dokter.store');
Route::put('/rajal/resep/dokter/update/{id}', [MedicineReceiptController::class, 'update'])->name('rajal/resep/dokter.update');
Route::get('/rajal/resep/dokter/show/{id}', [MedicineReceiptController::class, 'show'])->name('rajal/resep/dokter.show');
Route::delete('/rajal/resep/dokter/destroy/{id}', [MedicineReceiptController::class, 'destroy'])->name('rajal/resep/dokter.destroy');

//kontrol ulang
Route::put('/rajal/kontrol/ulang/update/{id}', [KontrolUlangController::class, 'update'])->name('rajal/kontrol/ulang.update');
Route::get('/rajal/kontrol/ulang/destroy/{id}', [KontrolUlangController::class, 'destroy'])->name('rajal/kontrol/ulang.destroy');
Route::get('/rajal/kontrol/ulang/show/{id}', [KontrolUlangController::class, 'show'])->name('rajal/kontrol/ulang.show');
// Route::get('/rajal/sbpk/update/ttd', [KontrolUlangController::class, 'getTtd'])->name('rajal/sbpk.ttd');

// Route::group(['middleware' => ['permission:tambah rme perawat']], function(){
Route::get('/asesmen/awal/perawat/create_step_one/{id}', [AsesmentPerawatController::class, 'create_step_one'])->name('asesmen/awal/perawat.create_step_one');
Route::post('/asesmen/awal/perawat/store_step_one/{id}', [AsesmentPerawatController::class, 'store_step_one'])->name('asesmen/awal/perawat.store_step_one');
Route::post('/asesmen/awal/perawat/store_step_two/{id}', [AsesmentPerawatController::class, 'store_step_two'])->name('asesmen/awal/perawat.store_step_two');
Route::post('/asesmen/awal/perawat/show/{id}', [AsesmentPerawatController::class, 'show'])->name('asesmen/awal/perawat.show');
Route::get('/asesmen/awal/perawat/edit/{id}', [AsesmentPerawatController::class, 'edit'])->name('asesmen/awal/perawat.edit');
Route::put('/asesmen/awal/perawat/update_step_one/{id}', [AsesmentPerawatController::class, 'update_step_one'])->name('asesmen/awal/perawat.update_step_one');
Route::put('/asesmen/awal/perawat/update_step_two/{id}', [AsesmentPerawatController::class, 'update_step_two'])->name('asesmen/awal/perawat.update_step_two');
Route::get('/asesmen/awal/perawat/print/{id}', [AsesmentPerawatController::class, 'print'])->name('asesmen/awal/perawat.print');

//Konsul internal
Route::put('/rajal/konsul/internal/update/{id}', [KonsulInternalController::class, 'update'])->name('rajal/konsul/internal.update');
Route::delete('/rajal/konsul/internal/destroy/{id}', [KonsulInternalController::class, 'destroy'])->name('rajal/konsul/internal.destroy');
// Route::get('/rajal/konsul/internal/show/{id}', [KonsulInternalController::class, 'show'])->name('rajal/konsul/internal.show');

//rajal farmasi
    Route::get('/rajal/farmasi/index', [RawatJalanFarmasiController::class, 'index'])->name('rajal/farmasi/index');
    Route::get('/rajal/farmasi/create/{id}', [RawatJalanFarmasiController::class, 'create'])->name('rajal/farmasi/create');
    Route::put('/rajal/farmasi/update/status/{id}', [RawatJalanFarmasiController::class, 'updateStatus'])->name('rajal/farmasi/update/status.updateStatus');
    Route::post('/rajal/farmasi/store/{id}', [RawatJalanFarmasiController::class, 'store'])->name('rajal/farmasi/store');
    Route::get('/rajal/farmasi/edit/{id}', [RawatJalanFarmasiController::class, 'edit'])->name('rajal/farmasi/edit');
    Route::put('/rajal/farmasi/update/{id}', [RawatJalanFarmasiController::class, 'update'])->name('rajal/farmasi/update');
    Route::delete('/rajal/farmasi/delete/{id}', [RawatJalanFarmasiController::class, 'destroy'])->name('rajal/farmasi/delete');
    Route::get('/rajal/farmasi/show/{id}', [RawatJalanFarmasiController::class, 'show'])->name('rajal/farmasi/show');
    Route::get('/rajal/farmasi/serahkan/obat/{id}', [RawatJalanFarmasiController::class, 'serahkanObat'])->name('rajal/farmasi/serahkan.obat');
    Route::put('/rajal/farmasi/update/status/{id}', [RawatJalanFarmasiController::class, 'updateStatus'])->name('rajal/farmasi/update.status');

//rajal Kasir
    Route::get('/rajal/kasir/pembayaran', [KasirController::class, 'index'])->name('rajal/kasir/pembayaran/index');
    Route::get('/rajal/kasir/pembayaran/edit/{id}', [KasirController::class, 'edit'])->name('rajal/kasir/pembayaran/edit');
    Route::get('/rajal/kasir/pembayaran/show/{id}', [KasirController::class, 'show'])->name('rajal/kasir/pembayaran/show');
    Route::put('/rajal/kasir/pembayaran/update/{id}', [KasirController::class, 'update'])->name('rajal/kasir/pembayaran/update');
    Route::put('/rajal/kasir/revisi/billing/tindakan/{id}', [KasirController::class, 'revisiPatientAction'])->name('rajal/kasir/revisi/billing.tindakan');

//Laboratorium Patient
    Route::get('/laboratorium/patient', [LaboratoriumPatientController::class, 'index'])->name('laboratorium/patient.index');
    Route::get('/laboratorium/patient/hasil/create/{id}', [LaboratoriumPatientController::class, 'create'])->name('laboratorium/patient/hasil.create');
    Route::post('/laboratorium/patient/hasil/store/{id}', [LaboratoriumPatientController::class, 'store'])->name('laboratorium/patient/hasil.store');
    Route::get('/laboratorium/patient/hasil/show/{id}', [LaboratoriumPatientController::class, 'show'])->name('laboratorium/patient/hasil.show');

//Laboratorium Patient Queue
    Route::get('/laboratorium/patient/queue', [LaboratoriumPatientQueueController::class, 'index'])->name('laboratorium/patient/queue.index');
    Route::post('/laboratorium/patient/queue/store/{id}', [LaboratoriumPatientQueueController::class, 'store'])->name('laboratorium/patient/queue.store');
// update status pada sidebar permintaan labor pk
    Route::put('/laboratorium/patient/queue/update/{id}', [LaboratoriumPatientQueueController::class, 'update'])->name('laboratorium/patient/queue.update');

//Radiologi Patient
Route::get('/radiologi/patient', [RadiologiPatientController::class, 'index'])->name('radiologi/patient.index');
Route::get('/radiologi/patient/create/{id}', [RadiologiPatientController::class, 'create'])->name('radiologi/patient.create');
Route::get('/radiologi/patient/hasil/show/{id}', [RadiologiPatientController::class, 'show'])->name('radiologi/patient/hasil.show');
Route::put('/radiologi/patient/hasil/update/{id}', [RadiologiPatientController::class, 'update'])->name('radiologi/patient/hasil.update');
Route::put('/radiologi/patient/validasiHasil/{id}', [RadiologiPatientController::class, 'validasiHasil'])->name('radiologi/patient.validasiHasil');
Route::get('/radiologi/patient/hasil/printAll/{id}', [RadiologiPatientController::class, 'printAll'])->name('radiologi/patient/hasil.printAll');

//Radiologi Patient Queue
Route::get('/radiologi/patient/queue', [RadiologiPatientQueueController::class, 'index'])->name('radiologi/patient/queue.index');
Route::post('/radiologi/patient/queue/store/{id}', [RadiologiPatientQueueController::class, 'store'])->name('radiologi/patient/queue.store');


// rme start
Route::get('/rekam/medis/elektronik', [RekamMedisElektronikController::class, 'index'])->name('rekam/medis/elektronik.index');
Route::get('/rekam/medis/elektronik/show/{id}', [RekamMedisElektronikController::class, 'show'])->name('rekam/medis/elektronik.show');
// rme end


//Report
//penggunaan obat pasien
Route::get('/laporan/penggunaan/obat', [ReportDrugUsageController::class, 'index'])->name('laporan/penggunaan/obat.index');
Route::get('/laporan/penggunaan/obat/show/{id}', [ReportDrugUsageController::class, 'show'])->name('laporan/penggunaan/obat.show');
Route::get('/laporan/penggunaan/obat/exportExcel/{id}', [ReportDrugUsageController::class, 'exportExcel'])->name('laporan/penggunaan/obat.exportExcel');

//kasir
Route::get('/laporan/kasir', [ReportCashierController::class, 'index'])->name('laporan/kasir.index');
Route::get('/laporan/kasir/list/{id}', [ReportCashierController::class, 'detail'])->name('laporan/kasir.list');
Route::get('/laporan/kasir/show/{id}', [ReportCashierController::class, 'show'])->name('laporan/kasir.show');
Route::get('/laporan/kasir/exportExcel/{id}', [ReportCashierController::class, 'exportExcel'])->name('laporan/kasir.exportExcel');

//penunjang
Route::get('/laporan/lab/patologi/klinik', [ReportPenunjangController::class, 'indexPk'])->name('laporan/lab/patologi/klinik.index');
Route::get('/laporan/lab/patologi/klinik/show/{id}', [ReportPenunjangController::class, 'showPk'])->name('laporan/lab/patologi/klinik.show');
Route::get('/laporan/lab/patologi/klinik/exportExcel/{id}', [ReportPenunjangController::class, 'exportExcelPk'])->name('laporan/lab/patologi/klinik.exportExcel');

require __DIR__ . '/auth.php';
