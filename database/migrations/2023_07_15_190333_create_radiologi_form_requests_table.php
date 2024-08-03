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
        Schema::create('radiologi_form_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('queue_id')->nullable();
            $table->string('diagnosa_klinis', 50)->nullable();
            $table->text('catatan')->nullable();
            $table->string('ttd_dokter', 100)->nullable();
            $table->dateTime('jadwal_periksa')->nullable();
            $table->string('no_reg_rad', 20)->nullable(); //format RAD/24/06/27/001
            $table->enum('status', ['WAITING', 'CANCEL', 'DENIED', 'ACCEPTED', 'ONGOING', 'FINISHED'])->default('WAITING');
            $table->foreignId('validator_rad_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radiologi_form_requests');
    }
};
