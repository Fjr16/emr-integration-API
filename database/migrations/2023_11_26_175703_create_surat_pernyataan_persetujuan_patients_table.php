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
        Schema::create('surat_pernyataan_persetujuan_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('umur')->nullable();
            $table->text('alamat')->nullable();
            $table->string('hubungan')->nullable();
            $table->longText('ctt_khusus')->nullable();
            $table->string('paraf')->nullable();
            $table->string('header')->nullable();
            $table->string('jaminan')->nullable();
            $table->string('dariKelas')->nullable();
            $table->string('keKelas')->nullable();
            $table->boolean('statusAdm')->nullable();
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
        Schema::dropIfExists('surat_pernyataan_persetujuan_patients');
    }
};
