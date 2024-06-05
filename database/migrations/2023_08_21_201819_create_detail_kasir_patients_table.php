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
        Schema::create('detail_kasir_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('kasir_patient_id');
            $table->string('name');
            $table->string('tanggal');
            $table->string('category');
            $table->string('jumlah');
            $table->string('tarif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_kasir_patients');
    }
};
