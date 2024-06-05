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
        Schema::create('ranap_assesmen_pra_sedation_nafas_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_assesmen_pra_sedation_id')->nullable();
            $table->boolean('bebas')->nullable();
            $table->string('buka_mulut')->nullable();
            $table->string('malampathy')->nullable();
            $table->string('jarak_mentohyoid')->nullable();
            $table->string('leher')->nullable();
            $table->string('gerak_leher')->nullable();
            $table->boolean('gigi_palsu')->nullable();
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
        Schema::dropIfExists('ranap_assesmen_pra_sedation_nafas_evaluations');
    }
};
