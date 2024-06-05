<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiDetailStatusFisikDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_status_fisik_diagnosa_keperawatan_patient_id',
        'category',
        'name',
    ];

    public function kemoterapistatusFisikDiagnosaKeperawatanPatient()
    {
        return $this->belongsTo(KemoterapiStatusFisikDiagnosaKeperawatanPatient::class);
    }
}
