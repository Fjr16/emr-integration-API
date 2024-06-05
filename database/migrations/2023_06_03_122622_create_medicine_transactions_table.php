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
        Schema::create('medicine_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->nullable();
            $table->foreignId('unit_id')->nullable();
            $table->foreignId('medicine_id')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('satuan')->nullable();
            $table->string('harga')->nullable();
            $table->string('total_harga')->nullable();
            $table->string('no_batch')->nullable();
            $table->string('production_date')->nullable();
            $table->string('exp_date')->nullable();
            $table->string('pajak')->nullable(); //rupiah
            $table->string('diskon')->nullable(); //rupiah
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
        Schema::dropIfExists('medicine_transactions');
    }
};
