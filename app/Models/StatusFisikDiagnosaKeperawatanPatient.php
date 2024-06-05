<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusFisikDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'asesment_keperawatan_status_fisik_patient_id',
        'diagnosis_keperawatan_patient_id',
        'darah',
        'nadi',
        'suhu',
        'pernafasan',
        'tb',
        'bb',
    ];

    public function diagnosisKeperawatanPatient(){
        return $this->belongsTo(DiagnosisKeperawatanPatient::class);
    }

    public function detailStatusFisikDiagnosaKeperawatanPatient(){
        return $this->hasMany(DetailStatusFisikDiagnosaKeperawatanPatient::class);
    }

    public function asesmentKeperawatanStatusFisikPatient(){
        return $this->belongsTo(AsesmentKeperawatanStatusFisikPatient::class);
    }
}
