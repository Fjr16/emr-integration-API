<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineStok extends Model
{
    use HasFactory;


    protected $fillable = [
        'unit_id',
        'medicine_id',
        'stok',
        'base_harga',
        'diskon_satuan',
        'pajak_satuan',
        'no_batch',
        'production_date',
        'exp_date',
        'satuan',
    ];

    protected $with = ['medicine', 'medicineDistributionDetails', 'rajalFarmasiObatDetails'];

    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }
    public function medicineDistributionDetails(){
        return $this->hasMany(MedicineDistributionDetail::class);
    }
    public function rajalFarmasiObatDetails(){
        return $this->hasMany(RajalFarmasiObatDetail::class);
    }
}
