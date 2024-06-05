<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnestesiReportMedicineDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'anestesi_report_medicine_id',
        'medicine_id',
        'medicine_value',
    ];

    public function anestesiReportMedicine(){
        return $this->belongsTo(AnestesiReportMedicine::class);
    }
    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
}
