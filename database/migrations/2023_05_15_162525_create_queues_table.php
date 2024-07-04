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
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('patient_category_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->enum('status_antrian', ['WAITING', 'CANCEL', 'ARRIVED', 'FINISHED'])->default('WAITING');
            $table->string('no_antrian')->nullable();
            $table->string('tgl_antrian')->nullable();
            $table->string('no_rujukan')->nullable();
            $table->string('last_diagnostic')->nullable();
            $table->string('category')->nullable();
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
        Schema::dropIfExists('queues');
    }
};
