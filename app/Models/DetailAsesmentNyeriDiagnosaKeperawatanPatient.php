<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAsesmentNyeriDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'asesment_nyeri_diagnosa_keperawatan_patient_id',
        'name',
    ];

    public function asesmentNyeriDiagnosaKeperawatanPatient()
    {
        return $this->belongsTo(AsesmentNyeriDiagnosaKeperawatanPatient::class);
    }
}
