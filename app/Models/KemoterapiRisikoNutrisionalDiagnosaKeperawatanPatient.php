<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiRisikoNutrisionalDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_diagnosis_keperawatan_patient_id',
        'kemoterapi_asesment_keperawatan_skrining_resiko_jatuh_patient_id',
        'diagnosa',
    ];

    public function kemoterapidiagnosisKeperawatanPatient()
    {
        return $this->belongsTo(KemoterapiDiagnosisKeperawatanPatient::class);
    }

    public function kemoterapidetailRisikoNutrisionalDiagnosaKeperawatanPatient()
    {
        return $this->hasMany(KemoterapiDetailRisikoNutrisionalDiagnosaKeperawatanPatient::class);
    }

    public function kemoterapiasesmentKeperawatanSkriningResikoJatuhPatient()
    {
        return $this->belongsTo(KemoterapiAsesmentKeperawatanSkriningResikoJatuhPatient::class);
    }
}
