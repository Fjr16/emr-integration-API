<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiAsesmentKeperawatanDiagnosisKeperawatanPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'kemoterapi_diagnosis_keperawatan_patient_id'
    ];

    public function kemoterapidiagnosisKeperawatanPatient(){
        return $this->belongsTo(KemoterapiDiagnosisKeperawatanPatient::class);
    }

    public function kemoterapidetailDiagnosisKeperawatanPatient(){
        return $this->hasOne(KemoterapiDetailDiagnosisKeperawatanPatient::class);
    }

    public function kemoterapidetailMasalahDiagnosisKeperawatanPatient(){
        return $this->hasOne(KemoterapiDetailMasalahDiagnosisKeperawatan::class);
    }
}
