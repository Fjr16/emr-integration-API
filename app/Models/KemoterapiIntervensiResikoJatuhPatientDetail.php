<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiIntervensiResikoJatuhPatientDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'kemoterapi_intervensi_resiko_jatuh_patient_id',
        'tindakan',
    ];

    public function kemoterapiIntervensiResikoJatuhPatient()
    {
        return $this->belongsTo(KemoterapiIntervensiResikoJatuhPatient::class);
    }
}
