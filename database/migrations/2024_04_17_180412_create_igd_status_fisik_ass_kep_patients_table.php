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
        Schema::create('igd_status_fisik_ass_kep_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('igd_ase_kep_patient_id')->nullable();
            $table->string('darah')->nullable();
            $table->string('nadi')->nullable();
            $table->string('suhu')->nullable();
            $table->string('pernafasan')->nullable();
            $table->string('tb')->nullable();
            $table->string('bb')->nullable();
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
        Schema::dropIfExists('igd_status_fisik_ass_kep_patients');
    }
};
