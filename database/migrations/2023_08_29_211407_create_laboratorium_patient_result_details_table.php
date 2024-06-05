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
        Schema::create('laboratorium_patient_result_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratorium_patient_result_id')->nullable();
            $table->foreignId('laboratorium_request_master_variable_id')->nullable();
            $table->string('value')->nullable();
            $table->boolean('kondisi_kritis')->default(false);
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
        Schema::dropIfExists('laboratorium_patient_result_details');
    }
};
