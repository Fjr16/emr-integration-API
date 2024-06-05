<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiDetailKarmobiditasPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_discharge_summary_id',
        'karmobiditas',
        'icd',
    ];

    public function kemoterapiDischargeSummary()
    {
        return $this->belongsTo(KemoterapiDischargeSummary::class);
    }
}
