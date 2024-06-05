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
        Schema::create('kemoterapi_status_fisik_diagnosa_keperawatan_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kemoterapi_diagnosis_keperawatan_patient_id');
            $table->foreignId('kemoterapi_asesment_keperawatan_status_fisik_patient_id');
            $table->string('darah')->nullable();
            $table->string('nadi')->nullable();
            $table->string('suhu')->nullable();
            $table->string('pernafasan')->nullable();
            $table->string('tb')->nullable();
            $table->string('bb')->nullable();
            $table->string('luas_permukaan_badan')->nullable();
            $table->string('imt')->nullable();
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
        Schema::dropIfExists('kemoterapi_status_fisik_diagnosa_keperawatan_patients');
    }
};
