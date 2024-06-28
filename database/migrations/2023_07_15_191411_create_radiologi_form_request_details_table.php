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
        Schema::create('radiologi_form_request_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('radiologi_form_request_id')->nullable();
            $table->foreignId('action_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->dateTime('tanggal_periksa')->nullable();
            $table->text('hasil')->nullable();
            $table->string('image', 100)->nullable();
            $table->enum('status', ['WAITING', 'UNVALIDATE', 'VALIDATE'])->default('WAITING');
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
        Schema::dropIfExists('radiologi_form_request_details');
    }
};
