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
        Schema::table('surat_bukti_pelayanan_patient_details', function (Blueprint $table) {
            $table->string('poliklinik')->nullable();
            $table->string('tdt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_bukti_pelayanan_patient_details', function (Blueprint $table) {
            //
        });
    }
};
