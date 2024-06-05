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
        Schema::create('kemoterapi_diagnosis_keperawatan_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('patient_id');
            $table->foreignId('queue_id');
            $table->string('no_rm');
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
        Schema::dropIfExists('kemoterapi_diagnosis_keperawatan_patients');
    }
};
