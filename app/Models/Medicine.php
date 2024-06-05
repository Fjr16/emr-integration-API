<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_type_id',
        'medicine_category_id',
        'medicine_form_id',
        'kode',
        'name',
        'unit_conversion_master_id',
    ];

    protected $with = ['unitConversionMaster'];

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

    public function unitConversions(){
        return $this->hasMany(UnitConversion::class);
    }
    public function unitConversionMaster(){
        return $this->belongsTo(UnitConversionMaster::class);
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

    //ranap discharge summary
    public function ranapDetailObatDirawatPatients(){
        return $this->hasMany(RanapDetailObatDirawatPatient::class);
    }
    public function ranapDetailObatDirumahPatients(){
        return $this->hasMany(RanapDetailObatDirumahPatient::class);
    }
    public function ranapMedicineReceiptDetail(){
        return $this->hasMany(RanapMedicineReceiptDetail::class);
    }
    public function ranapDischargePlanningPharmacies(){
        return $this->hasMany(RanapDischargePlanningPharmacy::class);
    }
}
