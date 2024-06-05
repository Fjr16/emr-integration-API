<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiPostkemo extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_monitoring_tindakan_patient_id',
        'td',
        'nadi',
        'rr',
        'suhu',
        'nama_perawat',
    ];

    public function kemoterapiMonitoring()
    {
        return $this->belongsTo(KemoterapiMonitoringTindakanPatient::class);
    }
    public function kemoterapiRegimen()
    {
        return $this->hasMany(KemoterapiRegimen::class);
    }
}
