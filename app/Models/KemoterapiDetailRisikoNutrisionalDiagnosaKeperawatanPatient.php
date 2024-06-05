<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiDetailRisikoNutrisionalDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $table = 'kemoterapi_detail_risiko_nutrisional_diagnosa_keperawatan';
    protected $fillable = [
        'kemoterapi_risiko_nutrisional_diagnosa_keperawatan_patient_id',
        'name',
        'category',
        'nilai',
    ];

    public function kemoterapirisikoNutrisionalDiagnosaKeperawatanPatient(){
        return $this->hasOne(KemoterapiRisikoNutrisionalDiagnosaKeperawatanPatient::class);
    }
}
