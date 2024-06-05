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
        Schema::create('ranap_rencana_pemulangan_pasien_initial_assesments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_initial_assesment_id')->nullable();
            $table->string('name')->nullable();
            $table->boolean('isYes')->default(false);
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
        Schema::dropIfExists('ranap_rencana_pemulangan_pasien_initial_assesments');
    }
};
