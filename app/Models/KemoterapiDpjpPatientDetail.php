<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiDpjpPatientDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kemoterapi_patient_id',
        'start',
        'end',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function kemoterapiPatient(){
        return $this->belongsTo(KemoterapiPatient::class);
    }
}
