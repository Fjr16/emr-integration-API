<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumRequestMasterVariable extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratorium_request_category_master_id',
        'name',
        'icd_code',
        'tarif_umum',
        'tarif_uc',
        'isActive',
    ];

    public function laboratoriumRequestCategoryMaster(){
        return $this->belongsTo(LaboratoriumRequestCategoryMaster::class);
    }
    public function laboratoriumRequestMasterDetails(){
        return $this->hasMany(LaboratoriumRequestMasterDetail::class);
    }
    public function laboratoriumRequestDetails(){
        return $this->hasMany(LaboratoriumRequestDetail::class);
    }
    public function laboratoriumPatientResultDetails(){
        return $this->hasMany(LaboratoriumPatientResultDetail::class);
    }
    public function laboratoriumRequestMasterRates(){
        return $this->hasMany(LaboratoriumRequestMasterRate::class);
    }
}
