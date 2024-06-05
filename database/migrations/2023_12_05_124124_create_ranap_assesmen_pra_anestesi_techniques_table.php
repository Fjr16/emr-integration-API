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
        Schema::create('ranap_assesmen_pra_anestesi_techniques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_assesmen_pra_anesthesia_id')->nullable();
            $table->string('name')->nullable();
            $table->string('value')->nullable();
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
        Schema::dropIfExists('ranap_assesmen_pra_anestesi_techniques');
    }
};
