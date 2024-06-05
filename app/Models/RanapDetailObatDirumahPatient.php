<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapDetailObatDirumahPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_discharge_summary_id',
        'medicine_id',
        'jumlah',
        'aturan_pakai',
        'keterangan',
        'other',
    ];
    
    public function ranapDischargeSummary(){
        return $this->belongsTo(RanapDischargeSummary::class);
    }
    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
}
