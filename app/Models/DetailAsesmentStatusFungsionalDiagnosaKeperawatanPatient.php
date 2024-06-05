<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'asesment_status_fungsional_diagnosa_keperawatan_patient_id',
        'name',
        'nilai',
    ];

    public function asesmentStatusFungsionalDiagnosaKeperawatanPatient(){
        return $this->belongsTo(AsesmentStatusFungsionalDiagnosaKeperawatanPatient::class);
    }
}
