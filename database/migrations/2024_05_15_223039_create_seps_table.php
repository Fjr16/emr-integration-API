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
        Schema::create('seps', function (Blueprint $table) {
            $table->id();
            $table->string('no_sep', 100);
            $table->string('noka', 100);
            $table->string('nik', 20)->nullable();
            $table->string('nama_peserta', 200);
            $table->date('tgl_lahir_peserta');
            $table->string('jenis_kelamin', 10);
            $table->string('jenis_peserta', 100);
            $table->date('tgl_sep');
            $table->string('kode_ppk_pelayanan', 20);
            $table->string('ppk_pelayanan', 200)->nullable();
            $table->unsignedBigInteger('kd_jns_pelayanan');
            $table->string('jns_pelayanan', 50);
            $table->unsignedBigInteger('kd_kls_rawat_hak');
            $table->string('kls_rawat_hak', 50);
            $table->unsignedBigInteger('kd_kls_rawat_naik')->nullable();
            $table->string('kls_rawat_naik', 50)->nullable();
            $table->integer('kd_kls_rawat_pembiayaan')->nullable();
            $table->string('kls_rawat_pembiayaan', 100)->nullable();
            $table->string('kls_rawat_penanggung_jawab', 200)->nullable();
            $table->string('no_mr', 20);
            $table->unsignedBigInteger('kd_asal_rujukan');
            $table->string('asal_rujukan', 20);
            $table->date('tgl_rujukan')->nullable();
            $table->string('no_rujukan', 50)->nullable();
            $table->string('kd_ppk_rujukan', 20)->nullable();
            $table->string('ppk_rujukan', 100)->nullable();
            $table->text('catatan')->nullable();
            $table->string('kd_diag_awal', 20);
            $table->string('diag_awal', 255);
            $table->string('kode_poli_tujuan', 100)->nullable();
            $table->string('poli_tujuan', 200)->nullable();
            $table->boolean('poli_eksekutif')->default(0);
            $table->boolean('cob')->default(0);
            $table->boolean('katarak')->default(0);
            $table->unsignedBigInteger('kd_laka_lantas')->default(0);
            $table->string('laka_lantas', 100)->nullable();
            $table->integer('kd_penjamin')->nullable();
            $table->string('penjamin', 50)->nullable();
            $table->string('no_lp', 100)->nullable();
            $table->date('tgl_kejadian_laka')->nullable();
            $table->text('keterangan_laka')->nullable();
            $table->boolean('suplesi')->default(0);
            $table->string('no_sep_suplesi', 100)->nullable();
            $table->string('kd_provinsi_laka', 20)->nullable();
            $table->string('provinsi_laka', 100)->nullable();
            $table->string('kd_kab_laka', 20)->nullable();
            $table->string('kabupaten_laka', 100)->nullable();
            $table->string('kd_kec_laka', 20)->nullable();
            $table->string('kecamatan_laka', 100)->nullable();
            $table->integer('kd_tujuan_kunj');
            $table->string('tujuan_kunj', 20);
            $table->integer('kd_flag_procedur')->nullable();
            $table->string('flag_procedur', 100)->nullable();
            $table->integer('kd_penunjang')->nullable();
            $table->string('nama_penunjang', 50)->nullable();
            $table->integer('kd_assessment_pel')->nullable();
            $table->string('assessment_pel', 100)->nullable();
            $table->string('no_skdp', 50)->nullable();
            $table->string('kd_skdp_dpjp', 20)->nullable();
            $table->string('skd_dpjp', 100)->nullable();
            $table->string('kd_dpjp_layanan', 20)->nullable();
            $table->string('dpjp_layanan', 100)->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->string('user_create', 100);
            $table->string('sumber_sep', 100)->nullable();
            $table->timestamps();

            // Indexes
            $table->index('no_sep');
            $table->index('noka');
            $table->index('nama_peserta');
            $table->index('tgl_sep');
            $table->index('no_mr');
            $table->index('kd_diag_awal');
            $table->index('diag_awal');
            $table->index('kode_poli_tujuan');
            $table->index('poli_tujuan');
            $table->index('sumber_sep');
            $table->index('kd_dpjp_layanan');
            $table->index('dpjp_layanan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seps');
    }
};