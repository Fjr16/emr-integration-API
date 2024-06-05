<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineDistributionResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_category_id',
        'medicine_distribution_request_id',
        'status',
        'isAmprahan',
    ];

    public function unitCategory(){
        return $this->belongsTo(UnitCategory::class);
    }
    public function medicineDistributionRequest(){
        return $this->belongsTo(MedicineDistributionRequest::class);
    }
    public function MedicineDistribution(){
        return $this->hasOne(MedicineDistribution::class);
    }
}
