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
        Schema::create('satu_sehat_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('queue_id');
            $table->string('no_rm', 50)->nullable();
            $table->string('nama_pasien', 100)->nullable();
            $table->date('tgl_lhr')->nullable();
            $table->string('nik')->nullable();
            $table->date('tanggal_pelayanan')->nullable();
            $table->string('kode_dpjp', 50)->nullable();
            $table->string('sip', 100)->nullable();
            $table->string('nama_dpjp', 100)->nullable();
            $table->string('poliklinik', 50)->nullable();
            $table->text('anamnesa')->nullable();
            $table->string('kesadaran', 50)->nullable();
            $table->string('tinggi_badan', 50)->nullable();
            $table->string('berat_badan', 50)->nullable();
            $table->string('nadi', 50)->nullable();
            $table->string('tekanan_darah', 50)->nullable();
            $table->string('suhu', 50)->nullable();
            $table->string('nafas', 50)->nullable();
            $table->string('kode_diagnosa_utama', 50)->nullable();
            $table->string('nama_diagnosa_utama', 50)->nullable();
            $table->text('diagnosa_sekunder')->nullable();
            $table->string('kode_prosedur', 50)->nullable();
            $table->string('nama_prosedur', 50)->nullable();
            $table->text('radiologi')->nullable();
            $table->text('laboratorium')->nullable();
            $table->text('tindakan')->nullable();
            $table->text('resep_obat')->nullable();
            $table->text('intruksi_pulang')->nullable();
            $table->string('keadaan_keluar', 100)->nullable();
            $table->string('cara_keluar', 100)->nullable();
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
        Schema::dropIfExists('satu_sehat_patients');
    }
};
