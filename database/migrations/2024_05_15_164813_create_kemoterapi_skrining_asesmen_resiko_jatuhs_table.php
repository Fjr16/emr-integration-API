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
        Schema::create('kemoterapi_skrining_asesmen_resiko_jatuhs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('kemoterapi_diagnosis_keperawatan_patient_id');
            $table->foreignId('kemoterapi_asesment_keperawatan_skrining_resiko_jatuh_patient_id');
            $table->string('usia')->nullable();
            $table->string('skor')->nullable();
            $table->string('kategori')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->string('name')->nullable();
            $table->string('ttd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kemoterapi_skrining_asesmen_resiko_jatuhs');
    }
};
