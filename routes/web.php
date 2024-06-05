<?php

use App\Models\Queue;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BedController;
use App\Http\Controllers\GetConversion;
use App\Http\Controllers\IcdController;
use App\Http\Controllers\IgdController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PrmrjController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\UrineController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\InacbgController;
use App\Models\KemoterapiDischargeSummary;
use App\Http\Controllers\BedroomController;
use App\Http\Controllers\BedTypeController;
use App\Http\Controllers\CasemixController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\GetStokController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RmeCpptController;
use App\Http\Controllers\SurgeryController;
use App\Http\Controllers\AnsietasController;
use App\Http\Controllers\AsuransiController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CpptRanapController;
use App\Http\Controllers\GeneralConsentRanap;
use App\Http\Controllers\IgdTriageController;
use App\Http\Controllers\NyeriAkutController;
use App\Http\Controllers\RawatInapController;
use App\Http\Controllers\RawatInapNewController;
use App\Http\Controllers\ReferensiController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\DoctorPoliController;
use App\Http\Controllers\GetWilayahController;
use App\Http\Controllers\IgdRmeCpptController;
use App\Http\Controllers\RawatJalanController;
use App\Http\Controllers\RoomDetailController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\BedroomRatesController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\MedicineFormController;
use App\Http\Controllers\MedicineStokController;
use App\Http\Controllers\MedicineTypeController;
use App\Http\Controllers\QueueConfirmController;
use App\Http\Controllers\SurgeryRatesController;
use App\Http\Controllers\ActionMembersController;
use App\Http\Controllers\IgdPatientRmeController;
use App\Http\Controllers\InvoiceReturnController;
use App\Http\Controllers\QueueUriologiController;
use App\Http\Controllers\ReportCashierController;
use App\Http\Controllers\ActionCategoryController;
use App\Http\Controllers\AsuransiDetailController;
use App\Http\Controllers\BillingCaptionController;
use App\Http\Controllers\CpptKemoterapiController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\IgdTriageScaleController;
use App\Http\Controllers\LaporanOperasiController;
use App\Http\Controllers\RanapAlihRawatController;
use App\Http\Controllers\UnitConversionController;
use App\Models\RanapRekapTindakanPelayananPatient;
use App\Http\Controllers\AsesmentPerawatController;
use App\Http\Controllers\MedicineReceiptController;
use App\Http\Controllers\PatientCategoryController;
use App\Http\Controllers\ReportDrugUsageController;
use App\Http\Controllers\ReportPenunjangController;
use App\Http\Controllers\SurgeryCategoryController;
use App\Http\Controllers\GetTriageCheckupController;
use App\Http\Controllers\IgdTriageCheckupController;
use App\Http\Controllers\InitialAssesmentController;
use App\Http\Controllers\InvoicePembelianController;
use App\Http\Controllers\MedicineCategoryController;
use App\Http\Controllers\RadiologiPatientController;
use App\Http\Controllers\ActionMemberRatesController;
use App\Http\Controllers\AsuhanKeperawatanController;
use App\Http\Controllers\IgdGeneralConsentController;
use App\Http\Controllers\KemoterapiPatientController;
use App\Http\Controllers\RawatJalanFarmasiController;
use App\Http\Controllers\RekamMedisPatientController;
use App\Http\Controllers\UnitCategoryPivotController;
use App\Http\Controllers\IgdInitialAssesmentController;
use App\Http\Controllers\LaboratoriumPatientController;
use App\Http\Controllers\PatientActionReportController;
use App\Http\Controllers\RanapEwsAnakPatientController;
use App\Http\Controllers\RanapHaisIADPatientController;
use App\Http\Controllers\RanapHaisIDOPatientController;
use App\Http\Controllers\RanapHaisISKPatientController;
use App\Http\Controllers\SuratPengantarRawatController;
use App\Http\Controllers\MedicineDistributionController;
use App\Http\Controllers\RadiologiFormRequestController;
use App\Http\Controllers\RanapEvaluasiAwalMppController;
use App\Http\Controllers\RanapLaporanAnestesiController;
use App\Http\Controllers\RanapMedicineReceiptController;
use App\Http\Controllers\RekamMedisElektronikController;
use App\Http\Controllers\UnitConversionMasterController;
use App\Http\Controllers\KemoterapiPersetujuanController;
use App\Http\Controllers\KemoterapiSbpkPatientController;
use App\Http\Controllers\RadiologiPatientQueueController;
use App\Http\Controllers\RanapDischargeSummaryController;
use App\Http\Controllers\RanapEwsDewasaPatientController;
use App\Http\Controllers\RanapInitialAssesmentController;
use App\Http\Controllers\CatatanPerjalananRanapController;
use App\Http\Controllers\CostEstimateSimulationController;
use App\Http\Controllers\IgdSuratPengantarRawatController;
use App\Http\Controllers\RanapAssesmenPraSedasiController;
use App\Http\Controllers\GangguanIntegritasKulitController;
use App\Http\Controllers\LaboratoriumFormRequestController;
use App\Http\Controllers\RingkasanMasukDanKeluarController;
use App\Http\Controllers\IgdTriageCategoryCheckupController;
use App\Http\Controllers\KemoterapiAntrianPatientController;
use App\Http\Controllers\KemoterapiGeneralConsentController;
use App\Http\Controllers\LaboratoriumPatientQueueController;
use App\Http\Controllers\MedicineTransactionReturnController;
use App\Http\Controllers\RanapFormulirRekonsilasiObatPatient;
use App\Http\Controllers\SkriningCovidRanapPatientController;
use App\Http\Controllers\IgdAssesmenAwalKeperawatanController;
use App\Http\Controllers\KemoterapiDischargeSummaryController;
use App\Http\Controllers\KemoterapiInitialAssesmentController;
use App\Http\Controllers\MedicineDistributionReturnController;
use App\Http\Controllers\RadiologiFormRequestMasterController;
use App\Http\Controllers\RadiologiRequestRekamMedisController;
use App\Http\Controllers\RanapIntervensiResikoJatuhController;
use App\Http\Controllers\RanapMonitoringCairanInfusController;
use App\Http\Controllers\RanapMonitoringResikoJatuhController;
use App\Http\Controllers\SuratBuktiPelayananPatientController;
use App\Http\Controllers\MedicineDistributionRequestController;
use App\Http\Controllers\AsesmentKeperawatanDiagnosisController;
use App\Http\Controllers\AssesmenAwalKeperawatanRanapController;
use App\Http\Controllers\KemoterapiMonitoringTindakanController;
use App\Http\Controllers\MedicineDistributionResponseController;
use App\Http\Controllers\MedicineTransactionPembelianController;
use App\Http\Controllers\RanapFormulirRekonsilasiObatController;
use App\Http\Controllers\RanapSurgicalSafetyChecklistController;
use App\Http\Controllers\GangguanMobilitasFisikPatientController;
use App\Http\Controllers\KemoterapiLembarKonsulPatientController;
use App\Http\Controllers\LaboratoriumRequestMasterRateController;
use App\Http\Controllers\LaboratoriumRequestRekamMedisController;
use App\Http\Controllers\LaboratoriumRequestTypeMasterController;
use App\Http\Controllers\RanapEdukasiPasienPraAnestesiController;
use App\Http\Controllers\AsesmentKeperawatanStatusFisikController;
use App\Http\Controllers\RadiologiFormRequestMasterRateController;
use App\Http\Controllers\IgdAsesmentKeperawatanDiagnosisController;
use App\Http\Controllers\LaboratoriumRequestMasterDetailController;
use App\Http\Controllers\RanapMonitoringStatusFungsionalController;
use App\Http\Controllers\AsesmentKeperawatanRencanaAsuhanController;
use App\Http\Controllers\RadiologiFormRequestMasterDetailController;
use App\Http\Controllers\AsesmentKeperawatanDiagnosisRanapController;
use App\Http\Controllers\AssesmenAwalKeperawatanKemoterapiController;
use App\Http\Controllers\IgdAsesmentKeperawatanStatusFisikController;
use App\Http\Controllers\KemoterapiRingkasanMasukdanKeluarController;
use App\Http\Controllers\LaboratoriumRequestCategoryMasterController;
use App\Http\Controllers\MedicineDistributionReturnRequestController;
use App\Http\Controllers\RanapCheklistRencanaPulangPageOneController;
use App\Http\Controllers\RanapCheklistRencanaPulangPageTwoController;
use App\Http\Controllers\KemoterapiTindakanPelayananPatientController;
use App\Http\Controllers\MedicineDistributionReturnResponseController;
use App\Http\Controllers\RadiologiFormRequestMasterCategoryController;
use App\Http\Controllers\RanapAssesmenPraAnestesiPraInduksiController;
use App\Http\Controllers\RanapMonitoringPelayananObatPasienController;
use App\Http\Controllers\RanapRekapTindakanPelayananPatientController;
use App\Http\Controllers\AsesmentKeperawatanStatusFisikRanapController;
use App\Http\Controllers\IgdAsesmentKeperawatanRencanaAsuhanController;
use App\Http\Controllers\RanapPersetujuanTindakanBedahPatientController;
use App\Http\Controllers\AsesmentKeperawatanRencanaAsuhanRanapController;
use App\Http\Controllers\DaftarTilikVerifikasiPasienPraOperasiController;
use App\Http\Controllers\LaboratoriumMasterVariabelPemeriksaanController;
use App\Http\Controllers\AsesmentKeperawatanSkriningResikoJatuhController;
use App\Http\Controllers\KemoterapiIntervensiResikoJatuhPatientController;
use App\Http\Controllers\KemoterapiMonitoringResikoJatuhPatientController;
use App\Http\Controllers\AsesmenKeperawatanStatusFisikKemoterapiController;
use App\Http\Controllers\PermintaanLaboratoriumPatogologiAnatomikController;
use App\Http\Controllers\IgdAsesmentKeperawatanSkriningResikoJatuhController;
use App\Http\Controllers\RanapLembarKonsultasiPenyakitDalamPatientController;
use App\Http\Controllers\RanapPernyataanPersetujuanStatusPelayananController;
use App\Http\Controllers\RanapJawabanKonsultasiPenyakitDalamPatientController;
use App\Http\Controllers\AsesmentKeperawatanSkriningResikoJatuhRanapController;
use App\Http\Controllers\RanapPemberianInformasiPersetujuanTindakanAnestesiController;
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

require __DIR__ . '/arg01web.php';
Route::get('clear/asesmenawal/igd', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_24_180937_create_igd_initial_assesments_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_24_181745_create_igd_physical_examination_details_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_25_204220_create_igd_education_need_details_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_25_204303_create_igd_status_present_details_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_25_210833_create_igd_plan_details_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_25_211300_create_igd_supporting_examination_details_table.php');
    return back()->with('success', 'SUKSES RESET');
})->name('clear/asesmenawal.igd');

Route::get('clear/user/tabel', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2014_10_12_000000_create_users_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_05_19_215901_add__s_i_p_and_kode_dokter_bpjs_to_users.php');
    Artisan::call('db:seed --class=UserSeeder');
    return back()->with('success', 'SUKSES RESET');
    return 'success';
})->name('clear/tabel.user');

Route::get('storage/link/tabel', function () {
    Artisan::call('storage:link');
})->name('storage/link.tabel');

Route::get('migrate/all/tabel', function () {
    Artisan::call('migrate');
})->name('migrate/all.tabel');

Route::get('clear/permission', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_08_185341_create_permission_tables.php');
    Artisan::call('db:seed --class=PermissionSeeder');
    Artisan::call('db:seed --class=RoleSeeder');
    Artisan::call('db:seed --class=UserHasPermissionSeeder');
    // Artisan::call('db:seed --class=PatientCategorySeeder'); //patient category
    return back()->with('success', 'SUKSES RESET');
})->name('clear.permission');

//migrate refresh laporan anestesi
Route::get('/laporan/anestesi/clear', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2024_02_02_145633_create_anestesi_reports_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_02_02_152010_create_anestesi_report_airways_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_02_02_152701_create_anestesi_report_intubasis_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_02_02_155925_create_anestesi_report_perifers_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_02_02_162229_create_anestesi_report_ventilations_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_02_02_195407_create_anestesi_report_anasthesias_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_02_02_200012_create_anestesi_report_monitorings_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_02_03_124900_create_anestesi_report_medicines_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_02_03_125057_create_anestesi_report_medicine_details_table.php');
    return back()->with('success', 'SUKSES RESET');
})->name('clear/laporan/anestesi');

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

