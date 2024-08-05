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
        Schema::create('laboratorium_request_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratorium_request_id')->nullable();
            $table->foreignId('action_id')->nullable();
            $table->string('keterangan')->nullable();
            $table->float('hasil')->default(0);
            $table->string('satuan', 50)->nullable();
            $table->boolean('kritis')->default(false);
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
        Schema::dropIfExists('laboratorium_request_details');
    }
};