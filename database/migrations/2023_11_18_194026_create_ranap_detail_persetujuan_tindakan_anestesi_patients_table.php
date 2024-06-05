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
        Schema::create('ranap_detail_persetujuan_tindakan_anestesi_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_persetujuan_tindakan_anestesi_patient_id')->nullable();
            $table->string('jenis')->nullable();
            $table->string('isi')->nullable();
            $table->string('ttd')->nullable();
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
        Schema::dropIfExists('ranap_detail_persetujuan_tindakan_anestesi_patients');
    }
};
