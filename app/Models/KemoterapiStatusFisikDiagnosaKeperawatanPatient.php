<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiStatusFisikDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_asesment_keperawatan_status_fisik_patient_id',
        'kemoterapi_diagnosis_keperawatan_patient_id',
        'darah',
        'nadi',
        'suhu',
        'pernafasan',
        'tb',
        'bb',
        'luas_permukaan_badan',
        'imt',
    ];

    public function kemoterapidiagnosisKeperawatanPatient(){
        return $this->belongsTo(KemoterapiDiagnosisKeperawatanPatient::class);
    }

    public function kemoterapidetailStatusFisikDiagnosaKeperawatanPatient(){
        return $this->hasMany(KemoterapiDetailStatusFisikDiagnosaKeperawatanPatient::class);
    }

    public function kemoterapiasesmentKeperawatanStatusFisikPatient(){
        return $this->belongsTo(KemoterapiAsesmentKeperawatanStatusFisikPatient::class);
    }
}
