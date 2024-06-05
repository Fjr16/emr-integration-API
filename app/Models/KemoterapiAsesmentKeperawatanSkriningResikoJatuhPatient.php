<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiAsesmentKeperawatanSkriningResikoJatuhPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_diagnosis_keperawatan_patient_id'
    ];

    public function kemoterapidiagnosisKeperawatanPatient()
    {
        return $this->belongsTo(KemoterapiDiagnosisKeperawatanPatient::class);
    }

    public function kemoterapiresikoRajalDiagnosaKeperawatanPatient()
    {
        return $this->hasOne(KemoterapiResikoRajalDiagnosaKeperawatanPatient::class);
    }

    public function kemoterapiasesmentStatusFungsionalDiagnosaKeperawatanPatient()
    {
        return $this->hasOne(KemoterapiAsesmentStatusFungsionalDiagnosaKeperawatanPatient::class);
    }

    public function kemoterapirisikoNutrisionalDiagnosaKeperawatanPatient()
    {
        return $this->hasOne(KemoterapiRisikoNutrisionalDiagnosaKeperawatanPatient::class);
    }

    public function kemoterapiskriningAsesmenResikoJatuhRanap()
    {
        return $this->hasOne(KemoterapiSkriningAsesmenResikoJatuh::class);
    }
}
