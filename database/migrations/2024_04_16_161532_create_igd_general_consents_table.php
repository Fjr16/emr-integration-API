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
        Schema::create('igd_general_consents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('igd_patient_id');
            $table->foreignId('patient_id');
            $table->string('name')->nullable();
            $table->date('tgl_lhr')->nullable();
            $table->string('kelamin')->nullable();
            $table->string('alamat')->nullable();
            $table->string('phone')->nullable();
            $table->string('hubungan')->nullable();
            $table->string('kebutuhan_privasi1')->nullable();
            $table->string('kebutuhan_privasi2')->nullable();
            $table->text('kebutuhan_privasi_khusus')->nullable();
            $table->longText('harta_benda')->nullable();
            $table->string('persetujuan_pelepasan_informasi')->nullable();
            $table->longText('ttd')->nullable();
            $table->longText('ttd_admisi')->nullable();
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
        Schema::dropIfExists('igd_general_consents');
    }
};
