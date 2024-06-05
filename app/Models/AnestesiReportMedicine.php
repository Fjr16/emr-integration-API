<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnestesiReportMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'anestesi_report_id',
        'nitrogen_oksida',
        'oksigen',
        'air',
        'isof',
        'sevo',
        'des',
    ];

    public function anestesiReport(){
        return $this->belongsTo(AnestesiReport::class);
    }
    public function anestesiReportMedicineDetails(){
        return $this->hasMany(AnestesiReportMedicineDetail::class);
    }

}
