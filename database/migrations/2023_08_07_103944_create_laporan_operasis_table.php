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
        Schema::create('laporan_operasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->string('nama_ahli_bedah')->nullable();
            $table->string('asisten_bedah')->nullable();
            $table->string('nama_ahli_anestesi')->nullable();
            $table->string('jenis_anestesi')->nullable();
            $table->string('tingkatan_operasi')->nullable();
            $table->string('diagnosis_pra_operasi')->nullable();
            $table->string('diagnosis_pasca_operasi')->nullable();
            $table->string('nama_operasi')->nullable();
            $table->string('komplikasi')->nullable();
            $table->string('spesimen_operasi_pemeriksaan_pa')->nullable();
            $table->string('jumlah_pendarahan')->nullable();
            $table->string('jumlah_darah_ditransfusi')->nullable();
            $table->date('tanggal')->nullable();
            $table->time('jam_dimulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->string('lama_operasi')->nullable();
            $table->text('prosedur_operasi')->nullable();
            $table->string('nomor_implan')->nullable();
            $table->text('instruksi_ruangan')->nullable();
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
        Schema::dropIfExists('laporan_operasis');
    }
};
