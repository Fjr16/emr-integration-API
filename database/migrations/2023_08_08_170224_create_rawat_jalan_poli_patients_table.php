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
        Schema::create('rawat_jalan_poli_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('queue_id')->nullable();
            $table->text('diet')->nullable();
            $table->text('intruksi')->nullable();
            $table->string('cara_keluar', 50)->nullable();
            $table->string('keadaan_keluar', 50)->nullable();
            $table->enum('status', ['WAITING', 'ONGOING', 'FINISHED'])->default('WAITING');
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
        Schema::dropIfExists('rawat_jalan_poli_patients');
    }
};
