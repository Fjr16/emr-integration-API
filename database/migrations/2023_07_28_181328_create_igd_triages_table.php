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
        Schema::create('igd_triages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('tanggal_masuk')->nullable();
            $table->string('jam_respon')->nullable();
            $table->string('jalan_nafas')->nullable();
            $table->string('pernapasan')->nullable();
            $table->string('sirkulasi')->nullable();
            $table->string('disabilitas')->nullable();
            $table->string('lain')->nullable();
            $table->string('cara_masuk')->nullable();
            $table->string('asal_masuk')->nullable();
            $table->string('jenis_kasus')->nullable();
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
        Schema::dropIfExists('igd_triages');
    }
};
