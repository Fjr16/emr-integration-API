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
        Schema::create('detail_administrasi_catatan_perjalanan_kemoterapi_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('administrasi_cacatan_perjalanan_kemoterapi_patient_id');
            $table->string('name');
            $table->string('value');
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
        Schema::dropIfExists('detail_administrasi_catatan_perjalanan_kemoterapi_patients');
    }
};
