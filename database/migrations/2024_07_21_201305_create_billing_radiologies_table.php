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
        Schema::create('billing_radiologies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kasir_patient_id')->required();
            $table->foreignId('action_id')->nullable();
            $table->foreignId('patient_category_id')->nullable();
            $table->string('kode_tindakan', 50)->required();
            $table->string('nama_tindakan', 100)->required();
            $table->integer('jumlah')->default(1);
            $table->decimal('tarif', 10, 2)->default(0);
            $table->decimal('sub_total', 10, 2)->default(0);
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
        Schema::dropIfExists('billing_radiologies');
    }
};
