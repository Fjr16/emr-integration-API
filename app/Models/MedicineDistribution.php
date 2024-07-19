<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineDistribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unit_asal_id',
        'unit_tujuan_id',
        'no_distribusi',
        'message',
        'tanggal',
        'status',
    ];

    public function medicineDistributionDetails(){
        return $this->hasMany(MedicineDistributionDetail::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function unitAsal(){
        return $this->belongsTo(Unit::class, 'unit_asal_id');
    }
    public function unitTujuan(){
        return $this->belongsTo(Unit::class, 'unit_tujuan_id');
    }
    
}
