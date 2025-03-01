<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function medicineTransactions(){
        return $this->hasMany(MedicineTransaction::class);
    }
    public function medicineDistributions(){
        return $this->hasMany(MedicineDistribution::class, 'unit_tujuan_id');
    }
    public function medicineStoks(){
        return $this->hasMany(MedicineStok::class);
    }
}
