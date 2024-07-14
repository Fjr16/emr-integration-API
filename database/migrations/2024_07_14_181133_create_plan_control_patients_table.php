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
        Schema::create('plan_control_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('queue_id');
            $table->foreignId('user_id');
            $table->date('tgl_kontrol');
            $table->string('ttd')->nullable();
            $table->enum('status', ['WAITING', 'FINISHED'])->default('WAITING');
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
        Schema::dropIfExists('plan_control_patients');
    }
};
