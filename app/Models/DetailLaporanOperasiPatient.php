<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailLaporanOperasiPatient extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'laporan_operasi_patient_id',
        'name',
    ];

    public function laporanOperasiPatient()
    {
        return $this->belongsTo(LaporanOperasiPatient::class);
    }
}
