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
            $table->foreignId('medicine_receipt_id')->nullable();
            $table->foreignId('medicine_id')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('aturan_pakai')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('medicine_receipt_details');
    }
};
