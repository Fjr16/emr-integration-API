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
        Schema::create('rajal_farmasi_obat_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rajal_farmasi_patient_id')->nullable();
            $table->foreignId('medicine_id')->nullable();
            $table->foreignId('medicine_stok_id')->nullable();
            $table->foreignId('unit_id')->nullable();
            $table->string('nama_obat', 100)->nullable();
            $table->string('satuan_obat', 50)->nullable();
            $table->text('aturan_pakai')->nullable();
            $table->integer('harga_satuan')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('sub_total')->nullable();
            $table->boolean('ditanggung_asuransi')->default(false);
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
        Schema::dropIfExists('rajal_farmasi_obat_details');
    }
};
