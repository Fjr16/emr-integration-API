<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologiFormRequestMasterRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'radiologi_form_request_master_id',
        'patient_category_id',
        'tarif_umum',
        'tarif_uc',
    ];

    public function radiologiFormRequestMaster(){
        return $this->belongsTo(RadiologiFormRequestMaster::class);
    }
    public function patientCategory(){
        return $this->belongsTo(PatientCategory::class);
    }
}
