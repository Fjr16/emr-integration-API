<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumRequestDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratorium_request_id',
        'laboratorium_request_master_variable_id',
        'value',
    ];


    public function laboratoriumRequest(){
        return $this->belongsTo(LaboratoriumRequest::class);
    }
    public function laboratoriumRequestMasterVariable(){
        return $this->belongsTo(LaboratoriumRequestMasterVariable::class);
    }
}
