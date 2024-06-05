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
            $table->foreignId('rajal_farmasi_obat_invoice_id')->nullable();
            $table->foreignId('medicine_id')->nullable();
            $table->foreignId('medicine_stok_id')->nullable();
            $table->foreignId('unit_id')->nullable();
            $table->foreignId('patient_category_id')->nullable();
            $table->string('harga_satuan')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('total_harga')->nullable();
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
