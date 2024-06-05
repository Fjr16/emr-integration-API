<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiAsesmentNyeriDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_diagnosis_keperawatan_patient_id',
        'kemoterapi_asesment_keperawatan_status_fisik_patient_id',
        'status',
        'category',
        'provocation',
        'quality',
        'region',
        'severity',
        'time',
    ];

    public function kemoterapidetailAsesmentNyeriDiagnosaKeperawatanPatient(){
        return $this->hasMany(KemoterapiDetailAsesmentNyeriDiagnosaKeperawatanPatient::class);
    }

    public function kemoterapidiagnosisKeperawatanPatient(){
        return $this->belongsTo(KemoterapiDiagnosisKeperawatanPatient::class);
    }

    public function kemoterapiasesmentKeperawatanStatusFisikPatient(){
        return $this->belongsTo(KemoterapiAsesmentKeperawatanStatusFisikPatient::class);
    }
}
