<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiDetailMasalahDiagnosisKeperawatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_diagnosis_keperawatan_patient_id',
        'kemoterapi_asesment_keperawatan_diagnosis_keperawatan_patient_id',
        'diagnosa',
        // 'asesment_keperawatan_rencana_asuhan_patient_id',
    ];

    public function kemoterapidiagnosisKeperawatanPatient()
    {
        return $this->belongsTo(KemoterapiDiagnosisKeperawatanPatient::class);
    }

    public function kemoterapiasesmentKeperawatanDiagnosisKeperawatanPatient()
    {
        return $this->belongsTo(KemoterapiAsesmentKeperawatanDiagnosisKeperawatanPatient::class);
    }

}
