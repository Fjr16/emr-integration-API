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
        Schema::create('ranap_jawaban_konsul_penyakit_dalam_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_permintaan_konsul_penyakit_dalam_patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->text('ket_pasien')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->text('anjuran')->nullable();
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
        Schema::dropIfExists('ranap_jawaban_konsul_penyakit_dalam_patients');
    }
};
