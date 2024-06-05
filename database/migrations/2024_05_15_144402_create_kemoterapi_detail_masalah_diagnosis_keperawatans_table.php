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
        Schema::create('kemoterapi_detail_masalah_diagnosis_keperawatans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('kemoterapi_diagnosis_keperawatan_patient_id');
            $table->foreignId('kemoterapi_asesment_keperawatan_diagnosis_keperawatan_patient_id');
            $table->string('diagnosa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kemoterapi_detail_masalah_diagnosis_keperawatans');
    }
};
