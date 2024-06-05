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
        Schema::create('igd_riwayat_alergi_ass_kep_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('igd_ase_kep_patient_id');
            $table->string('status')->nullable();
            $table->string('alergi_obat')->nullable();
            $table->string('reaksi_obat')->nullable();
            $table->string('alergi_mkn')->nullable();
            $table->string('reaksi_mkn')->nullable();
            $table->string('alergi_lainnya')->nullable();
            $table->string('reaksi_lainnya')->nullable();
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
        Schema::dropIfExists('igd_riwayat_alergi_ass_kep_patients');
    }
};