//migrate refresh rawat inap
Route::get('/ranap/clear/database', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2023_09_11_133829_create_rawat_inap_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_31_153524_create_catatan_perjalan_ranap_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_01_154802_create_administrasi_cacatan_perjalanan_ranap_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_01_161349_create_detail_administrasi_cacatan_perjalanan_ranap_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_10_172247_create_initial_assesment_educational_needs_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_31_025531_create_surat_pengantar_rawat_jalan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_31_030120_create_sekunder_surat_pengantar_rawat_jalan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_31_030340_create_operasi_surat_pengantar_rawat_jalan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_31_030457_create_terapi_surat_pengantar_rawat_jalan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_31_032702_create_kebutuhan_surat_pengantar_rawat_jalan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_03_141322_create_skrining_covid_ranap_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_03_140526_create_daftar_tilik_verifikasi_pra_operasi_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_03_140713_create_detail_daftar_tilik_verifikasi_pra_operasi_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_03_143022_create_detail_petugas_tilik_verifikasi_pra_operasi_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_03_140713_create_detail_daftar_tilik_verifikasi_pra_operasi_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_05_101350_create_ringkasan_masuk_dan_keluar_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_07_153438_create_cppt_ranaps_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_08_08_110141_create_change_log_cppt_ranaps_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_08_015641_create_ranap_discharge_summaries_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_08_015746_create_ranap_detail_diganosa_utama_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_08_015816_create_ranap_detail_karmobiditas_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_08_015842_create_ranap_detail_prosedur_terapi_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_08_015915_create_ranap_detail_obat_dirawat_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_08_015929_create_ranap_detail_obat_dirumah_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_153811_create_ranap_initial_assesments_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_155233_create_ranap_pemeriksaan_fisik_initial_assesments_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_155631_create_ranap_rencana_initial_assesments_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_155832_create_ranap_kebutuhan_edukasi_initial_assesments_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_160127_create_ranap_rencana_pemulangan_pasien_initial_assesments_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_214155_create_ranap_hasil_pemeriksaan_penunjang_initial_assesments_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_221131_create_ranap_medicine_receipts_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_221247_create_ranap_medicine_receipt_details_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_14_194028_create_ranap_permintaan_konsul_penyakit_dalam_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_14_194138_create_ranap_jawaban_konsul_penyakit_dalam_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_15_124736_create_ranap_jawaban_konsul_detail_skrining_covid_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_15_125345_create_ranap_jawaban_konsul_detail_lainnya_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_15_130833_create_ranap_jawaban_konsul_detail_penemuan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_18_193746_create_ranap_persetujuan_tindakan_anestesi_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_18_194026_create_ranap_detail_persetujuan_tindakan_anestesi_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_19_202425_create_ranap_discharge_planning_perawat_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_19_213518_create_ranap_detail_discharge_planning_perawat_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_20_195842_create_ranap_child_detail_discharge_planning_surgeries_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_20_204657_create_ranap_grand_child_detail_discharge_planning_surgeries_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_21_160528_create_ttv_ranap_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_21_204936_create_ranap_discharge_planning_gizi_pharmacies_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_21_205642_create_ranap_discharge_planning_nutrition_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_21_210002_create_ranap_discharge_planning_pharmacies_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_21_222817_create_ranap_monitoring_cairan_infus_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_23_185502_create_ranap_persetujuan_tindakan_bedah_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_23_185746_create_ranap_detail_persetujuan_tindakan_bedah_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_26_175703_create_surat_pernyataan_persetujuan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_26_205450_create_detail_adm_pernyataan_persetujuan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_28_063821_create_ranap_edukasi_pra_anestesi_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_28_064326_create_ranap_detail_edukasi_pra_anestesi_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_01_042011_create_ranap_form_rekonsiliasi_medicines_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_01_043200_create_ranap_form_rekonsiliasi_detail_medicines_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_01_043858_create_ranap_form_rekonsiliasi_detail_visites_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_02_174314_create_ranap_monitoring_medicines_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_02_174333_create_ranap_monitoring_detail_medicines_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_02_174413_create_ranap_another_monitoring_medicines_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_02_200509_create_ranap_monitoring_resiko_jatuh_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_02_200536_create_ranap_monitoring_resiko_jatuh_detail_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_02_204818_create_ranap_intervensi_resiko_jatuh_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_02_205342_create_ranap_intervensi_resiko_jatuh_detail_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_015036_create_ranap_ews_dewasa_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_020755_create_ranap_ews_anak_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_021848_create_ranap_rekap_tindakan_pelayanan_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_123311_create_ranap_assesmen_pra_anesthesias_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_123909_create_ranap_assesmen_pra_anestesi_checklists_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_124124_create_ranap_assesmen_pra_anestesi_techniques_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_124237_create_ranap_assesmen_pra_anestesi_special_tools_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_124324_create_ranap_assesmen_pra_anestesi_monitorings_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_124535_create_ranap_assesmen_pra_anestesi_inductions_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_142238_create_ranap_assesmen_pra_sedations_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_143118_create_ranap_assesmen_pra_sedation_riwayat_diseases_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_143311_create_ranap_assesmen_pra_sedation_pemeriksaan_physicals_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_143445_create_ranap_assesmen_pra_sedation_nafas_evaluations_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_143605_create_ranap_assesmen_pra_sedation_other_examinations_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_143658_create_ranap_assesmen_pra_sedation_normal_results_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_143800_create_ranap_assesmen_pra_sedation_anestesi_plans_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_144242_create_ranap_assesmen_pra_sedation_anestesi_instructions_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_05_144444_create_ranap_assesmen_pra_sedation_persiapan_bloods_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_10_165101_create_rekap_tindakan_pelayanan_patient_details_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_20_020714_create_ranap_ases_moni_status_fungsional_details_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_12_20_020926_create_ranap_ases_moni_status_fungsional_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_01_10_141050_create_ranap_mpp_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_01_10_141725_create_ranap_mpp_skrining_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_01_11_110216_create_ranap_mpp_problem_risk_chances_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_01_11_110653_create_ranap_mpp_asses_management_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_01_11_110830_create_ranap_mpp_manager_plannings_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_01_11_111119_create_ranap_mpp_pelayanan_advanceds_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_01_18_000235_create_ranap_cppt_sbar_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_01_22_144322_create_ranap_cppt_alih_rawat_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_11_08_010145_create_general_consent_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_01_09_200136_create_ranap_hais_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_01_09_200224_create_ranap_detail_hais_patients_table.php');
    return back()->with('success', 'SUKSES RESET');
})->name('clear/ranap');
//clear asesmen awal keperawatan ranap
Route::get('/assesmen/awal/keperawatan/ranap/clear', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2023_09_25_125442_create_asesment_perawat_ranap_patients_table.php');
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
    Artisan::call('migrate:refresh --path=/database/migrations/2024_01_28_130035_create_skrining_asesmen_resiko_jatuh_ranaps_table.php');
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
    Artisan::call('migrate:refresh --path=/database/migrations/2024_01_31_044543_create_detail_asesment_keperawatan_rencana_asuhan_patients_table.php');

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
    Artisan::call('migrate:refresh --path=/database/migrations/2023_06_07_122329_create_medicine_distributions_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_06_07_121026_create_medicine_distribution_requests_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_07_06_003033_create_medicine_distribution_details_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_06_07_121958_create_medicine_distribution_responses_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2023_06_07_121958_create_medicine_distribution_responses_table.php');
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

// Route::get('clear/cppt/ranap', function () {
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_08_07_153438_create_cppt_ranaps_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2024_01_18_000235_create_ranap_cppt_sbar_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2024_01_22_144322_create_ranap_cppt_alih_rawat_patients_table.php');
//     return back()->with('success', 'BERHASIL RESET');
// })->name('clear/cppt.ranap');

//clear General Consent
// Route::get('/general/consent/ranap/clear', function () {
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_08_010145_create_general_consent_patients_table.php');
//     return back()->with('success', 'Berhasil Di Reset');
// })->name('clear/general/consent.ranap');

//clear Assesmen Awal Medis Ranap
// Route::get('/assesmen/awal/medis/ranap/clear', function () {
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_153811_create_ranap_initial_assesments_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_155233_create_ranap_pemeriksaan_fisik_initial_assesments_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_155631_create_ranap_rencana_initial_assesments_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_214155_create_ranap_hasil_pemeriksaan_penunjang_initial_assesments_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_155832_create_ranap_kebutuhan_edukasi_initial_assesments_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_160127_create_ranap_rencana_pemulangan_pasien_initial_assesments_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_221131_create_ranap_medicine_receipts_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_10_221247_create_ranap_medicine_receipt_details_table.php');
//     return back()->with('success', 'Berhasil Di Reset');
// })->name('clear/assesmen/awal/medis.ranap');

//clear discharge summary
// Route::get('/ringkasan/catatan/medis/clear/database', function () {
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_08_015641_create_ranap_discharge_summaries_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_08_015746_create_ranap_detail_diganosa_utama_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_08_015816_create_ranap_detail_karmobiditas_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_08_015842_create_ranap_detail_prosedur_terapi_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_08_015915_create_ranap_detail_obat_dirawat_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_08_015929_create_ranap_detail_obat_dirumah_patients_table.php');
//     return back()->with('success', 'Berhasil Di Reset');
// })->name('clear/ringkasan/catatan/medis');

//clear Lembar Konsultasi
// Route::get('/lembar/konsultasi/penyakit/dalam/clear/database', function () {
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_14_194028_create_ranap_permintaan_konsul_penyakit_dalam_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_14_194138_create_ranap_jawaban_konsul_penyakit_dalam_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_15_124736_create_ranap_jawaban_konsul_detail_skrining_covid_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_15_125345_create_ranap_jawaban_konsul_detail_lainnya_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_15_130833_create_ranap_jawaban_konsul_detail_penemuan_patients_table.php');
//     return back()->with('success', 'Berhasil Di Reset');
// })->name('clear/lembar/konsultasi/penyakit/dalam');

//clear Persetujuan tindakan anestesi
// Route::get('/persetujuan/tindakan/anestesi/clear/database', function () {
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_18_193746_create_ranap_persetujuan_tindakan_anestesi_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_18_194026_create_ranap_detail_persetujuan_tindakan_anestesi_patients_table.php');
//     return back()->with('success', 'Berhasil Di Reset');
// })->name('clear/persetujuan/tindakan/anestesi');

//clear Persetujuan tindakan bedah
// Route::get('/persetujuan/tindakan/bedah/clear/database', function () {
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_23_185502_create_ranap_persetujuan_tindakan_bedah_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_23_185746_create_ranap_detail_persetujuan_tindakan_bedah_patients_table.php');
//     return back()->with('success', 'Berhasil Di Reset');
// })->name('clear/persetujuan/tindakan/bedah');

//Discharge Planning Perawat
// Route::get('/discharge/planning/perawat/clear/database', function () {
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_19_202425_create_ranap_discharge_planning_perawat_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_19_213518_create_ranap_detail_discharge_planning_perawat_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_20_195842_create_ranap_child_detail_discharge_planning_surgeries_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2023_11_20_204657_create_ranap_grand_child_detail_discharge_planning_surgeries_table.php');
//     return back()->with('success', 'Berhasil Di Reset');
// })->name('clear/discharge/planning/perawat');

//MPP Ranap
// Route::get('/mpp/ranap/clear/database', function () {
//     Artisan::call('migrate:refresh --path=/database/migrations/2024_01_10_141050_create_ranap_mpp_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2024_01_10_141725_create_ranap_mpp_skrining_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2024_01_11_110216_create_ranap_mpp_problem_risk_chances_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2024_01_11_110653_create_ranap_mpp_asses_management_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2024_01_11_110830_create_ranap_mpp_manager_plannings_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2024_01_11_111119_create_ranap_mpp_pelayanan_advanceds_table.php');
//     return back()->with('success', 'Berhasil Di Reset');
// })->name('clear/mpp/ranap');

//Hais Ranap
// Route::get('/hais/ranap/clear/database', function () {
//     Artisan::call('migrate:refresh --path=/database/migrations/2024_01_09_200136_create_ranap_hais_patients_table.php');
//     Artisan::call('migrate:refresh --path=/database/migrations/2024_01_09_200224_create_ranap_detail_hais_patients_table.php');
//     return back()->with('success', 'Berhasil Di Reset');
// })->name('clear/hais/ranap');

// clear asskep igd
Route::get('/igd/asskep/clear', function () {
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_17_172003_create_igd_ase_kep_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_17_180323_create_igd_psiko_spiritual_ass_kep_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_17_180412_create_igd_status_fisik_ass_kep_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_17_180435_create_igd_ekonomi_ass_kep_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_17_180501_create_igd_riwayat_alergi_ass_kep_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_17_180532_create_igd_asesmen_nyeri_ass_kep_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_17_181004_create_igd_detail_status_fisik_ass_kep_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_17_181832_create_igd_detail_asesmen_nyeri_ass_kep_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_17_182212_create_igd_skrining_resiko_ass_kep_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_17_182240_create_igd_status_fungsional_ass_kep_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_17_182311_create_igd_resiko_nutrisional_ass_kep_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_17_230459_create_igd_detail_skrining_resiko_ass_kep_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_18_154542_create_igd_diagnosis_keperawatan_ass_kep_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_18_154833_create_igd_hub_diagnosis_kep_ass_kep_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_18_155159_create_igd_masalah_keperawatan_ass_kep_patients_table.php');
    Artisan::call('migrate:refresh --path=/database/migrations/2024_04_18_165925_create_igd_rencana_asuhan_ass_kep_patients_table.php');
    return back()->with('success', 'Berhasil Di Reset');
})->name('igd/asskep.clear');


Route::group(['middleware' => 'auth'], function () {
    //DistribusiObat
    Route::get('/farmasi/obat/distribusi', [MedicineDistributionController::class, 'index'])->name('farmasi/obat/distribusi.index');
    Route::get('/farmasi/obat/distribusi/create/{id}', [MedicineDistributionController::class, 'create'])->name('farmasi/obat/distribusi.create');
    Route::post('/farmasi/obat/distribusi/store', [MedicineDistributionController::class, 'store'])->name('farmasi/obat/distribusi.store');
    Route::get('/farmasi/obat/distribusi/show/{id}', [MedicineDistributionController::class, 'show'])->name('farmasi/obat/distribusi.show');
    Route::delete('/farmasi/obat/distribusi/destroy/{id}', [MedicineDistributionController::class, 'destroy'])->name('farmasi/obat/distribusi.destroy');

    //Distribusi Request
    Route::get('/farmasi/obat/distribusi/request', [MedicineDistributionRequestController::class, 'index'])->name('farmasi/obat/distribusi/request.index');
    Route::post('/farmasi/obat/distribusi/request/show', [MedicineDistributionRequestController::class, 'show'])->name('farmasi/obat/distribusi/request.show');
    Route::post('/farmasi/obat/distribusi/request/store', [MedicineDistributionRequestController::class, 'store'])->name('farmasi/obat/distribusi/request.store');
    Route::put('/farmasi/obat/distribusi/request/update/{id}', [MedicineDistributionRequestController::class, 'update'])->name('farmasi/obat/distribusi/request.update');

    //Distribusi Response
    Route::get('/farmasi/obat/distribusi/response', [MedicineDistributionResponseController::class, 'index'])->name('farmasi/obat/distribusi/response.index');
    Route::put('/farmasi/obat/distribusi/response/update/{id}', [MedicineDistributionResponseController::class, 'update'])->name('farmasi/obat/distribusi/response.update');
    Route::get('/farmasi/obat/distribusi/response/cetak/faktur/{id}', [MedicineDistributionResponseController::class, 'show'])->name('farmasi/obat/distribusi/response/cetak/faktur.show');

    //Distribusi ReturnObat
    Route::get('/farmasi/obat/distribusi/return', [MedicineDistributionReturnController::class, 'index'])->name('farmasi/obat/distribusi/return.index');
    Route::get('/farmasi/obat/distribusi/return/show/{id}', [MedicineDistributionReturnController::class, 'show'])->name('farmasi/obat/distribusi/return.show');
    Route::delete('/farmasi/obat/distribusi/return/destroy/{id}', [MedicineDistributionReturnController::class, 'destroy'])->name('farmasi/obat/distribusi/return.destroy');

    //Distribusi Return Request
    Route::get('/farmasi/obat/distribusi/return/request', [MedicineDistributionReturnRequestController::class, 'index'])->name('farmasi/obat/distribusi/return/request.index');
    Route::post('/farmasi/obat/distribusi/return/request/store', [MedicineDistributionReturnRequestController::class, 'store'])->name('farmasi/obat/distribusi/return/request.store');
    Route::put('/farmasi/obat/distribusi/return/request/update/{id}', [MedicineDistributionReturnRequestController::class, 'update'])->name('farmasi/obat/distribusi/return/request.update');

    //Distribusi Return Response
    Route::get('/farmasi/obat/distribusi/return/response', [MedicineDistributionReturnResponseController::class, 'index'])->name('farmasi/obat/distribusi/return/response.index');
    Route::put('/farmasi/obat/distribusi/return/response/update/{id}', [MedicineDistributionReturnResponseController::class, 'update'])->name('farmasi/obat/distribusi/return/response.update');

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
    Route::get('/farmasi/pabrik', [FactoryController::class, 'index'])->name('farmasi/pabrik.index');
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
    Route::get('/farmasi/obat/jenis', [MedicineTypeController::class, 'index'])->name('farmasi/obat/jenis.index');
    Route::get('/farmasi/obat/jenis/create', [MedicineTypeController::class, 'create'])->name('farmasi/obat/jenis.create');
    Route::post('/farmasi/obat/jenis/store', [MedicineTypeController::class, 'store'])->name('farmasi/obat/jenis.store');
    Route::get('/farmasi/obat/jenis/edit/{id}', [MedicineTypeController::class, 'edit'])->name('farmasi/obat/jenis.edit');
    Route::put('/farmasi/obat/jenis/update/{id}', [MedicineTypeController::class, 'update'])->name('farmasi/obat/jenis.update');
    Route::delete('/farmasi/obat/jenis/destroy/{id}', [MedicineTypeController::class, 'destroy'])->name('farmasi/obat/jenis.destroy');

    //Golongan Obat
    Route::get('/farmasi/obat/golongan', [MedicineCategoryController::class, 'index'])->name('farmasi/obat/golongan.index');
    Route::get('/farmasi/obat/golongan/create', [MedicineCategoryController::class, 'create'])->name('farmasi/obat/golongan.create');
    Route::post('/farmasi/obat/golongan/store', [MedicineCategoryController::class, 'store'])->name('farmasi/obat/golongan.store');
    Route::get('/farmasi/obat/golongan/edit/{id}', [MedicineCategoryController::class, 'edit'])->name('farmasi/obat/golongan.edit');
    Route::put('/farmasi/obat/golongan/update/{id}', [MedicineCategoryController::class, 'update'])->name('farmasi/obat/golongan.update');
    Route::delete('/farmasi/obat/golongan/destroy/{id}', [MedicineCategoryController::class, 'destroy'])->name('farmasi/obat/golongan.destroy');

    //bentuk Sediaan Obat
    Route::get('/farmasi/obat/bentuk', [MedicineFormController::class, 'index'])->name('farmasi/obat/bentuk.index');
    Route::get('/farmasi/obat/bentuk/create', [MedicineFormController::class, 'create'])->name('farmasi/obat/bentuk.create');
    Route::post('/farmasi/obat/bentuk/store', [MedicineFormController::class, 'store'])->name('farmasi/obat/bentuk.store');
    Route::get('/farmasi/obat/bentuk/edit/{id}', [MedicineFormController::class, 'edit'])->name('farmasi/obat/bentuk.edit');
    Route::put('/farmasi/obat/bentuk/update/{id}', [MedicineFormController::class, 'update'])->name('farmasi/obat/bentuk.update');
    Route::delete('/farmasi/obat/bentuk/destroy/{id}', [MedicineFormController::class, 'destroy'])->name('farmasi/obat/bentuk.destroy');

    //Operasi
    Route::get('/operasi', [SurgeryController::class, 'index'])->name('surgery.index');
    Route::get('/operasi/create', [SurgeryController::class, 'create'])->name('surgery.create');
    Route::post('/operasi/store', [SurgeryController::class, 'store'])->name('surgery.store');
    Route::get('/operasi/edit/{id}', [SurgeryController::class, 'edit'])->name('surgery.edit');
    Route::put('/operasi/update/{id}', [SurgeryController::class, 'update'])->name('surgery.update');
    Route::delete('/operasi/destroy/{id}', [SurgeryController::class, 'destroy'])->name('surgery.destroy');

    //Jasa Operasi
    Route::get('/operasi/jasa/create', [SurgeryCategoryController::class, 'create'])->name('surgery/category.create');
    Route::post('/operasi/jasa/store', [SurgeryCategoryController::class, 'store'])->name('surgery/category.store');
    Route::get('/operasi/jasa/edit/{id}', [SurgeryCategoryController::class, 'edit'])->name('surgery/category.edit');
    Route::put('/operasi/jasa/update/{id}', [SurgeryCategoryController::class, 'update'])->name('surgery/category.update');
    Route::delete('/operasi/jasa/destroy/{id}', [SurgeryCategoryController::class, 'destroy'])->name('surgery/category.destroy');

    //Tarif Operasi
    Route::get('/operasi/tarif/index/{id}', [SurgeryRatesController::class, 'index'])->name('surgery/rates.index');
    Route::put('/operasi/tarif/update/{id}', [SurgeryRatesController::class, 'update'])->name('surgery/rates.update');


    //Diagnosa
    Route::get('/diagnosa', [DiagnosticController::class, 'index'])->name('diagnosa.index');
    Route::get('/diagnosa/create', [DiagnosticController::class, 'create'])->name('diagnosa.create');
    Route::post('/diagnosa/store', [DiagnosticController::class, 'store'])->name('diagnosa.store');
    Route::get('/diagnosa/edit/{id}', [DiagnosticController::class, 'edit'])->name('diagnosa.edit');
    Route::put('/diagnosa/update/{id}', [DiagnosticController::class, 'update'])->name('diagnosa.update');
    Route::delete('/diagnosa/destroy/{id}', [DiagnosticController::class, 'destroy'])->name('diagnosa.destroy');

    //Kamar
    Route::get('/kamar/lantai', [FloorController::class, 'index'])->name('kamar/lantai.index');
    Route::get('/kamar/lantai/create', [FloorController::class, 'create'])->name('kamar/lantai.create');
    Route::post('/kamar/lantai/store', [FloorController::class, 'store'])->name('kamar/lantai.store');
    Route::get('/kamar/lantai/edit/{id}', [FloorController::class, 'edit'])->name('kamar/lantai.edit');
    Route::put('/kamar/lantai/update/{id}', [FloorController::class, 'update'])->name('kamar/lantai.update');
    Route::delete('/kamar/lantai/destroy/{id}', [FloorController::class, 'destroy'])->name('kamar/lantai.destroy');

    Route::get('/kamar', [BedroomController::class, 'index'])->name('kamar.index');
    Route::get('/kamar/create', [BedroomController::class, 'create'])->name('kamar.create');
    Route::post('/kamar/store', [BedroomController::class, 'store'])->name('kamar.store');
    Route::get('/kamar/edit/{id}', [BedroomController::class, 'edit'])->name('kamar.edit');
    Route::put('/kamar/update/{id}', [BedroomController::class, 'update'])->name('kamar.update');
    Route::delete('/kamar/destroy/{id}', [BedroomController::class, 'destroy'])->name('kamar.destroy');

    //tipe ranjang
    Route::get('/kamar/ranjang/tipe', [BedTypeController::class, 'index'])->name('kamar/ranjang/tipe.index');
    Route::get('/kamar/ranjang/tipe/create', [BedTypeController::class, 'create'])->name('kamar/ranjang/tipe.create');
    Route::post('/kamar/ranjang/tipe/store', [BedTypeController::class, 'store'])->name('kamar/ranjang/tipe.store');
    Route::get('/kamar/ranjang/tipe/edit/{id}', [BedTypeController::class, 'edit'])->name('kamar/ranjang/tipe.edit');
    Route::put('/kamar/ranjang/tipe/update/{id}', [BedTypeController::class, 'update'])->name('kamar/ranjang/tipe.update');
    Route::delete('/kamar/ranjang/tipe/destroy/{id}', [BedTypeController::class, 'destroy'])->name('kamar/ranjang/tipe.destroy');

    //ranjang
    Route::get('/kamar/ranjang', [BedController::class, 'index'])->name('kamar/ranjang.index');
    Route::get('/kamar/ranjang/create', [BedController::class, 'create'])->name('kamar/ranjang.create');
    Route::post('/kamar/ranjang/store', [BedController::class, 'store'])->name('kamar/ranjang.store');
    Route::get('/kamar/ranjang/edit/{id}', [BedController::class, 'edit'])->name('kamar/ranjang.edit');
    Route::put('/kamar/ranjang/update/{id}', [BedController::class, 'update'])->name('kamar/ranjang.update');
    Route::delete('/kamar/ranjang/destroy/{id}', [BedController::class, 'destroy'])->name('kamar/ranjang.destroy');

    //status ranjang
    Route::get('/kamar/ranjang/show', [BedController::class, 'show'])->name('kamar/ranjang.show');

    //tarif kamar
    Route::get('/kamar/ranjang/tarif/{id}', [BedroomRatesController::class, 'index'])->name('kamar/ranjang/tarif.index');
    Route::put('/kamar/ranjang/tarif/update/{id}', [BedroomRatesController::class, 'update'])->name('kamar/ranjang/tarif.update');

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

    //ReturnObat
    Route::get('/farmasi/obat/return', [MedicineTransactionReturnController::class, 'index'])->name('farmasi/obat/return.index');
    Route::get('/farmasi/obat/return/create/{id}', [MedicineTransactionReturnController::class, 'create'])->name('farmasi/obat/return.create');
    Route::post('/farmasi/obat/return/store/{id}', [MedicineTransactionReturnController::class, 'store'])->name('farmasi/obat/return.store');
    Route::delete('/farmasi/obat/return/destroy/{id}', [MedicineTransactionReturnController::class, 'destroy'])->name('farmasi/obat/return.destroy');

    //Faktur Return Obat
    Route::get('/farmasi/obat/return/faktur/{id}', [InvoiceReturnController::class, 'index'])->name('farmasi/obat/return/faktur.index');
    Route::get('/farmasi/obat/return/faktur/create/{id}', [InvoiceReturnController::class, 'create'])->name('farmasi/obat/return/faktur.create');
    Route::post('/farmasi/obat/return/faktur/store/{id}', [InvoiceReturnController::class, 'store'])->name('farmasi/obat/return/faktur.store');
    Route::get('/farmasi/obat/return/faktur/edit/{id}', [InvoiceReturnController::class, 'edit'])->name('farmasi/obat/return/faktur.edit');
    Route::put('/farmasi/obat/return/faktur/update/{id}', [InvoiceReturnController::class, 'update'])->name('farmasi/obat/return/faktur.update');
    Route::delete('/farmasi/obat/return/faktur/destroy/{id}', [InvoiceReturnController::class, 'destroy'])->name('farmasi/obat/return/faktur.destroy');

    //Stock Obat
    Route::get('/farmasi/obat/stock', [MedicineStokController::class, 'index'])->name('farmasi/obat/stock.index');
    Route::get('/farmasi/obat/stock/show/{id}', [MedicineStokController::class, 'show'])->name('farmasi/obat/stock.show');
    Route::get('/farmasi/obat/stock/all', [MedicineStokController::class, 'all'])->name('farmasi/obat/stock.all');

    //Konversi
    Route::get('/farmasi/obat/konversi', [UnitConversionController::class, 'index'])->name('farmasi/obat/konversi.index');
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


    //getStok
    Route::post('/farmasi/obat/get/stok', [GetStokController::class, 'index'])->name('farmasi/obat/get/stok.index');
    Route::post('/farmasi/obat/get/medicineStok/all', [GetStokController::class, 'create'])->name('farmasi/obat/get/medicineStok/all.create');

    //getConversion
    Route::post('/konversi/obat/get/satuan', [GetConversion::class, 'index'])->name('konversi/obat/get/satuan.index');
    Route::post('/konversi/obat/get/satuan/awal', [GetConversion::class, 'create'])->name('konversi/obat/get/satuan/awal.create');
    Route::post('/konversi/obat/get/jumlah', [GetConversion::class, 'getJumlah'])->name('konversi/obat/get.jumlah');
});

//Antrian
Route::group(['middleware' => ['permission:daftar antrian|tambah antrian|registrasi ulang antrian']], function () {
    // cek bpjs
    Route::get('/antrian/check/bpjs/{noka}/{tgl}', [QueueController::class, 'cekPesertaNoka'])->name('antrian.cekBpjs');
    Route::get('/antrian/check/nomor/rujukan/{rujukan}', [QueueController::class, 'cariRujukanBerdasarkanNomorRujukanFaskes'])->name('antrian.cekNomorRujukan');
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

//ranap request Radiologi
Route::group(['middleware' => ['permission:tambah permintaan radiologi']], function () {
    Route::get('/ranap/permintaan/radiologi/create/{id}', [RadiologiFormRequestController::class, 'create'])->name('ranap/permintaan/radiologi.create');
    Route::post('/ranap/permintaan/radiologi/store/{id}', [RadiologiFormRequestController::class, 'store'])->name('ranap/permintaan/radiologi.store');
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

//IGD
Route::get('/igd/patient', [IgdController::class, 'index'])->name('igd/patient.index');
Route::get('/igd/patient/create', [IgdController::class, 'create'])->name('igd/patient.create');
Route::post('/igd/patient/store', [IgdController::class, 'store'])->name('igd/patient.store');
Route::get('/igd/patient/edit/{id}', [IgdController::class, 'edit'])->name('igd/patient.edit');
Route::get('/igd/patient/show/{id}', [IgdController::class, 'show'])->name('igd/patient.show');

//RME IGD
Route::get('/igd/patient/rme/show/{id}', [IgdPatientRmeController::class, 'show'])->name('igd/patient/rme.show');
Route::put('/igd/patient/rme/updateStatus/{id}', [IgdPatientRmeController::class, 'update'])->name('igd/patient/rme.updateStatus');

//igd Skala Triase
Route::get('/igd/triase/skala/create', [IgdTriageScaleController::class, 'create'])->name('igd/triase/skala.create');
Route::post('/igd/triase/skala/store', [IgdTriageScaleController::class, 'store'])->name('igd/triase/skala.store');
Route::delete('/igd/triase/skala/destroy/{id}', [IgdTriageScaleController::class, 'destroy'])->name('igd/triase/skala.destroy');
//igd kategori Triase
Route::get('/igd/triase/kategori/create', [IgdTriageCategoryCheckupController::class, 'create'])->name('igd/triase/kategori.create');
Route::post('/igd/triase/kategori/store', [IgdTriageCategoryCheckupController::class, 'store'])->name('igd/triase/kategori.store');
Route::delete('/igd/triase/kategori/destroy/{id}', [IgdTriageCategoryCheckupController::class, 'destroy'])->name('igd/triase/kategori.destroy');
//igd pemeriksaan Triase
Route::get('/igd/triase/pemeriksaan/create', [IgdTriageCheckupController::class, 'create'])->name('igd/triase/pemeriksaan.create');
Route::post('/igd/triase/pemeriksaan/store', [IgdTriageCheckupController::class, 'store'])->name('igd/triase/pemeriksaan.store');
Route::delete('/igd/triase/pemeriksaan/destroy/{id}', [IgdTriageCheckupController::class, 'destroy'])->name('igd/triase/pemeriksaan.destroy');

//igd Triase
Route::get('/igd/triase/create/{id}', [IgdTriageController::class, 'create'])->name('igd/triase.create');
Route::post('/igd/triase/store/{id}', [IgdTriageController::class, 'store'])->name('igd/triase.store');
Route::get('/igd/triase/show/{id}', [IgdTriageController::class, 'show'])->name('igd/triase.show');
Route::get('/igd/triase/edit/{id}', [IgdTriageController::class, 'edit'])->name('igd/triase.edit');
Route::post('/igd/triase/update', [IgdTriageController::class, 'update'])->name('igd/triase.update');
Route::delete('/igd/triase/destroy/{id}', [IgdTriageController::class, 'destroy'])->name('igd/triase.destroy');

//print igd triase
Route::get('/igd/triase/print/{id}/{dokter_id}', [IgdTriageController::class, 'print'])->name('igd/triase.print');
Route::get('/igd/triase/printall/{id}', [IgdTriageController::class, 'allPrint'])->name('igd/triase/print.allPrint');

Route::get('/igd/triase/get/checkup/{id}', [GetTriageCheckupController::class, 'show'])->name('igd/triase/get/checkup.show');

//IGD General Consent
Route::get('igd/general/consent/create/{id}', [IgdGeneralConsentController::class, 'create'])->name('igd/general/consent.create');
Route::post('igd/general/consent/store/{id}', [IgdGeneralConsentController::class, 'store'])->name('igd/general/consent.store');
Route::get('igd/general/consent/show/{id}', [IgdGeneralConsentController::class, 'show'])->name('igd/general/consent.show');
Route::get('igd/general/consent/showtatatertib/{id}', [IgdGeneralConsentController::class, 'showTataTertib'])->name('igd/general/consent.showtatatertib');
Route::get('igd/general/consent/showhakdankewajiban/{id}', [IgdGeneralConsentController::class, 'showHakDanKewajiban'])->name('igd/general/consent.showhakdankewajiban');
Route::get('igd/general/consent/edit/{id}', [IgdGeneralConsentController::class, 'edit'])->name('igd/general/consent.edit');
Route::put('igd/general/consent/update/{id}', [IgdGeneralConsentController::class, 'update'])->name('igd/general/consent.update');
Route::delete('igd/general/consent/destroy/{id}', [IgdGeneralConsentController::class, 'destroy'])->name('igd/general/consent.destroy');

//assesmen awal medis IGD
Route::post('/igd/assesmenawal/index', [IgdInitialAssesmentController::class, 'index'])->name('igd/assesmenawal.index');
Route::get('/igd/assesmenawal/create/{id}', [IgdInitialAssesmentController::class, 'create'])->name('igd/assesmenawal.create');
Route::post('/igd/assesmenawal/store/{id}', [IgdInitialAssesmentController::class, 'store'])->name('igd/assesmenawal.store');
Route::get('/igd/assesmenawal/show/{id}', [IgdInitialAssesmentController::class, 'show'])->name('igd/assesmenawal.show');
Route::delete('/igd/assesmenawal/destroy/{id}', [IgdInitialAssesmentController::class, 'destroy'])->name('igd/assesmenawal.destroy');

// asesmen keperawatan igd
//Igd Assesmen Awal Keperawatan Pasien Rawat Inap
Route::get('/igd/assesmen/awal/keperawatan/show/{id}', [IgdAssesmenAwalKeperawatanController::class, 'show'])->name('igd/assesmen/awal/keperawatan.show');
// Route::get('/igd/assesmen/awal/keperawatan/edit/{id}', [IgdAssesmenAwalKeperawatanController::class, 'edit'])->name('igd/assesmen/awal/keperawatan.edit');
Route::delete('/igd/assesmen/awal/keperawatan/destroy/{id}', [IgdAssesmenAwalKeperawatanController::class, 'destroy'])->name('igd/assesmen/awal/keperawatan.destroy');

//Igd Assesmen Perawat Status Fisik
Route::get('/igd/asesmen/status/fisik/index/{id}', [IgdAsesmentKeperawatanStatusFisikController::class, 'index'])->name('igd/asesmen/status/fisik.index');
Route::post('/igd/asesmen/status/fisik/store/{id}', [IgdAsesmentKeperawatanStatusFisikController::class, 'store'])->name('igd/asesmen/status/fisik.store');

//Igd Assesmen Perawat Skrining Resiko Jatuh
Route::get('/igd/asesmen/skrining/resiko/jatuh/index/{id}', [IgdAsesmentKeperawatanSkriningResikoJatuhController::class, 'index'])->name('igd/asesmen/skrining/resiko/jatuh.index');
Route::post('/igd/asesmen/skrining/resiko/jatuh/store/{id}', [IgdAsesmentKeperawatanSkriningResikoJatuhController::class, 'store'])->name('igd/asesmen/skrining/resiko/jatuh.store');

//Igd Assesmen Perawat Diagnosis Keperawatan
Route::get('/igd/asesmen/diagnosis/keperawatan/index/{id}', [IgdAsesmentKeperawatanDiagnosisController::class, 'index'])->name('igd/asesmen/diagnosis/keperawatan.index');
Route::post('/igd/asesmen/diagnosis/keperawatan/store/{id}', [IgdAsesmentKeperawatanDiagnosisController::class, 'store'])->name('igd/asesmen/diagnosis/keperawatan.store');

//Igd Assesmen Perawat rencana asuhan
Route::get('/igd/asesmen/rencana/asuhan/index/{id}', [IgdAsesmentKeperawatanRencanaAsuhanController::class, 'index'])->name('igd/asesmen/rencana/asuhan.index');
Route::post('/igd/asesmen/rencana/asuhan/store/{id}', [IgdAsesmentKeperawatanRencanaAsuhanController::class, 'store'])->name('igd/asesmen/rencana/asuhan.store');
// end Assesmen keperawatan igd

//igd CPPT
Route::post('/igd/cppt/create{id}', [IgdRmeCpptController::class, 'create'])->name('igd/cppt.create');
Route::post('/igd/cppt/store/{id}', [IgdRmeCpptController::class, 'store'])->name('igd/cppt.store');
Route::get('/igd/cppt/edit/{id}', [IgdRmeCpptController::class, 'edit'])->name('igd/cppt.edit');
Route::put('/igd/cppt/update/{id}', [IgdRmeCpptController::class, 'update'])->name('igd/cppt.update');
Route::get('/igd/cppt/show/{id}', [IgdRmeCpptController::class, 'show'])->name('igd/cppt.show');
Route::delete('/igd/cppt/destroy/{id}', [IgdRmeCpptController::class, 'destroy'])->name('igd/cppt.destroy');

// igd Surat Pengantar
// Route::group(['middleware' => ['permission:tambah surat pengantar ranap']], function () {
Route::get('igd/surat/pengantar/create/{id}', [IgdSuratPengantarRawatController::class, 'create'])->name('igd/suratpengantar.create');
Route::post('igd/surat/pengantar/store/{id}', [IgdSuratPengantarRawatController::class, 'store'])->name('igd/suratpengantar.store');
// });
// Route::group(['middleware' => ['permission:edit surat pengantar ranap']], function () {
Route::get('igd/surat/pengantar/edit/{id}', [IgdSuratPengantarRawatController::class, 'edit'])->name('igd/suratpengantar.edit');
Route::put('igd/surat/pengantar/update/{id}', [IgdSuratPengantarRawatController::class, 'update'])->name('igd/suratpengantar.update');
// });
// Route::group(['middleware' => ['permission:delete surat pengantar ranap']], function () {
Route::delete('igd/surat/pengantar/destroy/{id}', [IgdSuratPengantarRawatController::class, 'destroy'])->name('igd/suratpengantar.destroy');
// });

// start kemoterapi
Route::get('kemoterapi/antrian/index', [KemoterapiAntrianPatientController::class, 'index'])->name('kemoterapi/antrian.index');
Route::post('kemoterapi/antrian/create', [KemoterapiAntrianPatientController::class, 'create'])->name('kemoterapi/antrian.create');
Route::post('kemoterapi/antrian/store/{id}', [KemoterapiAntrianPatientController::class, 'store'])->name('kemoterapi/antrian.store');
Route::get('kemoterapi/antrian/edit/{id}', [KemoterapiAntrianPatientController::class, 'edit'])->name('kemoterapi/antrian.edit');
Route::get('kemoterapi/antrian/update/{id}', [KemoterapiAntrianPatientController::class, 'update'])->name('kemoterapi/antrian.update');

Route::get('kemoterapi/patient/index', [KemoterapiPatientController::class, 'index'])->name('kemoterapi/patient.index');
Route::get('kemoterapi/patient/show/{id}', [KemoterapiPatientController::class, 'show'])->name('kemoterapi/patient.show');

// sbpk
Route::get('kemoterapi/sbpk/create/{id}', [KemoterapiSbpkPatientController::class, 'create'])->name('kemoterapi/sbpk.create');
Route::post('kemoterapi/sbpk/store/{id}', [KemoterapiSbpkPatientController::class, 'store'])->name('kemoterapi/sbpk.store');
Route::get('kemoterapi/sbpk/show/{id}', [KemoterapiSbpkPatientController::class, 'show'])->name('kemoterapi/sbpk.show');
Route::get('kemoterapi/sbpk/edit/{id}', [KemoterapiSbpkPatientController::class, 'edit'])->name('kemoterapi/sbpk.edit');
Route::post('kemoterapi/sbpk/update/{id}', [KemoterapiSbpkPatientController::class, 'update'])->name('kemoterapi/sbpk.update');
Route::get('kemoterapi/sbpk/destroy/{id}', [KemoterapiSbpkPatientController::class, 'destroy'])->name('kemoterapi/sbpk.destroy');
// end sbpk

// Persetujuan Tindakan kemoterapi
Route::get('kemoterapi/persetujuan/create/{id}', [KemoterapiPersetujuanController::class, 'create'])->name('kemoterapi/persetujuan.create');
Route::post('kemoterapi/persetujuan/store/{id}', [KemoterapiPersetujuanController::class, 'store'])->name('kemoterapi/persetujuan.store');
Route::get('kemoterapi/persetujuan/show/{id}', [KemoterapiPersetujuanController::class, 'show'])->name('kemoterapi/persetujuan.show');
Route::get('kemoterapi/persetujuan/edit/{id}', [KemoterapiPersetujuanController::class, 'edit'])->name('kemoterapi/persetujuan.edit');
Route::post('kemoterapi/persetujuan/update/{id}', [KemoterapiPersetujuanController::class, 'update'])->name('kemoterapi/persetujuan.update');
Route::get('kemoterapi/persetujuan/destroy/{id}', [KemoterapiPersetujuanController::class, 'destroy'])->name('kemoterapi/persetujuan.destroy');
// end Persetujuan Tindakan kemoterapi

// Kemoterapi Monitoring Resiko Jatuh
Route::get('kemoterapi/monitoring/resiko/jatuh/create/{id}', [KemoterapiMonitoringResikoJatuhPatientController::class, 'create'])->name('kemoterapi/monitoring/resiko/jatuh.create');
Route::post('kemoterapi/monitoring/resiko/jatuh/store/{id}', [KemoterapiMonitoringResikoJatuhPatientController::class, 'store'])->name('kemoterapi/monitoring/resiko/jatuh.store');
Route::get('kemoterapi/monitoring/resiko/jatuh/show/{id}', [KemoterapiMonitoringResikoJatuhPatientController::class, 'show'])->name('kemoterapi/monitoring/resiko/jatuh.show');
Route::get('kemoterapi/monitoring/resiko/jatuh/edit/{id}', [KemoterapiMonitoringResikoJatuhPatientController::class, 'edit'])->name('kemoterapi/monitoring/resiko/jatuh.edit');
Route::put('kemoterapi/monitoring/resiko/jatuh/update/{id}', [KemoterapiMonitoringResikoJatuhPatientController::class, 'update'])->name('kemoterapi/monitoring/resiko/jatuh.update');
Route::get('kemoterapi/monitoring/resiko/jatuh/destroy/{id}', [KemoterapiMonitoringResikoJatuhPatientController::class, 'destroy'])->name('kemoterapi/monitoring/resiko/jatuh.destroy');
// end Kemoterapi Monitoring Resiko Jatuh

// Kemoterapi Intervensi Pencegahan resiko jatuh
Route::get('kemoterapi/intervensi/pencegahan/resiko/jatuh/create/{id}', [KemoterapiIntervensiResikoJatuhPatientController::class, 'create'])->name('kemoterapi/intervensi/pencegahan/resiko/jatuh.create');
Route::post('kemoterapi/intervensi/pencegahan/resiko/jatuh/store/{id}', [KemoterapiIntervensiResikoJatuhPatientController::class, 'store'])->name('kemoterapi/intervensi/pencegahan/resiko/jatuh.store');
Route::get('kemoterapi/intervensi/pencegahan/resiko/jatuh/show/{id}', [KemoterapiIntervensiResikoJatuhPatientController::class, 'show'])->name('kemoterapi/intervensi/pencegahan/resiko/jatuh.show');
Route::get('kemoterapi/intervensi/pencegahan/resiko/jatuh/edit/{id}', [KemoterapiIntervensiResikoJatuhPatientController::class, 'edit'])->name('kemoterapi/intervensi/pencegahan/resiko/jatuh.edit');
Route::post('kemoterapi/intervensi/pencegahan/resiko/jatuh/update/{id}', [KemoterapiIntervensiResikoJatuhPatientController::class, 'update'])->name('kemoterapi/intervensi/pencegahan/resiko/jatuh.update');
Route::get('kemoterapi/intervensi/pencegahan/resiko/jatuh/destroy/{id}', [KemoterapiIntervensiResikoJatuhPatientController::class, 'destroy'])->name('kemoterapi/intervensi/pencegahan/resiko/jatuh.destroy');
// end Kemoterapi Intervensi Pencegahan resiko jatuh


// Kemoterapi General Consent
Route::get('kemoterapi/general/consent/create/{id}', [KemoterapiGeneralConsentController::class, 'create'])->name('kemoterapi/general/consent.create');
Route::post('kemoterapi/general/consent/store/{id}', [KemoterapiGeneralConsentController::class, 'store'])->name('kemoterapi/general/consent.store');
Route::get('kemoterapi/general/consent/show/{id}', [KemoterapiGeneralConsentController::class, 'show'])->name('kemoterapi/general/consent.show');
Route::get('kemoterapi/general/consent/showtatatertib/{id}', [KemoterapiGeneralConsentController::class, 'showTataTertib'])->name('kemoterapi/general/consent.showtatatertib');
Route::get('kemoterapi/general/consent/showhakdankewajiban/{id}', [KemoterapiGeneralConsentController::class, 'showHakDanKewajiban'])->name('kemoterapi/general/consent.showhakdankewajiban');
Route::get('kemoterapi/general/consent/edit/{id}', [KemoterapiGeneralConsentController::class, 'edit'])->name('kemoterapi/general/consent.edit');
Route::put('kemoterapi/general/consent/update/{id}', [KemoterapiGeneralConsentController::class, 'update'])->name('kemoterapi/general/consent.update');
Route::delete('kemoterapi/general/consent/destroy/{id}', [KemoterapiGeneralConsentController::class, 'destroy'])->name('kemoterapi/general/consent.destroy');
// end Kemoterapi General Consent

//Assesmen Awal Medis Kemoterapi
Route::get('/kemoterapi/assesmenawal/create/{id}', [KemoterapiInitialAssesmentController::class, 'create'])->name('kemoterapi/assesmenawal.create');
Route::post('/kemoterapi/assesmenawal/store/{id}', [KemoterapiInitialAssesmentController::class, 'store'])->name('kemoterapi/assesmenawal.store');
Route::get('/kemoterapi/assesmenawal/show/{id}', [KemoterapiInitialAssesmentController::class, 'show'])->name('kemoterapi/assesmenawal.show');
Route::delete('/kemoterapi/assesmenawal/destroy/{id}', [KemoterapiInitialAssesmentController::class, 'destroy'])->name('kemoterapi/assesmenawal.destroy');
// end Assesmen Awal Medis Kemoterapi


//Ranap Assesmen Awal Keperawatan Pasien Rawat Inap
Route::get('/kemoterapi/assesmen/awal/keperawatan/index', [AssesmenAwalKeperawatanKemoterapiController::class, 'index'])->name('kemoterapi/assesmen/awal/keperawatan.index');
Route::get('/kemoterapi/assesmen/awal/keperawatan/detail/{id}', [AssesmenAwalKeperawatanKemoterapiController::class, 'detail'])->name('kemoterapi/assesmen/awal/keperawatan.detail');
Route::get('/kemoterapi/assesmen/awal/keperawatan/show/{id}', [AssesmenAwalKeperawatanKemoterapiController::class, 'show'])->name('kemoterapi/assesmen/awal/keperawatan.show');
Route::get('/kemoterapi/assesmen/awal/keperawatan/edit/{id}', [AssesmenAwalKeperawatanKemoterapiController::class, 'edit'])->name('kemoterapi/assesmen/awal/keperawatan.edit');
Route::delete('/kemoterapi/assesmen/awal/keperawatan/destroy/{id}', [AssesmenAwalKeperawatanKemoterapiController::class, 'destroy'])->name('kemoterapi/assesmen/awal/keperawatan.destroy');


//Ranap Assesmen Perawat Status Fisik
Route::get('/kemoterapi/asesmen/status/fisik/index/{id}', [AsesmenKeperawatanStatusFisikKemoterapiController::class, 'index'])->name('kemoterapi/asesmen/status/fisik.index');
Route::post('/kemoterapi/asesmen/status/fisik/store/{id}', [AsesmenKeperawatanStatusFisikKemoterapiController::class, 'store'])->name('kemoterapi/asesmen/status/fisik.store');


//Kemoterapi Ringkasan Masuk dan Keluar
Route::get('kemoterapi/ringkasan/masuk/dan/keluar/create/{id}', [KemoterapiRingkasanMasukdanKeluarController::class, 'create'])->name('kemoterapi/ringkasan-masuk-keluar.create');
Route::post('kemoterapi/masuk/dan/keluar/store/{id}', [KemoterapiRingkasanMasukdanKeluarController::class, 'store'])->name('kemoterapi/ringkasan-masuk-keluar.store');
Route::get('kemoterapi/ringkasan/masuk/dan/keluar/show/{id}', [KemoterapiRingkasanMasukdanKeluarController::class, 'show'])->name('kemoterapi/ringkasan-masuk-keluar.show');
Route::get('kemoterapi/ringkasan/masuk/dan/keluar/edit/{id}', [KemoterapiRingkasanMasukdanKeluarController::class, 'edit'])->name('kemoterapi/ringkasan-masuk-keluar.edit');
Route::put('kemoterapi/ringkasan/masuk/dan/keluar/update/{id}', [KemoterapiRingkasanMasukdanKeluarController::class, 'update'])->name('kemoterapi/ringkasan-masuk-keluar.update');
Route::delete('kemoterapi/ringkasan/masuk/dan/keluar/delete/{id}', [KemoterapiRingkasanMasukdanKeluarController::class, 'destroy'])->name('kemoterapi/ringkasan-masuk-keluar.destroy');
//end Kemoterapi Ringkasan Masuk dan Keluar

// Monitoring Tindakan Kemoterapi
Route::get('kemoterapi/monitoring/tindakan/kemoterapi/create/{id}', [KemoterapiMonitoringTindakanController::class, 'create'])->name('kemoterapi/monitoring-tindakan.create');
Route::post('kemoterapi/monitoring/tindakan/kemoterapi/store/{id}', [KemoterapiMonitoringTindakanController::class, 'store'])->name('kemoterapi/monitoring-tindakan.store');
Route::get('kemoterapi/monitoring/tindakan/kemoterapi/show/{id}', [KemoterapiMonitoringTindakanController::class, 'show'])->name('kemoterapi/monitoring-tindakan.show');
Route::get('kemoterapi/monitoring/tindakan/kemoterapi/edit/{id}', [KemoterapiMonitoringTindakanController::class, 'edit'])->name('kemoterapi/monitoring-tindakan.edit');
Route::put('kemoterapi/monitoring/tindakan/kemoterapi/update/{id}', [KemoterapiMonitoringTindakanController::class, 'update'])->name('kemoterapi/monitoring-tindakan.update');
Route::delete('kemoterapi/monitoring/tindakan/kemoterapi/destroy/{id}', [KemoterapiMonitoringTindakanController::class, 'destroy'])->name('kemoterapi/monitoring-tindakan.destroy');
Route::get('/monitoring-tindakan-kemoterapi', function () {
    return view('pages.monitoringTindakanKemoterapi.index', [
        "title" => "Monitoring Tindakan Kemoterapi",
        "menu" => ""
    ]);
});
Route::get('/tambah-monitoring-tindakan-kemoterapi', function () {
    return view('pages.monitoringTindakanKemoterapi.create', [
        "title" => "Tambah Monitoring Tindakan Kemoterapi",
        "menu" => ""
    ]);
})->name('add-monitoring');
// end Monitoring Tindakan Kemoterapi

// Tindakan Pelayanan Pasien
Route::get('/kemoterapi/tindakan/pelayanan/pasien/index/{id}', [KemoterapiTindakanPelayananPatientController::class, 'index'])->name('kemoterapi/tindakan/pelayanan/pasien.index');
Route::post('/kemoterapi/tindakan/pelayanan/pasien/storeIndex/{id}', [KemoterapiTindakanPelayananPatientController::class, 'storeIndex'])->name('kemoterapi/tindakan/pelayanan/pasien.storeIndex');
Route::get('/kemoterapi/tindakan/pelayanan/pasien/create/{id}', [KemoterapiTindakanPelayananPatientController::class, 'create'])->name('kemoterapi/tindakan/pelayanan/pasien.create');
Route::post('/kemoterapi/tindakan/pelayanan/pasien/store/{id}', [KemoterapiTindakanPelayananPatientController::class, 'store'])->name('kemoterapi/tindakan/pelayanan/pasien.store');
Route::get('/kemoterapi/tindakan/pelayanan/pasien/edit/{id}', [KemoterapiTindakanPelayananPatientController::class, 'edit'])->name('kemoterapi/tindakan/pelayanan/pasien.edit');
Route::get('/kemoterapi/tindakan/pelayanan/pasien/show/{id}', [KemoterapiTindakanPelayananPatientController::class, 'show'])->name('kemoterapi/tindakan/pelayanan/pasien.show');
Route::get('/kemoterapi/tindakan/pelayanan/pasien/destroy/{id}', [KemoterapiTindakanPelayananPatientController::class, 'destroy'])->name('kemoterapi/tindakan/pelayanan/pasien.destroy');
Route::get('/kemoterapi/tindakan/pelayanan/pasien/detail/editDetail/{id}', [KemoterapiTindakanPelayananPatientController::class, 'editDetail'])->name('kemoterapi/tindakan/pelayanan/pasien/detail.editDetail');
Route::post('/kemoterapi/tindakan/pelayanan/pasien/detail/updateDetail/{id}', [KemoterapiTindakanPelayananPatientController::class, 'updateDetail'])->name('kemoterapi/tindakan/pelayanan/pasien/detail.updateDetail');
Route::get('/kemoterapi/tindakan/pelayanan/pasien/detail/destroyDetail/{id}', [KemoterapiTindakanPelayananPatientController::class, 'destroyDetail'])->name('kemoterapi/tindakan/pelayanan/pasien/detail.destroyDetail');
// end Tindakan Pelayanan Pasien
// Data Sosial
Route::get('/data-sosial', function () {
    return view('pages.datasosial.index', [
        "title" => "Rekam Medis",
        "menu" => "Rekam Medis",
    ]);
});

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

//catatan Perjalanan Administrasi Ranap
Route::get('/catat/perjalanan/ranap', [CatatanPerjalananRanapController::class, 'index'])->name('perjalananadministrasi-ranap.index');
Route::get('/catat/perjalanan/ranap/pasien', [CatatanPerjalananRanapController::class, 'create'])->name('perjalananadministrasi-ranap.create');
Route::get('/catat/perjalanan/ranap/pasien/administrasi/{id}', [CatatanPerjalananRanapController::class, 'edit'])->name('perjalananadministrasi-ranap.edit');
Route::get('/catat/perjalanan/ranap/rekam-medis/{id}', [CatatanPerjalananRanapController::class, 'rekamMedis'])->name('perjalananadministrasi-ranap.rekam-medis');
Route::get('/catat/perjalanan/ranap/asuransi/{id}', [CatatanPerjalananRanapController::class, 'asuransi'])->name('perjalananadministrasi-ranap.asuransi');
Route::get('/catat/perjalanan/ranap/registrasi/{id}', [CatatanPerjalananRanapController::class, 'registrasi'])->name('perjalananadministrasi-ranap.registrasi');
Route::get('/catat/perjalanan/ranap/kamar-bedah/{id}', [CatatanPerjalananRanapController::class, 'bedah'])->name('perjalananadministrasi-ranap.kamar-bedah');
Route::get('/catat/perjalanan/ranap/laboratorium/{id}', [CatatanPerjalananRanapController::class, 'laboratorium'])->name('perjalananadministrasi-ranap.laboratorium');
Route::get('/catat/perjalanan/ranap/farmasi-kasir/{id}', [CatatanPerjalananRanapController::class, 'farmasikasir'])->name('perjalananadministrasi-ranap.farmasi-kasir');
Route::put('/catat/perjalanan/ranap/update/{id}', [CatatanPerjalananRanapController::class, 'update'])->name('perjalananadministrasi-ranap.update');
Route::post('/catat/perjalanan/ranap/store/{id}', [CatatanPerjalananRanapController::class, 'store'])->name('perjalananadministrasi-ranap.store');
Route::delete('/catat/perjaalanan/ranap/destroy/{id}', [CatatanPerjalananRanapController::class, 'destroy'])->name('perjalananadministrasi-ranap.destroy');

//Skrining Covid Ranap Pasien
Route::get('/skrining/covid', [SkriningCovidRanapPatientController::class, 'index'])->name('skrining/covid.index');
Route::get('/skrining/covid/create/{id}', [SkriningCovidRanapPatientController::class, 'create'])->name('skrining/covid.create');
Route::post('/skrining/covid/store/{id}', [SkriningCovidRanapPatientController::class, 'store'])->name('skrining/covid.store');
Route::get('/skrining/covid/edit/{id}', [SkriningCovidRanapPatientController::class, 'edit'])->name('skrining/covid.edit');
Route::put('/skrining/covid/update/{id}', [SkriningCovidRanapPatientController::class, 'update'])->name('skrining/covid.update');
Route::delete('/skrining/covid/destroy/{id}', [SkriningCovidRanapPatientController::class, 'destroy'])->name('skrining/covid.destroy');

//Laporan Operasi Ranap
Route::get('/laporan/operasi', [LaporanOperasiController::class, 'index'])->name('laporan/operasi.index');
Route::get('/laporan/operasi/create/{id}', [LaporanOperasiController::class, 'create'])->name('laporan/operasi.create');
Route::get('/laporan/operasi/detail/{id}', [LaporanOperasiController::class, 'detail'])->name('laporan/operasi.detail');
Route::post('/laporan/operasi/store/{id}', [LaporanOperasiController::class, 'store'])->name('laporan/operasi.store');
Route::get('/laporan/operasi/edit/{id}', [LaporanOperasiController::class, 'edit'])->name('laporan/operasi.edit');
Route::put('/laporan/operasi/update/{id}', [LaporanOperasiController::class, 'update'])->name('laporan/operasi.update');
Route::delete('/laporan/operasi/destroy/{id}', [LaporanOperasiController::class, 'destroy'])->name('laporan/operasi.destroy');
Route::get('/laporan/operasi/get/ttd', [LaporanOperasiController::class, 'getTtd'])->name('laporan/operasi.ttd');
//Ranap CPPT
Route::get('/ranap/cppt/create/{id}', [CpptRanapController::class, 'create'])->name('ranap/cppt.create');
Route::post('/ranap/cppt/store/{id}', [CpptRanapController::class, 'store'])->name('ranap/cppt.store');
Route::get('/ranap/cppt/edit/{id}', [CpptRanapController::class, 'edit'])->name('ranap/cppt.edit');
Route::put('/ranap/cppt/update/{id}', [CpptRanapController::class, 'update'])->name('ranap/cppt.update');
Route::get('/ranap/cppt/show/{id}', [CpptRanapController::class, 'show'])->name('ranap/cppt.show');
Route::get('/ranap/cppt/print/{id}', [CpptRanapController::class, 'print'])->name('ranap/cppt.print');
Route::delete('/ranap/cppt/destroy/{id}', [CpptRanapController::class, 'destroy'])->name('ranap/cppt.destroy');
Route::get('/ranap/cppt/getTtd', [CpptRanapController::class, 'getTtd'])->name('ranap/cppt.getTtd');
Route::get('/ranap/cppt/updateTtd', [CpptRanapController::class, 'updateTtd'])->name('ranap/cppt.updateTtd');

//Kemoterapi CPPT
Route::get('/kemoterapi/cppt/create/{id}', [CpptKemoterapiController::class, 'create'])->name('kemoterapi/cppt.create');
Route::post('/kemoterapi/cppt/store/{id}', [CpptKemoterapiController::class, 'store'])->name('kemoterapi/cppt.store');
Route::get('/kemoterapi/cppt/edit/{id}', [CpptKemoterapiController::class, 'edit'])->name('kemoterapi/cppt.edit');
Route::put('/kemoterapi/cppt/update/{id}', [CpptKemoterapiController::class, 'update'])->name('kemoterapi/cppt.update');
Route::get('/kemoterapi/cppt/show/{id}', [CpptKemoterapiController::class, 'show'])->name('kemoterapi/cppt.show');
Route::get('/kemoterapi/cppt/print/{id}', [CpptKemoterapiController::class, 'print'])->name('kemoterapi/cppt.print');
Route::delete('/kemoterapi/cppt/destroy/{id}', [CpptKemoterapiController::class, 'destroy'])->name('kemoterapi/cppt.destroy');
Route::get('/kemoterapi/cppt/getTtd', [CpptKemoterapiController::class, 'getTtd'])->name('kemoterapi/cppt.getTtd');
Route::get('/kemoterapi/cppt/updateTtd', [CpptKemoterapiController::class, 'updateTtd'])->name('kemoterapi/cppt.updateTtd');


Route::get('/ranap/alih/rawat/create/{id}', [RanapAlihRawatController::class, 'create'])->name('ranap/alih/rawat.create');
Route::post('/ranap/alih/rawat/store/{id}', [RanapAlihRawatController::class, 'store'])->name('ranap/alih/rawat.store');

//Ranap resep dokter
Route::group(['middleware' => ['permission:daftar resep dokter']], function () {
    Route::get('/ranap/resep/dokter', [RanapMedicineReceiptController::class, 'index'])->name('ranap/resep/dokter.index');
    Route::get('/ranap/resep/dokter/detail/{id}', [RanapMedicineReceiptController::class, 'detail'])->name('ranap/resep/dokter.detail');
});
Route::group(['middleware' => ['permission:tambah resep dokter']], function () {
    Route::get('/ranap/resep/dokter/create/{id}', [RanapMedicineReceiptController::class, 'create'])->name('ranap/resep/dokter.create');
    Route::post('/ranap/resep/dokter/store/{id}', [RanapMedicineReceiptController::class, 'store'])->name('ranap/resep/dokter.store');
});
Route::group(['middleware' => ['permission:edit resep dokter']], function () {
    Route::get('/ranap/resep/dokter/edit/{id}', [RanapMedicineReceiptController::class, 'edit'])->name('ranap/resep/dokter.edit');
    Route::put('/ranap/resep/dokter/update/{id}', [RanapMedicineReceiptController::class, 'update'])->name('ranap/resep/dokter.update');
});
Route::group(['middleware' => ['permission:print resep dokter']], function () {
    Route::get('/ranap/resep/dokter/show/{id}', [RanapMedicineReceiptController::class, 'show'])->name('ranap/resep/dokter.show');
});
Route::group(['middleware' => ['permission:hapus resep dokter']], function () {
    Route::delete('/ranap/resep/dokter/destroy/{id}', [RanapMedicineReceiptController::class, 'destroy'])->name('ranap/resep/dokter.destroy');
});

//Daftar Tilik Verifikasi Pasien Pra Operasi
Route::get('daftar/tilik/verifikasi/pasien/', [DaftarTilikVerifikasiPasienPraOperasiController::class, 'index'])->name('daftar-tilik.index');
Route::get('daftar/tilik/verifikasi/pasien/create/{id}', [DaftarTilikVerifikasiPasienPraOperasiController::class, 'create'])->name('daftar-tilik.create');
Route::post('daftar/tilik/verifikasi/pasien/store/{id}', [DaftarTilikVerifikasiPasienPraOperasiController::class, 'store'])->name('daftar-tilik.store');
Route::get('daftar/tilik/verifikasi/pasien/edit/{id}', [DaftarTilikVerifikasiPasienPraOperasiController::class, 'edit'])->name('daftar-tilik.edit');
Route::put('daftar/tilik/verifikasi/pasien/update/{id}', [DaftarTilikVerifikasiPasienPraOperasiController::class, 'update'])->name('daftar-tilik.update');
Route::delete('daftar/tilik/verifikasi/pasien/delete/{id}', [DaftarTilikVerifikasiPasienPraOperasiController::class, 'destroy'])->name('daftar-tilik.destroy');

//Assesmen Awal Medis Rawat Inap
Route::get('assesmen/awal/medis/ranap/', [RanapInitialAssesmentController::class, 'index'])->name('assesmen/awal/medis/ranap.index');
Route::get('assesmen/awal/medis/ranap/detail/{id}', [RanapInitialAssesmentController::class, 'detail'])->name('assesmen/awal/medis/ranap.detail');
Route::get('assesmen/awal/medis/ranap/create/{id}', [RanapInitialAssesmentController::class, 'create'])->name('assesmen/awal/medis/ranap.create');
Route::post('assesmen/awal/medis/ranap/store/{id}', [RanapInitialAssesmentController::class, 'store'])->name('assesmen/awal/medis/ranap.store');
Route::get('assesmen/awal/medis/ranap/edit/{id}', [RanapInitialAssesmentController::class, 'edit'])->name('assesmen/awal/medis/ranap.edit');
Route::get('assesmen/awal/medis/ranap/show/{id}', [RanapInitialAssesmentController::class, 'show'])->name('assesmen/awal/medis/ranap.show');
Route::put('assesmen/awal/medis/ranap/update/{id}', [RanapInitialAssesmentController::class, 'update'])->name('assesmen/awal/medis/ranap.update');
Route::delete('assesmen/awal/medis/ranap/delete/{id}', [RanapInitialAssesmentController::class, 'destroy'])->name('assesmen/awal/medis/ranap.destroy');
Route::get('assesmen/awal/medis/ranap/ttd', [RanapInitialAssesmentController::class, 'getTtd'])->name('assesmen/awal/medis/ranap.ttd');
//Ringkasan Masuk dan Keluar
Route::get('ringkasan/masuk/dan/keluar/', [RingkasanMasukDanKeluarController::class, 'index'])->name('ringkasan-masuk-keluar.index');
Route::get('ringkasan/masuk/dan/keluar/detail/{id}', [RingkasanMasukDanKeluarController::class, 'detail'])->name('ringkasan-masuk-keluar.detail');
Route::get('ringkasan/masuk/dan/keluar/create/{id}', [RingkasanMasukDanKeluarController::class, 'create'])->name('ringkasan-masuk-keluar.create');
Route::post('ringkasan/masuk/dan/keluar/store/{id}', [RingkasanMasukDanKeluarController::class, 'store'])->name('ringkasan-masuk-keluar.store');
Route::get('ringkasan/masuk/dan/keluar/show/{id}', [RingkasanMasukDanKeluarController::class, 'show'])->name('ringkasan-masuk-keluar.show');
Route::get('ringkasan/masuk/dan/keluar/edit/{id}', [RingkasanMasukDanKeluarController::class, 'edit'])->name('ringkasan-masuk-keluar.edit');
Route::put('ringkasan/masuk/dan/keluar/update/{id}', [RingkasanMasukDanKeluarController::class, 'update'])->name('ringkasan-masuk-keluar.update');
Route::delete('ringkasan/masuk/dan/keluar/delete/{id}', [RingkasanMasukDanKeluarController::class, 'destroy'])->name('ringkasan-masuk-keluar.destroy');
Route::get('ringkasan/masuk/dan/keluar/ttd/', [RingkasanMasukDanKeluarController::class, 'ttd'])->name('ringkasan-masuk-keluar.ttd');

//Ringkasan Catatan Medis
Route::get('ringkasan/catatan/medis/create/{id}', [RanapDischargeSummaryController::class, 'create'])->name('ringkasan/catatan/medis.create');
Route::post('ringkasan/catatan/medis/store/{id}', [RanapDischargeSummaryController::class, 'store'])->name('ringkasan/catatan/medis.store');
Route::get('ringkasan/catatan/medis/edit/{id}', [RanapDischargeSummaryController::class, 'edit'])->name('ringkasan/catatan/medis.edit');
Route::get('ringkasan/catatan/medis/show/{id}', [RanapDischargeSummaryController::class, 'show'])->name('ringkasan/catatan/medis.show');
Route::put('ringkasan/catatan/medis/update/{id}', [RanapDischargeSummaryController::class, 'update'])->name('ringkasan/catatan/medis.update');
Route::delete('ringkasan/catatan/medis/delete/{id}', [RanapDischargeSummaryController::class, 'destroy'])->name('ringkasan/catatan/medis.destroy');

//Ringkasan Catatan Medis Kemoterapi
Route::get('ringkasan/catatan/medis/kemoterapi/create/{id}', [KemoterapiDischargeSummaryController::class, 'create'])->name('ringkasan/catatan/medis/kemoterapi.create');
Route::post('ringkasan/catatan/medis/kemoterapi/store/{id}', [KemoterapiDischargeSummaryController::class, 'store'])->name('ringkasan/catatan/medis/kemoterapi.store');
Route::get('ringkasan/catatan/medis/kemoterapi/edit/{id}', [KemoterapiDischargeSummaryController::class, 'edit'])->name('ringkasan/catatan/medis/kemoterapi.edit');
Route::get('ringkasan/catatan/medis/kemoterapi/show/{id}', [KemoterapiDischargeSummaryController::class, 'show'])->name('ringkasan/catatan/medis/kemoterapi.show');
Route::put('ringkasan/catatan/medis/kemoterapi/update/{id}', [KemoterapiDischargeSummaryController::class, 'update'])->name('ringkasan/catatan/medis/kemoterapi.update');
Route::delete('ringkasan/catatan/medis/kemoterapi/delete/{id}', [KemoterapiDischargeSummaryController::class, 'destroy'])->name('ringkasan/catatan/medis/kemoterapi.destroy');
Route::get('/kemoterapi/discharges/getTtd', [KemoterapiDischargeSummary::class, 'getTtd'])->name('kemoterapi/discharges.getTtd');

//Lembar Konsultasi Penyakit Dalam
Route::get('lembar/konsultasi/penyakit/dalam/index/', [RanapLembarKonsultasiPenyakitDalamPatientController::class, 'index'])->name('lembar/konsultasi/penyakit/dalam.index');
Route::get('lembar/konsultasi/penyakit/dalam/detail/{id}', [RanapLembarKonsultasiPenyakitDalamPatientController::class, 'detail'])->name('lembar/konsultasi/penyakit/dalam.detail');
Route::get('lembar/konsultasi/penyakit/dalam/create/{id}', [RanapLembarKonsultasiPenyakitDalamPatientController::class, 'create'])->name('lembar/konsultasi/penyakit/dalam.create');
Route::post('lembar/konsultasi/penyakit/dalam/store/{id}', [RanapLembarKonsultasiPenyakitDalamPatientController::class, 'store'])->name('lembar/konsultasi/penyakit/dalam.store');
Route::get('lembar/konsultasi/penyakit/dalam/edit/{id}', [RanapLembarKonsultasiPenyakitDalamPatientController::class, 'edit'])->name('lembar/konsultasi/penyakit/dalam.edit');
Route::get('lembar/konsultasi/penyakit/dalam/show/{id}', [RanapLembarKonsultasiPenyakitDalamPatientController::class, 'show'])->name('lembar/konsultasi/penyakit/dalam.show');
Route::put('lembar/konsultasi/penyakit/dalam/update/{id}', [RanapLembarKonsultasiPenyakitDalamPatientController::class, 'update'])->name('lembar/konsultasi/penyakit/dalam.update');
Route::delete('lembar/konsultasi/penyakit/dalam/delete/{id}', [RanapLembarKonsultasiPenyakitDalamPatientController::class, 'destroy'])->name('lembar/konsultasi/penyakit/dalam.destroy');

//Jawaban Konsultasi Penyakit Dalam
Route::get('jawaban/konsultasi/penyakit/dalam/create/{id}', [RanapJawabanKonsultasiPenyakitDalamPatientController::class, 'create'])->name('jawaban/konsultasi/penyakit/dalam.create');
Route::post('jawaban/konsultasi/penyakit/dalam/store/{id}', [RanapJawabanKonsultasiPenyakitDalamPatientController::class, 'store'])->name('jawaban/konsultasi/penyakit/dalam.store');
Route::get('jawaban/konsultasi/penyakit/dalam/edit/{id}', [RanapJawabanKonsultasiPenyakitDalamPatientController::class, 'edit'])->name('jawaban/konsultasi/penyakit/dalam.edit');
Route::get('jawaban/konsultasi/penyakit/dalam/show/{id}', [RanapJawabanKonsultasiPenyakitDalamPatientController::class, 'show'])->name('jawaban/konsultasi/penyakit/dalam.show');
Route::put('jawaban/konsultasi/penyakit/dalam/update/{id}', [RanapJawabanKonsultasiPenyakitDalamPatientController::class, 'update'])->name('jawaban/konsultasi/penyakit/dalam.update');
Route::delete('jawaban/konsultasi/penyakit/dalam/delete/{id}', [RanapJawabanKonsultasiPenyakitDalamPatientController::class, 'destroy'])->name('jawaban/konsultasi/penyakit/dalam.destroy');

//Pemberian Informasi Dan Persetujuan Tindakan Bedah
Route::get('persetujuan/tindakan/bedah/index', [RanapPersetujuanTindakanBedahPatientController::class, 'index'])->name('persetujuan/tindakan/bedah.index');
Route::get('persetujuan/tindakan/bedah/detail/{id}', [RanapPersetujuanTindakanBedahPatientController::class, 'detail'])->name('persetujuan/tindakan/bedah.detail');
Route::get('persetujuan/tindakan/bedah/create/{id}', [RanapPersetujuanTindakanBedahPatientController::class, 'create'])->name('persetujuan/tindakan/bedah.create');
Route::post('persetujuan/tindakan/bedah/store/{id}', [RanapPersetujuanTindakanBedahPatientController::class, 'store'])->name('persetujuan/tindakan/bedah.store');
Route::get('persetujuan/tindakan/bedah/edit/{id}', [RanapPersetujuanTindakanBedahPatientController::class, 'edit'])->name('persetujuan/tindakan/bedah.edit');
Route::get('persetujuan/tindakan/bedah/show/{id}', [RanapPersetujuanTindakanBedahPatientController::class, 'show'])->name('persetujuan/tindakan/bedah.show');
Route::put('persetujuan/tindakan/bedah/update/{id}', [RanapPersetujuanTindakanBedahPatientController::class, 'update'])->name('persetujuan/tindakan/bedah.update');
Route::delete('persetujuan/tindakan/bedah/delete/{id}', [RanapPersetujuanTindakanBedahPatientController::class, 'destroy'])->name('persetujuan/tindakan/bedah.destroy');

//Pemberian Informasi dan Persetujuan Tindakan Anestesi
Route::get('pemberian/informasi/persetujuan/tindakan/anestesi/index', [RanapPemberianInformasiPersetujuanTindakanAnestesiController::class, 'index'])->name('pemberian/informasi/persetujuan/tindakan/anestesi.index');
Route::get('pemberian/informasi/persetujuan/tindakan/anestesi/detail/{id}', [RanapPemberianInformasiPersetujuanTindakanAnestesiController::class, 'detail'])->name('pemberian/informasi/persetujuan/tindakan/anestesi.detail');
Route::get('pemberian/informasi/persetujuan/tindakan/anestesi/create/{id}', [RanapPemberianInformasiPersetujuanTindakanAnestesiController::class, 'create'])->name('pemberian/informasi/persetujuan/tindakan/anestesi.create');
Route::post('pemberian/informasi/persetujuan/tindakan/anestesi/store/{id}', [RanapPemberianInformasiPersetujuanTindakanAnestesiController::class, 'store'])->name('pemberian/informasi/persetujuan/tindakan/anestesi.store');
Route::get('pemberian/informasi/persetujuan/tindakan/anestesi/edit/{id}', [RanapPemberianInformasiPersetujuanTindakanAnestesiController::class, 'edit'])->name('pemberian/informasi/persetujuan/tindakan/anestesi.edit');
Route::get('pemberian/informasi/persetujuan/tindakan/anestesi/show/{id}', [RanapPemberianInformasiPersetujuanTindakanAnestesiController::class, 'show'])->name('pemberian/informasi/persetujuan/tindakan/anestesi.show');
Route::put('pemberian/informasi/persetujuan/tindakan/anestesi/update/{id}', [RanapPemberianInformasiPersetujuanTindakanAnestesiController::class, 'update'])->name('pemberian/informasi/persetujuan/tindakan/anestesi.update');
Route::delete('pemberian/informasi/persetujuan/tindakan/anestesi/delete/{id}', [RanapPemberianInformasiPersetujuanTindakanAnestesiController::class, 'destroy'])->name('pemberian/informasi/persetujuan/tindakan/anestesi.destroy');

//Monitoring Cairan Infus
Route::get('monitoring/cairan/infus/index', [RanapMonitoringCairanInfusController::class, 'index'])->name('monitoring/cairan/infus.index');
Route::get('monitoring/cairan/infus/create/{id}', [RanapMonitoringCairanInfusController::class, 'create'])->name('monitoring/cairan/infus.create');
Route::post('monitoring/cairan/infus/store/{id}', [RanapMonitoringCairanInfusController::class, 'store'])->name('monitoring/cairan/infus.store');
Route::get('monitoring/cairan/infus/edit/{id}', [RanapMonitoringCairanInfusController::class, 'edit'])->name('monitoring/cairan/infus.edit');
Route::get('monitoring/cairan/infus/show/{id}', [RanapMonitoringCairanInfusController::class, 'show'])->name('monitoring/cairan/infus.show');
Route::put('monitoring/cairan/infus/update/{id}', [RanapMonitoringCairanInfusController::class, 'update'])->name('monitoring/cairan/infus.update');
Route::delete('monitoring/cairan/infus/delete/{id}', [RanapMonitoringCairanInfusController::class, 'destroy'])->name('monitoring/cairan/infus.destroy');

//Rencana Pulang page 1
Route::get('checklist/rencana/pulang/page/one/index', [RanapCheklistRencanaPulangPageOneController::class, 'index'])->name('checklist/rencana/pulang/page/one.index');
Route::get('checklist/rencana/pulang/page/one/create/{id}', [RanapCheklistRencanaPulangPageOneController::class, 'create'])->name('checklist/rencana/pulang/page/one.create');
Route::post('checklist/rencana/pulang/page/one/store/{id}', [RanapCheklistRencanaPulangPageOneController::class, 'store'])->name('checklist/rencana/pulang/page/one.store');
Route::get('checklist/rencana/pulang/page/one/edit/{id}', [RanapCheklistRencanaPulangPageOneController::class, 'edit'])->name('checklist/rencana/pulang/page/one.edit');
Route::put('checklist/rencana/pulang/page/one/update/{id}', [RanapCheklistRencanaPulangPageOneController::class, 'update'])->name('checklist/rencana/pulang/page/one.update');
Route::get('checklist/rencana/pulang/page/one/show/{id}', [RanapCheklistRencanaPulangPageOneController::class, 'show'])->name('checklist/rencana/pulang/page/one.show');
Route::get('checklist/rencana/pulang/page/one/print/{id}', [RanapCheklistRencanaPulangPageOneController::class, 'print'])->name('checklist/rencana/pulang/page/one.print');
Route::delete('checklist/rencana/pulang/page/one/delete/{id}', [RanapCheklistRencanaPulangPageOneController::class, 'destroy'])->name('checklist/rencana/pulang/page/one.destroy');

//Rencana Pulang page 2
Route::get('checklist/rencana/pulang/page/two/index', [RanapCheklistRencanaPulangPageTwoController::class, 'index'])->name('checklist/rencana/pulang/page/two.index');
Route::get('checklist/rencana/pulang/page/two/create/{id}', [RanapCheklistRencanaPulangPageTwoController::class, 'create'])->name('checklist/rencana/pulang/page/two.create');
Route::post('checklist/rencana/pulang/page/two/store/{id}', [RanapCheklistRencanaPulangPageTwoController::class, 'store'])->name('checklist/rencana/pulang/page/two.store');
Route::get('checklist/rencana/pulang/page/two/edit/{id}', [RanapCheklistRencanaPulangPageTwoController::class, 'edit'])->name('checklist/rencana/pulang/page/two.edit');
Route::get('checklist/rencana/pulang/page/two/show/{id}', [RanapCheklistRencanaPulangPageTwoController::class, 'show'])->name('checklist/rencana/pulang/page/two.show');
Route::get('checklist/rencana/pulang/page/two/print/{id}', [RanapCheklistRencanaPulangPageTwoController::class, 'print'])->name('checklist/rencana/pulang/page/two.print');
Route::put('checklist/rencana/pulang/page/two/update/{id}', [RanapCheklistRencanaPulangPageTwoController::class, 'update'])->name('checklist/rencana/pulang/page/two.update');
Route::delete('checklist/rencana/pulang/page/two/delete/{id}', [RanapCheklistRencanaPulangPageTwoController::class, 'destroy'])->name('checklist/rencana/pulang/page/two.destroy');

//Surat Pernyataan Persetujuan Status Pelayanan
Route::get('surat/pernyataan/persetujuan/status/pelayanan/index', [RanapPernyataanPersetujuanStatusPelayananController::class, 'index'])->name('surat/pernyataan/persetujuan/status/pelayanan.index');
Route::get('surat/pernyataan/persetujuan/status/pelayanan/detail/{id}', [RanapPernyataanPersetujuanStatusPelayananController::class, 'detail'])->name('surat/pernyataan/persetujuan/status/pelayanan.detail');
Route::get('surat/pernyataan/persetujuan/status/pelayanan/create/{id}', [RanapPernyataanPersetujuanStatusPelayananController::class, 'create'])->name('surat/pernyataan/persetujuan/status/pelayanan.create');
Route::post('surat/pernyataan/persetujuan/status/pelayanan/store/{id}', [RanapPernyataanPersetujuanStatusPelayananController::class, 'store'])->name('surat/pernyataan/persetujuan/status/pelayanan.store');
Route::get('surat/pernyataan/persetujuan/status/pelayanan/edit/{id}', [RanapPernyataanPersetujuanStatusPelayananController::class, 'edit'])->name('surat/pernyataan/persetujuan/status/pelayanan.edit');
Route::get('surat/pernyataan/persetujuan/status/pelayanan/show/{id}', [RanapPernyataanPersetujuanStatusPelayananController::class, 'show'])->name('surat/pernyataan/persetujuan/status/pelayanan.show');
Route::put('surat/pernyataan/persetujuan/status/pelayanan/update/{id}', [RanapPernyataanPersetujuanStatusPelayananController::class, 'update'])->name('surat/pernyataan/persetujuan/status/pelayanan.update');
Route::delete('surat/pernyataan/persetujuan/status/pelayanan/delete/{id}', [RanapPernyataanPersetujuanStatusPelayananController::class, 'destroy'])->name('surat/pernyataan/persetujuan/status/pelayanan.destroy');

//Laporan Anestesi
Route::get('laporan/anestesi/index', [RanapLaporanAnestesiController::class, 'index'])->name('laporan/anestesi.index');
Route::get('laporan/anestesi/detail/{id}', [RanapLaporanAnestesiController::class, 'detail'])->name('laporan/anestesi.detail');
Route::get('laporan/anestesi/create/{id}', [RanapLaporanAnestesiController::class, 'create'])->name('laporan/anestesi.create');
Route::post('laporan/anestesi/store/{id}', [RanapLaporanAnestesiController::class, 'store'])->name('laporan/anestesi.store');
Route::get('laporan/anestesi/edit/{id}', [RanapLaporanAnestesiController::class, 'edit'])->name('laporan/anestesi.edit');
Route::get('laporan/anestesi/show/{id}', [RanapLaporanAnestesiController::class, 'show'])->name('laporan/anestesi.show');
Route::put('laporan/anestesi/update/{id}', [RanapLaporanAnestesiController::class, 'update'])->name('laporan/anestesi.update');
Route::delete('laporan/anestesi/delete/{id}', [RanapLaporanAnestesiController::class, 'destroy'])->name('laporan/anestesi.destroy');

//Surgical Safety Checklist
Route::get('surgical/safety/checklist/create/{id}', [RanapSurgicalSafetyChecklistController::class, 'create'])->name('surgical/safety/checklist.create');
Route::post('surgical/safety/checklist/store/{id}', [RanapSurgicalSafetyChecklistController::class, 'store'])->name('surgical/safety/checklist.store');
Route::get('surgical/safety/checklist/edit/{id}', [RanapSurgicalSafetyChecklistController::class, 'edit'])->name('surgical/safety/checklist.edit');
Route::get('surgical/safety/checklist/show/{id}', [RanapSurgicalSafetyChecklistController::class, 'show'])->name('surgical/safety/checklist.show');
Route::put('surgical/safety/checklist/update/{id}', [RanapSurgicalSafetyChecklistController::class, 'update'])->name('surgical/safety/checklist.update');
Route::delete('surgical/safety/checklist/delete/{id}', [RanapSurgicalSafetyChecklistController::class, 'destroy'])->name('surgical/safety/checklist.destroy');

//EDUKASI PASIEN PRA ANESTESI INFORMASI TENTANG ANESTESI DAN SEDASI MENENGAH DALAM
Route::get('edukasi/pasien/pra/anestesi/index', [RanapEdukasiPasienPraAnestesiController::class, 'index'])->name('edukasi/pasien/pra/anestesi.index');
Route::get('edukasi/pasien/pra/anestesi/create/{id}', [RanapEdukasiPasienPraAnestesiController::class, 'create'])->name('edukasi/pasien/pra/anestesi.create');
Route::post('edukasi/pasien/pra/anestesi/store/{id}', [RanapEdukasiPasienPraAnestesiController::class, 'store'])->name('edukasi/pasien/pra/anestesi.store');
Route::get('edukasi/pasien/pra/anestesi/edit/{id}', [RanapEdukasiPasienPraAnestesiController::class, 'edit'])->name('edukasi/pasien/pra/anestesi.edit');
Route::get('edukasi/pasien/pra/anestesi/show/{id}', [RanapEdukasiPasienPraAnestesiController::class, 'show'])->name('edukasi/pasien/pra/anestesi.show');
Route::put('edukasi/pasien/pra/anestesi/update/{id}', [RanapEdukasiPasienPraAnestesiController::class, 'update'])->name('edukasi/pasien/pra/anestesi.update');
Route::delete('edukasi/pasien/pra/anestesi/delete/{id}', [RanapEdukasiPasienPraAnestesiController::class, 'destroy'])->name('edukasi/pasien/pra/anestesi.destroy');

//Formulir Rekonsilasi Obat
Route::get('formulir/rekonsilasi/obat/index', [RanapFormulirRekonsilasiObatController::class, 'index'])->name('formulir/rekonsilasi/obat.index');
Route::get('formulir/rekonsilasi/obat/create/{id}', [RanapFormulirRekonsilasiObatController::class, 'create'])->name('formulir/rekonsilasi/obat.create');
Route::post('formulir/rekonsilasi/obat/store/{id}', [RanapFormulirRekonsilasiObatController::class, 'store'])->name('formulir/rekonsilasi/obat.store');
Route::get('formulir/rekonsilasi/obat/edit/{id}', [RanapFormulirRekonsilasiObatController::class, 'edit'])->name('formulir/rekonsilasi/obat.edit');
Route::get('formulir/rekonsilasi/obat/show/{id}', [RanapFormulirRekonsilasiObatController::class, 'show'])->name('formulir/rekonsilasi/obat.show');
Route::put('formulir/rekonsilasi/obat/update/{id}', [RanapFormulirRekonsilasiObatController::class, 'update'])->name('formulir/rekonsilasi/obat.update');
Route::delete('formulir/rekonsilasi/obat/delete/{id}', [RanapFormulirRekonsilasiObatController::class, 'destroy'])->name('formulir/rekonsilasi/obat.destroy');

//EWS Dewasa
Route::get('ews/dewasa/index/', [RanapEwsDewasaPatientController::class, 'index'])->name('ews/dewasa.index');
Route::get('ews/dewasa/create/{id}', [RanapEwsDewasaPatientController::class, 'create'])->name('ews/dewasa.create');
Route::post('ews/dewasa/store/{id}', [RanapEwsDewasaPatientController::class, 'store'])->name('ews/dewasa.store');
Route::get('ews/dewasa/edit/{id}', [RanapEwsDewasaPatientController::class, 'edit'])->name('ews/dewasa.edit');
Route::get('ews/dewasa/show/{id}', [RanapEwsDewasaPatientController::class, 'show'])->name('ews/dewasa.show');
Route::get('ews/dewasa/detail/{id}', [RanapEwsDewasaPatientController::class, 'detail'])->name('ews/dewasa.detail');
Route::put('ews/dewasa/update/{id}', [RanapEwsDewasaPatientController::class, 'update'])->name('ews/dewasa.update');
Route::delete('ews/dewasa/delete/{id}', [RanapEwsDewasaPatientController::class, 'destroy'])->name('ews/dewasa.destroy');

//EWS Anak
Route::get('ews/anak/create/{id}', [RanapEwsAnakPatientController::class, 'create'])->name('ews/anak.create');
Route::post('ews/anak/store/{id}', [RanapEwsAnakPatientController::class, 'store'])->name('ews/anak.store');
Route::get('ews/anak/edit/{id}', [RanapEwsAnakPatientController::class, 'edit'])->name('ews/anak.edit');
Route::get('ews/anak/show/{id}', [RanapEwsAnakPatientController::class, 'show'])->name('ews/anak.show');
Route::put('ews/anak/update/{id}', [RanapEwsAnakPatientController::class, 'update'])->name('ews/anak.update');
Route::delete('ews/anak/delete/{id}', [RanapEwsAnakPatientController::class, 'destroy'])->name('ews/anak.destroy');

//Assesmen monitoring resiko jatuh
Route::get('assesmen/monitoring/resiko/jatuh/index', [RanapMonitoringResikoJatuhController::class, 'index'])->name('assesmen/monitoring/resiko/jatuh.index');
Route::get('assesmen/monitoring/resiko/jatuh/detail/{id}', [RanapMonitoringResikoJatuhController::class, 'detail'])->name('assesmen/monitoring/resiko/jatuh.detail');
Route::get('assesmen/monitoring/resiko/jatuh/create/{id}', [RanapMonitoringResikoJatuhController::class, 'create'])->name('assesmen/monitoring/resiko/jatuh.create');
Route::post('assesmen/monitoring/resiko/jatuh/store/{id}', [RanapMonitoringResikoJatuhController::class, 'store'])->name('assesmen/monitoring/resiko/jatuh.store');
Route::get('assesmen/monitoring/resiko/jatuh/edit/{id}', [RanapMonitoringResikoJatuhController::class, 'edit'])->name('assesmen/monitoring/resiko/jatuh.edit');
Route::get('assesmen/monitoring/resiko/jatuh/show/{id}', [RanapMonitoringResikoJatuhController::class, 'show'])->name('assesmen/monitoring/resiko/jatuh.show');
Route::put('assesmen/monitoring/resiko/jatuh/update/{id}', [RanapMonitoringResikoJatuhController::class, 'update'])->name('assesmen/monitoring/resiko/jatuh.update');
Route::delete('assesmen/monitoring/resiko/jatuh/delete/{id}', [RanapMonitoringResikoJatuhController::class, 'destroy'])->name('assesmen/monitoring/resiko/jatuh.destroy');

//Intervensi Pencegahan resiko jatuh
Route::get('intervensi/pencegahan/resiko/jatuh/create/{id}', [RanapIntervensiResikoJatuhController::class, 'create'])->name('intervensi/pencegahan/resiko/jatuh.create');
Route::post('intervensi/pencegahan/resiko/jatuh/store/{id}', [RanapIntervensiResikoJatuhController::class, 'store'])->name('intervensi/pencegahan/resiko/jatuh.store');
Route::get('intervensi/pencegahan/resiko/jatuh/edit/{id}', [RanapIntervensiResikoJatuhController::class, 'edit'])->name('intervensi/pencegahan/resiko/jatuh.edit');
Route::get('intervensi/pencegahan/resiko/jatuh/show/{id}', [RanapIntervensiResikoJatuhController::class, 'show'])->name('intervensi/pencegahan/resiko/jatuh.show');
Route::put('intervensi/pencegahan/resiko/jatuh/update/{id}', [RanapIntervensiResikoJatuhController::class, 'update'])->name('intervensi/pencegahan/resiko/jatuh.update');
Route::delete('intervensi/pencegahan/resiko/jatuh/delete/{id}', [RanapIntervensiResikoJatuhController::class, 'destroy'])->name('intervensi/pencegahan/resiko/jatuh.destroy');

//Ranap Rekapitulasi tindakan pelayanan pasien
Route::get('rekapitulasi/tindakan/pelayanan/pasien/index/{id}', [RanapRekapTindakanPelayananPatientController::class, 'index'])->name('rekapitulasi/tindakan/pelayanan/pasien.index');
Route::post('rekapitulasi/tindakan/pelayanan/pasien/storeIndex/{id}', [RanapRekapTindakanPelayananPatientController::class, 'storeIndex'])->name('rekapitulasi/tindakan/pelayanan/pasien.storeIndex');
Route::get('rekapitulasi/tindakan/pelayanan/pasien/create/{id}', [RanapRekapTindakanPelayananPatientController::class, 'create'])->name('rekapitulasi/tindakan/pelayanan/pasien.create');
Route::post('rekapitulasi/tindakan/pelayanan/pasien/store/{id}', [RanapRekapTindakanPelayananPatientController::class, 'store'])->name('rekapitulasi/tindakan/pelayanan/pasien.store');
Route::get('rekapitulasi/tindakan/pelayanan/pasien/edit/{id}', [RanapRekapTindakanPelayananPatientController::class, 'edit'])->name('rekapitulasi/tindakan/pelayanan/pasien.edit');
Route::get('rekapitulasi/tindakan/pelayanan/pasien/show/{id}', [RanapRekapTindakanPelayananPatientController::class, 'show'])->name('rekapitulasi/tindakan/pelayanan/pasien.show');
Route::put('rekapitulasi/tindakan/pelayanan/pasien/update/{id}', [RanapRekapTindakanPelayananPatientController::class, 'update'])->name('rekapitulasi/tindakan/pelayanan/pasien.update');
Route::delete('rekapitulasi/tindakan/pelayanan/pasien/delete/{id}', [RanapRekapTindakanPelayananPatientController::class, 'destroy'])->name('rekapitulasi/tindakan/pelayanan/pasien.destroy');
Route::get('rekapitulasi/tindakan/pelayanan/pasien/getBiayaTindakan/{id}', [RanapRekapTindakanPelayananPatientController::class, 'getBiayaTindakan'])->name('rekapitulasi/tindakan/pelayanan/pasien.getBiayaTindakan');
Route::get('rekapitulasi/tindakan/pelayanan/pasien/getBiayaKonsul/{id}', [RanapRekapTindakanPelayananPatientController::class, 'getBiayaKonsul'])->name('rekapitulasi/tindakan/pelayanan/pasien.getBiayaKonsul');

//General Consent Ranap
Route::get('general/consent/ranap/index', [GeneralConsentRanap::class, 'index'])->name('general-consent-ranap.index');
Route::get('general/consent/ranap/detail/{id}', [GeneralConsentRanap::class, 'detail'])->name('general-consent-ranap.detail');
Route::get('general/consent/ranap/create/{id}', [GeneralConsentRanap::class, 'create'])->name('general-consent-ranap.create');
Route::get('general/consent/ranap/halaman1/{id}', [GeneralConsentRanap::class, 'halaman1'])->name('general-consent-ranap.halaman1');
Route::get('general/consent/ranap/halaman2/{id}', [GeneralConsentRanap::class, 'halaman2'])->name('general-consent-ranap.halaman2');
Route::get('general/consent/ranap/tataTertib/{id}', [GeneralConsentRanap::class, 'tataTertib'])->name('general-consent-ranap.tataTertib');
Route::post('general/consent/ranap/store/{id}', [GeneralConsentRanap::class, 'store'])->name('general-consent-ranap.store');
Route::get('general/consent/ranap/show/{id}', [GeneralConsentRanap::class, 'show'])->name('general-consent-ranap.show');
Route::get('general/consent/ranap/showtatatertib/{id}', [GeneralConsentRanap::class, 'showtatatertib'])->name('general-consent-ranap.showtatatertib');
Route::get('general/consent/ranap/showhakdankewajiban/{id}', [GeneralConsentRanap::class, 'showhakdankewajiban'])->name('general-consent-ranap.showhakdankewajiban');
Route::get('general/consent/ranap/edit/{id}', [GeneralConsentRanap::class, 'edit'])->name('general-consent-ranap.edit');
Route::put('general/consent/ranap/update/{id}', [GeneralConsentRanap::class, 'update'])->name('general-consent-ranap.update');
Route::delete('general/consent/ranap/destroy/{id}', [GeneralConsentRanap::class, 'destroy'])->name('general-consent-ranap.destroy');

//Hais ISK
Route::get('hais/index', [RanapHaisISKPatientController::class, 'index'])->name('hais.index');
Route::get('hais/detail/{id}', [RanapHaisISKPatientController::class, 'detail'])->name('hais.detail');
Route::get('hais/isk/create/{id}', [RanapHaisISKPatientController::class, 'create'])->name('hais/isk.create');
Route::post('hais/isk/store/{id}', [RanapHaisISKPatientController::class, 'store'])->name('hais/isk.store');
Route::get('hais/isk/edit/{id}', [RanapHaisISKPatientController::class, 'edit'])->name('hais/isk.edit');
Route::get('hais/isk/show/{id}', [RanapHaisISKPatientController::class, 'show'])->name('hais/isk.show');
Route::put('hais/isk/update/{id}', [RanapHaisISKPatientController::class, 'update'])->name('hais/isk.update');
Route::delete('hais/isk/delete/{id}', [RanapHaisISKPatientController::class, 'destroy'])->name('hais/isk.destroy');

//Hais IAD
Route::get('hais/iad/create/{id}', [RanapHaisIADPatientController::class, 'create'])->name('hais/iad.create');
Route::post('hais/iad/store/{id}', [RanapHaisIADPatientController::class, 'store'])->name('hais/iad.store');
Route::get('hais/iad/edit/{id}', [RanapHaisIADPatientController::class, 'edit'])->name('hais/iad.edit');
Route::get('hais/iad/show/{id}', [RanapHaisIADPatientController::class, 'show'])->name('hais/iad.show');
Route::put('hais/iad/update/{id}', [RanapHaisIADPatientController::class, 'update'])->name('hais/iad.update');
Route::delete('hais/iad/delete/{id}', [RanapHaisIADPatientController::class, 'destroy'])->name('hais/iad.destroy');

//Hais IDO
Route::get('hais/ido/create/{id}', [RanapHaisIDOPatientController::class, 'create'])->name('hais/ido.create');
Route::post('hais/ido/store/{id}', [RanapHaisIDOPatientController::class, 'store'])->name('hais/ido.store');
Route::get('hais/ido/edit/{id}', [RanapHaisIDOPatientController::class, 'edit'])->name('hais/ido.edit');
Route::get('hais/ido/show/{id}', [RanapHaisIDOPatientController::class, 'show'])->name('hais/ido.show');
Route::put('hais/ido/update/{id}', [RanapHaisIDOPatientController::class, 'update'])->name('hais/ido.update');
Route::delete('hais/ido/delete/{id}', [RanapHaisIDOPatientController::class, 'destroy'])->name('hais/ido.destroy');

Route::get('/interaksi-obat', function () {
    return view('pages.interaksiobat.index', [
        "title" => "Interaksi Obat",
        "menu" => "Obat",
    ]);
});

Route::get('/tambah-asesmenperawat-igd', function () {
    return view('pages.asesmenperawatigd.create', [
        "title" => "Asesmen Perawat",
        "menu" => "In Patient",
    ]);
});


Route::group(['middleware' => ['permission:daftar pasien ranap']], function () {
    Route::get('rawat/inap/index', [RawatInapController::class, 'index'])->name('rawat/inap.index');
    Route::get('rawat/inap/show/{id}', [RawatInapController::class, 'show'])->name('rawat/inap.show');
    Route::get('rawat/inap/room/{id}', [RawatInapController::class, 'room'])->name('rawat/inap.room');
    Route::get('rawat/inap/{id}/cancel', [RawatInapController::class, 'cancel'])->name('rawat/inap.cancel');


    //Booking Kamar
    Route::put('Rawat/Inap/{id}/booking/{bed_id}', [RawatInapController::class, 'bookingKamar'])->name('rawat/inap.booking');
    //Masuk Kamar
    Route::put('Rawat/Inap/{id}/masuk/{bed_id}', [RawatInapController::class, 'masukKamar'])->name('rawat/inap.masuk');
    //Titip Kamar
    Route::put('Rawat/Inap/{id}/titip/{bed_id}', [RawatInapController::class, 'titipKamar'])->name('rawat/inap.titip');
    // cancel kamar
    Route::get('rawat/inap/{id}/cancel/{bed_id}', [RawatInapController::class, 'cancelKamar'])->name('rawat/inap.cancelKamar');
});
//Rawat Inap
// Route::post('rawat/inap/store/{id}', [RawatInapController::class, 'store'])->name('rawat/inap.store');

//kerohanian
Route::get('/permintaan-pelayanan-kerohanian', function () {
    return view('pages.pasienPelayananKerohanian.index', [
        "title" => "Kerohanian",
        "menu" => "Diluar MAP",
    ]);
});
Route::get('/create-permintaan-pelayanan-kerohanian', function () {
    return view('pages.pasienPelayananKerohanian.create', [
        "title" => "Kerohanian",
        "menu" => "Diluar MAP",
    ]);
});
Route::get('/create-hasil-pelaksanaan-pelayanan-kerohanian', function () {
    return view('pages.pasienPelaksanaanPelayananKerohanian.create', [
        "title" => "Kerohanian",
        "menu" => "Diluar MAP",
    ]);
});
Route::get('/bukti-pelaksanaan-pelayanan-kerohanian', function () {
    return view('pages.pasienPelaksanaanPelayananKerohanian.show', [
        "title" => "Kerohanian",
        "menu" => "Diluar MAP",
    ]);
});
Route::get('/show-permintaan-pelayanan-kerohanian', function () {
    return view('pages.pasienPelayananKerohanian.show', [
        "title" => "Kerohanian",
        "menu" => "Diluar MAP",
    ]);
});

//second-opinion
Route::get('/tambah-second-opinion', function () {
    return view('pages.pasienSecondOpinion.create', [
        "title" => "Second Opinion",
        "menu" => "Diluar MAP",
    ]);
});

Route::get('/second-opinion', function () {
    return view('pages.pasienSecondOpinion.index', [
        "title" => "Second Opinion",
        "menu" => "Diluar MAP",
    ]);
});

Route::get('/show-permintaan-second-opinion', function () {
    return view('pages.pasienSecondOpinion.show', [
        "title" => "Second Opinion",
        "menu" => "Diluar MAP",
    ]);
});

Route::get('/ttv', function () {
    $farmakologi = [
        'dingin',
        'panas',
        'posisi',
        'pijat',
        'musik',
        'relaksasi dan pernafasan',
    ];
    return view('pages.ttvRanap.create', [
        "farmakologi" => $farmakologi,
        "title" => "Second Opinion",
        "menu" => "Diluar MAP",
    ]);
});

Route::get('/ttv/balance/cairan', function () {
    $farmakologi = [
        'dingin',
        'panas',
        'posisi',
        'pijat',
        'musik',
        'relaksasi dan pernafasan',
    ];
    return view('pages.ttvBalanceCairanRanap.create', [
        "farmakologi" => $farmakologi,
        "title" => "Second Opinion",
        "menu" => "Diluar MAP",
    ]);
});

// Antran RS GET
Route::get('referensi/poli', [ReferensiController::class, 'getPoli'])->name('referensi/poli.getPoli');
Route::get('referensi/dokter', [ReferensiController::class, 'getDokter'])->name('referensi/dokter.getDokter');
Route::get('referensi/dokterJadwal/{kdPoli}/tanggal/{tgl}', [ReferensiController::class, 'getDokterJadwal'])->name('referensi/dokterJadwal.getDokterJadwal');

//Vclaim GET
Route::get('referensi/diagnosa/{diagnosa}', [ReferensiController::class, 'getDiagnosa'])->name('referensi/diagnosa.getDiagnosa');
Route::get('SEP/{sep}', [ReferensiController::class, 'getSep'])->name('sep.getSep');
Route::post('SEP/2.0/insert', [ReferensiController::class, 'postSep'])->name('sep.postSep');
Route::get('Peserta/nokartu/{noka}/tglSEP/{tgl}', [ReferensiController::class, 'getNoka'])->name('noka.getNoka');
Route::get('Peserta/nik/{nik}/tglSEP/{tgl}', [ReferensiController::class, 'getNokaNik'])->name('noka.getNokaNik');
Route::get('referensi/poli/{kdPoli}', [ReferensiController::class, 'getPoliName'])->name('poli/name.getPoliName');
Route::get('referensi/faskes/{faskes1}/{faskes2}', [ReferensiController::class, 'getFaskes'])->name('faskes.getFaskes');
Route::get('referensi/dokter/pelayanan/{param1}/tglPelayanan/{param2}/Spesialis/{param3}', [ReferensiController::class, 'getDokterDpjp'])->name('dokter/dpjp.getDokterDpjp');
Route::get('referensi/propinsi', [ReferensiController::class, 'getProvince'])->name('province.getProvince');
Route::get('referensi/kabupaten/propinsi/{param1}', [ReferensiController::class, 'getKabupaten'])->name('kabupaten.getKabupaten');
Route::get('referensi/kecamatan/kabupaten/{param1}', [ReferensiController::class, 'getKecamatan'])->name('kecamatan.getKecamatan');
Route::get('referensi/diagnosaprb', [ReferensiController::class, 'getDiagnosaPrb'])->name('diagnosaprb.getDiagnosaPrb');
Route::get('referensi/obatprb/{param1}', [ReferensiController::class, 'getObatPrb'])->name('obatprb.getObatPrb');
Route::get('referensi/procedure/{param1}', [ReferensiController::class, 'getProcedure'])->name('procedure.getProcedure');
Route::get('referensi/kelasrawat', [ReferensiController::class, 'getKelasRawat'])->name('kelas/rawat.getKelasRawat');
Route::get('referensi/dokter/{param1}', [ReferensiController::class, 'getDokterDpjpClaim'])->name('dokter/dpjp/claim.getDokterDpjpClaim');



//Evaluasi Awal MPP
Route::get('evaluasi/awal/MPP/index', [RanapEvaluasiAwalMppController::class, 'index'])->name('evaluasi/awal/MPP.index');
Route::get('evaluasi/awal/MPP/detail/{id}', [RanapEvaluasiAwalMppController::class, 'detail'])->name('evaluasi/awal/MPP.detail');
Route::get('evaluasi/awal/MPP/create/{id}', [RanapEvaluasiAwalMppController::class, 'create'])->name('evaluasi/awal/MPP.create');
Route::post('evaluasi/awal/MPP/store/{id}', [RanapEvaluasiAwalMppController::class, 'store'])->name('evaluasi/awal/MPP.store');
Route::get('evaluasi/awal/MPP/edit/{id}', [RanapEvaluasiAwalMppController::class, 'edit'])->name('evaluasi/awal/MPP.edit');
Route::get('evaluasi/awal/MPP/show/{id}', [RanapEvaluasiAwalMppController::class, 'show'])->name('evaluasi/awal/MPP.show');
Route::put('evaluasi/awal/MPP/update/{id}', [RanapEvaluasiAwalMppController::class, 'update'])->name('evaluasi/awal/MPP.update');
Route::delete('evaluasi/awal/MPP/delete/{id}', [RanapEvaluasiAwalMppController::class, 'destroy'])->name('evaluasi/awal/MPP.destroy');
Route::get('evaluasi/awal/MPP/ttd', [RanapEvaluasiAwalMppController::class, 'getTtd'])->name('evaluasi/awal/MPP.ttd');


//Monitoring Pelayanan Obat Pasien
Route::get('monitoring/pelayanan/obat/pasien/create/{id}', [RanapMonitoringPelayananObatPasienController::class, 'create'])->name('monitoring/pelayanan/obat/pasien.create');
Route::post('monitoring/pelayanan/obat/pasien/store/{id}', [RanapMonitoringPelayananObatPasienController::class, 'store'])->name('monitoring/pelayanan/obat/pasien.store');
Route::get('monitoring/pelayanan/obat/pasien/edit/{id}', [RanapMonitoringPelayananObatPasienController::class, 'edit'])->name('monitoring/pelayanan/obat/pasien.edit');
Route::get('monitoring/pelayanan/obat/pasien/show/{id}', [RanapMonitoringPelayananObatPasienController::class, 'show'])->name('monitoring/pelayanan/obat/pasien.show');
Route::put('monitoring/pelayanan/obat/pasien/update/{id}', [RanapMonitoringPelayananObatPasienController::class, 'update'])->name('monitoring/pelayanan/obat/pasien.update');
Route::delete('monitoring/pelayanan/obat/pasien/delete/{id}', [RanapMonitoringPelayananObatPasienController::class, 'destroy'])->name('monitoring/pelayanan/obat/pasien.destroy');

//Assesmen Pra Sedasi
Route::get('assesmen/pra/sedasi/index/', [RanapAssesmenPraSedasiController::class, 'index'])->name('assesmen/pra/sedasi.index');
Route::get('assesmen/pra/sedasi/create/{id}', [RanapAssesmenPraSedasiController::class, 'create'])->name('assesmen/pra/sedasi.create');
Route::post('assesmen/pra/sedasi/store/{id}', [RanapAssesmenPraSedasiController::class, 'store'])->name('assesmen/pra/sedasi.store');
Route::get('assesmen/pra/sedasi/edit/{id}', [RanapAssesmenPraSedasiController::class, 'edit'])->name('assesmen/pra/sedasi.edit');
Route::get('assesmen/pra/sedasi/detail/{id}', [RanapAssesmenPraSedasiController::class, 'detail'])->name('assesmen/pra/sedasi.detail');
Route::get('assesmen/pra/sedasi/show/{id}', [RanapAssesmenPraSedasiController::class, 'show'])->name('assesmen/pra/sedasi.show');
Route::put('assesmen/pra/sedasi/update/{id}', [RanapAssesmenPraSedasiController::class, 'update'])->name('assesmen/pra/sedasi.update');
Route::delete('assesmen/pra/sedasi/delete/{id}', [RanapAssesmenPraSedasiController::class, 'destroy'])->name('assesmen/pra/sedasi.destroy');

//Assesmen Pra Anestesi Pra Induksi
Route::get('assesmen/pra/anestesi/pra/induksi/index', [RanapAssesmenPraAnestesiPraInduksiController::class, 'index'])->name('assesmen/pra/anestesi/pra/induksi.index');
Route::get('assesmen/pra/anestesi/pra/induksi/detail/{id}', [RanapAssesmenPraAnestesiPraInduksiController::class, 'detail'])->name('assesmen/pra/anestesi/pra/induksi.detail');
Route::get('assesmen/pra/anestesi/pra/induksi/create/{id}', [RanapAssesmenPraAnestesiPraInduksiController::class, 'create'])->name('assesmen/pra/anestesi/pra/induksi.create');
Route::post('assesmen/pra/anestesi/pra/induksi/store/{id}', [RanapAssesmenPraAnestesiPraInduksiController::class, 'store'])->name('assesmen/pra/anestesi/pra/induksi.store');
Route::get('assesmen/pra/anestesi/pra/induksi/edit/{id}', [RanapAssesmenPraAnestesiPraInduksiController::class, 'edit'])->name('assesmen/pra/anestesi/pra/induksi.edit');
Route::get('assesmen/pra/anestesi/pra/induksi/show/{id}', [RanapAssesmenPraAnestesiPraInduksiController::class, 'show'])->name('assesmen/pra/anestesi/pra/induksi.show');
Route::put('assesmen/pra/anestesi/pra/induksi/update/{id}', [RanapAssesmenPraAnestesiPraInduksiController::class, 'update'])->name('assesmen/pra/anestesi/pra/induksi.update');
Route::delete('assesmen/pra/anestesi/pra/induksi/delete/{id}', [RanapAssesmenPraAnestesiPraInduksiController::class, 'destroy'])->name('assesmen/pra/anestesi/pra/induksi.destroy');

// Status fungsional
Route::get('monitoring/status/fungsional/index', [RanapMonitoringStatusFungsionalController::class, 'index'])->name('monitoring/status/fungsional.index');
Route::get('monitoring/status/fungsional/detail/{id}', [RanapMonitoringStatusFungsionalController::class, 'detail'])->name('monitoring/status/fungsional.detail');
Route::get('monitoring/status/fungsional/create/{id}', [RanapMonitoringStatusFungsionalController::class, 'create'])->name('monitoring/status/fungsional.create');
Route::post('monitoring/status/fungsional/store/{id}', [RanapMonitoringStatusFungsionalController::class, 'store'])->name('monitoring/status/fungsional.store');
Route::get('monitoring/status/fungsional/edit/{id}', [RanapMonitoringStatusFungsionalController::class, 'edit'])->name('monitoring/status/fungsional.edit');
Route::get('monitoring/status/fungsional/show/{id}', [RanapMonitoringStatusFungsionalController::class, 'show'])->name('monitoring/status/fungsional.show');
Route::put('monitoring/status/fungsional/update/{id}', [RanapMonitoringStatusFungsionalController::class, 'update'])->name('monitoring/status/fungsional.update');
Route::delete('monitoring/status/fungsional/delete/{id}', [RanapMonitoringStatusFungsionalController::class, 'destroy'])->name('monitoring/status/fungsional.destroy');

//Ranap Assesmen Awal Keperawatan Pasien Rawat Inap
Route::get('/ranap/assesmen/awal/keperawatan/index', [AssesmenAwalKeperawatanRanapController::class, 'index'])->name('ranap/assesmen/awal/keperawatan.index');
Route::get('/ranap/assesmen/awal/keperawatan/detail/{id}', [AssesmenAwalKeperawatanRanapController::class, 'detail'])->name('ranap/assesmen/awal/keperawatan.detail');
Route::get('/ranap/assesmen/awal/keperawatan/show/{id}', [AssesmenAwalKeperawatanRanapController::class, 'show'])->name('ranap/assesmen/awal/keperawatan.show');
Route::get('/ranap/assesmen/awal/keperawatan/edit/{id}', [AssesmenAwalKeperawatanRanapController::class, 'edit'])->name('ranap/assesmen/awal/keperawatan.edit');
Route::delete('/ranap/assesmen/awal/keperawatan/destroy/{id}', [AssesmenAwalKeperawatanRanapController::class, 'destroy'])->name('ranap/assesmen/awal/keperawatan.destroy');

//Ranap Assesmen Perawat Status Fisik
Route::get('/ranap/asesmen/status/fisik/index/{id}', [AsesmentKeperawatanStatusFisikRanapController::class, 'index'])->name('ranap/asesmen/status/fisik.index');
Route::post('/ranap/asesmen/status/fisik/store/{id}', [AsesmentKeperawatanStatusFisikRanapController::class, 'store'])->name('ranap/asesmen/status/fisik.store');

//Ranap Assesmen Perawat Skrining Resiko Jatuh
Route::get('/ranap/asesmen/skrining/resiko/jatuh/index/{id}', [AsesmentKeperawatanSkriningResikoJatuhRanapController::class, 'index'])->name('ranap/asesmen/skrining/resiko/jatuh.index');
Route::get('/ranap/asesmen/skrining/resiko/jatuh/edit/{id}', [AsesmentKeperawatanSkriningResikoJatuhRanapController::class, 'edit'])->name('ranap/asesmen/skrining/resiko/jatuh.edit');
Route::post('/ranap/asesmen/skrining/resiko/jatuh/store/{id}', [AsesmentKeperawatanSkriningResikoJatuhRanapController::class, 'store'])->name('ranap/asesmen/skrining/resiko/jatuh.store');

//Ranap Assesmen Perawat Diagnosis Keperawatan
Route::get('/ranap/asesmen/diagnosis/keperawatan/index/{id}', [AsesmentKeperawatanDiagnosisRanapController::class, 'index'])->name('ranap/asesmen/diagnosis/keperawatan.index');
Route::get('/ranap/asesmen/diagnosis/keperawatan/edit/{id}', [AsesmentKeperawatanDiagnosisRanapController::class, 'edit'])->name('ranap/asesmen/diagnosis/keperawatan.edit');
Route::post('/ranap/asesmen/diagnosis/keperawatan/store/{id}', [AsesmentKeperawatanDiagnosisRanapController::class, 'store'])->name('ranap/asesmen/diagnosis/keperawatan.store');

//Ranap Assesmen Perawat Diagnosis Keperawatan
Route::get('/ranap/asesmen/rencana/asuhan/index/{id}', [AsesmentKeperawatanRencanaAsuhanRanapController::class, 'index'])->name('ranap/asesmen/rencana/asuhan.index');
Route::get('/ranap/asesmen/rencana/asuhan/edit/{id}', [AsesmentKeperawatanRencanaAsuhanRanapController::class, 'edit'])->name('ranap/asesmen/rencana/asuhan.edit');
Route::post('/ranap/asesmen/rencana/asuhan/store/{id}', [AsesmentKeperawatanRencanaAsuhanRanapController::class, 'store'])->name('ranap/asesmen/rencana/asuhan.store');

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

// simulasi Biaya
Route::get('/ranap/simulasi/biaya', [CostEstimateSimulationController::class, 'index'])->name('ranap/simulasi/biaya.index');
Route::post('/ranap/simulasi/biaya/store', [CostEstimateSimulationController::class, 'store'])->name('ranap/simulasi/biaya.store');
Route::get('/ranap/simulasi/biaya/show/{id}', [CostEstimateSimulationController::class, 'show'])->name('ranap/simulasi/biaya.show');




//ranap form
//monitoring pacu
Route::get('/create-monitoring-pacu', function () {
    return view('pages.ranapMonitoringPacu.create', [
        "title" => "Monitoring Pacu",
        "menu" => "Rawat Inap",
    ]);
});
//-monitoring pacu
//-ranap form

//diluar MAP
//komplain
Route::get('/komplain', function () {
    return view('pages.diluarMapKomplain.index', [
        "title" => "Komplain",
        "menu" => "Diluar MAP"
    ]);
});
Route::get('/create-komplain', function () {
    return view('pages.diluarMapKomplain.create', [
        "title" => "Komplain",
        "menu" => "Diluar MAP"
    ]);
});
Route::get('/show-komplain', function () {
    return view('pages.diluarMapKomplain.show', [
        "title" => "Komplain",
        "menu" => "Diluar MAP"
    ]);
});
//komplain
Route::get('/melarikan-diri', function () {
    return view('pages.diluarMapPasienMelarikanDiri.index', [
        "title" => "Pasien Melarikan Diri",
        "menu" => "Diluar MAP"
    ]);
});
Route::get('/create-melarikan-diri', function () {
    return view('pages.diluarMapPasienMelarikanDiri.create', [
        "title" => "Pasien Melarikan Diri",
        "menu" => "Diluar MAP"
    ]);
});
Route::get('/show-melarikan-diri', function () {
    return view('pages.diluarMapPasienMelarikanDiri.show', [
        "title" => "Pasien Melarikan Diri",
        "menu" => "Diluar MAP"
    ]);
});
//-diluar MAP
//testing
Route::get('/lap-anestes', function () {
    return view('pages.surat.lapAnestesi', [
        "title" => "Laporan Anestesi",
        "menu" => "Diluar MAP"
    ]);
});

//gizi
Route::get('/asesmen-awal-gizi', function () {
    return view('pages.giziAsesmenAwalGizi.index', [
        "title" => "Asesmen Awal Gizi",
        "menu" => "Gizi"
    ]);
});
Route::get('/create-asesmen-awal-gizi', function () {
    return view('pages.giziAsesmenAwalGizi.create', [
        "title" => "Create Asesmen Awal Gizi",
        "menu" => "Gizi"
    ]);
});

//Keuangan
Route::post('tarif/layanan/store', [TarifController::class, 'store'])->name('tarif/layanan.store');
Route::put('tarif/layanan/update/{id}', [TarifController::class, 'update'])->name('tarif/layanan.update');
Route::get('tarif/layanan/tarifLayananStore', [TarifController::class, 'tarifLayananStore'])->name('tarif/layanan.tarifLayananStore');
Route::get('tarif/layanan/index', [TarifController::class, 'index'])->name('tarif/layanan.index');
Route::get('tarif/layanan/show/{type}', [TarifController::class, 'show'])->name('tarif/layanan.show');
Route::get('tarif/layanan/create/{type}', [TarifController::class, 'create'])->name('tarif/layanan.create');
Route::get('tarif/layanan/edit/{id}', [TarifController::class, 'edit'])->name('tarif/layanan.edit');
Route::delete('tarif/layanan/destroy/{id}', [TarifController::class, 'destroy'])->name('tarif/layanan.destroy');

//Keunganan - asuransi
Route::get('asuransi/index', [AsuransiController::class, 'index'])->name('asuransi.index');
Route::get('asuransi/create', [AsuransiController::class, 'create'])->name('asuransi.create');
Route::get('asuransi/show/{id}', [AsuransiController::class, 'show'])->name('asuransi.show');
Route::post('asuransi/store', [AsuransiController::class, 'store'])->name('asuransi.store');
Route::get('asuransi/detail/index/{id}', [AsuransiDetailController::class, 'index'])->name('asuransi/detail.index');
Route::get('asuransi/detail/create/{id}', [AsuransiDetailController::class, 'create'])->name('asuransi/detail.create');
Route::get('asuransi/detail/show/{id}', [AsuransiDetailController::class, 'show'])->name('asuransi/detail.show');
Route::post('asuransi/detail/store/{id}', [AsuransiDetailController::class, 'store'])->name('asuransi/detail.store');
// Route::get('/pengantar/asuransi', function () {
//     return view('pages.asuransi.pengantar', [
//         'title' => 'ASURANSI',
//         'menu' => 'KEUANGAN',
//     ]);
// });
// Route::get('/lampiran/asuransi', function () {
//     return view('pages.asuransi.lampiran', [
//         'title' => 'ASURANSI',
//         'menu' => 'KEUANGAN',
//     ]);
// });

//casemix
Route::get('/casemix', [CasemixController::class, 'index'])->name('casemix');
Route::get('/casemix/queue/{id}', [CasemixController::class, 'queue'])->name('casemix.queue');
Route::get('/casemix/queue/show/{id}', [CasemixController::class, 'showQueue'])->name('casemix/queue.show');

// Route::post('/casemix/grouping/{id}', [CasemixController::class, 'grouping'])->name('casemix.grouping');
// Route::post('/casemix/pendanaan/{id}', [CasemixController::class, 'pendanaan'])->name('casemix.queue.pendanaan');
// Route::delete('/casemix/delete/{id}', [CasemixController::class, 'delete'])->name('casemix.queue.delete');
// Route::delete('/casemix/remove-tindakan/{id}', [CasemixController::class, 'removeDetailTindakan'])->name('casemix.remove-tindakan');
// Route::get('/casemix/detail-claim/{id}', [CasemixController::class, 'showClaim'])->name('casemix.detail-claim');
// Route::get('/casemix/coding_grouping', [CasemixController::class, 'codingGrouping'])->name('casemix.coding_grouping');
// Route::post('/casemix/groupe/{id}', [CasemixController::class, 'pendanaan'])->name('casemix.groupe');
// Route::post('/casemix/add-grouping/{id}', [CasemixController::class, 'updateDataClaim'])->name('casemix.add-grouping');
// Route::post('/casemix/tarif/{id}', [CasemixController::class, 'tarif'])->name('casemix.tarif');


Route::get('/casemix/csrf', [InacbgController::class, 'getCrsf']);
Route::post('/casemix/register-claim/{id}', [InacbgController::class, 'registerClaim'])->name('casemix/register.claim');
Route::post('/casemix/update-claim/{id}', [InacbgController::class, 'updateClaim'])->name('casemix/update.claim');



// Kemoterapi Lembar Konsul
Route::get('kemoterapi/lembar/konsul/pasien/create', [KemoterapiLembarKonsulPatientController::class, 'create'])->name('kemoterapi/lembar/konsul.create');
Route::get('kemoterapi/lembar/konsul/pasien/edit', [KemoterapiLembarKonsulPatientController::class, 'edit'])->name('kemoterapi/lembar/konsul.edit');
Route::get('kemoterapi/lembar/konsul/pasien/show', [KemoterapiLembarKonsulPatientController::class, 'show'])->name('kemoterapi/lembar/konsul.show');
// end Kemoterapi Lembar Konsul

// Rawat Inap New Menu
Route::get('/rawat/inap/dashboard/patient', function () {
    return view('pages.rawatInapNew.dashboardPasien', [
        "title" => "Dashboard Pasien",
        "menu" => "Rawat Inap"
    ]);
})->name('rawat.inap.dashboard.patient');

Route::group(['middleware' => 'clear.ranap.session'], function () {
    Route::get('/rawat/inap/assesmen/{id}', [RawatInapNewController::class, 'assesmen'])->name('rawat.inap.assesmen');
    // Route::get('/rawat/inap/catatan/perjalanan/administrasi/{id}', [RawatInapNewController::class, 'catatanPerjalananAdministrasi'])->name('rawat.inap.catatan.perjalanan.administrasi');
    // Route::get('/rawat/inap/cppt/{id}', [RawatInapNewController::class, 'cppt'])->name('rawat.inap.cppt');
    Route::get('/rawat/inap/catatan/perjalanan/administrasi/{id}', [RawatInapNewController::class, 'catatanPerjalananAdministrasi'])->name('rawat.inap.catatan.perjalanan.administrasi');
    Route::get('/rawat/inap/cppt/{id}', [RawatInapNewController::class, 'cppt'])->name('rawat.inap.cppt');
    Route::get('/rawat/inap/daftar/tilik/{id}', [RawatInapNewController::class, 'daftarTilik'])->name('rawat.inap.daftar.tilik');
    Route::get('/rawat/inap/daftar/tilik/discharge/{id}', [RawatInapNewController::class, 'discharge'])->name('rawat.inap.discharge');
    Route::get('/rawat/inap/edukasi/pasien/praAnestesi/{id}', [RawatInapNewController::class, 'edukasiPasienPraAnestesi'])->name('rawat.inap.edukasi.pasien.praAnestesi');
    Route::get('/rawat/inap/ews/{id}', [RawatInapNewController::class, 'ews'])->name('rawat.inap.ews');
    Route::get('/rawat/inap/formulir/rekonsilisasi/obat/{id}', [RawatInapNewController::class, 'formulirRekonsiliasiObat'])->name('rawat.inap.formulir.rekonsilisasi.obat');
    Route::get('/rawat/inap/general/consent/{id}', [RawatInapNewController::class, 'generalConsent'])->name('rawat.inap.general.consent');
    Route::get('/rawat/inap/hais/{id}', [RawatInapNewController::class, 'hais'])->name('rawat.inap.hais');
    Route::get('/rawat/inap/konsultasi/penyakit/dalam/{id}', [RawatInapNewController::class, 'konsultasiPenyakitDalam'])->name('rawat.inap.konsultasi.penyakit.dalam');
    Route::get('/rawat/inap/laporan/{id}', [RawatInapNewController::class, 'laporan'])->name('rawat.inap.laporan');
    Route::get('/rawat/inap/manager/pelayanan/pasien/{id}', [RawatInapNewController::class, 'managerPelayananPasien'])->name('rawat.inap.manager.pelayanan.pasien');
    Route::get('/rawat/inap/monitoring/{id}', [RawatInapNewController::class, 'monitoring'])->name('rawat.inap.monitoring');
    Route::get('/rawat/inap/persetujuan/{id}', [RawatInapNewController::class, 'persetujuan'])->name('rawat.inap.persetujuan');
    Route::get('/rawat/inap/resep/dokter/{id}', [RawatInapNewController::class, 'resepDokter'])->name('rawat.inap.resep.dokter');
    Route::get('/rawat/inap/ringkasan/masuk/dan/keluar/{id}', [RawatInapNewController::class, 'ringkasanMasukDanKeluar'])->name('rawat.inap.ringkasan.masuk.dan.keluar');
    Route::get('/rawat/inap/skrining/covid/{id}', [RawatInapNewController::class, 'skriningCovid'])->name('rawat.inap.skrining.covid');
    Route::get('/rawat/inap/tindakan/pelayanan/{id}', [RawatInapNewController::class, 'tindakanPelayanan'])->name('rawat.inap.tindakan.pelayanan');
});




Route::get('/e-klaim', function () {
    return view('pages.eKlaim.create', [
        "title" => "E-Klaim",
        "menu" => "Rawat Inap",
    ]);
})->name('e-klaim');
// end Rawat Inap New Menu
require __DIR__ . '/auth.php';
