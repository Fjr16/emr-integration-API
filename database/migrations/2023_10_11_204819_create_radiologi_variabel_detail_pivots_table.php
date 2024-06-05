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
        Schema::create('radiologi_variabel_detail_pivots', function (Blueprint $table) {
            $table->foreignId('radiologi_form_request_master_id');
            $table->foreignId('radiologi_form_request_master_detail_id');
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
        Schema::dropIfExists('radiologi_variabel_detail_pivots');
    }
};
