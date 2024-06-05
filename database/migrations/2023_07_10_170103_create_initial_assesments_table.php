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
        Schema::create('initial_assesments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_jalan_poli_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('isPasien')->nullable();
            $table->string('name')->nullable();
            $table->string('hubungan')->nullable();
            $table->string('keluhan')->nullable();
            $table->string('riwayat_penyakit_sekarang')->nullable();
            $table->string('riwayat_penyakit_dahulu')->nullable();
            $table->string('riwayat_penggunaan_obat')->nullable();
            $table->string('riwayat_penyakit_keluarga')->nullable();
            $table->string('status_lokalis')->nullable();
            $table->string('diagnosa_kerja')->nullable();
            $table->string('diagnosa_banding')->nullable();
            $table->text('terapi')->nullable();
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
        Schema::dropIfExists('initial_assesments');
    }
};
