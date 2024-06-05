<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnestesiReportIntubasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'anestesi_report_id',
        'name',
        'value',
    ];

    public function anestesiReport(){
        return $this->belongsTo(AnestesiReport::class);
    }
}
