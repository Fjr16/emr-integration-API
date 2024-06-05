<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RisikoNutrisionalDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'diagnosis_keperawatan_patient_id',
        'asesment_keperawatan_skrining_resiko_jatuh_patient_id',
        'diagnosa',
    ];

    public function diagnosisKeperawatanPatient()
    {
        return $this->belongsTo(DiagnosisKeperawatanPatient::class);
    }

    public function detailRisikoNutrisionalDiagnosaKeperawatanPatient()
    {
        return $this->hasMany(DetailRisikoNutrisionalDiagnosaKeperawatanPatient::class);
    }

    public function asesmentKeperawatanSkriningResikoJatuhPatient()
    {
        return $this->belongsTo(AsesmentKeperawatanSkriningResikoJatuhPatient::class);
    }
}
