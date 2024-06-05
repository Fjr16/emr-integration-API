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
        Schema::create('anestesi_report_medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anestesi_report_id')->nullable();
            $table->string('nitrogen_oksida')->nullable();
            $table->string('oksigen')->nullable();
            $table->string('air')->nullable();
            $table->string('isof')->nullable();
            $table->string('sevo')->nullable();
            $table->string('des')->nullable();
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
        Schema::dropIfExists('anestesi_report_medicines');
    }
};
