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
        Schema::create('bukti_diagnosa_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('asuhan_keperawatan_id');
            $table->string('diagnosa');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bukti_diagnosa_patients');
    }
};
