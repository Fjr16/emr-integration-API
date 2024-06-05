<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologiFormRequestMasterCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'isActive',
    ];

    public function radiologiFormRequestMasters(){
        return $this->hasMany(RadiologiFormRequestMaster::class);
    }
}
