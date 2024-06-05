<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineDistributionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_category_id',
        'status',
        'message',
    ];

    public function medicineDistributionResponse(){
        return $this->hasOne(MedicineDistributionResponse::class);
    }
    public function unitCategory(){
        return $this->belongsTo(UnitCategory::class);
    }

    public function medicineDistributionDetails(){
        return $this->hasMany(MedicineDistributionDetail::class);
    }
}
