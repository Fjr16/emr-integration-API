<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiMonitoringResikoJatuhPatientDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_monitoring_resiko_jatuh_patient_id',
        'faktor_resiko',
        'skor',
    ];

    public function kemoterapiMonitoringResikoJatuhPatient(){
        return $this->belongsTo(KemoterapiMonitoringResikoJatuhPatient::class);
    }
}
