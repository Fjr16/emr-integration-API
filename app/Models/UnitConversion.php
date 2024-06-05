<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitConversion extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'unit_from',
        'unit_to',
        'nilai',
    ];

    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }

}
