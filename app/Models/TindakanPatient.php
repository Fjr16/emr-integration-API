<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
    ];

    public function detailTindakan(){
        return $this->hasMany(DetailTindakanIcd::class);
    }
}
