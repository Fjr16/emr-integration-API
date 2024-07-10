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
        Schema::create('diagnostic_procedure_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('queue_id');
            $table->foreignId('diagnostic_id')->nullable();
            $table->text('desc_diagnosa_primer')->nullable();
            $table->text('desc_diagnosa_sekunder')->nullable();
            $table->foreignId('procedure_id')->nullable();
            $table->text('desc_prosedure')->nullable();
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
        Schema::dropIfExists('diagnostic_procedure_patients');
    }
};
