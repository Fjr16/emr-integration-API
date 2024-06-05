<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapAssesmenPraSedationAnestesiInstruction extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_assesmen_pra_sedation_id',
        'puasa',
        'obat_diberikan',
        'obat_diberhentikan',
        'persiapan_darah',
    ];

    public function ranapAssesmenPraSedation(){
        return $this->belongsTo(RanapAssesmenPraSedation::class);
    }
    public function ranapAssesmenPraSedationPersiapanBloods(){
        return $this->hasMany(RanapAssesmenPraSedationPersiapanBlood::class);
    }
}
