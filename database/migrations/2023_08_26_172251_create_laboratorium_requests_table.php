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
        Schema::create('laboratorium_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('queue_id')->nullable();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('room_detail_id')->nullable();
            $table->string('diagnosa', 50)->nullable();
            $table->text('catatan')->nullable();
            $table->string('ttd_dokter',100)->nullable();
            $table->string('tipe_permintaan', 20)->nullable();
            $table->date('tanggal_sampel')->nullable();
            $table->dateTime('jadwal_periksa')->nullable();
            $table->date('tanggal_periksa_selesai')->nullable();
            $table->string('no_reg', 20)->nullable();
            $table->enum('status', ['WAITING', 'CANCEL', 'DENIED', 'ACCEPTED', 'UNVALIDATE', 'FINISHED'])->default('WAITING');
            $table->foreignId('validator_id')->nullable();
            $table->foreignId('petugas_id')->nullable();
            $table->text('kesan_anjuran')->nullable();
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
        Schema::dropIfExists('laboratorium_requests');
    }
};
