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
        Schema::create('igd_triage_checkups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('igd_triage_scale_id')->nullable();
            $table->foreignId('igd_triage_category_checkup_id')->nullable();
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
        Schema::dropIfExists('igd_triage_checkups');
    }
};
