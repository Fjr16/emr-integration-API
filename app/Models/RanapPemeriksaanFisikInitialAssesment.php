<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapPemeriksaanFisikInitialAssesment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_initial_assesment_id',
        'name',
        'isNormal',
        'keterangan',
    ];

    public function ranapInitialAssesment(){
        return $this->belongsTo(RanapInitialAssesment::class);
    }
}
