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
        Schema::create('kasir_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('queue_id')->nullable();
            $table->double('total')->default(0);
            $table->enum('status', ['WAITING', 'FINISHED'])->default('WAITING');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kasir_patients');
    }
};
