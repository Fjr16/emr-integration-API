<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnestesiReportAnasthesia extends Model
{
    use HasFactory;

    protected $fillable = [
        'anestesi_report_id',
        'respirasi',
        'nadi',
        'tekanan_darah_sistolik',
        'tekanan_darah_diastolik',
    ];

    public function anestesiReport(){
        return $this->belongsTo(AnestesiReport::class);
    }
}
