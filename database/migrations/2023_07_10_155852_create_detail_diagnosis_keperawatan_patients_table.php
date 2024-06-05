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
        Schema::create('detail_diagnosis_keperawatan_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('diagnosis_keperawatan_patient_id');
            $table->foreignId('asesment_keperawatan_diagnosis_keperawatan_patient_id');
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
        Schema::dropIfExists('detail_diagnosis_keperawatan_patients');
    }
};
