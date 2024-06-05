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
        Schema::create('kemoterapi_detail_asesment_nyeri_diagnosa_keperawatan_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kemoterapi_asesment_nyeri_diagnosa_keperawatan_patient_id');
            $table->string('name');
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
        Schema::dropIfExists('kemoterapi_detail_asesment_nyeri_diagnosa_keperawatan_patients');
    }
};
