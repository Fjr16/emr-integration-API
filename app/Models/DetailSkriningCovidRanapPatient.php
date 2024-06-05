<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSkriningCovidRanapPatient extends Model
{
    use HasFactory;

    protected $fillable = ['skrining_covid_ranap_patient_id', 'no', 'name', 'score', 'check', 'ket',];

    public function skriningCovid()
    {
        return $this->belongsTo(SkriningCovidRanapPatient::class);
    }

    public function detailParameterSkrining()
    {
        return $this->hasMany(DetailParameterSkriningCovidRanapPatient::class);
    }
}
