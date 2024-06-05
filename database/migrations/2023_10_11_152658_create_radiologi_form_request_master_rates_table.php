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
        Schema::create('radiologi_form_request_master_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('radiologi_form_request_master_id')->nullable();
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
        Schema::dropIfExists('radiologi_form_request_master_rates');
    }
};
