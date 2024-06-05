<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDiagnosisKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'diagnosis_keperawatan_patient_id',
        'asesment_keperawatan_diagnosis_keperawatan_patient_id',
        'diagnosa',
    ];

    public function diagnosisKeperawatanPatient()
    {
        return $this->belongsTo(DiagnosisKeperawatanPatient::class);
    }

    public function hubunganDiagnosaAwalPatient()
    {
        return $this->hasMany(HubunganDiagnosaAwalPatient::class);
    }

    public function asesmentKeperawatanDiagnosisKeperawatanPatient()
    {
        return $this->belongsTo(AsesmentKeperawatanDiagnosisKeperawatanPatient::class);
    }
}
