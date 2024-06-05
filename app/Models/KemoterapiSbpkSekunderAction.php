<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiSbpkSekunderAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'kemoterapi_sbpk_patient_id',
        'action_name',
        'action_icdg',
    ];

    public function kemoterapiSbpkPatient(){
        return $this->belongsTo(KemoterapiSbpkPatient::class);
    }

}
