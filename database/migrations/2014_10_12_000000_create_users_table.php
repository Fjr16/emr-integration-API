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
            $table->foreignId('unit_id')->nullable();
            $table->foreignId('poliklinik_id')->nullable();
            $table->string('name', 100)->nullable();
            $table->bigInteger('nik')->nullable();
            $table->string('email', 50)->unique();
            $table->string('ayah', 50)->nullable();
            $table->string('ibu', 50)->nullable(); 
            $table->enum('gender', ['Pria', 'Wanita'])->nullable(); 
            $table->string('status_kawin', 20)->nullable(); 
            $table->integer('jumlah_anak')->default(0); 
            $table->date('tgl_lahir')->nullable(); 
            $table->date('tgl_masuk')->nullable(); 
            $table->string('telp', 20)->nullable(); 
            $table->string('nama_kontak_darurat', 50)->nullable(); 
            $table->string('no_kontak_darurat', 20)->nullable(); 
            $table->text('alamat_ktp')->nullable(); 
            $table->text('alamat_domisili')->nullable(); 
            $table->text('alamat_kontak_darurat')->nullable(); 
            $table->string('pendidikan', 30)->nullable(); 
            $table->text('pengalaman')->nullable(); 
            $table->string('nama_rekening', 30)->nullable(); 
            $table->bigInteger('no_rekening')->default(0); 
            $table->text('catatan')->nullable(); 
            $table->string('staff_id', 20)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('status', ['AKTIF', 'TIDAK AKTIF'])->default('AKTIF');
            $table->boolean('isDokter')->default(false);
            $table->string('paraf')->nullable();
            $table->string('sip', 50)->nullable();
            $table->decimal('tarif', 10,2)->default(0);
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
