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
        Schema::create('ranap_mpp_problem_risk_chances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_mpp_patient_id')->nullable();
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('ranap_mpp_problem_risk_chances');
    }
};
