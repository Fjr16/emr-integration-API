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
        Schema::table('laporan_operasi_patients', function (Blueprint $table) {
            $table->text('ttd_pasien')->nullable();
            $table->string('diJelaskan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan_operasi_patients', function (Blueprint $table) {
            //
        });
    }
};
