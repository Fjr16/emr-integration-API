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
        Schema::create('rawat_inap_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('queue_id');
            $table->foreignId('patient_id')->nullable();
            // $table->foreignId('user_id')->nullable();
            $table->foreignId('surat_pengantar_rawat_jalan_patient_id');
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rawat_inap_patients');
    }
};