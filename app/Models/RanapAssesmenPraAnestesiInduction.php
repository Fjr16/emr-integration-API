<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapAssesmenPraAnestesiInduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_assesmen_pra_anesthesia_id',
        'keluhan',
        'kesadaran',
        'td',
        'hr',
        'rr',
        'temperature',
        'saturasi',
        'lainnya',
    ];

    public function ranapAssesmenPraAnesthesia(){
        return $this->belongsTo(RanapAssesmenPraAnesthesia::class);
    }
}
