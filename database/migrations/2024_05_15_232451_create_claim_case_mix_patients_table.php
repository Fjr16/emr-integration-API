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
        Schema::create('claim_case_mix_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreignId('queue_id')->nullable();
            $table->string('nomor_kartu');
            $table->string('nomor_sep')->nullable();
            $table->string('nomor_rm')->nullable();
            $table->string('nama_pasien');
            $table->timestamp('tgl_lahir');
            $table->string('gender');
            $table->foreignId('admission_id');
            $table->foreignId('hospital_admission_id');
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
        Schema::dropIfExists('claim_case_mix_patients');
    }
};
