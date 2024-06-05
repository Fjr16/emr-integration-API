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
        Schema::create('kemoterapi_detail_diagnosa_utama_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kemoterapi_discharge_summary_id')->nullable();
            $table->text('diagnosa_utama')->nullable();
            $table->text('icd')->nullable();
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
        Schema::dropIfExists('kemoterapi_detail_diagnosa_utama_patients');
    }
};
