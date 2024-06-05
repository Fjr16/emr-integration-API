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
        Schema::create('ranap_ases_moni_status_fungsional_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_ases_moni_status_fungsional_patient_id')->nullable();
            $table->text('name')->nullable();
            $table->integer('skor')->nullable();
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
        Schema::dropIfExists('ranap_ases_moni_status_fungsional_details');
    }
};
