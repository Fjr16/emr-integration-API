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
        Schema::create('igd_triage_doas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('igd_triage_id')->nullable();
            $table->string('kehidupan')->nullable();
            $table->string('nadi')->nullable();
            $table->string('reflek')->nullable();
            $table->string('ekg')->nullable();
            $table->string('jam_doa')->nullable();
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
        Schema::dropIfExists('igd_triage_doas');
    }
};
