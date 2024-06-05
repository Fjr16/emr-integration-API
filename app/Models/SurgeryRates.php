<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurgeryRates extends Model
{
    use HasFactory;
    protected $fillable = [
        'surgery_id',
        'surgery_category_id',
        'patient_category_id',
        'vip',
        'vvip',
        'kelas1',
        'kelas2',
        'kelas3',
        'lokal',
        'kemoterapi',
        'onedaycare',
        'utama',
        'hcu',
        'ruang_isolasi',
        'bedah_minor',
    ];

    public function patientCategory(){
        return $this->belongsTo(PatientCategory::class);
    }

    public function surgeryCategory(){
        return $this->belongsTo(SurgeryCategory::class);
    }
}
