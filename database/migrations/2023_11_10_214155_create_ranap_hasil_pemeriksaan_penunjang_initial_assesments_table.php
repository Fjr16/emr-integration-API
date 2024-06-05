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
        Schema::create('ranap_hasil_pemeriksaan_penunjang_initial_assesments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_initial_assesment_id')->nullable();
            $table->text('name')->nullable();
            $table->text('hasil')->nullable();
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
        Schema::dropIfExists('ranap_hasil_pemeriksaan_penunjang_initial_assesments');
    }
};
