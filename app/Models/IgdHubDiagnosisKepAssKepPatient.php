<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdHubDiagnosisKepAssKepPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'igd_diagnosis_keperawatan_ass_kep_patient_id',
        'name',
    ];

    public function igdDiagnosisKeperawatanAssKepPatient(){
        return $this->belongsTo(IgdDiagnosisKeperawatanAssKepPatient::class);
    }
}
