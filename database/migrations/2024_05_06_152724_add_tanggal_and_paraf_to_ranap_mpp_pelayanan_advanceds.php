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
        Schema::table('ranap_mpp_pelayanan_advanceds', function (Blueprint $table) {
            $table->dateTime('tanggal')->nullable();
            $table->text('paraf')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ranap_mpp_pelayanan_advanceds', function (Blueprint $table) {
            //
        });
    }
};
