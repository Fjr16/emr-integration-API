<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetConversion;
use App\Http\Controllers\IcdController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PrmrjController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\UrineController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\GetStokController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RmeCpptController;
use App\Http\Controllers\AnsietasController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\NyeriAkutController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\DoctorPoliController;
use App\Http\Controllers\GetWilayahController;
use App\Http\Controllers\RawatJalanController;
use App\Http\Controllers\RoomDetailController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\MedicineFormController;
use App\Http\Controllers\MedicineStokController;
use App\Http\Controllers\MedicineTypeController;
use App\Http\Controllers\QueueConfirmController;
use App\Http\Controllers\ActionMembersController;
use App\Http\Controllers\QueueUriologiController;
use App\Http\Controllers\ReportCashierController;
use App\Http\Controllers\ActionCategoryController;
use App\Http\Controllers\BillingCaptionController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\UnitConversionController;
use App\Http\Controllers\AsesmentPerawatController;
use App\Http\Controllers\MedicineReceiptController;
use App\Http\Controllers\PatientCategoryController;
use App\Http\Controllers\ReportDrugUsageController;
use App\Http\Controllers\ReportPenunjangController;
use App\Http\Controllers\InitialAssesmentController;
use App\Http\Controllers\InvoicePembelianController;
use App\Http\Controllers\MedicineCategoryController;
use App\Http\Controllers\RadiologiPatientController;
use App\Http\Controllers\ActionMemberRatesController;
use App\Http\Controllers\AsuhanKeperawatanController;
use App\Http\Controllers\RawatJalanFarmasiController;
use App\Http\Controllers\RekamMedisPatientController;
use App\Http\Controllers\UnitCategoryPivotController;
use App\Http\Controllers\LaboratoriumPatientController;
use App\Http\Controllers\PatientActionReportController;
use App\Http\Controllers\SuratPengantarRawatController;
use App\Http\Controllers\RadiologiFormRequestController;
use App\Http\Controllers\RekamMedisElektronikController;
use App\Http\Controllers\UnitConversionMasterController;
use App\Http\Controllers\RadiologiPatientQueueController;
use App\Http\Controllers\CostEstimateSimulationController;
use App\Http\Controllers\GangguanIntegritasKulitController;
use App\Http\Controllers\LaboratoriumFormRequestController;
use App\Http\Controllers\LaboratoriumPatientQueueController;
use App\Http\Controllers\RadiologiFormRequestMasterController;
use App\Http\Controllers\SuratBuktiPelayananPatientController;
use App\Http\Controllers\AsesmentKeperawatanDiagnosisController;
use App\Http\Controllers\MedicineTransactionPembelianController;
use App\Http\Controllers\GangguanMobilitasFisikPatientController;
use App\Http\Controllers\LaboratoriumRequestMasterRateController;
use App\Http\Controllers\LaboratoriumRequestRekamMedisController;
use App\Http\Controllers\LaboratoriumRequestTypeMasterController;
use App\Http\Controllers\AsesmentKeperawatanStatusFisikController;
use App\Http\Controllers\RadiologiFormRequestMasterRateController;
use App\Http\Controllers\LaboratoriumRequestMasterDetailController;
use App\Http\Controllers\AsesmentKeperawatanRencanaAsuhanController;
use App\Http\Controllers\RadiologiFormRequestMasterDetailController;
use App\Http\Controllers\LaboratoriumRequestCategoryMasterController;
use App\Http\Controllers\RadiologiFormRequestMasterCategoryController;
use App\Http\Controllers\LaboratoriumMasterVariabelPemeriksaanController;
use App\Http\Controllers\AsesmentKeperawatanSkriningResikoJatuhController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\PermintaanLaboratoriumPatogologiAnatomikController;
use App\Http\Controllers\RajalGeneralConsentController;

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
    Artisan::call('migrate:refresh --path=/database/migrations/2024_05_19_215901_add__s_i_p_and_kode_dokter_bpjs_to_users.php');
    Artisan::call('db:seed --class=UserSeeder');
    return back()->with('success', 'SUKSES RESET');
    return 'success';
})->name('clear/tabel.user');

Route::get('clear/permission', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_08_185341_create_permission_tables.php');
    Artisan::call('db:seed --class=PermissionSeeder');
    Artisan::call('db:seed --class=RoleSeeder');
    Artisan::call('db:seed --class=UserHasPermissionSeeder');
    // Artisan::call('db:seed --class=PatientCategorySeeder'); //patient category
    return back()->with('success', 'SUKSES RESET');
})->name('clear.permission');


// migrate refresh rajal
Route::get('/rajal/clear/database', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_09_175345_create_rajal_farmasi_obat_invoices_table.php');
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

    //diagnosa keperawtan
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_21_230812_create_resiko_rajal_diagnosa_keperawatan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_21_230821_create_detail_resiko_rajal_diagnosa_keperawatan_patients_table.php');
    return back()->with('success', 'SUKSES RESET');
})->name('clear/rajal');

//clear asesmen awal keperawatan ranap
Route::get('/assesmen/awal/keperawatan/ranap/clear', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_10_155843_create_diagnosis_keperawatan_patients_table.php');
    // status fisik
    Artisan::call('migrate:refresh --path=/database/migrations/2023_09_27_194723_create_asesment_keperawatan_status_fisik_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_21_224706_create_status_fisik_diagnosa_keperawatan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_21_224722_create_detail_status_fisik_diagnosa_keperawatan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_21_224752_create_psiko_sosio_spritual_diagnosa_keperawatan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_21_224810_create_detail_psiko_sosio_spritual_diagnosa_keperawatan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_21_225840_create_ekonomi_diagnosa_keperawatan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_21_230434_create_riwayat_alergi_diagnosa_keperawatan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_21_230642_create_asesment_nyeri_diagnosa_keperawatan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_21_230657_create_detail_asesment_nyeri_diagnosa_keperawatan_patients_table.php');
    //risiko jatuh
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_21_230954_create_asesment_status_fungsional_diagnosa_keperawatan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_21_231004_create_detail_asesment_status_fungsional_diagnosa_keperawatan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_21_231156_create_risiko_nutrisional_diagnosa_keperawatan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_21_231218_create_detail_risiko_nutrisional_diagnosa_keperawatan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_09_27_210330_create_asesment_keperawatan_skrining_resiko_jatuh_patients_table.php');
    //diagnosis keperawatan
    Artisan::call('migrate:refresh --path=/database/migrations/2023_09_27_210849_create_asesment_keperawatan_diagnosis_keperawatan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_10_155852_create_detail_diagnosis_keperawatan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_11_144340_create_hubungan_diagnosa_awal_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_10_155917_create_detail_masalah_diagnosis_keperawatan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_10_155938_create_detail_rencana_diagnosis_keperawatan_patients_table.php');
    //rencana asuhan
    Artisan::call('migrate:refresh --path=/database/migrations/2023_09_27_211337_create_asesment_keperawatan_rencana_asuhan_patients_table.php');

    return back()->with('success', 'SUKSES RESET');
    return 'success';
})->name('clear/assesmen/awal/keperawatan/ranap.clear');

//migrate refresh radiologi
Route::get('/radiologi/clear/database', function () {
    // Artisan::call('migrate:refresh --path=/database/migrations/2023_10_11_152207_create_radiologi_form_request_master_categories_table.php');
    // Artisan::call('migrate:refresh --path=/database/migrations/2023_07_15_174606_create_radiologi_form_request_masters_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_10_11_152343_create_radiologi_form_request_master_details_table.php');
    // Artisan::call('migrate:refresh --path=/database/migrations/2023_10_11_152658_create_radiologi_form_request_master_rates_table.php');
    // Artisan::call('migrate:refresh --path=/database/migrations/2023_07_15_190333_create_radiologi_form_requests_table.php');
    // Artisan::call('migrate:refresh --path=/database/migrations/2023_07_15_191411_create_radiologi_form_request_details_table.php');
    // Artisan::call('migrate:refresh --path=/database/migrations/2023_08_25_032628_create_radiologi_patients_table.php');
    // Artisan::call('migrate:refresh --path=/database/migrations/2023_08_25_033326_create_radiologi_patient_request_details_table.php');
    // Artisan::call('migrate:refresh --path=/database/migrations/2023_10_11_204819_create_radiologi_variabel_detail_pivots_table.php');
    // Artisan::call('db:seed --class=RadiologiSeeder');
    return back()->with('success', 'SUKSES RESET');
})->name('clear/radiologi/request/hasil');

//migrate refresh labor pk
Route::get('/labor/clear/database', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_26_172251_create_laboratorium_requests_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_26_173042_create_laboratorium_request_details_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_29_001222_create_laboratorium_patient_results_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_29_211407_create_laboratorium_patient_result_details_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_09_24_163714_create_laboratorium_request_category_masters_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_09_28_033954_create_laboratorium_request_master_variables_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_09_27_210949_create_laboratorium_request_master_details_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_10_13_105652_create_laboratorium_request_master_rates_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_10_06_034000_create_laboratorium_user_validators_table.php');
    return back()->with('success', 'SUKSES RESET');
})->name('clear/labor/request/hasil');

