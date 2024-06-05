<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'unit_category_pivot_id',
        'stok',
    ];

    public function unitCategoryPivot(){
        return $this->belongsTo(UnitCategoryPivot::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class);
    }
    public function medicineTransactions(){
        return $this->hasMany(MedicineTransaction::class);
    }

    public function medicineDistributionRequests(){
        return $this->hasMany(MedicineDistributionRequest::class);
    }
    public function medicineDistributionResponses(){
        return $this->hasMany(MedicineDistributionResponse::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function medicineStoks(){
        return $this->hasMany(MedicineStok::class);
    }

    public function rajalFarmasiObatDetails(){
        return $this->hasMany(RajalFarmasiObatDetail::class);
    }
    
}
