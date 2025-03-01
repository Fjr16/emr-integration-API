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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('name')->nullable();
            $table->string('telp')->nullable();
            $table->text('alamat')->nullable();
            // $table->string('kuota')->nullable();
            $table->foreignId('specialist_id')->nullable();
            $table->foreignId('poli_id')->nullable();
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
        Schema::dropIfExists('doctors');
    }
};
