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
        Schema::create('igd_initial_assesments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('igd_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('isPasien')->nullable();
            $table->string('name')->nullable(); //nama penerima info
            $table->string('hubungan')->nullable();
            $table->string('keluhan')->nullable();
            $table->string('riwayat_penyakit_sekarang')->nullable();
            $table->string('riwayat_penyakit_dahulu')->nullable();
            $table->string('riwayat_penggunaan_obat')->nullable();
            $table->string('riwayat_penyakit_keluarga')->nullable();
            $table->string('status_lokalis')->nullable();
            $table->string('diagnosa_kerja')->nullable();
            $table->string('diagnosa_banding')->nullable();
            $table->string('terapi')->nullable();
            $table->string('dijelaskan_kepada')->nullable();
            $table->string('ttd_penerima_info')->nullable();
            $table->string('nama_dpjp')->nullable();
            $table->string('ttd_dpjp')->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->boolean('isActive')->default(true); //soft deletes
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
        Schema::dropIfExists('igd_initial_assesments');
    }
};
