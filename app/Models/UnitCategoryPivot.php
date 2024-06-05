<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitCategoryPivot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }
    public function unitCategory(){
        return $this->hasMany(UnitCategory::class);
    }
}
