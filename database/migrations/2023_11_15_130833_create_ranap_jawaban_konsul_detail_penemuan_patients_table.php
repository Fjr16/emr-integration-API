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
        Schema::create('ranap_jawaban_konsul_detail_penemuan_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_jawaban_konsul_penyakit_dalam_patient_id')->nullable();
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->string('satuan')->nullable();
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
        Schema::dropIfExists('ranap_jawaban_konsul_detail_penemuan_patients');
    }
};
