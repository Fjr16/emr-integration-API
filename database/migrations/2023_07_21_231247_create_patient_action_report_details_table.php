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
        Schema::create('patient_action_report_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_action_report_id')->nullable();
            $table->foreignId('action_id')->nullable();
            $table->integer('jumlah')->default(1);
            $table->integer('harga_satuan')->nullable();
            $table->integer('sub_total')->nullable();
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
        Schema::dropIfExists('patient_action_report_details');
    }
};
