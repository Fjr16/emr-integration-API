<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiDetailRencanaDiagnosisKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'diagnosa',
        'kemoterapi_diagnosis_keperawatan_patient_id',
    ];

    public function kemoterapidiagnosisKeperawatanPatient(){
        return $this->belongsTo(KemoterapiDiagnosisKeperawatanPatient::class);
    }
}
