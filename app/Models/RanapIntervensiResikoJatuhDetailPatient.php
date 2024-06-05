<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapIntervensiResikoJatuhDetailPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_intervensi_resiko_jatuh_patient_id',
        'tindakan',
    ];

    public function ranapIntervensiResikoJatuhPatient()
    {
        return $this->belongsTo(RanapIntervensiResikoJatuhPatient::class);
    }
}
