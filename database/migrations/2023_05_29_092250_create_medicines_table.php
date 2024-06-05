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
            $table->foreignId('unit_conversion_master_id')->nullable();
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
