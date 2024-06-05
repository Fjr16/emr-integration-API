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
        Schema::create('ranap_assesmen_pra_anestesi_inductions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_assesmen_pra_anesthesia_id')->nullable();
            $table->string('keluhan')->nullable();
            $table->string('kesadaran')->nullable();
            $table->bigInteger('td')->nullable();
            $table->bigInteger('hr')->nullable();
            $table->bigInteger('rr')->nullable();
            $table->bigInteger('temperature')->nullable();
            $table->bigInteger('saturasi')->nullable();
            $table->text('lainnya')->nullable();
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
        Schema::dropIfExists('ranap_assesmen_pra_anestesi_inductions');
    }
};
