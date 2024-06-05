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
        Schema::create('laboratorium_request_master_variables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratorium_request_category_master_id')->nullable();
            $table->string('name')->nullable();
            $table->string('icd_code')->nullable();
            $table->integer('tarif_umum')->nullable();
            $table->integer('tarif_uc')->nullable();
            $table->boolean('isActive')->default(true);
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
        Schema::dropIfExists('laboratorium_request_master_variables');
    }
};
