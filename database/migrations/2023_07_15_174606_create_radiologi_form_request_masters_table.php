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
        Schema::create('radiologi_form_request_masters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('radiologi_form_request_master_category_id')->nullable();
            $table->string('name')->nullable();
            $table->string('input_type')->nullable();
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
        Schema::dropIfExists('radiologi_form_request_masters');
    }
};
