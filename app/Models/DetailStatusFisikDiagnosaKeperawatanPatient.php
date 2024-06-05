<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailStatusFisikDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'status_fisik_diagnosa_keperawatan_patient_id',
        'category',
        'name',
    ];

    public function statusFisikDiagnosaKeperawatanPatient()
    {
        return $this->belongsTo(StatusFisikDiagnosaKeperawatanPatient::class);
    }
}
