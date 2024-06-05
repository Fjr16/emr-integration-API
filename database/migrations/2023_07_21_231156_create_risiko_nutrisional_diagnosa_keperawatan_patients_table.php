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
        Schema::create('risiko_nutrisional_diagnosa_keperawatan_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diagnosis_keperawatan_patient_id');
            $table->foreignId('asesment_keperawatan_skrining_resiko_jatuh_patient_id');
            $table->string('diagnosa');
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
        Schema::dropIfExists('risiko_nutrisional_diagnosa_keperawatan_patients');
    }
};
