<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapDpjpPatientDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rawat_inap_patient_id',
        'start',
        'end',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function rawatInapPatient(){
        return $this->belongsTo(RawatInapPatient::class);
    }
}
