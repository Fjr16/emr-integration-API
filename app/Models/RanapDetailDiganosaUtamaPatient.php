<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapDetailDiganosaUtamaPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_discharge_summary_id',
        'diagnosa_utama',
        'icd',
    ];

    public function ranapDischargeSummary(){
        return $this->belongsTo(RanapDischargeSummary::class);
    }
}
