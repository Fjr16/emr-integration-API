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
        Schema::create('ranap_medicine_receipt_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_medicine_receipt_id')->nullable();
            $table->foreignId('medicine_id')->nullable();
            $table->integer('jumlah')->nullable();
            $table->text('aturan_pakai')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('other')->nullable();
            $table->enum('category', ['Selama Rawatan', 'Pulang'])->nullable();
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
        Schema::dropIfExists('ranap_medicine_receipt_details');
    }
};
