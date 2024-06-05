<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapDischargePlanningPerawatPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'user_id',
        'ttd_pasien',
        'pasien_name',
        'ttd_petugas',
        'petugas_name',
        'tanggal',
    ];

    public function rawatInapPatient(){
        return $this->belongsTo(RawatInapPatient::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function ranapDetailDischargePlanningPerawatPatients(){
        return $this->hasMany(RanapDetailDischargePlanningPerawatPatient::class);
    }
}
