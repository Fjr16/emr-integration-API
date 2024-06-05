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
        Schema::create('anestesi_report_airways', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anestesi_report_id')->nullable();
            $table->string('face_mask_no')->nullable();
            $table->string('ett_no')->nullable();
            $table->string('ett_jenis')->nullable();
            $table->string('lma_no')->nullable();
            $table->string('lma_jenis')->nullable();
            $table->string('trakheostomi_no')->nullable();
            $table->string('trakheostomi_jenis')->nullable();
            $table->string('glidescope_no')->nullable();
            $table->string('glidescope_fiksasi')->nullable();
            $table->text('other_airway')->nullable();
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
        Schema::dropIfExists('anestesi_report_airways');
    }
};
