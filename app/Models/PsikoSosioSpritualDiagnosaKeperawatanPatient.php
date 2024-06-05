<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsikoSosioSpritualDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [        
        'diagnosis_keperawatan_patient_id',
        'asesment_keperawatan_status_fisik_patient_id',
    ];

    public function diagnosisKeperawatanPatient(){
        return $this->belongsTo(DiagnosisKeperawatanPatient::class);
    }

    public function detailPsikoSosioSpritualDiagnosaKeperawatanPatient(){
        return $this->hasMany(DetailPsikoSosioSpritualDiagnosaKeperawatanPatient::class);
    }

    public function asesmentKeperawatanStatusFisikPatient(){
        return $this->belongsTo(AsesmentKeperawatanStatusFisikPatient::class);
    }
    
}