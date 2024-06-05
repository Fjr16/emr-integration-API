<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kemoterapi_sbpk_sekunder_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kemoterapi_sbpk_patient_id')->nullable();
            $table->string('action_name')->nullable();
            $table->string('action_icdg')->nullable();
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
        Schema::dropIfExists('kemoterapi_sbpk_sekunder_actions');
    }
};
