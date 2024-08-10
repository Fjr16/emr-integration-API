<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    // protected $with = [
    //     'medicineTransactions', 
    //     'medicineStoks', 
    //     'medicineDistributionDetails', 
    //     'rajalFarmasiObatDetails', 
    //     'medicineReceiptDetails'
    // ];

    protected $fillable = [
        'medicine_type_id',
        'medicine_category_id',
        'medicine_form_id',
        'kode',
        'name',
        'small_unit',
        'small_to_medium',
        'medium_unit',
        'medium_to_big',
        'big_unit',
        'base_harga',
        'disc',
        'pajak',
    ];

    public function medicineType(){
        return $this->belongsTo(MedicineType::class);
    }
    public function medicineCategory(){
        return $this->belongsTo(MedicineCategory::class);
    }
    public function medicineForm(){
        return $this->belongsTo(MedicineForm::class);
    }
    public function medicineTransactions(){
        return $this->hasMany(MedicineTransaction::class);
    }
    public function medicineStoks(){
        return $this->hasMany(MedicineStok::class);
    }
    public function medicineDistributionDetails(){
        return $this->belongsTo(MedicineDistributionDetail::class);
    }

    public function rajalFarmasiObatDetails(){
        return $this->hasMany(RajalFarmasiObatDetail::class);
    }
    public function medicineReceiptDetails(){
        return $this->hasMany(MedicineReceiptDetail::class);
    }
}
