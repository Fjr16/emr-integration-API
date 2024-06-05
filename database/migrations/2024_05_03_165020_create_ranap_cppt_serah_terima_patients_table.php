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
        Schema::create('ranap_cppt_serah_terima_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cppt_ranap_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('ttd')->nullable();
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
        Schema::dropIfExists('ranap_cppt_serah_terima_patients');
    }
};
