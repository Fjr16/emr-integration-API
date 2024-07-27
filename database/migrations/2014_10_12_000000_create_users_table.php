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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('nik')->nullable();
            $table->string('email')->unique();
            $table->string('ayah')->nullable();
            $table->string('ibu')->nullable(); 
            $table->string('gender')->nullable(); 
            $table->string('status_kawin')->nullable(); 
            $table->string('jumlah_anak')->nullable(); 
            $table->date('tgl_lahir')->nullable(); 
            $table->date('tgl_masuk')->nullable(); 
            $table->string('telp')->nullable(); 
            $table->string('nama_kontak_darurat')->nullable(); 
            $table->string('no_kontak_darurat')->nullable(); 
            $table->text('alamat_ktp')->nullable(); 
            $table->text('alamat_domisili')->nullable(); 
            $table->text('alamat_kontak_darurat')->nullable(); 
            $table->text('pendidikan')->nullable(); 
            $table->text('pengalaman')->nullable(); 
            $table->text('nama_rekening')->nullable(); 
            $table->text('no_rekening')->nullable(); 
            $table->text('catatan')->nullable(); 
            $table->string('staff_id')->nullable();
            $table->foreignId('unit_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->default('AKTIF');
            $table->boolean('isDokter')->default(false);
            $table->string('paraf')->nullable();
            $table->string('sip')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
