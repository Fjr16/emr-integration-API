<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapMppAssesManagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_mpp_patient_id',
        'name',
        'value',
    ];

    public function ranapMppPatient()
    {
        return $this->belongsTo(RanapMppPatient::class);
    }
}
