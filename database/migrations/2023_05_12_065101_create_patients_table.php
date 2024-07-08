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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->nullable();
            $table->foreignId('province_id')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('village_id')->nullable();
            $table->unsignedBigInteger('no_rm')->unique();
            $table->string('noka')->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('tempat_lhr')->nullable();
            $table->string('tanggal_lhr')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('telp')->nullable();
            $table->string('agama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rw')->nullable();
            $table->string('rt')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('status')->nullable();
            $table->string('nm_ayah')->nullable();
            $table->string('nm_ibu')->nullable();
            $table->string('nm_wali')->nullable();
            $table->string('nik')->nullable();
            $table->text('alergi_makanan')->nullable();
            $table->text('alergi_obat')->nullable();
            $table->string('suku')->nullable();
            $table->string('bangsa')->nullable();
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
        Schema::dropIfExists('patients');
    }
};
