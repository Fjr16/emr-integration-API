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
        Schema::create('asesment_keperawatan_status_fisik_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('diagnosis_keperawatan_patient_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asesment_keperawatan_status_fisik_patients');
    }
};
