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
        Schema::create('antrian_laboratorium_patologi_anatomi_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('permintaan_laboratorium_patologi_anatomik_patient_id');
            $table->foreignId('user_id');
            $table->dateTime('tgl_diperiksa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('antrian_laboratorium_patologi_anatomi_patients');
    }
};
