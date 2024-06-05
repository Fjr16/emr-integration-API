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
        Schema::table('ranap_ases_moni_status_fungsional_patients', function (Blueprint $table) {
            $table->string('pelaksanaan_asesmen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ranap_ases_moni_status_fungsional_patients', function (Blueprint $table) {
            //
        });
    }
};