//Clear Antrian Laboratorium Anatomik
Route::get('/permintaan/laboratorium/patologi/anatomik/clear', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2023_10_12_004829_create_hasil_laboratorium_patologi_anatomik_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_10_12_013701_create_antrian_laboratorium_patologi_anatomi_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_10_12_014146_create_detail_antrian_laboratorium_patologi_anatomi_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_10_13_224523_create_hasil_histopatologi_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_10_13_224532_create_hasil_sitopatologi_patients_table.php');
    return back()->with('success', 'SUKSES RESET');
})->name('permintaan/laboratorium/patologi/anatomik/clear');

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

//seeder master labor
Route::get('/labor/seed/master/database', function () {
    Artisan::call('db:seed --class=LaboratoriumRequestCategoryMasterSeeder');
    Artisan::call('db:seed --class=LaboratoriumRequestMasterVariableSeeder');
    Artisan::call('db:seed --class=LaboratoriumRequestMasterDetailSeeder');
    return back()->with('success', 'SUKSES SEED');
})->name('seed/labor/master.database');

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
    Route::get('/user/role/index', [RolesController::class, 'index'])->name('user/role.index');
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

    //Ruang
    Route::get('/ruang', [RoomController::class, 'index'])->name('ruang.index');
    Route::get('/ruang/create', [RoomController::class, 'create'])->name('ruang.create');
    Route::post('/ruang/store', [RoomController::class, 'store'])->name('ruang.store');
    Route::get('/ruang/edit/{id}', [RoomController::class, 'edit'])->name('ruang.edit');
    Route::put('/ruang/update/{id}', [RoomController::class, 'update'])->name('ruang.update');
    Route::delete('/ruang/destroy/{id}', [RoomController::class, 'destroy'])->name('ruang.destroy');

    //Detail Ruang
    Route::get('/ruang/detail/create', [RoomDetailController::class, 'create'])->name('ruang/detail.create');
    Route::post('/ruang/detail/store', [RoomDetailController::class, 'store'])->name('ruang/detail.store');
    Route::get('/ruang/detail/edit/{id}', [RoomDetailController::class, 'edit'])->name('ruang/detail.edit');
    Route::put('/ruang/detail/update/{id}', [RoomDetailController::class, 'update'])->name('ruang/detail.update');
    Route::delete('/ruang/detail/destroy/{id}', [RoomDetailController::class, 'destroy'])->name('ruang/detail.destroy');

    //Icd
    Route::get('/icd', [IcdController::class, 'index'])->name('icd.index');
    Route::get('/icd/create', [IcdController::class, 'create'])->name('icd.create');
    Route::post('/icd/store', [IcdController::class, 'store'])->name('icd.store');
    Route::get('/icd/edit/{id}', [IcdController::class, 'edit'])->name('icd.edit');
    Route::put('/icd/update/{id}', [IcdController::class, 'update'])->name('icd.update');
    Route::delete('/icd/destroy/{id}', [IcdController::class, 'destroy'])->name('icd.destroy');

    //Unit
    Route::get('/unit', [UnitController::class, 'index'])->name('unit.index');
    Route::get('/unit/create', [UnitController::class, 'create'])->name('unit.create');
    Route::post('/unit/store', [UnitController::class, 'store'])->name('unit.store');
    Route::get('/unit/edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
    Route::put('/unit/update/{id}', [UnitController::class, 'update'])->name('unit.update');
    Route::delete('/unit/destroy/{id}', [UnitController::class, 'destroy'])->name('unit.destroy');

    //SubUnit
    Route::get('/sub-unit/create', [UnitCategoryPivotController::class, 'create'])->name('sub-unit.create');
    Route::post('/sub-unit/store', [UnitCategoryPivotController::class, 'store'])->name('sub-unit.store');
    Route::get('/sub-unit/edit/{id}', [UnitCategoryPivotController::class, 'edit'])->name('sub-unit.edit');
    Route::put('/sub-unit/update/{id}', [UnitCategoryPivotController::class, 'update'])->name('sub-unit.update');
    Route::delete('/sub-unit/destroy/{id}', [UnitCategoryPivotController::class, 'destroy'])->name('sub-unit.destroy');

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

    //kategori tindakan
    Route::get('/tindakan/category', [ActionCategoryController::class, 'index'])->name('tindakan/category');
    Route::get('/tindakan/category/create', [ActionCategoryController::class, 'create'])->name('tindakan/category.create');
    Route::post('/tindakan/category/store', [ActionCategoryController::class, 'store'])->name('tindakan/category.store');
    Route::get('/tindakan/category/edit/{id}', [ActionCategoryController::class, 'edit'])->name('tindakan/category.edit');
    Route::put('/tindakan/category/update/{id}', [ActionCategoryController::class, 'update'])->name('tindakan/category.update');
    Route::delete('/category/tindakan/destroy/{id}', [ActionCategoryController::class, 'destroy'])->name('tindakan/category.destroy');

    //tindakan
    Route::get('/tindakan/create/{id}', [ActionController::class, 'create'])->name('tindakan.create');
    Route::post('/tindakan/store/{id}', [ActionController::class, 'store'])->name('tindakan.store');
    Route::delete('/tindakan/destroy/{id}', [ActionController::class, 'destroy'])->name('tindakan.destroy');

    //keterangan tagihan (billing caption)
    Route::get('/tagihan', [BillingCaptionController::class, 'index'])->name('billing/caption.index');
    Route::post('/tagihan/store', [BillingCaptionController::class, 'store'])->name('billing/caption.store');
    Route::get('/tagihan/edit/{id}', [BillingCaptionController::class, 'edit'])->name('billing/caption.edit');
    Route::put('/tagihan/update/{id}', [BillingCaptionController::class, 'update'])->name('billing/caption.update');
    Route::delete('/tagihan/destroy/{id}', [BillingCaptionController::class, 'destroy'])->name('billing/caption.destroy');

    //Tindakan Member
    Route::get('/tindakan/anggota', [ActionMembersController::class, 'index'])->name('action/members.index');
    Route::get('/tindakan/anggota/create', [ActionMembersController::class, 'create'])->name('action/members.create');
    Route::post('/tindakan/anggota/store', [ActionMembersController::class, 'store'])->name('action/members.store');
    Route::get('/tindakan/anggota/edit/{id}', [ActionMembersController::class, 'edit'])->name('action/members.edit');
    Route::put('/tindakan/anggota/update/{id}', [ActionMembersController::class, 'update'])->name('action/members.update');
    Route::delete('/tindakan/anggota/destroy/{id}', [ActionMembersController::class, 'destroy'])->name('action/members.destroy');

    //tariftindakanmember
    Route::get('/tindakan/anggota/tarif/edit/{id}', [ActionMemberRatesController::class, 'edit'])->name('action/members/rates.edit');
    Route::put('/tindakan/anggota/tarif/update/{id}', [ActionMemberRatesController::class, 'update'])->name('action/members/rates.update');

    //Jadwal Dokter
    Route::get('/dokter/jadwal', [DoctorScheduleController::class, 'index'])->name('dokter/jadwal.index');
    Route::group(['middleware' => ['permission:jadwal poli']], function () {
        Route::get('/dokter/jadwal/all', [DoctorScheduleController::class, 'all'])->name('dokter/jadwal.all');
    });
    Route::get('/dokter/jadwal/edit/{id}', [DoctorScheduleController::class, 'edit'])->name('dokter/jadwal.edit');
    Route::post('/dokter/jadwal/update/{id}', [DoctorScheduleController::class, 'update'])->name('dokter/jadwal.update');
    Route::get('/dokter/jadwal/show/{id}', [DoctorScheduleController::class, 'show'])->name('dokter/jadwal.show');
    Route::post('/dokter/jadwal/store/{id}', [DoctorScheduleController::class, 'store'])->name('dokter/jadwal.store');

    //PembelianObat
    Route::get('/farmasi/obat/pembelian', [MedicineTransactionPembelianController::class, 'index'])->name('farmasi/obat/pembelian.index');
    Route::get('/farmasi/obat/pembelian/create', [MedicineTransactionPembelianController::class, 'create'])->name('farmasi/obat/pembelian.create');
    Route::post('/farmasi/obat/pembelian/store', [MedicineTransactionPembelianController::class, 'store'])->name('farmasi/obat/pembelian.store');
    Route::get('/farmasi/obat/pembelian/edit/{id}', [MedicineTransactionPembelianController::class, 'edit'])->name('farmasi/obat/pembelian.edit');
    Route::get('/farmasi/obat/pembelian/update/{id}', [MedicineTransactionPembelianController::class, 'update'])->name('farmasi/obat/pembelian.update');
    Route::post('/farmasi/obat/pembelian/getJumlah', [MedicineTransactionPembelianController::class, 'getJumlah'])->name('farmasi/obat/pembelian.getJumlah');
    Route::delete('/farmasi/obat/pembelian/destroy/{id}', [MedicineTransactionPembelianController::class, 'destroy'])->name('farmasi/obat/pembelian.destroy');

    //FakturPembelianObat
    Route::get('/farmasi/obat/pembelian/faktur/edit/{id}', [InvoicePembelianController::class, 'edit'])->name('farmasi/obat/pembelian/faktur.edit');
    Route::put('/farmasi/obat/pembelian/faktur/update/{id}', [InvoicePembelianController::class, 'update'])->name('farmasi/obat/pembelian/faktur.update');

    //Stock Obat
    Route::get('/farmasi/obat/stock', [MedicineStokController::class, 'index'])->name('farmasi/obat/stock.index');
    Route::get('/farmasi/obat/stock/show/{id}', [MedicineStokController::class, 'show'])->name('farmasi/obat/stock.show');
    Route::get('/farmasi/obat/stock/all', [MedicineStokController::class, 'all'])->name('farmasi/obat/stock.all');

    //Konversi
    Route::get('/farmasi/obat/konversi/create', [UnitConversionController::class, 'create'])->name('farmasi/obat/konversi.create');
    Route::post('/farmasi/obat/konversi/store', [UnitConversionController::class, 'store'])->name('farmasi/obat/konversi.store');
    Route::get('/farmasi/obat/konversi/edit/{id}', [UnitConversionController::class, 'edit'])->name('farmasi/obat/konversi.edit');
    Route::put('/farmasi/obat/konversi/update/{id}', [UnitConversionController::class, 'update'])->name('farmasi/obat/konversi.update');
    Route::post('/farmasi/obat/konversi/show', [UnitConversionController::class, 'show'])->name('farmasi/obat/konversi.show');
    Route::delete('/farmasi/obat/konversi/destroy/{id}', [UnitConversionController::class, 'destroy'])->name('farmasi/obat/konversi.destroy');

    //KonversiMaster
    Route::get('/farmasi/obat/master/konversi/create', [UnitConversionMasterController::class, 'create'])->name('farmasi/obat/master/konversi.create');
    Route::post('/farmasi/obat/master/konversi/store', [UnitConversionMasterController::class, 'store'])->name('farmasi/obat/master/konversi.store');
    Route::get('/farmasi/obat/master/konversi/edit/{id}', [UnitConversionMasterController::class, 'edit'])->name('farmasi/obat/master/konversi.edit');
    Route::put('/farmasi/obat/master/konversi/update/{id}', [UnitConversionMasterController::class, 'update'])->name('farmasi/obat/master/konversi.update');
    Route::delete('/farmasi/obat/master/konversi/destroy/{id}', [UnitConversionMasterController::class, 'destroy'])->name('farmasi/obat/master/konversi.destroy');

    //getStok
    Route::post('/farmasi/obat/get/stok', [GetStokController::class, 'index'])->name('farmasi/obat/get/stok.index');
    Route::post('/farmasi/obat/get/medicineStok/all', [GetStokController::class, 'create'])->name('farmasi/obat/get/medicineStok/all.create');

    //getConversion
    Route::post('/konversi/obat/get/satuan', [GetConversion::class, 'index'])->name('konversi/obat/get/satuan.index');
    Route::post('/konversi/obat/get/satuan/awal', [GetConversion::class, 'create'])->name('konversi/obat/get/satuan/awal.create');
    Route::post('/konversi/obat/get/jumlah', [GetConversion::class, 'getJumlah'])->name('konversi/obat/get.jumlah');
});

