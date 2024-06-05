<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologiFormRequestMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'radiologi_form_request_master_category_id',
        'name',
        'input_type',
        'icd_code',
        'tarif_umum',
        'tarif_uc',
        'isActive',
    ];

    public function radiologiFormRequestMasterCategory(){
        return $this->belongsTo(RadiologiFormRequestMasterCategory::class);
    }
    public function radiologiFormRequestMasterDetails(){
        return $this->belongsToMany(RadiologiFormRequestMasterDetail::class, 'radiologi_variabel_detail_pivots');
    }
    public function radiologiFormRequestMasterRates(){
        return $this->hasMany(RadiologiFormRequestMasterRate::class);
    }
    public function radiologiFormRequests(){
        return $this->belongsToMany(RadiologiFormRequest::class, 'radiologi_form_request_detail');
    }
}
