<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiEkonomiDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_diagnosis_keperawatan_patient_id',
        'kemoterapi_asesment_keperawatan_status_fisik_patient_id',
        'status',
        'hambatan',
    ];

    public function kemoterapidiagnosisKeperawatanPatient(){
        return $this->belongsTo(KemoterapiDiagnosisKeperawatanPatient::class);
    }

    public function kemoterapiasesmentKeperawatanStatusFisikPatient(){
        return $this->belongsTo(KemoterapiAsesmentKeperawatanStatusFisikPatient::class);
    }
}
