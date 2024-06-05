<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnestesiReportAirway extends Model
{
    use HasFactory;

    protected $fillable = [
        'anestesi_report_id',
        'face_mask_no',
        'ett_no',
        'ett_jenis',
        'lma_no',
        'lma_jenis',
        'trakheostomi_no',
        'trakheostomi_jenis',
        'glidescope_no',
        'glidescope_fiksasi',
        'other_airway',
    ];

    public function AnestesiReport(){
        return $this->belongsTo(AnestesiReport::class);
    }
}
