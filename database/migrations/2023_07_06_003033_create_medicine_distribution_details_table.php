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
        Schema::create('medicine_distribution_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_distribution_id')->nullable();
            $table->foreignId('medicine_id')->nullable();
            $table->foreignId('medicine_stok_id')->nullable();
            $table->string('satuan')->nullable();
            $table->string('jumlah')->nullable();
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
        Schema::dropIfExists('medicine_distribution_details');
    }
};
