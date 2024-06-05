<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapDetailDischargePlanningPerawatPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_discharge_planning_perawat_patient_id',
        'kegiatan',
        'catatan',
    ];

    public function ranapDischargePlanningPerawatPatient(){
        return $this->belongsTo(RanapDischargePlanningPerawatPatient::class);
    }
    public function ranapChildDetailDischargePlanningSurgeries(){
        return $this->hasMany(RanapChildDetailDischargePlanningSurgery::class);
    }
}
