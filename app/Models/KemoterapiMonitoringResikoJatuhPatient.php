<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiMonitoringResikoJatuhPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'kemoterapi_patient_id',
        'patient_id',
        'user_id',
        'total_skor',
        'nilai_skor',
        'tanggal',
        'tipe',
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
    public function kemoterapiMonitoringResikoJatuhPatientDetail()
    {
        return $this->hasMany(KemoterapiMonitoringResikoJatuhPatientDetail::class);
    }
    public function kemoterapiIntervensiResikoJatuhPatient()
    {
        return $this->hasOne(KemoterapiIntervensiResikoJatuhPatient::class);
    }
}
