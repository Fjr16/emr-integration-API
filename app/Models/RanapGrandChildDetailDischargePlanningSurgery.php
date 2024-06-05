<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapGrandChildDetailDischargePlanningSurgery extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_child_detail_discharge_planning_surgery_id',
        'name',
    ];

    public function ranapChildDetailDischargePlanningSurgery(){
        return $this->belongsTo(RanapChildDetailDischargePlanningSurgery::class);
    }
}
