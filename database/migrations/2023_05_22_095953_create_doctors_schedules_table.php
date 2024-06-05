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
        Schema::create('doctors_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            // $table->foreignId('room_detail_id')->nullable();
            // $table->string('kuota_jkn')->nullable();
            // $table->string('kuota_non_jkn')->nullable();
            $table->string('day')->nullable();
            $table->string('start_at')->nullable();
            $table->string('ends_at')->nullable();
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
        Schema::dropIfExists('doctors_schedules');
    }
};
