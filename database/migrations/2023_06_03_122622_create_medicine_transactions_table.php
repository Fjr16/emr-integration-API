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
            $table->integer('jumlah')->default(0);
            $table->string('satuan', 50)->nullable();
            $table->integer('harga')->default(0);
            $table->integer('total_harga')->default(0);
            $table->string('no_batch', 100)->nullable();
            $table->date('production_date')->nullable();
            $table->date('exp_date')->nullable();
            $table->integer('pajak')->default(0); //rupiah
            $table->integer('diskon')->default(0); //rupiah
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
