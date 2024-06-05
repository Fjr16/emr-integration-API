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
        Schema::create('igd_resiko_nutrisional_ass_kep_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('igd_ase_kep_patient_id');
            $table->string('name')->nullable();
            $table->string('category')->nullable();
            $table->string('nilai')->nullable();
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
        Schema::dropIfExists('igd_resiko_nutrisional_ass_kep_patients');
    }
};
