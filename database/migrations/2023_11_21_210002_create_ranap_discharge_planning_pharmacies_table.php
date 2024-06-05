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
        Schema::create('ranap_discharge_planning_pharmacies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_discharge_planning_gizi_pharmacy_id')->nullable();
            $table->foreignId('medicine_id')->nullable();
            $table->string('indikasi')->nullable();
            $table->string('dosis')->nullable();
            $table->dateTime('waktu_pemberian')->nullable();
            $table->string('cara_pemberian')->nullable();
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
        Schema::dropIfExists('ranap_discharge_planning_pharmacies');
    }
};
