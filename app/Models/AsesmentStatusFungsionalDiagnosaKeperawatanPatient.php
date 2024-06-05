<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmentStatusFungsionalDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'diagnosis_keperawatan_patient_id',
        'asesment_keperawatan_skrining_resiko_jatuh_patient_id'
    ];

    public function diagnosisKeperawatanPatient(){
        return $this->belongsTo(DiagnosisKeperawatanPatient::class);
    }

    public function detailAsesmentStatusFungsionalDiagnosaKeperawatanPatient(){
        return $this->hasMany(DetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient::class);
    }

    public function asesmentKeperawatanSkriningResikoJatuhPatient(){
        return $this->belongsTo(AsesmentKeperawatanSkriningResikoJatuhPatient::class);
    }
}
