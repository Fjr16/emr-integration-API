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
        Schema::create('skrining_covid_ranap_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreignId('rawat_inap_patient_id');
            $table->bigInteger('total_skor');
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
        Schema::dropIfExists('skrining_covid_ranap_patients');
    }
};
