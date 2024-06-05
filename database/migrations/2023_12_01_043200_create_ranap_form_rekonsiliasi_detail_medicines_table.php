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
        Schema::create('ranap_form_rekonsiliasi_detail_medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_form_rekonsiliasi_medicine_id')->nullable();
            $table->foreignId('medicine_id')->nullable();
            $table->string('frekuensi')->nullable();
            $table->string('rute')->nullable();
            $table->boolean('isAdmisi')->nullable();
            $table->string('ruangTf1')->nullable();
            $table->boolean('isTransfer1')->nullable();
            $table->string('ruangTf2')->nullable();
            $table->boolean('isTransfer2')->nullable();
            $table->string('ruangTf3')->nullable();
            $table->boolean('isTransfer3')->nullable();
            $table->boolean('isPulang')->nullable();
            $table->dateTime('tanggal')->nullable();
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
        Schema::dropIfExists('ranap_form_rekonsiliasi_detail_medicines');
    }
};