// Rencana Asuhan
 //Gangguan Mobilitas Fisik
 Route::get('/asuhan/keperawatan/pasien/gangguan/mobilitas/fisik', [GangguanMobilitasFisikPatientController::class, 'index'])->name('fisik.index');
 Route::post('/asuhan/keperawatan/pasien/gangguan/mobilitas/fisik/store', [GangguanMobilitasFisikPatientController::class, 'store'])->name('fisik.store');

 //Ansietas
 Route::get('/asuhan/keperawatan/pasien/ansietas', [AnsietasController::class, 'index'])->name('ansietas.index');
 Route::post('/asuhan/keperawatan/pasien/ansietas/store', [AnsietasController::class, 'store'])->name('ansietas.store');

 //Retensi Urine
 Route::get('/asuhan/keperawatan/pasien/retensi/urine', [UrineController::class, 'index'])->name('urine.index');
 Route::post('/asuhan/keperawatan/pasien/retensi/urine/store', [UrineController::class, 'store'])->name('urine.store');
 Route::get('/asuhan/keperawatan/pasien/retensi/urine/show', [UrineController::class, 'show'])->name('urine.show');

 //Nyeri Akut
 Route::get('/asuhan/keperawatan/pasien/nyeri/akut', [NyeriAkutController::class, 'index'])->name('nyeri.index');
 Route::post('/asuhan/keperawatan/pasien/nyeri/akut/store', [NyeriAkutController::class, 'store'])->name('nyeri.store');
 Route::get('/asuhan/keperawatan/pasien/nyeri/akut/show', [NyeriAkutController::class, 'show'])->name('nyeri.show');

 //Gangguan Integritas kulit / jaringan
 Route::get('/asuhan/keperawatan/pasien/kulit', [GangguanIntegritasKulitController::class, 'index'])->name('kulit.index');
 Route::post('/asuhan/keperawatan/pasien/kulit/store', [GangguanIntegritasKulitController::class, 'store'])->name('kulit.store');


//Antrian
Route::group(['middleware' => ['permission:daftar antrian|tambah antrian|registrasi ulang antrian']], function () {
    //Antrian
    Route::get('/antrian/create', [QueueController::class, 'create'])->name('antrian.create');
    Route::post('/antrian/store', [QueueController::class, 'store'])->name('antrian.store');
    Route::get('/antrian/show/{id}', [QueueController::class, 'show'])->name('antrian.show');
    Route::get('/antrian/edit/{id}', [QueueController::class, 'edit'])->name('antrian.edit');
    Route::get('/antrian/jadwalDokter/{dokterID}', [QueueController::class, 'jadwalDokter'])->name('antrian.jadwal-dokter');
    //getDataPasien pada antrian
    Route::post('/antrian/get/pasien', [QueueController::class, 'getPasien'])->name('antrian/get/pasien.getPasien');
    // Route::delete('/antrian/destroy/{id}', [QueueController::class, 'destroy'])->name('antrian.destroy');
    //konfirmasi antrian
    Route::get('/antrian/konfirmasi/create/{id}', [QueueConfirmController::class, 'create'])->name('antrian/konfirmasi.create');
    Route::post('/antrian/konfirmasi/store/{id}', [QueueConfirmController::class, 'store'])->name('antrian/konfirmasi.store');
    Route::get('/antrian/konfirmasi/ulang/create/{id}', [QueueConfirmController::class, 'panggilUlang'])->name('antrian/konfirmasi/ulang.create');

    //Antrian urologi
    Route::get('/antrian/urologi/create', [QueueUriologiController::class, 'create'])->name('antrian-urologi.create');
    Route::post('/antrian/urologi/store', [QueueUriologiController::class, 'store'])->name('antrian-urologi.store');
    Route::get('/antrian/urologi/show/{id}', [QueueUriologiController::class, 'show'])->name('antrian-urologi.show');
    Route::get('/antrian/urologi/edit/{id}', [QueueUriologiController::class, 'edit'])->name('antrian-urologi.edit');
    // //getDataPasien pada antrian
    Route::post('/antrian/get/pasien/urologi', [QueueUriologiController::class, 'getPasien'])->name('antrian/get/pasien/urologi.getPasien');
    // // Route::delete('/antrian/destroy/{id}', [QueueController::class, 'destroy'])->name('antrian.destroy');
});
Route::get('/antrian/konfirmasi/chekin/{id}', [QueueConfirmController::class, 'konfirmasichekin'])->name('antrian/konfirmasi.checkin');
Route::group(['middleware' => ['permission:registrasi ulang antrian']], function () {
    //list antrian untuk registrasi ulang
    Route::get('/antrian', [QueueController::class, 'index'])->name('antrian.index');
    Route::get('/antrian/konfirmasi/edit/{id}', [QueueConfirmController::class, 'edit'])->name('antrian/konfirmasi.edit');
    Route::get('/antrian/konfirmasi/update/{id}', [QueueConfirmController::class, 'update'])->name('antrian/konfirmasi.update');
});

//Pasien
Route::group(['middleware' => ['permission:daftar pasien rumah sakit']], function () {
    Route::get('/pasien', [PatientController::class, 'index'])->name('pasien.index');
    Route::get('/pasien/detail/{id}', [PatientController::class, 'detail'])->name('pasien.detail');
});
Route::group(['middleware' => ['permission:tambah pasien rumah sakit']], function () {
    Route::get('/pasien/create', [PatientController::class, 'create'])->name('pasien.create');
    Route::post('/pasien/store', [PatientController::class, 'store'])->name('pasien.store');
});
Route::group(['middleware' => ['permission:edit pasien rumah sakit']], function () {
    Route::get('/pasien/edit/{id}', [PatientController::class, 'edit'])->name('pasien.edit');
    Route::put('/pasien/update/{id}', [PatientController::class, 'update'])->name('pasien.update');
});
Route::group(['middleware' => ['permission:delete pasien rumah sakit']], function () {
    Route::delete('/pasien/destroy/{id}', [PatientController::class, 'destroy'])->name('pasien.destroy');
});

