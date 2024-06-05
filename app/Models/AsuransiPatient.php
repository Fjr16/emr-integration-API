<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsuransiPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'no',
        'lamp',
        'hal',
        'name',
        'periode',
    ];

    public function asuransiDetailPatient(){
        return $this->hasMany(AsuransiDetailPatient::class);
    }
}
