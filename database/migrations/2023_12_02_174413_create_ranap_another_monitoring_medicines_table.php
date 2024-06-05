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
        Schema::create('ranap_another_monitoring_medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_monitoring_medicine_id')->nullable();
            $table->foreignId('medicine_id')->nullable();
            $table->foreignId('user_id')->nullable(); //get paraf dan nama
            $table->boolean('skin_test')->nullable();
            $table->boolean('alergi')->nullable();
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
        Schema::dropIfExists('ranap_another_monitoring_medicines');
    }
};
