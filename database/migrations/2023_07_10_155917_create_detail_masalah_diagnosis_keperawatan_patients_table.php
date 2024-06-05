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
        Schema::create('detail_masalah_diagnosis_keperawatan_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('diagnosis_keperawatan_patient_id');
            $table->foreignId('asesment_keperawatan_diagnosis_keperawatan_patient_id');
            $table->string('diagnosa')->nullable();
            // $table->foreignId('asesment_keperawatan_rencana_asuhan_patient_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_masalah_diagnosis_keperawatan_patients');
    }
};
