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
            $table->foreignId('user_id')->nullable();//dokter_id
            $table->string('day', 10)->nullable();
            $table->time('start_at')->nullable();
            $table->time('ends_at')->nullable();
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
