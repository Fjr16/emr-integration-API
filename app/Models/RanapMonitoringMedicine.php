<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapMonitoringMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'jenis_obat',
        'name',
        'dosis',
        'frekuensi',
        'rute',
        'nama_dokter',
        'ttd_dokter',
    ];

    public function rawatInapPatient(){
        return $this->belongsTo(RawatInapPatient::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function ranapMonitoringDetailMedicines(){
        return $this->hasMany(RanapMonitoringDetailMedicine::class);
    }
}
