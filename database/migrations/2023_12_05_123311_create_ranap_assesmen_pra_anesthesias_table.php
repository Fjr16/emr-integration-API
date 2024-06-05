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
        Schema::create('ranap_assesmen_pra_anesthesias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->string('dokter_anestesi')->nullable();
            $table->string('asisten_anestesi')->nullable();
            $table->string('dokter_bedah')->nullable();
            $table->string('diagnosis_pra_bedah')->nullable();
            $table->string('jenis_pembedahan')->nullable();
            $table->string('diagnosis_pasca_bedah')->nullable();
            $table->time('jam_operasi')->nullable();
            $table->time('puasa_jam')->nullable();
            $table->string('status_fisik')->nullable();
            $table->boolean('isAlergi')->nullable();
            $table->text('penyulit_pra_anestesi')->nullable();
            $table->string('ttd_dokter_anestesi')->nullable();
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
        Schema::dropIfExists('ranap_assesmen_pra_anesthesias');
    }
};
