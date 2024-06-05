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
        Schema::create('ranap_detail_karmobiditas_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_discharge_summary_id')->nullable();
            $table->text('karmobiditas')->nullable();
            $table->text('icd')->nullable();
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
        Schema::dropIfExists('ranap_detail_karmobiditas_patients');
    }
};
