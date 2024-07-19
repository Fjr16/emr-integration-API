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
        Schema::create('medicine_distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('unit_asal_id')->nullable();
            $table->foreignId('unit_tujuan_id')->nullable();
            $table->string('no_distribusi')->nullable();
            $table->string('message')->nullable();
            $table->string('tanggal')->nullable();
            $table->enum('status', ['SUCCESS', 'CANCEL', 'FAILED'])->default('SUCCESS');
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
        Schema::dropIfExists('medicine_distributions');
    }
};
