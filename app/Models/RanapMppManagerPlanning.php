<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapMppManagerPlanning extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_mpp_patient_id',
        'keterangan',
    ];

    public function ranapMppPatient(){
        return $this->belongsTo(RanapMppPatient::class);
    }
}
