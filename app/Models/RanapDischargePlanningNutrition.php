<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapDischargePlanningNutrition extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_discharge_planning_gizi_pharmacy_id',
        'diet',
    ];

    public function ranapDischargePlanningGiziPharmacy(){
        return $this->belongsTo(RanapDischargePlanningGiziPharmacy::class);
    }
}
