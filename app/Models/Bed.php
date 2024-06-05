<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bedroom_id',
        'bedroom_type_id',
        'isAvailable',
    ];

    public function bedroom()
    {
        return $this->belongsTo(Bedroom::class);
    }
    public function bedroomType()
    {
        return $this->belongsTo(BedroomType::class);
    }
    public function bedroomRate()
    {
        return $this->hasMany(BedroomRate::class);
    }

    public function RawatInapPatient()
    {
        return $this->hasMany(RawatInapPatient::class);
    }
}
