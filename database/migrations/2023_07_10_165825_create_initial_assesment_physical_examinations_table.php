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
        Schema::create('initial_assesment_physical_examinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('initial_assesment_id')->nullable();
            $table->string('name')->nullable();
            $table->string('isNormal')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('initial_assesment_physical_examinations');
    }
};
