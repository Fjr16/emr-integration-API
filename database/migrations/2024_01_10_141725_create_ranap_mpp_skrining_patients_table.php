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
        Schema::create('ranap_mpp_skrining_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_mpp_patient_id')->nullable();
            $table->longText('kriteria')->nullable();
            $table->integer('skor')->nullable();
            $table->string('kategori')->nullable();
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
        Schema::dropIfExists('ranap_mpp_skrining_patients');
    }
};
