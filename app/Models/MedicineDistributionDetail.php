<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineDistributionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_distribution_id',
        'medicine_id',
        'medicine_stok_id',
        'satuan',
        'jumlah',
    ];

    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
    public function medicineDistribution(){
        return $this->belongsTo(MedicineDistribution::class);
    }
    public function medicineStok(){
        return $this->belongsTo(MedicineStok::class);
    }
}
