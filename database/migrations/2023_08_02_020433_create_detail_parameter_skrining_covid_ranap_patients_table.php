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
        Schema::create('detail_parameter_skrining_covid_ranap_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detail_skrining_covid_ranap_patient_id');
            $table->string('name')->nullable();
            $table->string('ket')->nullable();
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
        Schema::dropIfExists('detail_parameter_skrining_covid_ranap_patients');
    }
};
