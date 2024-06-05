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
        Schema::create('ranap_hais_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('room_detail_id')->nullable();
            $table->string('jenis')->nullable();
            $table->date('tanggal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ranap_hais_patients');
    }
};
