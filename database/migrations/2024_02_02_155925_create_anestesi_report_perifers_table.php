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
        Schema::create('anestesi_report_perifers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anestesi_report_id')->nullable();
            $table->longText('jenis')->nullable();
            $table->text('lokasi')->nullable();
            $table->string('jenis_jarum')->nullable();
            $table->boolean('kateter')->nullable();
            $table->string('kateter_fiksasi')->nullable();
            $table->longText('obat')->nullable();
            $table->longText('komplikasi')->nullable();
            $table->string('hasil')->nullable();
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
        Schema::dropIfExists('anestesi_report_perifers');
    }
};
