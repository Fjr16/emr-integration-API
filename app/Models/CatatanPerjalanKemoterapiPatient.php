<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanPerjalanKemoterapiPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'kemoterapi_patient_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function kemoterapiPatient()
    {
        return $this->belongsTo(KemoterapiPatient::class);
    }
}
