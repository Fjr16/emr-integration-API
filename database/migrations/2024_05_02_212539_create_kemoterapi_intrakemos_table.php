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
        Schema::create('kemoterapi_intrakemos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kemoterapi_monitoring_tindakan_patient_id');
            $table->string('td')->nullable();
            $table->string('nadi')->nullable();
            $table->string('rr')->nullable();
            $table->string('suhu')->nullable();
            $table->string('nama_perawat')->nullable();
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
        Schema::dropIfExists('kemoterapi_intrakemos');
    }
};
