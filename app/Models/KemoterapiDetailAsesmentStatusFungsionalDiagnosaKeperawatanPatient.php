<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiDetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $table = 'kemoterapi_detail_asesment_status_fungsional_diagnosa';
    protected $fillable = [
        'kemoterapi_asesment_status_fungsional_diagnosa_patient_id',
        'name',
        'nilai',
    ];

    public function kemoterapiasesmentStatusFungsionalDiagnosaKeperawatanPatient()
    {
        return $this->belongsTo(KemoterapiAsesmentStatusFungsionalDiagnosaKeperawatanPatient::class);
    }
}
