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
        Schema::create('surgery_rates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('surgery_id')->nullable();
            $table->foreignId('surgery_category_id')->nullable();
            $table->foreignId('patient_category_id')->nullable();
            $table->integer('vip')->nullable();
            $table->integer('vvip')->nullable();
            $table->integer('kelas1')->nullable();
            $table->integer('kelas2')->nullable();
            $table->integer('kelas3')->nullable();
            $table->integer('lokal')->nullable();
            $table->integer('kemoterapi')->nullable();
            $table->integer('onedaycare')->nullable();
            $table->integer('utama')->nullable();
            $table->integer('hcu')->nullable();
            $table->integer('ruang_isolasi')->nullable();
            $table->integer('bedah_minor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surgery_rates');
    }
};
