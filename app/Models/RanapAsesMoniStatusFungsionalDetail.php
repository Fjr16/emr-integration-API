<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapAsesMoniStatusFungsionalDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_ases_moni_status_fungsional_patient_id',
        'name',
        'skor',
    ];

    public function ranapAsesMoniStatusFungsionalPatient(){
        return $this->belongsTo(RanapAsesMoniStatusFungsionalPatient::class);
    }
}
