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
        Schema::create('detail_antrian_laboratorium_patologi_anatomi_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('antrian_laboratorium_patologi_anatomi_patient_id');
            $table->string('name');
            $table->string('status')->default('Unvalidate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_antrian_laboratorium_patologi_anatomi_patients');
    }
};
