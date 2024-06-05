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
        Schema::create('ranap_monitoring_resiko_jatuh_detail_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_monitoring_resiko_jatuh_patient_id')->nullable();
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
        Schema::dropIfExists('ranap_monitoring_resiko_jatuh_detail_patients');
    }
};
