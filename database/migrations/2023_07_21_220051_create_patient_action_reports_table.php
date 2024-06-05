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
        Schema::create('patient_action_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->string('diagnosa')->nullable();
            $table->text('laporan_tindakan')->nullable();
            $table->text('intruksi')->nullable();
            $table->string('tgl_tindakan')->nullable();
            $table->string('lokasi')->nullable();
            $table->foreignId('rawat_jalan_poli_patient_id')->nullable();
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
        Schema::dropIfExists('patient_action_reports');
    }
};
