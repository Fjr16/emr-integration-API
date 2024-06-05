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
        Schema::create('medicine_stoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->nullable();
            $table->foreignId('medicine_id')->nullable();
            $table->string('stok')->nullable();
            $table->string('base_harga')->nullable();
            $table->string('diskon_satuan')->nullable();
            $table->string('pajak_satuan')->nullable();
            $table->string('no_batch')->nullable();
            $table->string('production_date')->nullable();
            $table->string('exp_date')->nullable();
            $table->string('satuan')->nullable();
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
        Schema::dropIfExists('medicine_stoks');
    }
};
