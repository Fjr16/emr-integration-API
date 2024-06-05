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
        Schema::create('rajal_cppt_sbar_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rme_cppt_id')->nullable();
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
        Schema::dropIfExists('rajal_cppt_sbar_patients');
    }
};
