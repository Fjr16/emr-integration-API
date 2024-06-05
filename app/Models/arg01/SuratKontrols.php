<?php

namespace App\Models\arg01;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKontrols extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_surat',
        'jenis_surat',
        'no_sep',
        'noka',
        'tgl_kontrol',
        'kd_dokter',
        'nama_dokter',
        'kd_poli',
        'poli_kontrol',
        'nama_pasien',
        'jns_kelamin',
        'tgl_lahir',
        'kd_diagnosa',
        'diagnosa',
        'user',
    ];
}