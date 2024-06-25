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
        Schema::create('radiologi_form_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('queue_id')->nullable();
            $table->foreignId('room_detail_id')->nullable();
            $table->string('diagnosa_klinis', 50)->nullable();
            $table->text('catatan')->nullable();
            $table->string('ttd_dokter', 100)->nullable();
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
        Schema::dropIfExists('radiologi_form_requests');
    }
};
