<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bedroom extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'floor_id',
        'deskripsi'
    ];

    // public function bedroomRate(){
    //     return $this->hasMany(BedroomRate::class);
    // }

    public function floor(){
        return $this->belongsTo(Floor::class);
    }

    public function beds(){
        return $this->hasMany(Bed::class);
    }

}
