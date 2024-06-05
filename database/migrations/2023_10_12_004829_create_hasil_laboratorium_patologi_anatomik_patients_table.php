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
        Schema::create('hasil_laboratorium_patologi_anatomik_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('detail_antrian_laboratorium_patologi_anatomi_patient_id');
            $table->foreignId('user_id');
            $table->string('validator');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_laboratorium_patologi_anatomik_patients');
    }
};
