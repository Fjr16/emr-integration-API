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
        Schema::create('permintaan_laboratorium_patologi_anatomik_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('queue_id');
            $table->foreignId('user_id');
            $table->foreignId('patient_id');
            $table->string('no_sediaan')->nullable();
            $table->string('jaringanTubuhDiDapat')->nullable();
            $table->longText('lokasiJaringanYangDiAmbil')->nullable();
            $table->longText('pengobatanYangTelahDiBerikan')->nullable();
            $table->longText('diagnosisKlinik')->nullable();
            $table->longText('keteranganKlinik')->nullable();
            $table->longText('sketsaLokasi')->nullable();
            $table->date('hphjt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permintaan_laboratorium_patologi_anatomik_patients');
    }
};
