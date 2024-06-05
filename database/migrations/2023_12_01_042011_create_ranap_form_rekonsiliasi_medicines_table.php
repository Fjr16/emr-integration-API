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
        Schema::create('ranap_form_rekonsiliasi_medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->boolean('isAlergi')->nullable();
            $table->boolean('isInUseMedicine')->nullable();
            $table->longText('intruksi')->nullable();
            $table->string('nama_dokter')->nullable();
            $table->string('ttd_dokter')->nullable();
            $table->string('nama_apoteker')->nullable();
            $table->string('ttd_apoteker')->nullable();
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
        Schema::dropIfExists('ranap_form_rekonsiliasi_medicines');
    }
};
