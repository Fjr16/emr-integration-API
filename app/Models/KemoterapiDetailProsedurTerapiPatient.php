<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiDetailProsedurTerapiPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_discharge_summary_id',
        'terapi',
        'icd',
    ];

    public function kemoterapiDischargeSummary()
    {
        return $this->belongsTo(KemoterapiDischargeSummary::class);
    }
}