//Kategori Pasien
Route::group(['middleware' => ['permission:master tanggungan pasien']], function () {
    Route::get('/pasien/category', [PatientCategoryController::class, 'index'])->name('pasien/category');
    Route::get('/pasien/category/create', [PatientCategoryController::class, 'create'])->name('pasien/category.create');
    Route::post('/pasien/category/store', [PatientCategoryController::class, 'store'])->name('pasien/category.store');
    Route::get('/pasien/category/edit/{id}', [PatientCategoryController::class, 'edit'])->name('pasien/category.edit');
    Route::put('/pasien/category/update/{id}', [PatientCategoryController::class, 'update'])->name('pasien/category.update');
    Route::delete('/pasien/category/destroy/{id}', [PatientCategoryController::class, 'destroy'])->name('pasien/category.destroy');
});

//rajal
Route::group(['middleware' => ['permission:daftar pasien poli']], function () {
    Route::get('/rajal', [RawatJalanController::class, 'index'])->name('rajal/index');  //index rajal poli
});
Route::group(['middleware' => ['permission:finish pasien poli', 'permission:show pasien poli']], function () {
    Route::put('/rajal/update/{id}', [RawatJalanController::class, 'update'])->name('rajal/update');
});
Route::group(['middleware' => ['permission:show pasien poli']], function () {
    Route::get('/rajal/show/{id}/{title}', [RawatJalanController::class, 'show'])->name('rajal/show');
});
Route::get('/rajal/panggil/{id}', [RawatJalanController::class, 'panggil'])->name('rajal/panggil');
Route::put('/rajal/update/panggil/{id}', [RawatJalanController::class, 'updatePanggil'])->name('rajal/update/panggil');
Route::get('/rajal/gagal/panggil/{id}', [RawatJalanController::class, 'updateTidakHadir'])->name('rajal/gagal/panggil');
//rekam medis
Route::group(['middleware' => ['permission:daftar pasien rekam medis']], function () {
    Route::get('/rajal/rekammedis/index', [RekamMedisPatientController::class, 'index'])->name('rajal/rekammedis.index'); //index rajal rekam medis
});

//Rajal General Consent
Route::get('rajal/general/consent/create/{id}', [RajalGeneralConsentController::class, 'create'])->name('rajal/general/consent.create');
Route::post('rajal/general/consent/store/{id}', [RajalGeneralConsentController::class, 'store'])->name('rajal/general/consent.store');
Route::get('rajal/general/consent/show/{id}', [RajalGeneralConsentController::class, 'show'])->name('rajal/general/consent.show');
Route::get('rajal/general/consent/showtatatertib/{id}', [RajalGeneralConsentController::class, 'showTataTertib'])->name('rajal/general/consent.showtatatertib');
Route::get('rajal/general/consent/showhakdankewajiban/{id}', [RajalGeneralConsentController::class, 'showHakDanKewajiban'])->name('rajal/general/consent.showhakdankewajiban');
Route::get('rajal/general/consent/edit/{id}', [RajalGeneralConsentController::class, 'edit'])->name('rajal/general/consent.edit');
Route::put('rajal/general/consent/update/{id}', [RajalGeneralConsentController::class, 'update'])->name('rajal/general/consent.update');
Route::delete('rajal/general/consent/destroy/{id}', [RajalGeneralConsentController::class, 'destroy'])->name('rajal/general/consent.destroy');


//assesmen Awal
Route::group(['middleware' => ['permission:tambah assesmen awal']], function () {
    Route::get('/rajal/rmedokter/assesmenawal/create/{id}', [InitialAssesmentController::class, 'create'])->name('rajal/rmedokter/assesmenawal.create');
    Route::post('/rajal/rmedokter/assesmenawal/store/{id}', [InitialAssesmentController::class, 'store'])->name('rajal/rmedokter/assesmenawal.store');
    Route::get('/rajal/rmedokter/assesmenawal/edit/{id}', [InitialAssesmentController::class, 'edit'])->name('rajal/rmedokter/assesmenawal.edit');
    Route::put('/rajal/rmedokter/assesmenawal/update/{id}', [InitialAssesmentController::class, 'update'])->name('rajal/rmedokter/assesmenawal.update');

});
Route::group(['middleware' => ['permission:print assesmen awal']], function () {
    Route::get('/rajal/rmedokter/assesmenawal/show/{id}', [InitialAssesmentController::class, 'show'])->name('rajal/rmedokter/assesmenawal.show');
    Route::get('/rajal/rmedokter/assesmenawal/print/{id}', [InitialAssesmentController::class, 'print'])->name('rajal/rmedokter/assesmenawal.print');
});

//rajal PRMRJ
Route::group(['middleware' => ['permission:tambah prmrj']], function () {
    Route::post('/rajal/prmrj/create', [PrmrjController::class, 'create'])->name('rajal/prmrj.create');
    Route::post('/rajal/prmrj/store', [PrmrjController::class, 'store'])->name('rajal/prmrj.store');
});
Route::group(['middleware' => ['permission:edit prmrj']], function () {
    Route::get('/rajal/prmrj/edit/{id}', [PrmrjController::class, 'edit'])->name('rajal/prmrj.edit');
    Route::put('/rajal/prmrj/update/{id}', [PrmrjController::class, 'update'])->name('rajal/prmrj.update');
});
Route::group(['middleware' => ['permission:print prmrj']], function () {
    Route::get('/rajal/prmrj/show/{id}', [PrmrjController::class, 'show'])->name('rajal/prmrj.show');
});
Route::group(['middleware' => ['permission:delete prmrj']], function () {
    Route::delete('/rajal/prmrj/destroy/{id}', [PrmrjController::class, 'destroy'])->name('rajal/prmrj.destroy');
});


//rajal CPPT
Route::group(['middleware' => ['permission:tambah cppt']], function () {
    Route::get('/rajal/cppt/create/{id}', [RmeCpptController::class, 'create'])->name('rajal/cppt.create');
    Route::post('/rajal/cppt/store/{id}', [RmeCpptController::class, 'store'])->name('rajal/cppt.store');
});
Route::group(['middleware' => ['permission:edit cppt']], function () {
    Route::get('/rajal/cppt/edit/{id}', [RmeCpptController::class, 'edit'])->name('rajal/cppt.edit');
    Route::put('/rajal/cppt/update/{id}', [RmeCpptController::class, 'update'])->name('rajal/cppt.update');
});
Route::group(['middleware' => ['permission:print cppt']], function () {
    Route::get('/rajal/cppt/show/{id}', [RmeCpptController::class, 'show'])->name('rajal/cppt.show');
    Route::get('/rajal/cppt/print/{id}', [RmeCpptController::class, 'print'])->name('rajal/cppt.print');
});
Route::group(['middleware' => ['permission:delete cppt']], function () {
    Route::delete('/rajal/cppt/destroy/{id}', [RmeCpptController::class, 'destroy'])->name('rajal/cppt.destroy');
});
Route::get('/rajal/cppt/update/ttd', [RmeCpptController::class, 'updateTtd'])->name('rajal/cppt/update.ttd');

//rajal request Radiologi
Route::group(['middleware' => ['permission:tambah permintaan radiologi']], function () {
    Route::get('/rajal/permintaan/radiologi/create/{id}', [RadiologiFormRequestController::class, 'create'])->name('rajal/permintaan/radiologi.create');
    Route::post('/rajal/permintaan/radiologi/store/{id}', [RadiologiFormRequestController::class, 'store'])->name('rajal/permintaan/radiologi.store');
});
Route::group(['middleware' => ['permission:print permintaan radiologi']], function () {
    Route::get('/rajal/permintaan/radiologi/show/{queue_id}/{radiologi_id}', [RadiologiFormRequestController::class, 'show'])->name('rajal/permintaan/radiologi.show');
});
Route::get('/rajal/permintaan/radiologi/edit/{queue_id}/{radiologi_id}', [RadiologiFormRequestController::class, 'edit'])->name('rajal/permintaan/radiologi.edit');
Route::post('/rajal/permintaan/radiologi/update/{queue_id}/{radiologi_id}', [RadiologiFormRequestController::class, 'update'])->name('rajal/permintaan/radiologi.update');
Route::group(['middleware' => ['permission:delete permintaan radiologi']], function () {
    Route::delete('/rajal/permintaan/radiologi/destroy/{queue_id}/{radiologi_id}', [RadiologiFormRequestController::class, 'destroy'])->name('rajal/permintaan/radiologi.destroy');
});


