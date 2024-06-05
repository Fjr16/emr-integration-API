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
        Schema::create('surat_kontrols', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat', 100);
            $table->enum('jenis_surat', ['kontrol', 'spri']);
            $table->string('no_sep', 100)->nullable();
            $table->string('noka', 50);
            $table->date('tgl_kontrol');
            $table->string('kd_dokter', 20);
            $table->string('nama_dokter', 100);
            $table->string('kd_poli', 20);
            $table->string('poli_kontrol', 100);
            $table->string('nama_pasien', 100);
            $table->string('jns_kelamin', 10);
            $table->date('tgl_lahir');
            $table->string('kd_diagnosa', 50)->nullable();
            $table->string('diagnosa', 100)->nullable();
            $table->string('user', 100);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('no_sep')->references('no_sep')->on('seps')->onUpdate('cascade')->onDelete('cascade');

            // Indexes
            $table->index('no_surat');
            $table->index('no_sep');
            $table->index('noka');
            $table->index('kd_poli');
            $table->index('poli_kontrol');
            $table->index('kd_diagnosa');
            $table->index('diagnosa');
            $table->index('tgl_kontrol');
            $table->index('kd_dokter');
            $table->index('nama_dokter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_kontrols');
    }
};