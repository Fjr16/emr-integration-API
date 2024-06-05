<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumUserValidator extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratorium_patient_result_id',
        'user_id',
    ];

    public function laboratoriumPatientResult(){
        return $this->belongsTo(LaboratoriumPatientResult::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
