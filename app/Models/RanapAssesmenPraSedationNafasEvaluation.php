<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapAssesmenPraSedationNafasEvaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_assesmen_pra_sedation_id',
        'bebas',
        'buka_mulut',
        'malampathy',
        'jarak_mentohyoid',
        'leher',
        'gerak_leher',
        'gigi_palsu',
    ];

    public function ranapAssesmenPraSedation(){
        return $this->belongsTo(RanapAssesmenPraSedation::class);
    }
}
