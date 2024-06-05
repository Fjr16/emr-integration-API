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
        Schema::create('ranap_discharge_planning_nutrition', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_discharge_planning_gizi_pharmacy_id')->nullable();
            $table->string('diet')->nullable();
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
        Schema::dropIfExists('ranap_discharge_planning_nutrition');
    }
};
