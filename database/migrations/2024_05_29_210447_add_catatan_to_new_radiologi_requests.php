<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_radiologi_requests', function (Blueprint $table) {
            $table->text('catatan')->nullable()->after('diagnosa_klinis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_radiologi_requests', function (Blueprint $table) {
            //
        });
    }
};
