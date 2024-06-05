<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapJawabanKonsulPenyakitDalamPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_permintaan_konsul_penyakit_dalam_patient_id',
        'user_id',
        'ket_pasien',
        'kesimpulan',
        'anjuran',
        'tanggal',
    ];


    public function ranapPermintaanKonsulPenyakitDalamPatient()
    {
        return $this->belongsTo(RanapPermintaanKonsulPenyakitDalamPatient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
