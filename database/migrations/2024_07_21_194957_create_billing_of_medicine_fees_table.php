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
        Schema::create('billing_of_medicine_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kasir_patient_id')->nullable();
            $table->foreignId('rajal_farmasi_obat_detail_id')->nullable();
            $table->string('kode_obat', 50)->required();
            $table->string('nama_obat', 100)->required();
            $table->string('satuan_obat', 50)->required();
            $table->integer('jumlah')->default(1);
            $table->decimal('tarif', 10, 2)->default(0);
            $table->decimal('sub_total', 10, 2)->default(0);
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
        Schema::dropIfExists('billing_of_medicine_fees');
    }
};
