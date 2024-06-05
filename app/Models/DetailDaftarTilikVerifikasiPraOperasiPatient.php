<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDaftarTilikVerifikasiPraOperasiPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'daftar_tilik_verifikasi_pra_operasi_patient_id',
        'name',
        'category',
        'ri',
        'ok',
        'pacu',
    ];
}
