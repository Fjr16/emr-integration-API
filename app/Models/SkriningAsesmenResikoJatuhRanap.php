<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkriningAsesmenResikoJatuhRanap extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosis_keperawatan_patient_id',
        'asesment_keperawatan_skrining_resiko_jatuh_patient_id',
        'usia',
        'skor',
        'kategori',
        'status',
        'tanggal',
        'name',
        'ttd',
    ];

    public function diagnosisKeperawatanPatient()
    {
        return $this->belongsTo(DiagnosisKeperawatanPatient::class);
    }

    public function asesmentKeperawatanSkriningResikoJatuhPatient()
    {
        return $this->belongsTo(AsesmentKeperawatanSkriningResikoJatuhPatient::class);
    }
}
