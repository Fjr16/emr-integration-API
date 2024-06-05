<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmentKeperawatanDiagnosisKeperawatanPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosis_keperawatan_patient_id'
    ];

    public function diagnosisKeperawatanPatient(){
        return $this->belongsTo(DiagnosisKeperawatanPatient::class);
    }

    public function detailDiagnosisKeperawatanPatient(){
        return $this->hasOne(DetailDiagnosisKeperawatanPatient::class);
    }

    public function detailMasalahDiagnosisKeperawatanPatient(){
        return $this->hasOne(DetailMasalahDiagnosisKeperawatanPatient::class);
    }
}
