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
        Schema::create('ranap_initial_assesments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->datetime('tanggal')->nullable();
            $table->boolean('isPasien')->nullable();
            $table->string('name')->nullable();
            $table->string('hubungan')->nullable();
            $table->longText('keluhan_utama')->nullable();
            $table->longText('riwayat_penyakit_sekarang')->nullable();
            $table->longText('riwayat_penyakit_dahulu')->nullable();
            $table->longText('riwayat_penggunaan_obat')->nullable();
            $table->longText('riwayat_penyakit_keluarga')->nullable();
            $table->longText('status_lokalis')->nullable();
            $table->longText('diagnosa_kerja')->nullable();
            $table->longText('diagnosa_banding')->nullable();
            $table->longText('terapi')->nullable();
            $table->string('dijelaskan_kepada')->nullable();
            $table->boolean('isActive')->default(true);
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
        Schema::dropIfExists('ranap_initial_assesments');
    }
};
