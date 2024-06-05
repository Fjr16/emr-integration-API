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
        Schema::create('surat_keterangan_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_bukti_pelayanan_patient_id');
            $table->foreignId('queue_id');
            $table->foreignId('patient_id');
            $table->string('diagnosa')->nullable();
            $table->string('terapi')->nullable();
            $table->date('tgl_surat_rujukan');
            $table->string('fasilitas_rujukan')->nullable();
            $table->string('fasilitas_rujukan_lainnya')->nullable();
            $table->string('tindak_lanjut')->nullable();
            $table->string('tindak_lanjut_lainnya')->nullable();
            $table->date('tgl_kunjungan');
            $table->string('nomor_antrian');
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
        Schema::dropIfExists('surat_keterangan_patients');
    }
};
