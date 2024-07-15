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
        Schema::create('konsul_internals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('queue_id');
            $table->foreignId('user_id');
            $table->foreignId('dokter_konsul_id');
            $table->text('permintaan_konsul')->nullable();
            $table->text('jawaban_konsul')->nullable();
            $table->string('ttd_user')->nullable();
            $table->string('ttd_dokter_konsul')->nullable();
            $table->enum('status', ['WAITING', 'ACCEPTED', 'FINISHED'])->default('WAITING');
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
        Schema::dropIfExists('konsul_internals');
    }
};
