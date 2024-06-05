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
        Schema::create('ranap_assesmen_pra_sedations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->dateTime('tanggal_operasi')->nullable();
            $table->string('dokter_anestesi')->nullable();
            $table->string('dokter_bedah')->nullable();
            $table->dateTime('tanggal_pemeriksaan')->nullable();
            $table->string ('diagnosis')->nullable();
            $table->string('rencana_operasi')->nullable();
            $table->string('anamnesa')->nullable();
            $table->boolean('is_konsumsi')->nullable();
            $table->time('makan_terakhir')->nullable();
            $table->time('minum_terakhir')->nullable();
            $table->text('riwayat_alergi')->nullable();
            $table->text('hasil_pemeriksaan_lain')->nullable();
            $table->text('penyulit')->nullable();
            $table->string('asa')->nullable();
            $table->text('antisipasi')->nullable();
            $table->string('is_can_operasi')->nullable();
            $table->string('rencana_sedasi')->nullable();
            $table->string('pasca_anestesi')->nullable();
            $table->text('obat_analgesia')->nullable();
            $table->string('ttd_dpjp_anestesi')->nullable();
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
        Schema::dropIfExists('ranap_assesmen_pra_sedations');
    }
};
