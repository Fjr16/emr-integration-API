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
        Schema::create('ranap_assesmen_pra_sedation_anestesi_instructions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranap_assesmen_pra_sedation_id')->nullable();
            $table->string('puasa')->nullable();
            $table->boolean('obat_diberikan')->nullable();
            $table->text('obat_diberhentikan')->nullable();
            $table->boolean('persiapan_darah')->nullable();
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
        Schema::dropIfExists('ranap_assesmen_pra_sedation_anestesi_instructions');
    }
};
