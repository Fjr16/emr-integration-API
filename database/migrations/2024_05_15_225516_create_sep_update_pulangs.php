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
        Schema::create('sep_update_pulangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_seps');
            $table->string('no_sep', 100);
            $table->integer('kd_status_pulang');
            $table->string('status_pulang', 100);
            $table->string('no_surat_meninggal', 100)->nullable();
            $table->date('tgl_meninggal')->nullable();
            $table->date('tgl_pulang');
            $table->string('no_lp_manual', 100)->nullable();
            $table->string('user', 100);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_seps')
                ->references('id')
                ->on('seps')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Indexes
            $table->index('no_sep');
            $table->index('kd_status_pulang');
            $table->index('status_pulang');
            $table->index('tgl_pulang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sep_update_pulangs');
    }
};