<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiAsesmentStatusFungsionalDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $table = 'kemoterapi_asesment_status_fungsional_diagnosa_keperawata';
    protected $fillable = [
        'kemoterapi_diagnosis_keperawatan_patient_id',
        'kemoterapi_asesment_keperawatan_skrining_resiko_jatuh_patient_id'
    ];

    public function kemoterapidiagnosisKeperawatanPatient(){
        return $this->belongsTo(KemoterapiDiagnosisKeperawatanPatient::class);
    }

    public function kemoterapidetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient(){
        return $this->hasMany(KemoterapiDetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient::class);
    }

    public function kemoterapiasesmentKeperawatanSkriningResikoJatuhPatient(){
        return $this->belongsTo(KemoterapiAsesmentKeperawatanSkriningResikoJatuhPatient::class);
    }
}
