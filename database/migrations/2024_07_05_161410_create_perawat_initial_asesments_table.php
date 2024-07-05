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
        Schema::create('perawat_initial_asesments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('queue_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->text('keluhan_utama')->nullable();
            $table->text('riw_penyakit_pasien')->nullable();
            $table->text('riw_penyakit_keluarga')->nullable();
            $table->text('alergi_makanan')->nullable();
            $table->text('alergi_obat')->nullable();
            $table->integer('skor_ass_gizi_1')->nullable();
            $table->integer('skor_ass_gizi_2')->nullable();
            $table->string('kondisi_gizi', 20)->nullable();
            $table->float('nadi')->nullable();
            $table->float('td_sistolik')->nullable();
            $table->float('td_diastolik')->nullable();
            $table->float('suhu')->nullable();
            $table->integer('nafas')->nullable();
            $table->string('keadaan_umum', 20)->nullable();
            $table->string('kesadaran', 100)->nullable();
            $table->float('tb')->nullable();
            $table->float('bb')->nullable();
            $table->float('lk')->nullable();
            $table->integer('skor_nyeri')->nullable();
            $table->string('stts_ekonomi')->nullable();
            $table->boolean('resiko_jatuh_a')->default(false);
            $table->boolean('resiko_jatuh_b')->nullable(false);
            $table->string('resiko_jatuh_result', 100)->nullable();
            $table->string('ttd')->nullable();
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
        Schema::dropIfExists('perawat_initial_asesments');
    }
};
