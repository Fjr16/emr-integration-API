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
        Schema::create('polikliniks', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 20)->nullable();
            $table->string('name', 50)->nullable();
            $table->string('kode_antrian', 10)->nullable();
            $table->boolean('isActive')->default(true);
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
        Schema::dropIfExists('polikliniks');
    }
};
