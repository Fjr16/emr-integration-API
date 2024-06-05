<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapDetailProsedurTerapiPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_discharge_summary_id',
        'terapi',
        'icd',
    ];

    public function ranapDischargeSummary(){
        return $this->belongsTo(RanapDischargeSummary::class);
    }
}
