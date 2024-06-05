<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiIntervensiResikoJatuhPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'kemoterapi_patient_id',
        'patient_id',
        'user_id',
        'kemoterapi_monitoring_resiko_jatuh_patient_id',
        'tanggal',
    ];

    public function kemoterapiPatient()
    {
        return $this->belongsTo(kemoterapiPatient::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kemoterapiMonitoringResikoJatuhPatient()
    {
        return $this->belongsTo(kemoterapiMonitoringResikoJatuhPatient::class);
    }
    public function kemoterapiIntervensiResikoJatuhPatientsDetail()
    {
        return $this->hasMany(kemoterapiIntervensiResikoJatuhPatientDetail::class);
    }
}
