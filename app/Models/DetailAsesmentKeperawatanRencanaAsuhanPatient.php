<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAsesmentKeperawatanRencanaAsuhanPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosis_keperawatan_patient_id',
        'asesment_keperawatan_rencana_asuhan_patient_id',
        'name',
    ];

    public function diagnosisKeperawatanPatient()
    {
        return $this->belongsTo(DiagnosisKeperawatanPatient::class);
    }

    public function asesmentKeperawatanRencanaAsuhanPatient()
    {
        return $this->belongsTo(asesmentKeperawatanRencanaAsuhanPatient::class);
    }
}
