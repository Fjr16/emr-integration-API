<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsuransiDetailPatient extends Model
{
    use HasFactory;
    protected $fillable = [
            'asuransi_patient_id',
            'category',
            'name',
            'masuk',
            'keluar',
            'total',
    ];
    public function asuransiPatient(){
        return $this->belongsTo(AsuransiPatient::class);
    }
}
