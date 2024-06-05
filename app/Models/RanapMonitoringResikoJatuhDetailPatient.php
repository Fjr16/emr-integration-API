<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapMonitoringResikoJatuhDetailPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_monitoring_resiko_jatuh_patient_id',
        'faktor_resiko',
        'skor',
    ];

    public function ranapMonitoringResikoJatuhPatient(){
        return $this->belongsTo(RanapMonitoringResikoJatuhPatient::class);
    }
}
