<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologiFormRequestDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'radiologi_form_request_id',
        'radiologi_form_request_master_id',
        'radiologi_form_request_master_detail_id',
        'value',
    ];

    public function radiologiFormRequestMaster(){
        return $this->belongsTo(RadiologiFormRequestMaster::class);
    }
    public function radiologiFormRequestMasterDetail(){
        return $this->belongsTo(RadiologiFormRequestMasterDetail::class);
    }
}
