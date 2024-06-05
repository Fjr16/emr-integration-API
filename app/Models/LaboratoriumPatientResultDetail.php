<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumPatientResultDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratorium_patient_result_id',
        'laboratorium_request_master_variable_id',
        'value',
        'kondisi_kritis',
    ];

    public function laboratoriumPatientResult(){
        return $this->belongsTo(LaboratoriumPatientResult::class);
    }
    public function laboratoriumRequestMasterVariable(){
        return $this->belongsTo(LaboratoriumRequestMasterVariable::class);
    }
}
