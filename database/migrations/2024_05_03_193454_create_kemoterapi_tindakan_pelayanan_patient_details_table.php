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
        Schema::create('kemoterapi_tindakan_pelayanan_patient_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kemoterapi_tindakan_pelayanan_patient_id')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('lab')->nullable();
            $table->foreignId('action_members_id')->nullable();
            $table->bigInteger('biaya_tindakan')->nullable();
            $table->string('ecg')->nullable();
            $table->string('tindakan')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->bigInteger('biaya_konsul')->nullable();
            $table->string('pa')->nullable();
            $table->string('oksigen')->nullable();
            $table->text('lain')->nullable();
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
        Schema::dropIfExists('kemoterapi_tindakan_pelayanan_patient_details');
    }
};
