<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapDischargePlanningGiziPharmacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'user_id',
        'keterangan_gizi',
        'nm_petugas_farmasi',
        'ttd_petugas_farmasi',
        'nm_petugas_gizi',
        'ttd_petugas_gizi',
        'nm_wali',
        'ttd_wali',
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
    public function ranapDischargePlanningNutritions(){
        return $this->hasMany(RanapDischargePlanningNutrition::class);
    }
    public function ranapDischargePlanningPharmacies(){
        return $this->hasMany(RanapDischargePlanningPharmacy::class);
    }

}
