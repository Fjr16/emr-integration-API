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
        Schema::create('medicine_receipt_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_receipt_id');
            $table->foreignId('medicine_id')->nullable();
            $table->string('nama_obat_custom')->nullable();
            $table->string('satuan_obat_custom')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('aturan_pakai')->nullable();
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
        Schema::dropIfExists('medicine_receipt_details');
    }
};
