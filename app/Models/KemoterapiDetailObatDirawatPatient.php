<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiDetailObatDirawatPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_discharge_summary_id',
        'medicine_id',
        'jumlah',
        'aturan_pakai',
        'keterangan',
        'other',
    ];
    
    public function kemoterapiDischargeSummary(){
        return $this->belongsTo(KemoterapiDischargeSummary::class);
    }
    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
}
