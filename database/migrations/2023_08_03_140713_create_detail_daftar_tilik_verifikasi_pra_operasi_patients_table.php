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
        Schema::create('detail_daftar_tilik_verifikasi_pra_operasi_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daftar_tilik_verifikasi_pra_operasi_patient_id');
            $table->string('name');
            $table->string('category');
            $table->string('ri')->nullable();
            $table->string('ok')->nullable();
            $table->string('pacu')->nullable();
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
        Schema::dropIfExists('detail_daftar_tilik_verifikasi_pra_operasi_patients');
    }
};
