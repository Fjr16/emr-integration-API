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
        Schema::create('kemoterapi_monitoring_resiko_jatuh_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kemoterapi_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable(); //nm perawat inisial dan ttd
            $table->integer('total_skor')->nullable();
            $table->string('nilai_skor')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('tipe')->nullable();
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
        Schema::dropIfExists('kemoterapi_monitoring_resiko_jatuh_patients');
    }
};
