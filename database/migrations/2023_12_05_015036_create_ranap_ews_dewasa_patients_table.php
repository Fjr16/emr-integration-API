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
        Schema::create('ranap_ews_dewasa_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->date('tanggal')->nullable();
            $table->time('jam')->nullable();
            $table->integer('frekuensi_napas')->nullable();
            $table->integer('frekuensi_nadi')->nullable();
            $table->integer('tekanan_sistolik')->nullable();
            $table->float('suhu')->nullable();
            $table->integer('total_skor')->nullable();
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
        Schema::dropIfExists('ranap_ews_dewasa_patients');
    }
};
