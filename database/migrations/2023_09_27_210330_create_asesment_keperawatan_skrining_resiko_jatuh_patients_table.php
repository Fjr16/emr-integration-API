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
        Schema::create('asesment_keperawatan_skrining_resiko_jatuh_patients', function (Blueprint $table) {
            $table->foreignId('diagnosis_keperawatan_patient_id');
            $table->id();
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
        Schema::dropIfExists('asesment_keperawatan_skrining_resiko_jatuh_patients');
    }
};
