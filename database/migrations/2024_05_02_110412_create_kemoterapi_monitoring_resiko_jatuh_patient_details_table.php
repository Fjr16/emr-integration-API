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
        Schema::create('kemoterapi_monitoring_resiko_jatuh_patient_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kemoterapi_monitoring_resiko_jatuh_patient_id')->nullable();
            $table->string('faktor_resiko')->nullable();
            $table->integer('skor')->nullable();
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
        Schema::dropIfExists('kemoterapi_monitoring_resiko_jatuh_patient_details');
    }
};
