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
        Schema::create('ranap_mpp_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('room_detail_id')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->string('kelas_rawatan')->nullable();
            $table->string('tindakan')->nullable();
            $table->string('diagnosa')->nullable();
            $table->integer('total_skor_minor')->nullable();
            $table->integer('total_skor_major')->nullable();
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
        Schema::dropIfExists('ranap_mpp_patients');
    }
};
