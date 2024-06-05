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
        Schema::create('daftar_tilik_verifikasi_pra_operasi_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreignId('rawat_inap_patient_id');
            $table->string('jam_tiba');
            $table->string('jam_keluar');
            $table->string('ruang_rawat');
            $table->date('tanggal_operasi');
            $table->string('tindakan_operasi');
            $table->string('lokasi_sisi_operasi_tindakan');
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
        Schema::dropIfExists('daftar_tilik_verifikasi_pra_operasi_patients');
    }
};
