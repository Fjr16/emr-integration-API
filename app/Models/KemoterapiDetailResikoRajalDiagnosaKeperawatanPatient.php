<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiDetailResikoRajalDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_resiko_rajal_diagnosa_keperawatan_patient_id',
        'name',
    ];

    public function kemoterapiresikoRajalDiagnosaKeperawatanPatient(){
        return $this->hasMany(KemoterapiResikoRajalDiagnosaKeperawatanPatient::class);
    }
}
