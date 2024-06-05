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
        Schema::create('ranap_monitoring_cairan_infus_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->string('order_dokter')->nullable();
            $table->string('jenis')->nullable();
            $table->integer('botol_ke')->nullable();
            $table->integer('tetes')->nullable();
            $table->time('mulai')->nullable();
            $table->time('habis')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('ranap_monitoring_cairan_infus_patients');
    }
};
