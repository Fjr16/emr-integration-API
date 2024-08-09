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
            $table->string('no_rm', 50)->unique()->required();
            $table->bigInteger('noka')->unique()->nullable();
            $table->string('name', 50)->nullable();
            $table->string('tempat_lhr', 100)->nullable();
            $table->date('tanggal_lhr')->nullable();
            $table->enum('jenis_kelamin', ['Pria', 'Wanita'])->nullable();
            $table->string('telp', 20)->nullable();
            $table->string('agama', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->integer('rw')->nullable();
            $table->integer('rt')->nullable();
            $table->string('pendidikan', 30)->nullable();
            $table->string('status', 20)->nullable();
            $table->string('nm_ayah', 50)->nullable();
            $table->string('nm_ibu', 50)->nullable();
            $table->string('nm_wali', 50)->nullable();
            $table->bigInteger('nik')->required();
            $table->text('alergi_makanan')->nullable();
            $table->text('alergi_obat')->nullable();
            $table->string('suku', 50)->nullable();
            $table->string('bangsa', 50)->nullable();
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
