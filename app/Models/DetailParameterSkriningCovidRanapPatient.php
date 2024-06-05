<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailParameterSkriningCovidRanapPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail_skrining_covid_ranap_patient_id',
        'name',
        'ket',
    ];

    public function detailFormSkrining()
    {
        return $this->belongsTo(SkriningCovidRanapPatient::class);
    }
}
