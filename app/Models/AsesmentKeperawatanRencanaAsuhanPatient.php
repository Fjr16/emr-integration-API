<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmentKeperawatanRencanaAsuhanPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosis_keperawatan_patient_id',
        'ttddpjp',
        'namadpjp',
        'ttdppja',
        'namappja',
        'tanggal',
    ];

    public function diagnosisKeperawatanPatient()
    {
        return $this->belongsTo(DiagnosisKeperawatanPatient::class);
    }

    public function detailMasalahDiagnosisKeperawatanPatient()
    {
        return $this->hasOne(DetailMasalahDiagnosisKeperawatanPatient::class);
    }
}
