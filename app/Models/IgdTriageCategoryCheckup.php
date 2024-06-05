<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdTriageCategoryCheckup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function igdTriageCheckups(){
        return $this->hasMany(IgdTriageCheckup::class);
    }
}
