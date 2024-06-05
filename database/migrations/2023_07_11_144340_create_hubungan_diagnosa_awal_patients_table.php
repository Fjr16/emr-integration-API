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
        Schema::create('hubungan_diagnosa_awal_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('diagnosis_keperawatan_patient_id');
            $table->foreignId('detail_diagnosis_keperawatan_patient_id');
            $table->string('diagnosa')->nullable();
            $table->string('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hubungan_diagnosa_awal_patients');
    }
};
