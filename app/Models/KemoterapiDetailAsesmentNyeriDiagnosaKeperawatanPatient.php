<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiDetailAsesmentNyeriDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_asesment_nyeri_diagnosa_keperawatan_patient_id',
        'name',
    ];

    public function kemoterapiasesmentNyeriDiagnosaKeperawatanPatient()
    {
        return $this->belongsTo(KemoterapiAsesmentNyeriDiagnosaKeperawatanPatient::class);
    }
}
