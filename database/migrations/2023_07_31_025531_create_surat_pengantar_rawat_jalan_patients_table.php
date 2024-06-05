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
        Schema::create('surat_pengantar_rawat_jalan_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreignId('queue_id');
            $table->foreignId('user_id');
            $table->string('primer');
            $table->string('alat');
            $table->string('ruangan');
            $table->dateTime('tgl_operasi');
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
        Schema::dropIfExists('surat_pengantar_rawat_jalan_patients');
    }
};
