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
        Schema::create('radiologi_patient_request_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('radiologi_patient_id')->nullable();
            $table->foreignId('radiologi_form_request_detail_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('nomor')->nullable();
            $table->string('tanggal')->nullable();
            $table->text('hasil')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('radiologi_patient_request_details');
    }
};
