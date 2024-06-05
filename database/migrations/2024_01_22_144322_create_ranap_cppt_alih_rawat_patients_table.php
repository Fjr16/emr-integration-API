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
        Schema::create('ranap_cppt_alih_rawat_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cppt_ranap_id');
            $table->foreignId('user_id')->nullable();
            $table->string('ttd_user')->nullable();
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
        Schema::dropIfExists('ranap_cppt_alih_rawat_patients');
    }
};
