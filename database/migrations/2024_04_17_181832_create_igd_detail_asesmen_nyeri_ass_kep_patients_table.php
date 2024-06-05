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
        Schema::create('igd_detail_asesmen_nyeri_ass_kep_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('igd_asesmen_nyeri_ass_kep_patient_id');
            $table->string('name');
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
        Schema::dropIfExists('igd_detail_asesmen_nyeri_ass_kep_patients');
    }
};
