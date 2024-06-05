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
        Schema::create('laboratorium_patient_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('queue_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('laboratorium_request_id')->nullable();
            $table->string('nomor_antrian_lab')->nullable();
            $table->string('nomor_reg_lab')->nullable();
            $table->string('tanggal_periksa')->nullable();
            $table->string('status')->nullable();
            $table->text('kesan')->nullable();
            $table->text('anjuran')->nullable();
            $table->dateTime('tgl_pengambilan_sampel')->nullable();
            $table->dateTime('tgl_pemeriksaan_selesai')->nullable();
            $table->time('jam_pelaporan_kritis')->nullable();
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
        Schema::dropIfExists('laboratorium_patient_results');
    }
};
