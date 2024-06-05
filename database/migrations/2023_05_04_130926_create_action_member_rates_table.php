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
        Schema::create('action_member_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('action_members_id')->nullable();
            $table->foreignId('patient_category_id')->nullable();
            $table->string('tarif_umum')->nullable();
            $table->string('tarif_uc')->nullable();
            $table->string('jasa_dokter')->nullable();
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
        Schema::dropIfExists('action_member_rates');
    }
};
