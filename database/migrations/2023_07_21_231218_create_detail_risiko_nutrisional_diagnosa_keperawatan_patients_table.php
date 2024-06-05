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
        Schema::create('detail_risiko_nutrisional_diagnosa_keperawatan_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('risiko_nutrisional_diagnosa_keperawatan_patient_id');
            $table->string('name')->nullable();
            $table->string('category')->nullable();
            $table->string('nilai')->nullable();
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
        Schema::dropIfExists('detail_risiko_nutrisional_diagnosa_keperawatan_patients');
    }
};
