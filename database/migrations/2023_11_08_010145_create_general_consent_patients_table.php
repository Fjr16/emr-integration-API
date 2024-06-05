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
        Schema::create('general_consent_patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id');
            $table->foreignId('rawat_inap_patient_id');
            $table->string('name')->nullable();
            $table->date('tgl_lhr')->nullable();
            $table->string('kelamin')->nullable();
            $table->string('alamat')->nullable();
            $table->string('phone')->nullable();
            $table->string('hubungan')->nullable();
            $table->string('dpjp')->nullable();
            $table->string('kebutuhan_privasi1')->nullable();
            $table->string('kebutuhan_privasi2')->nullable();
            $table->string('kebutuhan_privasi3')->nullable();
            $table->text('kebutuhan_privasi_khusus')->nullable();
            $table->longText('harta_benda')->nullable();
            $table->string('persetujuan_pelepasan_informasi')->nullable();
            $table->longText('ttd')->nullable();
            $table->longText('ttd_admisi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_consent_patients');
    }
};
