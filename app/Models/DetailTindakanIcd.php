<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTindakanIcd extends Model
{
    use HasFactory;
    protected $fillable = [
        'tindakan_icd_id',
        'diagnosis_patient_id',
        'tindakan_patient_id',
    ];

    public function tindakanIcd(){
        return $this->belongsTo(TindakanIcd::class);
    }

    public function diagnosisPatientId(){
        return $this->belongsTo(DiagnosisPatient::class, 'diagnosis_patient_id', 'id');
    }

    public function tindakanPatientId(){
        return $this->belongsTo(TindakanPatient::class, 'tindakan_patient_id', 'id');
    }
}
