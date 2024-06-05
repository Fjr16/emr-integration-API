<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapHasilPemeriksaanPenunjangInitialAssesment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_initial_assesment_id',
        'name',
        'hasil',
    ];

    public function ranapInitialAssesment(){
        return $this->belongsTo(RanapInitialAssesment::class);
    }
}
