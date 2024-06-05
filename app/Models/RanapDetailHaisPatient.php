<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapDetailHaisPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_hais_patient_id',
        'kategori',
        'nama',
        'status',
        'ket',
    ];

    public function ranapHaisPatient()
    {
        return $this->belongsTo(RanapHaisPatient::class);
    }
}
