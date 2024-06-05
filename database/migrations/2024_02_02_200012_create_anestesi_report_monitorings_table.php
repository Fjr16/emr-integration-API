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
        Schema::create('anestesi_report_monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anestesi_report_id')->nullable();
            $table->string('jenis_pemantauan')->nullable();
            $table->string('pemantauan')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('nilai')->default(0);
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
        Schema::dropIfExists('anestesi_report_monitorings');
    }
};
