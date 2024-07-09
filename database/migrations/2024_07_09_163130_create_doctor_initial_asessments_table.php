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
        Schema::create('doctor_initial_asessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('queue_id');
            $table->foreignId('patient_id');
            $table->foreignId('user_id');
            $table->text('keluhan_utama')->nullable();
            $table->string('keadaan_umum', 20)->nullable();
            $table->string('kesadaran', 100)->nullable();
            $table->float('tb')->nullable();
            $table->float('bb')->nullable();
            $table->float('nadi')->nullable();
            $table->float('td_sistolik')->nullable();
            $table->float('td_diastolik')->nullable();
            $table->float('suhu')->nullable();
            $table->integer('nafas')->nullable();
            $table->string('ttd')->nullable();
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
        Schema::dropIfExists('doctor_initial_asessments');
    }
};
