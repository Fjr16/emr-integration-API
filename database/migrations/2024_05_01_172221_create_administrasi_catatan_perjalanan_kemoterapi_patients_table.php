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
        Schema::create('administrasi_catatan_perjalanan_kemoterapi_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catatan_perjalan_kemoterapi_patient_id');
            $table->string('category');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('administrasi_catatan_perjalanan_kemoterapi_patients');
    }
};
