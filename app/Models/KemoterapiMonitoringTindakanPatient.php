<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiMonitoringTindakanPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kemoterapi_patient_id',
        'patient_id',
        'alergi',
        'keterangan_alergi',
        'ekstravasasi',
        'keterangan_ekstravasasi',
        'keterangan',
        'ttd_perawat',
    ];

    public function kemoterapiPatient()
    {
        return $this->belongsTo(KemoterapiPatient::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function prekemo()
    {
        return $this->hasMany(KemoterapiPrekemo::class);
    }
    public function intrakemo()
    {
        return $this->hasMany(KemoterapiIntrakemo::class);
    }
    public function postkemo()
    {
        return $this->hasMany(KemoterapiPostkemo::class);
    }
}
