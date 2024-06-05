<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailResikoRajalDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'resiko_rajal_diagnosa_keperawatan_patient_id',
        'name',
    ];

    public function resikoRajalDiagnosaKeperawatanPatient(){
        return $this->hasMany(ResikoRajalDiagnosaKeperawatanPatient::class);
    }
}