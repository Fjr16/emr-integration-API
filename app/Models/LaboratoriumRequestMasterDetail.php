<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumRequestMasterDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratorium_request_master_variable_id',
        'name',
        'alias',
        'from',
        'to',
        'unit',
    ];

    public function laboratoriumRequestMasterVariable(){
        return $this->belongsTo(LaboratoriumRequestMasterVariable::class);
    }
}
