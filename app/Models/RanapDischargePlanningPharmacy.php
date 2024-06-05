<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapDischargePlanningPharmacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_discharge_planning_gizi_pharmacy_id',
        'medicine_id',
        'indikasi',
        'dosis',
        'waktu_pemberian',
        'cara_pemberian',
    ];

    public function ranapDischargePlanningGiziPharmacy(){
        return $this->belongsTo(RanapDischargePlanningGiziPharmacy::class);
    }
    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
}
