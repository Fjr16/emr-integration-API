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
        Schema::create('surat_bukti_pelayanan_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('queue_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->date('tanggal')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->time('jam_keluar')->nullable();
            $table->string('keterangan')->nullable();
            $table->text('anamnesa')->nullable();
            $table->text('konsultasi')->nullable();
            $table->text('usg')->nullable();
            $table->text('tindakan')->nullable();
            $table->text('rontgen')->nullable();
            $table->text('diagnosis_utama')->nullable();
            $table->string('icdx')->nullable();
            $table->text('tindakan_utama')->nullable();
            $table->string('icdg')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('surat_bukti_pelayanan_patients');
    }
};
