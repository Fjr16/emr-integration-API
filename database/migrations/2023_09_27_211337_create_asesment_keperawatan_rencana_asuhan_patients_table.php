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
        Schema::create('asesment_keperawatan_rencana_asuhan_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diagnosis_keperawatan_patient_id');
            $table->string('ttddpjp')->nullable();
            $table->string('namadpjp')->nullable();
            $table->string('ttdppja')->nullable();
            $table->string('namappja')->nullable();
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
        Schema::dropIfExists('asesment_keperawatan_rencana_asuhan_patients');
    }
};
