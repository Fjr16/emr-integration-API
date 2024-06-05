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
        Schema::create('kemoterapi_medicine_receipt_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kemoterapi_medicine_receipt_id')->nullable();
            $table->foreignId('medicine_id')->nullable();
            $table->integer('jumlah')->nullable();
            $table->text('aturan_pakai')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('other')->nullable();
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
        Schema::dropIfExists('kemoterapi_medicine_receipt_details');
    }
};
