<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapAsesMoniStatusFungsionalPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'user_id',
        'isPulang',
        'tanggal',
        'total_skor',
        'kategori_skor',
        'nama_perawat',
        'pelaksanaan_asesmen'
    ];

    public function rawatInapPatient()
    {
        return $this->belongsTo(RawatInapPatient::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ranapAsesMoniStatusFungsionalDetails()
    {
        return $this->hasMany(RanapAsesMoniStatusFungsionalDetail::class);
    }
}