Route::group(['middleware', 'permission:master radiologi'], function () {
    //Master Kategori Radiologi
    Route::get('/rajal/master/category/radiologi/create', [RadiologiFormRequestMasterCategoryController::class, 'create'])->name('rajal/master/category/radiologi.create');
    Route::post('/rajal/master/category/radiologi/store', [RadiologiFormRequestMasterCategoryController::class, 'store'])->name('rajal/master/category/radiologi.store');
    Route::get('/rajal/master/category/radiologi/edit/{id}', [RadiologiFormRequestMasterCategoryController::class, 'edit'])->name('rajal/master/category/radiologi.edit');
    Route::put('/rajal/master/category/radiologi/update/{id}', [RadiologiFormRequestMasterCategoryController::class, 'update'])->name('rajal/master/category/radiologi.update');
    Route::delete('/rajal/master/category/radiologi/destroy/{id}', [RadiologiFormRequestMasterCategoryController::class, 'destroy'])->name('rajal/master/category/radiologi.destroy');
    //Master Variabel Radiologi
    Route::get('/rajal/master/radiologi/index', [RadiologiFormRequestMasterController::class, 'index'])->name('rajal/master/radiologi.index');
    Route::get('/rajal/master/radiologi/create', [RadiologiFormRequestMasterController::class, 'create'])->name('rajal/master/radiologi.create');
    Route::post('/rajal/master/radiologi/store', [RadiologiFormRequestMasterController::class, 'store'])->name('rajal/master/radiologi.store');
    Route::get('/rajal/master/radiologi/edit/{id}', [RadiologiFormRequestMasterController::class, 'edit'])->name('rajal/master/radiologi.edit');
    Route::put('/rajal/master/radiologi/update/{id}', [RadiologiFormRequestMasterController::class, 'update'])->name('rajal/master/radiologi.update');
    Route::delete('/rajal/master/radiologi/destroy/{id}', [RadiologiFormRequestMasterController::class, 'destroy'])->name('rajal/master/radiologi.destroy');
    //Master Detail Variabel Radiologi
    Route::get('/rajal/master/detail/radiologi/create', [RadiologiFormRequestMasterDetailController::class, 'create'])->name('rajal/master/detail/radiologi.create');
    Route::post('/rajal/master/detail/radiologi/store', [RadiologiFormRequestMasterDetailController::class, 'store'])->name('rajal/master/detail/radiologi.store');
    Route::get('/rajal/master/detail/radiologi/edit/{id}', [RadiologiFormRequestMasterDetailController::class, 'edit'])->name('rajal/master/detail/radiologi.edit');
    Route::put('/rajal/master/detail/radiologi/update/{id}', [RadiologiFormRequestMasterDetailController::class, 'update'])->name('rajal/master/detail/radiologi.update');
    Route::delete('/rajal/master/detail/radiologi/destroy/{id}', [RadiologiFormRequestMasterDetailController::class, 'destroy'])->name('rajal/master/detail/radiologi.destroy');
    //Master Tarif Variabel Radiologi
    Route::get('/rajal/master/tarif/radiologi/index', [RadiologiFormRequestMasterRateController::class, 'index'])->name('rajal/master/tarif/radiologi.index');
    Route::get('/rajal/master/tarif/radiologi/create/{id}', [RadiologiFormRequestMasterRateController::class, 'create'])->name('rajal/master/tarif/radiologi.create');
    Route::get('/rajal/master/tarif/radiologi/edit/{id}', [RadiologiFormRequestMasterRateController::class, 'edit'])->name('rajal/master/tarif/radiologi.edit');
    Route::put('/rajal/master/tarif/radiologi/update/{id}', [RadiologiFormRequestMasterRateController::class, 'update'])->name('rajal/master/tarif/radiologi.update');
    Route::delete('/rajal/master/tarif/radiologi/destroy/{id}', [RadiologiFormRequestMasterRateController::class, 'destroy'])->name('rajal/master/tarif/radiologi.destroy');
});

//rajal request labor PK
Route::group(['middleware' => ['permission:tambah permintaan labor pk']], function () {
    Route::get('/rajal/laboratorium/request/create/{id}', [LaboratoriumFormRequestController::class, 'index'])->name('rajal/laboratorium/request.index');
    Route::post('rajal/laboratorium/request/store/{id}', [LaboratoriumFormRequestController::class, 'store'])->name('rajal/laboratorium/request.store');
    Route::get('/rajal/laboratorium/request/edit/{id}', [LaboratoriumFormRequestController::class, 'edit'])->name('rajal/laboratorium/request.edit');
    Route::get('/rajal/laboratorium/request/uncheckCategory/{id}', [LaboratoriumFormRequestController::class, 'uncheckCategory'])->name('rajal/laboratorium/request.uncheckCategory');
});
Route::group(['middleware' => ['permission:print permintaan labor pk']], function () {
    Route::get('/rajal/laboratorium/request/show/{queue_id}/{labor_id}', [LaboratoriumFormRequestController::class, 'show'])->name('rajal/laboratorium/request.show');
});
Route::group(['middleware' => ['permission:delete permintaan labor pk']], function () {
    Route::delete('/rajal/laboratorium/request/destroy/{id}', [LaboratoriumFormRequestController::class, 'destroy'])->name('rajal/laboratorium/request.destroy');
});

//ranap request labor PK
Route::group(['middleware' => ['permission:tambah permintaan labor pk']], function () {
    Route::get('/ranap/laboratorium/request/create/{id}', [LaboratoriumFormRequestController::class, 'index'])->name('ranap/laboratorium/request.index');
    Route::post('ranap/laboratorium/request/store/{id}', [LaboratoriumFormRequestController::class, 'store'])->name('ranap/laboratorium/request.store');
    Route::get('/ranap/laboratorium/request/edit/{id}', [LaboratoriumFormRequestController::class, 'edit'])->name('ranap/laboratorium/request.edit');
    Route::get('/ranap/laboratorium/request/uncheckCategory/{id}', [LaboratoriumFormRequestController::class, 'uncheckCategory'])->name('ranap/laboratorium/request.uncheckCategory');
});

//Petugas Labor request labor Pk
Route::get('laboratorium/PK/request/create/{id}', [LaboratoriumRequestRekamMedisController::class, 'create'])->name('laboratorium/PK/request.create');
Route::post('laboratorium/PK/request/store/{id}', [LaboratoriumRequestRekamMedisController::class, 'store'])->name('laboratorium/PK/request.store');

