<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiSbpkPatientDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'kemoterapi_sbpk_patient_id',
        'diagnosa',
        'icd',
        'nama_tindakan',
    ];

    public function kemoterapiSbpkPatient(){
        return $this->belongsTo(KemoterapiSbpkPatient::class);
    }
}
