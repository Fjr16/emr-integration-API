<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedroomRate extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'bed_id',
        'patient_category_id',
        'rawatan',
        'tindakan',
        'adm',
        'visite',
        'labor',
        'bhp',
        'coshering'
    ];

    public function bed(){
        return $this->belongsTo(Bed::class);
    }

    public function patientCategory(){
        return $this->belongsTo(PatientCategory::class);
    }
}
