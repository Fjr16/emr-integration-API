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
        Schema::create('terapi_surat_pengantar_rawat_jalan_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_pengantar_rawat_jalan_patient_id');
            $table->string('name');
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
        Schema::dropIfExists('terapi_surat_pengantar_rawat_jalan_patients');
    }
};
