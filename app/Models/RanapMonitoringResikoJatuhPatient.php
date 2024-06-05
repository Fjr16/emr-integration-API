<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapMonitoringResikoJatuhPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'user_id',
        'total_skor',
        'nilai_skor',
        'tanggal',
        'tipe',
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
    public function ranapMonitoringResikoJatuhDetailPatients()
    {
        return $this->hasMany(RanapMonitoringResikoJatuhDetailPatient::class);
    }
    public function ranapIntervensiResikoJatuhPatient()
    {
        return $this->hasOne(RanapIntervensiResikoJatuhPatient::class);
    }
}
