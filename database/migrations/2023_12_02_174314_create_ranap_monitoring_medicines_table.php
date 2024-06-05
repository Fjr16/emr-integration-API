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
        Schema::create('ranap_monitoring_medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->string('jenis_obat')->nullable();
            $table->string('name')->nullable();
            $table->string('dosis')->nullable();
            $table->string('frekuensi')->nullable();
            $table->string('rute')->nullable();
            $table->string('nama_dokter')->nullable();
            $table->string('ttd_dokter')->nullable();
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
        Schema::dropIfExists('ranap_monitoring_medicines');
    }
};
