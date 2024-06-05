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
        Schema::create('cppt_kemoterapis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kemoterapi_patient_id');
            $table->foreignId('user_id');
            $table->foreignId('patient_id');
            $table->text('soap')->nullable();
            $table->text('intruksi')->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->string('tipe_cppt')->nullable(); //esbar, non esbar, reguler
            $table->string('ttd_user')->nullable();
            $table->string('ttd_dpjp')->nullable();
            $table->integer('id_dpjp')->nullable(); //untuk parameter where
            $table->dateTime('tanggal_dpjp')->nullable();
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
        Schema::dropIfExists('cppt_kemoterapis');
    }
};
