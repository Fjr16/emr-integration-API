<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiDetailDiagnosisKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_diagnosis_keperawatan_patient_id',
        'kemoterapi_asesment_keperawatan_diagnosis_keperawatan_patient_id',
        'diagnosa',
    ];

    public function kemoterapikemoterapidiagnosisKeperawatanPatient()
    {
        return $this->belongsTo(KemoterapiDiagnosisKeperawatanPatient::class);
    }

    public function kemoterapihubunganDiagnosaAwalPatient()
    {
        return $this->hasMany(KemoterapiHubunganDiagnosaAwalPatient::class);
    }

    public function kemoterapiasesmentKeperawatanDiagnosisKeperawatanPatient()
    {
        return $this->belongsTo(KemoterapiAsesmentKeperawatanDiagnosisKeperawatanPatient::class);
    }
}
