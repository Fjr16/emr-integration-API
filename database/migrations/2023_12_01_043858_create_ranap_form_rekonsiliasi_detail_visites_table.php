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
        Schema::create('ranap_form_rekonsiliasi_detail_visites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_form_rekonsiliasi_medicine_id')->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('ranap_form_rekonsiliasi_detail_visites');
    }
};
