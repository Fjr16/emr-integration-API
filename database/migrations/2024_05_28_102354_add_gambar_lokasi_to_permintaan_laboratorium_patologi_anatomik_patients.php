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
        Schema::table('permintaan_laboratorium_patologi_anatomik_patients', function (Blueprint $table) {
            $table->string('gambarLokasiMuka')->nullable()->after('keteranganKlinik');
            $table->string('gambarLokasiLeher')->nullable()->after('gambarLokasiMuka');
            $table->string('gambarLokasiDada')->nullable()->after('gambarLokasiLeher');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permintaan_laboratorium_patologi_anatomik_patients', function (Blueprint $table) {
            //
        });
    }
};
