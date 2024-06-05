<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kemoterapi_persetujuan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kemoterapi_persetujuan_id')->nullable();
            $table->string('jenis')->nullable();
            $table->string('isi')->nullable();
            $table->longText('ttd')->nullable();
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
        Schema::dropIfExists('kemoterapi_persetujuan_details');
    }
};
