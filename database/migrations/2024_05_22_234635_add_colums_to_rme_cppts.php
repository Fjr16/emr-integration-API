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
        Schema::table('rme_cppts', function (Blueprint $table) {
            $table->string('ttd_user')->nullable();
            $table->string('ttd_dpjp')->nullable();
            $table->dateTime('tanggal_dpjp')->nullable();
            $table->boolean('serah_terima')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rme_cppts', function (Blueprint $table) {
            $table->dropColumn('ttd_user');
            $table->dropColumn('ttd_dpjp');
            $table->dropColumn('tanggal_dpjp');
            $table->dropColumn('serah_terima');
        });
    }
};
