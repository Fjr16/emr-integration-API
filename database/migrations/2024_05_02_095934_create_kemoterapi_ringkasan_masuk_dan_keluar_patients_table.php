<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kemoterapi_ringkasan_masuk_dan_keluar_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreignId('kemoterapi_patient_id');
            $table->date('tanggal_masuk')->nullable();
            $table->time('jam_masuk')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->time('jam_keluar')->nullable();
            $table->integer('lama_dirawat')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('tahun_kunjungan')->nullable();
            $table->string('dirawat_ke')->nullable();
            $table->string('ruang_rawat')->nullable();
            $table->string('alamat_sesuai_ktp')->nullable();
            $table->string('alamat_sesuai_domisili')->nullable();
            $table->string('no_telphone')->nullable();
            $table->string('email')->nullable();
            $table->string('suku_bangsa')->nullable();
            $table->string('agama')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('keyakinan')->nullable();
            $table->string('nilai_nilai_pribadi')->nullable();
            $table->string('bahasa')->nullable();
            $table->string('kedatangan_pasien')->nullable();
            $table->string('hambatan_bahasa')->nullable();
            $table->string('kebutuhan_penerjemah')->nullable();
            $table->string('kebutuhan_disabilitas')->nullable();
            $table->string('jalur_masuk_rumahsakit')->nullable();
            $table->string('mutasi_bangsal_1')->nullable();
            $table->string('mutasi_pindah_bangsal_1')->nullable();
            $table->string('tanggal_bangsal_1')->nullable();
            $table->string('mutasi_bangsal_2')->nullable();
            $table->string('mutasi_pindah_bangsal_2')->nullable();
            $table->string('tanggal_bangsal_2')->nullable();
            $table->string('keadaan_keluar')->nullable();
            $table->string('cara_keluar')->nullable();
            $table->string('meninggal')->nullable();
            $table->string('diagnosa_utama')->nullable();
            $table->string('diagnosa_sekunder')->nullable();
            $table->string('komplikasi_dan_resiko')->nullable();
            $table->string('tindakan_operasi')->nullable();
            $table->string('riwayat_alergi')->nullable();
            $table->string('riwayat_transfusi')->nullable();
            $table->date('tanggal_aps')->nullable();
            $table->time('jam_aps')->nullable();
            $table->date('tanggal_kontrol')->nullable();
            $table->time('jam_kontrol')->nullable();
            $table->longText('ttd_dpjp_tambahan_1')->nullable();
            $table->longText('ttd_dpjp_tambahan_2')->nullable();
            $table->longText('ttd_dpjp_utama')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kemoterapi_ringkasan_masuk_dan_keluar_patients');
    }
};
