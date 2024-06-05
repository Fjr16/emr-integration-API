<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HubunganDiagnosaAwalPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'diagnosis_keperawatan_patient_id',
        'detail_diagnosis_keperawatan_patient_id',
        'diagnosa',
        'name',
        'detail_name',
    ];

    public function detailDiagnosisKeperawatanPatient()
    {
        return $this->belongsTo(DetailDiagnosisKeperawatanPatient::class);
    }
}
