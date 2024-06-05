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
        Schema::create('ranap_discharge_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->dateTime('tanggal_masuk')->nullable();
            $table->dateTime('tanggal_keluar')->nullable();
            $table->longText('anamnesis')->nullable();
            $table->longText('indikasi')->nullable();
            $table->longText('riwayat_penyakit')->nullable();
            $table->longText('pemeriksaan_fisik')->nullable();
            $table->longText('pemeriksaan_diagnostik')->nullable();
            $table->text('kondisi_pasien')->nullable();
            $table->longText('intruksi')->nullable();
            $table->longText('tindak_lanjut')->nullable();
            $table->string('dokter_pengirim')->nullable();
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
        Schema::dropIfExists('ranap_discharge_summaries');
    }
};
