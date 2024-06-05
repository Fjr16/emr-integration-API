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
        Schema::create('rawat_jalan_poli_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_jalan_patient_id')->nullable();
            $table->string('status')->nullable();
            $table->string('status_rekam_medis')->nullable();
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
        Schema::dropIfExists('rawat_jalan_poli_patients');
    }
};
