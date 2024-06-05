<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineDistribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_distribusi',
        'medicine_distribution_response_id',
        'tanggal',
        'status',
    ];

    public function medicineDistributionResponse(){
        return $this->belongsTo(MedicineDistributionResponse::class);
    }
    
}
