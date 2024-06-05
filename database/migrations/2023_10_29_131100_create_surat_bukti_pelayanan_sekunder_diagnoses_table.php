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
        Schema::create('surat_bukti_pelayanan_sekunder_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_bukti_pelayanan_patient_id');
            $table->string('diganosa_name')->nullable();
            $table->string('diagnosa_icdx')->nullable();
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
        Schema::dropIfExists('surat_bukti_pelayanan_sekunder_diagnoses');
    }
};
