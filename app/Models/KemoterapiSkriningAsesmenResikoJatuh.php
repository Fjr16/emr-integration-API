<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiSkriningAsesmenResikoJatuh extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_diagnosis_keperawatan_patient_id',
        'kemoterapi_asesment_keperawatan_skrining_resiko_jatuh_patient_id',
        'usia',
        'skor',
        'kategori',
        'status',
        'tanggal',
        'name',
        'ttd',
    ];

    public function kemoterapidiagnosisKeperawatanPatient()
    {
        return $this->belongsTo(KemoterapiDiagnosisKeperawatanPatient::class);
    }

    public function kemoterapiasesmentKeperawatanSkriningResikoJatuhPatient()
    {
        return $this->belongsTo(KemoterapiAsesmentKeperawatanSkriningResikoJatuhPatient::class);
    }
}
