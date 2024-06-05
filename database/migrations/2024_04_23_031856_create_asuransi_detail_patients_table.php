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
        Schema::create('asuransi_detail_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('asuransi_patient_id');
            $table->string('category');
            $table->string('name');
            $table->date('masuk');
            $table->date('keluar');
            $table->double('total');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asuransi_detail_patients');
    }
};
