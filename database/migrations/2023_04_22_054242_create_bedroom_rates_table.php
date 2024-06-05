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
        Schema::create('bedroom_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bed_id')->nullable();
            $table->foreignId('patient_category_id')->nullable();
            $table->string('rawatan')->nullable();
            $table->string('tindakan')->nullable();
            $table->string('adm')->nullable();
            $table->string('visite')->nullable();
            $table->string('labor')->nullable();
            $table->string('bhp')->nullable();
            $table->string('coshering')->nullable();
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
        Schema::dropIfExists('bedroom_rates');
    }
};
