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
        Schema::create('igd_ase_kep_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('igd_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->text('ttdDokter')->nullable();
            $table->string('nm_dokter')->nullable();
            $table->text('ttdPerawat')->nullable();
            $table->string('nm_perawat')->nullable();
            $table->dateTime('tgl_selesai_asesmen')->nullable();
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
        Schema::dropIfExists('igd_ase_kep_patients');
    }
};
