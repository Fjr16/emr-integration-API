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
            $table->string('nm_dokter')->nullable();
            $table->string('nm_perawat')->nullable();
            $table->text('ttd_dokter')->nullable();
            $table->text('ttd_perawat')->nullable();
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
