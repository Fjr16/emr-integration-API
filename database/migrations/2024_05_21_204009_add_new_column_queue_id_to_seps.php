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
        Schema::table('seps', function (Blueprint $table) {
            $table->unsignedBigInteger('queue_id')->after('id');
            // $table->foreign('queue_id')->references('id')->on('queues')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seps', function (Blueprint $table) {
            $table->dropForeign(['queue_id']);
            $table->dropColumn('queue_id');
        });
    }
};