<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapMppPelayananAdvanced extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_mpp_patient_id',
        'name',
        'keterangan',
        'tanggal',
        'paraf'
    ];

    public function ranapMppPatient()
    {
        return $this->belongsTo(RanapMppPatient::class);
    }
}
