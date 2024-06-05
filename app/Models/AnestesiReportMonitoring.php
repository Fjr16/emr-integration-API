<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnestesiReportMonitoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'anestesi_report_id',
        'jenis_pemantauan',
        'pemantauan',
        'satuan',
        'nilai',
    ];

    public function anestesiReport(){
        return $this->belongsTo(AnestesiReport::class);
    }
}
