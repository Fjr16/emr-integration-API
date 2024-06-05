<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiResikoRajalDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_diagnosis_keperawatan_patient_id',
        'kemoterapi_asesment_keperawatan_skrining_resiko_jatuh_patient_id',
        'a',
        'b',
    ];

    public function kemoterapidiagnosisKeperawatanPatient(){
        return $this->belongsTo(KemoterapiDiagnosisKeperawatanPatient::class);
    }
    
    public function kemoterapiidetailResikoRajalDiagnosaKeperawatanPatient(){
        return $this->hasMany(KemoterapiDetailResikoRajalDiagnosaKeperawatanPatient::class);
    }
    
    public function kemoterapiasesmentKeperawatanSkriningResikoJatuhPatient(){
        return $this->belongsTo(KemoterapiAsesmentKeperawatanSkriningResikoJatuhPatient::class);
    }
}
