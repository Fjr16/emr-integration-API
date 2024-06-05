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
        Schema::create('asuransi_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('no');
            $table->string('lamp');
            $table->string('hal');
            $table->string('name');
            $table->string('periode');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asuransi_patients');
    }
};
