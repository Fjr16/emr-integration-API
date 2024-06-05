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
        Schema::create('kemoterapi_regimens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kemoterapi_prekemo_id')->nullable();
            $table->foreignId('kemoterapi_intrakemo_id')->nullable();
            $table->foreignId('kemoterapi_postkemo_id')->nullable();
            $table->time('jam_mulai')->nullable();
            $table->string('name')->nullable();
            $table->string('keterangan')->nullable();
            $table->time('jam_selesai')->nullable();
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
        Schema::dropIfExists('kemoterapi_regimens');
    }
};
