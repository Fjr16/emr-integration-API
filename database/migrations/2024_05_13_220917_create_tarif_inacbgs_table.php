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
        Schema::create('tarif_inacbgs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kasir_patient_id')->nullable();
            $table->foreignId('queue_id')->nullable();
            $table->foreignId('sep_id')->nullable();
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
        Schema::dropIfExists('tarif_inacbgs');
    }
};
