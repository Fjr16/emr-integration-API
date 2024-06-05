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
        Schema::create('anestesi_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('queue_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->string('nama_penata_anestesi')->nullable();
            $table->string('ttd_penata_anestesi')->nullable();
            $table->string('nama_dokter_anestesi')->nullable();
            $table->string('ttd_dokter_anestesi')->nullable();
            // infus perifer
            $table->longText('perifer_first')->nullable();
            $table->longText('perifer_second')->nullable();
            $table->longText('perifer_cvc')->nullable();
            // posisi
            $table->string('posisi')->nullable();
            // perlindungan mata
            $table->string('perlindungan_mata')->nullable();
            // premedikasi
            $table->longText('pre_oral')->nullable();
            $table->longText('pre_im')->nullable();
            $table->longText('pre_iv')->nullable();
            // induksi
            $table->longText('induksi_intravena')->nullable();
            $table->longText('induksi_inhalasi')->nullable();
            // pembiusan dan pembedahan
            $table->integer('lama_pembiusan_jam')->nullable();
            $table->integer('lama_pembiusan_menit')->nullable();
            $table->integer('lama_pembedahan_jam')->nullable();
            $table->integer('lama_pembedahan_menit')->nullable();
            // keterangan anestesi
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('anestesi_reports');
    }
};
