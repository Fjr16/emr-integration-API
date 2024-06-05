<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnestesiReportPerifer extends Model
{
    use HasFactory;

    protected $fillable = [
        'anestesi_report_id',
        'jenis',
        'lokasi',
        'jenis_jarum',
        'kateter',
        'kateter_fiksasi',
        'obat',
        'komplikasi',
        'hasil',
    ];

    public function anestesiReport(){
        return $this->belongsTo(AnestesiReport::class);
    }
}
