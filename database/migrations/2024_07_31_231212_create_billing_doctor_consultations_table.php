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
        Schema::create('billing_doctor_consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kasir_patient_id')->required();
            $table->foreignId('user_id')->required();
            $table->string('kode_dokter', 50)->nullable();
            $table->string('nama_dokter', 50)->nullable();
            $table->string('nama_poli', 50)->nullable();
            $table->decimal('tarif', 10, 2)->default(0);
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
        Schema::dropIfExists('billing_doctor_consultations');
    }
};
