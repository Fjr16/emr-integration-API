<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanPerjalanRanapPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'rawat_inap_patient_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function rawatInapPatient()
    {
        return $this->belongsTo(RawatInapPatient::class);
    }
}
