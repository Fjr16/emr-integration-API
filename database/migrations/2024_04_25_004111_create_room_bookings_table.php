
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
        Schema::create('room_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_inap_patient_id');
            $table->foreignId('bed_id');
            $table->dateTime('tanggal_masuk')->nullable();
            $table->dateTime('tanggal_selesai')->nullable();
            $table->enum('status', ['WAITING', 'SELESAI', 'BATAL'])->default('WAITING');
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
        Schema::dropIfExists('room_bookings');
    }
};
