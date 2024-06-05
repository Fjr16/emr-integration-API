<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiSbpkSekunderDiagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'kemoterapi_sbpk_patient_id',
        'diagnosa_name',
        'diagnosa_icdx',
    ];

    public function kemoterapiSbpkPatient(){
        return $this->belongsTo(KemoterapiSbpkPatient::class);
    }
}
