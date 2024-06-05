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
        Schema::create('ranap_persetujuan_tindakan_anestesi_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable(); //dokter pelaksana tindakan
            $table->string('petugas')->nullable();
            $table->string('name')->nullable();
            $table->string('umur')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('alamat')->nullable();
            $table->string('jenis_anestesi')->nullable();
            $table->string('hubungan')->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->string('ttdKet1')->nullable();
            $table->string('ttdKet2')->nullable();
            $table->string('ttdPenerimaInformasi')->nullable();
            $table->string('hub1')->nullable();
            $table->string('ttdHub1')->nullable();
            $table->string('hub2')->nullable();
            $table->string('namaHub1')->nullable();
            $table->string('ttdHub2')->nullable();
            $table->string('namaHub2')->nullable();
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
        Schema::dropIfExists('ranap_persetujuan_tindakan_anestesi_patients');
    }
};
