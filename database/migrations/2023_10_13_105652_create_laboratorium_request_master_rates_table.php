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
        Schema::create('laboratorium_request_master_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratorium_request_master_variable_id')->nullable();
            $table->foreignId('patient_category_id')->nullable();
            $table->integer('tarif_umum')->nullable();
            $table->integer('tarif_uc')->nullable();
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
        Schema::dropIfExists('laboratorium_request_master_rates');
    }
};
