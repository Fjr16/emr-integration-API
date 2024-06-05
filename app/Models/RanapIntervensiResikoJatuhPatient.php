<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapIntervensiResikoJatuhPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'user_id',
        'ranap_monitoring_resiko_jatuh_patient_id',
        'tanggal',
    ];

    public function rawatInapPatient()
    {
        return $this->belongsTo(RawatInapPatient::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ranapMonitoringResikoJatuhPatient()
    {
        return $this->belongsTo(RanapMonitoringResikoJatuhPatient::class);
    }
    public function ranapIntervensiResikoJatuhDetailPatients()
    {
        return $this->hasMany(RanapIntervensiResikoJatuhDetailPatient::class);
    }
}
