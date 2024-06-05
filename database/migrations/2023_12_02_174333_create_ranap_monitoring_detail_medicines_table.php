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
        Schema::create('ranap_monitoring_detail_medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_monitoring_medicine_id')->nullable();
            $table->foreignId('user_id')->nullable(); //get inisial perawat dari tabel user
            $table->date('tanggal')->nullable();
            $table->time('jam')->nullable();
            // $table->string('inisial_perawat')->nullable();
            $table->string('jumlah')->nullable();
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
        Schema::dropIfExists('ranap_monitoring_detail_medicines');
    }
};