Route::group(['middleware', 'permission:master laboratorium pk'], function () {
    //master tipe permintaan labor PK
    Route::get('/laboratorium/pk/tipe/permintaan/create', [LaboratoriumRequestTypeMasterController::class, 'create'])->name('laboratorium/pk/tipe/permintaan.create');
    Route::post('/laboratorium/pk/tipe/permintaan/store', [LaboratoriumRequestTypeMasterController::class, 'store'])->name('laboratorium/pk/tipe/permintaan.store');
    Route::get('/laboratorium/pk/tipe/permintaan/edit/{id}', [LaboratoriumRequestTypeMasterController::class, 'edit'])->name('laboratorium/pk/tipe/permintaan.edit');
    Route::put('/laboratorium/pk/tipe/permintaan/update/{id}', [LaboratoriumRequestTypeMasterController::class, 'update'])->name('laboratorium/pk/tipe/permintaan.update');
    Route::delete('/laboratorium/pk/tipe/permintaan/destroy/{id}', [LaboratoriumRequestTypeMasterController::class, 'destroy'])->name('laboratorium/pk/tipe/permintaan.destroy');
    //master kategori pemeriksaan labor PK
    Route::get('/laboratorium/pk/category/pemeriksaan/create', [LaboratoriumRequestCategoryMasterController::class, 'create'])->name('laboratorium/pk/category/pemeriksaan.create');
    Route::post('/laboratorium/pk/category/pemeriksaan/store', [LaboratoriumRequestCategoryMasterController::class, 'store'])->name('laboratorium/pk/category/pemeriksaan.store');
    Route::get('/laboratorium/pk/category/pemeriksaan/edit/{id}', [LaboratoriumRequestCategoryMasterController::class, 'edit'])->name('laboratorium/pk/category/pemeriksaan.edit');
    Route::put('/laboratorium/pk/category/pemeriksaan/update/{id}', [LaboratoriumRequestCategoryMasterController::class, 'update'])->name('laboratorium/pk/category/pemeriksaan.update');
    Route::delete('/laboratorium/pk/category/pemeriksaan/destroy/{id}', [LaboratoriumRequestCategoryMasterController::class, 'destroy'])->name('laboratorium/pk/category/pemeriksaan.destroy');
    //master variabel pemeriksaan labor PK
    Route::get('/laboratorium/pk/variabel/pemeriksaan/create', [LaboratoriumMasterVariabelPemeriksaanController::class, 'create'])->name('laboratorium/pk/variabel/pemeriksaan.create');
    Route::post('/laboratorium/pk/variabel/pemeriksaan/store', [LaboratoriumMasterVariabelPemeriksaanController::class, 'store'])->name('laboratorium/pk/variabel/pemeriksaan.store');
    Route::get('/laboratorium/pk/variabel/pemeriksaan/edit/{id}', [LaboratoriumMasterVariabelPemeriksaanController::class, 'edit'])->name('laboratorium/pk/variabel/pemeriksaan.edit');
    Route::put('/laboratorium/pk/variabel/pemeriksaan/update/{id}', [LaboratoriumMasterVariabelPemeriksaanController::class, 'update'])->name('laboratorium/pk/variabel/pemeriksaan.update');
    Route::delete('/laboratorium/pk/variabel/pemeriksaan/destroy/{id}', [LaboratoriumMasterVariabelPemeriksaanController::class, 'destroy'])->name('laboratorium/pk/variabel/pemeriksaan.destroy');
    //master detail variabel pemeriksaan labor PK
    Route::post('/laboratorium/pk/kondisi/normal/variabel/store/{id}', [LaboratoriumRequestMasterDetailController::class, 'store'])->name('laboratorium/pk/kondisi/normal/variabel.store');
    Route::get('/laboratorium/pk/kondisi/normal/variabel/edit/{id}', [LaboratoriumRequestMasterDetailController::class, 'edit'])->name('laboratorium/pk/kondisi/normal/variabel.edit');
    Route::put('/laboratorium/pk/kondisi/normal/variabel/update/{id}', [LaboratoriumRequestMasterDetailController::class, 'update'])->name('laboratorium/pk/kondisi/normal/variabel.update');
    Route::delete('/laboratorium/pk/kondisi/normal/variabel/destroy/{id}', [LaboratoriumRequestMasterDetailController::class, 'destroy'])->name('laboratorium/pk/kondisi/normal/variabel.destroy');
    //master Tarif variabel pemeriksaan labor PK
    Route::get('/laboratorium/pk/tarif/pemeriksaan/index', [LaboratoriumRequestMasterRateController::class, 'index'])->name('laboratorium/pk/tarif/pemeriksaan.index');
    Route::get('/laboratorium/pk/tarif/pemeriksaan/create/{id}', [LaboratoriumRequestMasterRateController::class, 'create'])->name('laboratorium/pk/tarif/pemeriksaan.create');
    Route::get('/laboratorium/pk/tarif/pemeriksaan/show/{id}', [LaboratoriumRequestMasterRateController::class, 'show'])->name('laboratorium/pk/tarif/pemeriksaan.show');
    Route::post('/laboratorium/pk/tarif/pemeriksaan/store', [LaboratoriumRequestMasterRateController::class, 'store'])->name('laboratorium/pk/tarif/pemeriksaan.store');
    Route::get('/laboratorium/pk/tarif/pemeriksaan/edit/{id}', [LaboratoriumRequestMasterRateController::class, 'edit'])->name('laboratorium/pk/tarif/pemeriksaan.edit');
    //update tarif per kategori pasien
    Route::put('/laboratorium/pk/tarif/pemeriksaan/update/{id}', [LaboratoriumRequestMasterRateController::class, 'update'])->name('laboratorium/pk/tarif/pemeriksaan.update');
    //update tarif per variabel pemeriksaan labor
    Route::put('/laboratorium/pk/variabel/tarif/pemeriksaan/update/{id}', [LaboratoriumRequestMasterRateController::class, 'update'])->name('laboratorium/pk/variabel/tarif/pemeriksaan.update');
});

//rajal tindakan
Route::group(['middleware' => ['permission:tambah laporan tindakan']], function () {
    Route::post('/rajal/laporan/tindakan/create', [PatientActionReportController::class, 'create'])->name('rajal/laporan/tindakan.create');
    Route::post('/rajal/laporan/tindakan/store', [PatientActionReportController::class, 'store'])->name('rajal/laporan/tindakan.store');
});
Route::group(['middleware' => ['permission:edit laporan tindakan']], function () {
    Route::get('/rajal/laporan/tindakan/edit/{id}', [PatientActionReportController::class, 'edit'])->name('rajal/laporan/tindakan.edit');
    Route::put('/rajal/laporan/tindakan/update/{id}', [PatientActionReportController::class, 'update'])->name('rajal/laporan/tindakan.update');
});
Route::group(['middleware' => ['permission:print laporan tindakan']], function () {
    Route::get('/rajal/laporan/tindakan/show/{id}', [PatientActionReportController::class, 'show'])->name('rajal/laporan/tindakan.show');
});
Route::group(['middleware' => ['permission:delete laporan tindakan']], function () {
    Route::delete('/rajal/laporan/tindakan/destroy/{id}', [PatientActionReportController::class, 'destroy'])->name('rajal/laporan/tindakan.destroy');
});

//resep dokter
Route::group(['middleware' => ['permission:edit resep dokter']], function () {
    Route::get('/rajal/resep/dokter/edit/{id}', [MedicineReceiptController::class, 'edit'])->name('rajal/resep/dokter.edit');
    Route::put('/rajal/resep/dokter/update/{id}', [MedicineReceiptController::class, 'update'])->name('rajal/resep/dokter.update');
});
Route::group(['middleware' => ['permission:print resep dokter']], function () {
    Route::get('/rajal/resep/dokter/show/{id}', [MedicineReceiptController::class, 'show'])->name('rajal/resep/dokter.show');
});
Route::group(['middleware' => ['permission:hapus resep dokter']], function () {
    Route::delete('/rajal/resep/dokter/destroy/{id}', [MedicineReceiptController::class, 'destroy'])->name('rajal/resep/dokter.destroy');
});

//sbpk
// Route::group(['middleware' => ['permission:edit resep dokter']], function(){
Route::get('/rajal/sbpk/create/{id}', [SuratBuktiPelayananPatientController::class, 'create'])->name('rajal/sbpk.create');
Route::post('/rajal/sbpk/store/{id}', [SuratBuktiPelayananPatientController::class, 'store'])->name('rajal/sbpk.store');
Route::get('/rajal/sbpk/edit/{id}', [SuratBuktiPelayananPatientController::class, 'edit'])->name('rajal/sbpk.edit');
Route::put('/rajal/sbpk/update/{id}', [SuratBuktiPelayananPatientController::class, 'update'])->name('rajal/sbpk.update');
Route::get('/rajal/sbpk/update/ttd', [SuratBuktiPelayananPatientController::class, 'getTtd'])->name('rajal/sbpk.ttd');
// });
// Route::group(['middleware' => ['permission:print resep dokter']], function(){
Route::get('/rajal/sbpk/show/{id}', [SuratBuktiPelayananPatientController::class, 'show'])->name('rajal/sbpk.show');
// });
// Route::group(['middleware' => ['permission:hapus resep dokter']], function(){
Route::delete('/rajal/sbpk/destroy/{id}', [SuratBuktiPelayananPatientController::class, 'destroy'])->name('rajal/sbpk.destroy');

// suratKeterangan
Route::get('/rajal/keterangan-sbpk/create/{id}/{surat_id}', [SuratBuktiPelayananPatientController::class, 'createSuratKeterangan'])->name('rajal/keterangan-sbpk.create');
Route::post('/rajal/keterangan-sbpk/store/{id}/{surat_id}', [SuratBuktiPelayananPatientController::class, 'storeSuratKeterangan'])->name('rajal/keterangan-sbpk.store');
Route::get('/rajal/keterangan-sbpk/edit/{id}', [SuratBuktiPelayananPatientController::class, 'editSuratKeterangan'])->name('rajal/keterangan-sbpk.edit');
Route::put('/rajal/keterangan-sbpk/update/{id}', [SuratBuktiPelayananPatientController::class, 'updateSuratKeterangan'])->name('rajal/keterangan-sbpk.update');
// });

//Asesment Perawat Status Fisik
Route::get('/rajal/asesmen/status/fisik/index/{id}', [AsesmentKeperawatanStatusFisikController::class, 'index'])->name('rajal/asesmen/status/fisik.index');
Route::post('/rajal/asesmen/status/fisik/store/{id}', [AsesmentKeperawatanStatusFisikController::class, 'store'])->name('rajal/asesmen/status/fisik.store');
Route::post('/rajal/asesmen/status/fisik/save/{id}', [AsesmentKeperawatanStatusFisikController::class, 'save'])->name('rajal/asesmen/status/fisik.save');

//Asesment Perawat Skrining Resiko Jatuh
Route::get('/rajal/asesmen/skrining/resiko/jatuh/index/{id}', [AsesmentKeperawatanSkriningResikoJatuhController::class, 'index'])->name('rajal/asesmen/skrining/resiko/jatuh.index');
Route::post('/rajal/asesmen/skrining/resiko/jatuh/store/{id}', [AsesmentKeperawatanSkriningResikoJatuhController::class, 'store'])->name('rajal/asesmen/skrining/resiko/jatuh.store');

//Asesment Perawat Diagnosis Keperawatan
Route::get('/rajal/asesmen/diagnosis/keperawatan/index/{id}', [AsesmentKeperawatanDiagnosisController::class, 'index'])->name('rajal/asesmen/diagnosis/keperawatan.index');
Route::post('/rajal/asesmen/diagnosis/keperawatan/store/{id}', [AsesmentKeperawatanDiagnosisController::class, 'store'])->name('rajal/asesmen/diagnosis/keperawatan.store');

