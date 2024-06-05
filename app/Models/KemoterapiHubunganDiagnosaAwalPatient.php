<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiHubunganDiagnosaAwalPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_diagnosis_keperawatan_patient_id',
        'kemoterapi_detail_diagnosis_keperawatan_patient_id',
        'diagnosa',
        'name',
    ];

    public function kemoterapidetailDiagnosisKeperawatanPatient()
    {
        return $this->belongsTo(KemoterapiDetailDiagnosisKeperawatanPatient::class);
    }
}
