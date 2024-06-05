<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkriningCovidRanapPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'rawat_inap_patient_id', 
        'total_skor', 
    ];

    public function pasien()
    {
        return $this->belongsTo(Patient::class);
    }
    public function rawatInapPatient()
    {
        return $this->belongsTo(RawatInapPatient::class);
    }

    public function detailSkringCovid()
    {
        return $this->hasMany(DetailSkriningCovidRanapPatient::class);
    }
}
