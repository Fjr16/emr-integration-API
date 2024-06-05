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
        Schema::create('anestesi_report_medicine_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anestesi_report_medicine_id')->nullable();
            $table->foreignId('medicine_id')->nullable();
            $table->string('medicine_value')->nullable();
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
        Schema::dropIfExists('anestesi_report_medicine_details');
    }
};
