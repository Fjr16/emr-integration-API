<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function actions(){
        return $this->hasMany(Action::class);
    }
}
