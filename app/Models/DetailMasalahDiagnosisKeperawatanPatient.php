<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMasalahDiagnosisKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'diagnosis_keperawatan_patient_id',
        'asesment_keperawatan_diagnosis_keperawatan_patient_id',
        'diagnosa',
        // 'asesment_keperawatan_rencana_asuhan_patient_id',
    ];

    public function diagnosisKeperawatanPatient()
    {
        return $this->belongsTo(DiagnosisKeperawatanPatient::class);
    }

    public function asesmentKeperawatanDiagnosisKeperawatanPatient()
    {
        return $this->belongsTo(AsesmentKeperawatanDiagnosisKeperawatanPatient::class);
    }

    // public function asesmentKeperawatanRencanaAsuhanPatient(){
    //     return $this->belongsTo(AsesmentKeperawatanRencanaAsuhanPatient::class);
    // }
}
