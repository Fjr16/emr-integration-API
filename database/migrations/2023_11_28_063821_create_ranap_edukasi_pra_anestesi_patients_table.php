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
        Schema::create('ranap_edukasi_pra_anestesi_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->dateTime('tgl')->nullable();
            $table->string('rencana_tindakan')->nullable();
            $table->string('jenis_anestesi')->nullable();
            $table->string('ttd_user')->nullable();
            $table->string('ttd_wali_patient')->nullable();
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
        Schema::dropIfExists('ranap_edukasi_pra_anestesi_patients');
    }
};
