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
        Schema::create('kemoterapi_monitoring_tindakan_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('kemoterapi_patient_id');
            $table->foreignId('patient_id');
            $table->string('alergi')->nullable();
            $table->string('keterangan_alergi')->nullable();
            $table->string('ekstravasasi')->nullable();
            $table->string('keterangan_ekstravasasi')->nullable();
            $table->longText('ttd_perawat')->nullable();
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
        Schema::dropIfExists('kemoterapi_monitoring_tindakan_patients');
    }
};
