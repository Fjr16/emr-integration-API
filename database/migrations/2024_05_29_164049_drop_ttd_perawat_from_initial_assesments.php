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
        Schema::table('initial_assesments', function (Blueprint $table) {
            $table->dropColumn('nm_perawat');
            $table->dropColumn('ttd_perawat');
            $table->string('ttd_pasien')->nullable();
            $table->string('nm_pasien')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('initial_assesments', function (Blueprint $table) {
            //
        });
    }
};
