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
        Schema::create('log_vclaims', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori', ['SEP', 'Rencana Kontrol', 'Rujukan', ''])->notNull();
            $table->string('no_surat', 100);
            $table->string('user', 100);
            $table->timestamps();

            // Indexes
            $table->index('kategori');
            $table->index('no_surat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_vclaims');
    }
};