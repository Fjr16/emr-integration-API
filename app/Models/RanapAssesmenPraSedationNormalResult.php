<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapAssesmenPraSedationNormalResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_assesmen_pra_sedation_id',
        'name',
        'value',
    ];

    public function ranapAssesmenPraSedation(){
        return $this->belongsTo(RanapAssesmenPraSedation::class);
    }
}
