<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatAlergiDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'diagnosis_keperawatan_patient_id',
        'asesment_keperawatan_status_fisik_patient_id',
        'status',
        'alergi',
        'reaksi',
    ];

    public function diagnosisKeperawatanPatient(){
        return $this->belongsTo(DiagnosisKeperawatanPatient::class);
    }

    public function asesmentKeperawatanStatusFisikPatient(){
        return $this->belongsTo(AsesmentKeperawatanStatusFisikPatient::class);
    }
}