//Asesment Perawat Diagnosis Keperawatan
Route::get('/rajal/asesmen/rencana/asuhan/index/{id}', [AsesmentKeperawatanRencanaAsuhanController::class, 'index'])->name('rajal/asesmen/rencana/asuhan.index');
Route::post('/rajal/asesmen/rencana/asuhan/store/{id}', [AsesmentKeperawatanRencanaAsuhanController::class, 'store'])->name('rajal/asesmen/rencana/asuhan.store');


// Route::group(['middleware' => ['permission:tambah rme perawat']], function(){
Route::get('/rajal/asesmen/index/{id}', [AsesmentPerawatController::class, 'index'])->name('rajal/asesmen.index');
Route::get('/rajal/asesmen/index/statusFisik/{id}', [AsesmentPerawatController::class, 'statusFisik'])->name('rajal/asesmen/statusFisik.index');
Route::post('/rajal/asesmen/store/{id}', [AsesmentPerawatController::class, 'store'])->name('rajal/asesmen.store');
Route::get('/ranap/asesmen/index/{id}', [AsesmentPerawatController::class, 'index'])->name('ranap/asesmen.index');
// });
Route::group(['middleware' => ['permission:lihat rme perawat']], function () {
    Route::get('/rajal/asesmen/show/{id}', [AsesmentPerawatController::class, 'show'])->name('rajal/asesmen.show');
    Route::get('/rajal/asesmen/print/{id}', [AsesmentPerawatController::class, 'print'])->name('rajal/asesmen.print');
});

//Asuhan Keperawatan Pasien
Route::group(['middleware' => ['permission:asuhan keperawatan']], function () {
    Route::get('/rajal/asuhan/keperawatan/index/{id}', [AsuhanKeperawatanController::class, 'index'])->name('rajal/asuhan.index');
});

//rajal farmasi
Route::group(['middleware' => ['permission:daftar pasien farmasi rajal']], function () {
    Route::get('/rajal/farmasi/index', [RawatJalanFarmasiController::class, 'index'])->name('rajal/farmasi/index');
});
Route::group(['middleware' => ['permission:show pasien farmasi rajal']], function () {
    Route::get('/rajal/farmasi/create/{id}', [RawatJalanFarmasiController::class, 'create'])->name('rajal/farmasi/create');
});
Route::group(['middleware' => ['permission:perbarui status farmasi rajal']], function () {
    Route::put('/rajal/farmasi/update/status/{id}', [RawatJalanFarmasiController::class, 'updateStatus'])->name('rajal/farmasi/update/status.updateStatus');
});
Route::group(['middleware' => ['permission:input resep obat|permission:edit resep obat|permission:print resep obat']], function () {
    Route::post('/rajal/farmasi/store', [RawatJalanFarmasiController::class, 'store'])->name('rajal/farmasi/store');
    Route::get('/rajal/farmasi/edit/{id}', [RawatJalanFarmasiController::class, 'edit'])->name('rajal/farmasi/edit');
    Route::put('/rajal/farmasi/update/{id}', [RawatJalanFarmasiController::class, 'update'])->name('rajal/farmasi/update');
    Route::get('/rajal/farmasi/show/{id}', [RawatJalanFarmasiController::class, 'show'])->name('rajal/farmasi/show');
});

//rajal Kasir
Route::group(['middleware' => ['permission:daftar pembayaran']], function () {
    Route::get('/rajal/kasir/pembayaran', [KasirController::class, 'index'])->name('rajal/kasir/pembayaran/index');
});
Route::group(['middleware' => ['permission:show pembayaran']], function () {
    Route::get('/rajal/kasir/pembayaran/edit/{id}', [KasirController::class, 'edit'])->name('rajal/kasir/pembayaran/edit');
});
Route::get('/rajal/kasir/pembayaran/show/{id}', [KasirController::class, 'show'])->name('rajal/kasir/pembayaran/show');
Route::group(['middleware' => ['permission:perbarui status pembayaran']], function () {
    Route::put('/rajal/kasir/pembayaran/update/{id}', [KasirController::class, 'update'])->name('rajal/kasir/pembayaran/update');
});

//Laboratorium Patient

Route::group(['middleware' => ['permission:list permintaan pemeriksaan laboratorium pk']], function () {
    Route::get('/laboratorium/patient', [LaboratoriumPatientController::class, 'index'])->name('laboratorium/patient.index');
});
Route::group(['middleware' => ['permission:input hasil pemeriksaan laboratorium pk']], function () {
    Route::get('/laboratorium/patient/hasil/create/{id}', [LaboratoriumPatientController::class, 'create'])->name('laboratorium/patient/hasil.create');
    Route::post('/laboratorium/patient/hasil/store/{id}', [LaboratoriumPatientController::class, 'store'])->name('laboratorium/patient/hasil.store');
});
Route::group(['middleware' => ['permission:edit hasil pemeriksaan laboratorium pk']], function () {
    Route::get('/laboratorium/patient/hasil/edit/{id}', [LaboratoriumPatientController::class, 'edit'])->name('laboratorium/patient/hasil.edit');
    Route::put('/laboratorium/patient/hasil/update/{id}', [LaboratoriumPatientController::class, 'update'])->name('laboratorium/patient/hasil.update');
});
Route::group(['middleware' => ['permission:print hasil pemeriksaan laboratorium pk']], function () {
    Route::get('/laboratorium/patient/hasil/show/{id}', [LaboratoriumPatientController::class, 'show'])->name('laboratorium/patient/hasil.show');
});
// Route::group(['middleware' => ['permission:print hasil pemeriksaan laboratorium pk']], function(){
Route::get('/laboratorium/patient/hasil/reviewUlang/{id}', [LaboratoriumPatientController::class, 'reviewUlang'])->name('laboratorium/patient/hasil.reviewUlang');
Route::post('/laboratorium/patient/hasil/reviewUlangStore/{id}', [LaboratoriumPatientController::class, 'reviewUlangStore'])->name('laboratorium/patient/hasil.reviewUlangStore');
// });
//checkKondisiKritis
Route::get('/laboratorium/patient/queue/show/{id}', [LaboratoriumPatientQueueController::class, 'show'])->name('laboratorium/patient/queue.show');

//Laboratorium Patient Queue
Route::group(['middleware' => ['permission:daftar jadwal pemeriksaan laboratorium pk']], function () {
    Route::get('/laboratorium/patient/queue', [LaboratoriumPatientQueueController::class, 'index'])->name('laboratorium/patient/queue.index');
});
Route::group(['middleware' => ['permission:atur jadwal pemeriksaan laboratorium pk|permission:edit jadwal pemeriksaan laboratorium pk']], function () {
    Route::get('/laboratorium/patient/queue/create/{id}', [LaboratoriumPatientQueueController::class, 'create'])->name('laboratorium/patient/queue.create');
    Route::post('/laboratorium/patient/queue/store/{id}', [LaboratoriumPatientQueueController::class, 'store'])->name('laboratorium/patient/queue.store');
});
Route::group(['middleware' => ['permission:validasi status pemeriksaan laboratorium pk']], function () {
    Route::put('/laboratorium/patient/queue/update/{id}', [LaboratoriumPatientQueueController::class, 'update'])->name('laboratorium/patient/queue.update');
});

//Radiologi Patient
Route::group(['middleware' => ['permission:list permintaan pemeriksaan radiologi']], function () {
    Route::get('/radiologi/patient', [RadiologiPatientController::class, 'index'])->name('radiologi/patient.index');
});
Route::group(['middleware' => ['permission:show detail pemeriksaan radiologi']], function () {
    Route::get('/radiologi/patient/create/{id}', [RadiologiPatientController::class, 'create'])->name('radiologi/patient.create');
});
Route::group(['middleware' => ['permission:print hasil pemeriksaan radiologi']], function () {
    Route::get('/radiologi/patient/hasil/show/{id}', [RadiologiPatientController::class, 'show'])->name('radiologi/patient/hasil.show');
    Route::get('/radiologi/patient/hasil/showChange/{id}', [RadiologiPatientController::class, 'showChange'])->name('radiologi/patient/hasil.showChange');
});
Route::group(['middleware' => ['permission:input hasil pemeriksaan radiologi']], function () {
    Route::get('/radiologi/patient/hasil/edit/{id}', [RadiologiPatientController::class, 'edit'])->name('radiologi/patient/hasil.edit');
    Route::put('/radiologi/patient/hasil/update/{id}', [RadiologiPatientController::class, 'update'])->name('radiologi/patient/hasil.update');
});


//Radiologi Patient Queue
Route::group(['middleware' => ['permission:daftar jadwal pemeriksaan radiologi']], function () {
    Route::get('/radiologi/patient/queue', [RadiologiPatientQueueController::class, 'index'])->name('radiologi/patient/queue.index');
});
Route::group(['middleware' => ['permission:edit jadwal pemeriksaan radiologi|permission:atur jadwal pemeriksaan radiologi']], function () {
    Route::get('/radiologi/patient/queue/create/{id}', [RadiologiPatientQueueController::class, 'create'])->name('radiologi/patient/queue.create');
    Route::post('/radiologi/patient/queue/store/{id}', [RadiologiPatientQueueController::class, 'store'])->name('radiologi/patient/queue.store');
});
Route::group(['middleware' => ['permission:validasi status pemeriksaan radiologi']], function () {
    Route::put('/radiologi/patient/queue/update/{id}', [RadiologiPatientQueueController::class, 'update'])->name('radiologi/patient/queue.update');
});

