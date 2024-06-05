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
        Schema::create('detail_resiko_rajal_diagnosa_keperawatan_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resiko_rajal_diagnosa_keperawatan_patient_id');
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
        Schema::dropIfExists('detail_resiko_rajal_diagnosa_keperawatan_patients');
    }
};
