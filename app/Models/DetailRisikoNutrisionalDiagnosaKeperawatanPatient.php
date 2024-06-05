<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRisikoNutrisionalDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'risiko_nutrisional_diagnosa_keperawatan_patient_id',
        'name',
        'category',
        'nilai',
    ];

    public function risikoNutrisionalDiagnosaKeperawatanPatient(){
        return $this->hasOne(RisikoNutrisionalDiagnosaKeperawatanPatient::class);
    }
}
