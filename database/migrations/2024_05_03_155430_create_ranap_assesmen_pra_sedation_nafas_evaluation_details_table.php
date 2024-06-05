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
        Schema::create('ranap_assesmen_pra_sedation_nafas_evaluation_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_assesmen_pra_sedation_nafas_evaluation_id');
            $table->string('keterangan');
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
        Schema::dropIfExists('ranap_assesmen_pra_sedation_nafas_evaluation_details');
    }
};
