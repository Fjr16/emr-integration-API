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
        Schema::create('rme_cppts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('queue_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->text('subjective')->nullable();
            $table->text('objective')->nullable();
            $table->text('asesment')->nullable();
            $table->text('planning')->nullable();
            $table->string('ttd_user')->nullable();
            $table->string('ttd_dpjp')->nullable();
            $table->dateTime('tanggal_verif_dpjp')->nullable();
            $table->enum('category_soap', ['PERAWAT', 'DPJP', 'OTHER'])->default('PERAWAT');
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
        Schema::dropIfExists('rme_cppts');
    }
};
