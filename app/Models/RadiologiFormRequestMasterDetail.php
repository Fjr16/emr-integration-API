<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologiFormRequestMasterDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'isActive',
    ];

    public function radiologiFormRequestMaster(){
        return $this->belongsToMany(RadiologiFormRequestMaster::class, 'radiologi_variabel_detail_pivots');
    }
    // public function radiologiFormRequests(){
    //     return $this->belongsToMany(RadiologiFormRequest::class, 'radiologi_form_request_details');
    // }
}
