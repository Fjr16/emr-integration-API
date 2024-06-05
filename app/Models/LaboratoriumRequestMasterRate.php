<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumRequestMasterRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratorium_request_master_variable_id',
        'patient_category_id',
        'tarif_umum',
        'tarif_uc',
    ];

    public function laboratoriumRequestMasterVariable(){
        return $this->belongsTo(LaboratoriumRequestMasterVariable::class);
    }

    public function patientCategory(){
        return $this->belongsTo(PatientCategory::class);
    }

}
