<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdTriageScale extends Model
{
    use HasFactory;

    protected $with = ['igdTriageCheckups'];

    protected $fillable = [
        'name',
    ];

    public function igdTriageCheckups(){
        return $this->hasMany(IgdTriageCheckup::class);
    }

}