//Permintaan Laboratorium Patologi Anatomik
//list permintaan pemeriksaan labor pa
Route::group(['middleware' => ['permission:list permintaan pemeriksaan laboratorium pa']], function () {
    Route::get('/permintaan/laboratorium/patologi/anatomik/index', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'index'])->name('permintaan/laboratorium/patologi/anatomik.index');
});

// atur jadwal pemeriksaan laboratorium pa
Route::group(['middleware' => ['permission:atur jadwal pemeriksaan laboratorium pa']], function () {
    Route::get('/permintaan/laboratorium/patologi/anatomik/createAntrian/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'createAntrian'])->name('permintaan/laboratorium/patologi/anatomik.createAntrian');
    Route::post('/permintaan/laboratorium/patologi/anatomik/storeAntrian/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'storeAntrian'])->name('permintaan/laboratorium/patologi/anatomik.storeAntrian');
});

//daftar jadwal pemeriksaan labor pa
Route::group(['middleware' => ['permission:daftar jadwal pemeriksaan laboratorium pa']], function () {
    Route::get('/permintaan/laboratorium/patologi/anatomik/indexAntrian', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'indexAntrian'])->name('permintaan/laboratorium/patologi/anatomik.indexAntrian');
    Route::get('/permintaan/laboratorium/patologi/anatomik/show/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'show'])->name('permintaan/laboratorium/patologi/anatomik.show');
});

// input hasil pemeriksaan laboratorium pa
Route::group(['middleware' => ['permission:input hasil pemeriksaan laboratorium pa']], function () {
    Route::get('/permintaan/laboratorium/patologi/anatomik/createHistopatologi/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'createHistopatologi'])->name('permintaan/laboratorium/patologi/anatomik.createHistopatologi');
    Route::post('/permintaan/laboratorium/patologi/anatomik/storeHasilHispatologi/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'storeHasilHispatologi'])->name('permintaan/laboratorium/patologi/anatomik.storeHasilHispatologi');
    Route::get('/permintaan/laboratorium/patologi/anatomik/createSitopatologi/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'createSitopatologi'])->name('permintaan/laboratorium/patologi/anatomik.createSitopatologi');
    Route::post('/permintaan/laboratorium/patologi/anatomik/storeHasilSitopatologi/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'storeHasilSitopatologi'])->name('permintaan/laboratorium/patologi/anatomik.storeHasilSitopatologi');
});

//edit hasil pemeriksaan laboratorium pa
Route::group(['middleware' => ['permission:edit hasil pemeriksaan laboratorium pa']], function () {
    Route::get('/permintaan/laboratorium/patologi/anatomik/editHistopatologi/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'editHistopatologi'])->name('permintaan/laboratorium/patologi/anatomik.editHistopatologi');
    Route::put('/permintaan/laboratorium/patologi/anatomik/updateHasilHispatologi/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'updateHasilHispatologi'])->name('permintaan/laboratorium/patologi/anatomik.updateHasilHispatologi');
    Route::get('/permintaan/laboratorium/patologi/anatomik/editSitopatologi/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'editSitopatologi'])->name('permintaan/laboratorium/patologi/anatomik.editSitopatologi');
    Route::put('/permintaan/laboratorium/patologi/anatomik/updateHasilSitopatologi/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'updateHasilSitopatologi'])->name('permintaan/laboratorium/patologi/anatomik.updateHasilSitopatologi');
});

//print hasil pemeriksaan laboratorium pa
Route::group(['middleware' => ['permission:print hasil pemeriksaan laboratorium pa']], function () {
    Route::get('/permintaan/laboratorium/patologi/anatomik/showHistopatologi/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'showHistopatologi'])->name('permintaan/laboratorium/patologi/anatomik.showHistopatologi');
    Route::get('/permintaan/laboratorium/patologi/anatomik/showSitopatologi/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'showSitopatologi'])->name('permintaan/laboratorium/patologi/anatomik.showSitopatologi');
});

//validasi status pemeriksaan laboratorium pa
Route::group(['middleware' => ['permission:validasi status pemeriksaan laboratorium pa']], function () {
    Route::put('/permintaan/laboratorium/patologi/anatomik/updateStatus/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'updateStatus'])->name('permintaan/laboratorium/patologi/anatomik.updateStatus');
});

//tambah permintaan labor pa
// Route::group(['middleware' => ['permission:tambah permintaan labor pa']], function () {
Route::get('/permintaan/laboratorium/patologi/anatomik/create/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'create'])->name('permintaan/laboratorium/patologi/anatomik.create');
Route::post('/permintaan/laboratorium/patologi/anatomik/store/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'store'])->name('permintaan/laboratorium/patologi/anatomik.store');
Route::get('/permintaan/laboratorium/patologi/anatomik/edit/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'edit'])->name('permintaan/laboratorium/patologi/anatomik.edit');
Route::post('/permintaan/laboratorium/patologi/anatomik/update/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'update'])->name('permintaan/laboratorium/patologi/anatomik.update');
Route::get('/permintaan/laboratorium/patologi/anatomik/print/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'print'])->name('permintaan/laboratorium/patologi/anatomik.print');
Route::get('/permintaan/laboratorium/patologi/anatomik/delete/{id}', [PermintaanLaboratoriumPatogologiAnatomikController::class, 'delete'])->name('permintaan/laboratorium/patologi/anatomik.delete');
// });

//Surat Pengantar Ranap
// Route::get('/surat/pengantar/index', [SuratPengantarRawatController::class, 'index'])->name('suratpengantar.index');
Route::group(['middleware' => ['permission:tambah surat pengantar ranap']], function () {
    Route::get('/surat/pengantar/create/{id}', [SuratPengantarRawatController::class, 'create'])->name('suratpengantar.create');
    Route::post('/surat/pengantar/store/{id}', [SuratPengantarRawatController::class, 'store'])->name('suratpengantar.store');
});
Route::group(['middleware' => ['permission:edit surat pengantar ranap']], function () {
    Route::get('/surat/pengantar/edit/{id}', [SuratPengantarRawatController::class, 'edit'])->name('suratpengantar.edit');
    Route::put('/surat/pengantar/update/{id}', [SuratPengantarRawatController::class, 'update'])->name('suratpengantar.update');
});
Route::group(['middleware' => ['permission:delete surat pengantar ranap']], function () {
    Route::delete('/surat/pengantar/destroy/{id}', [SuratPengantarRawatController::class, 'destroy'])->name('suratpengantar.destroy');
});
Route::get('/surat/pengantar/show/{id}', [SuratPengantarRawatController::class, 'show'])->name('suratpengantar.show');


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

Route::get('/laporan/lab/patologi/anatomi', [ReportPenunjangController::class, 'indexPa'])->name('laporan/lab/patologi/anatomi.index');
Route::get('/laporan/lab/patologi/anatomi/show/{id}', [ReportPenunjangController::class, 'showPa'])->name('laporan/lab/patologi/anatomi.show');
Route::get('/laporan/lab/patologi/anatomi/exportExcel/{id}', [ReportPenunjangController::class, 'exportExcelPa'])->name('laporan/lab/patologi/anatomi.exportExcel');

Route::get('/laporan/lab/radiologi', [ReportPenunjangController::class, 'indexRad'])->name('laporan/lab/radiologi.index');
Route::get('/laporan/lab/radiologi/show/{id}', [ReportPenunjangController::class, 'showRad'])->name('laporan/lab/radiologi.show');
Route::get('/laporan/lab/radiologi/exportExcel/{id}', [ReportPenunjangController::class, 'exportExcelRad'])->name('laporan/lab/radiologi.exportExcel');

//Keuangan
Route::post('tarif/layanan/store', [TarifController::class, 'store'])->name('tarif/layanan.store');
Route::put('tarif/layanan/update/{id}', [TarifController::class, 'update'])->name('tarif/layanan.update');
Route::get('tarif/layanan/tarifLayananStore', [TarifController::class, 'tarifLayananStore'])->name('tarif/layanan.tarifLayananStore');
Route::get('tarif/layanan/index', [TarifController::class, 'index'])->name('tarif/layanan.index');
Route::get('tarif/layanan/show/{type}', [TarifController::class, 'show'])->name('tarif/layanan.show');
Route::get('tarif/layanan/create/{type}', [TarifController::class, 'create'])->name('tarif/layanan.create');
Route::get('tarif/layanan/edit/{id}', [TarifController::class, 'edit'])->name('tarif/layanan.edit');
Route::delete('tarif/layanan/destroy/{id}', [TarifController::class, 'destroy'])->name('tarif/layanan.destroy');

// end Rawat Inap New Menu
require __DIR__ . '/auth.php';
