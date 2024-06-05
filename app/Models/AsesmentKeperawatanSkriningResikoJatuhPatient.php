<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmentKeperawatanSkriningResikoJatuhPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosis_keperawatan_patient_id'
    ];

    public function diagnosisKeperawatanPatient()
    {
        return $this->belongsTo(DiagnosisKeperawatanPatient::class);
    }

    public function resikoRajalDiagnosaKeperawatanPatient()
    {
        return $this->hasOne(ResikoRajalDiagnosaKeperawatanPatient::class);
    }

    public function asesmentStatusFungsionalDiagnosaKeperawatanPatient()
    {
        return $this->hasOne(AsesmentStatusFungsionalDiagnosaKeperawatanPatient::class);
    }

    public function risikoNutrisionalDiagnosaKeperawatanPatient()
    {
        return $this->hasOne(RisikoNutrisionalDiagnosaKeperawatanPatient::class);
    }

    public function skriningAsesmenResikoJatuhRanap()
    {
        return $this->hasOne(SkriningAsesmenResikoJatuhRanap::class);
    }
}
