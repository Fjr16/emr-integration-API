<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuSehatPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'no_rm',
        'nama_pasien',
        'tgl_lhr',
        'nik',
        'tanggal_pelayanan',
        'kode_dpjp',
        'sip',
        'nama_dpjp',
        'poliklinik',
        'anamnesa',
        'kesadaran',
        'tinggi_badan',
        'berat_badan',
        'nadi',
        'tekanan_darah',
        'suhu',
        'nafas',
        'kode_diagnosa_utama',
        'nama_diagnosa_utama',
        'diagnosa_sekunder',
        'kode_prosedur',
        'nama_prosedur',
        'radiologi',
        'laboratorium',
        'tindakan',
        'resep_obat',
        'intruksi_pulang',
        'keadaan_keluar',
        'cara_keluar',
    ];
}
