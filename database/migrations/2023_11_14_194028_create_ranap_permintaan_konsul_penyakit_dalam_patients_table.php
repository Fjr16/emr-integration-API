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
        Schema::create('ranap_permintaan_konsul_penyakit_dalam_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('room_detail_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('permintaan')->nullable();
            $table->text('ket_pasien')->nullable();
            $table->text('pemeriksaan_ditemukan')->nullable();
            $table->dateTime('tanggal')->nullable();
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
        Schema::dropIfExists('ranap_permintaan_konsul_penyakit_dalam_patients');
    }
};
