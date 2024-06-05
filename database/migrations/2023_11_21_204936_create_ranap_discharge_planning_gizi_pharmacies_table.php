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
        Schema::create('ranap_discharge_planning_gizi_pharmacies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->longText('keterangan_gizi')->nullable();
            $table->string('nm_petugas_farmasi')->nullable();
            $table->string('ttd_petugas_farmasi')->nullable();
            $table->string('nm_petugas_gizi')->nullable();
            $table->string('ttd_petugas_gizi')->nullable();
            $table->string('nm_wali')->nullable();
            $table->string('ttd_wali')->nullable();
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
        Schema::dropIfExists('ranap_discharge_planning_gizi_pharmacies');
    }
};
