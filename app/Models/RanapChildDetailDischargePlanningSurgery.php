<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapChildDetailDischargePlanningSurgery extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_detail_discharge_planning_perawat_patient_id',
        'name',
        'value',
    ];

    public function ranapDetailDischargePlanningPerawatPatient()
    {
        return $this->belongsTo(RanapDetailDischargePlanningPerawatPatient::class);
    }
    public function ranapGrandChildDetailDischargePlanningSurgeries()
    {
        return $this->hasMany(RanapGrandChildDetailDischargePlanningSurgery::class);
    }
}
