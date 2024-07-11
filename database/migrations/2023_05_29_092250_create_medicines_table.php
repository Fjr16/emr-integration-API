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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_type_id')->nullable();
            $table->foreignId('medicine_category_id')->nullable();
            $table->foreignId('medicine_form_id')->nullable();
            $table->string('kode')->nullable();
            $table->string('name')->nullable();
            $table->string('small_unit')->nullable();
            $table->integer('small_to_medium')->nullable();
            $table->string('medium_unit')->nullable();
            $table->integer('medium_to_big')->nullable();
            $table->string('big_unit')->nullable();
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
        Schema::dropIfExists('medicines');
    }
};
