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
        Schema::table('igd_triages', function (Blueprint $table) {
            $table->foreignId('igd_patient_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('igd_triages', function (Blueprint $table) {
            
            $table->dropColumn('igd_patient_id');
        });
    }
};
