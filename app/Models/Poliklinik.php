<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliklinik extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'name',
        'kode_antrian',
        'isActive',
    ];

    public function users() {
        return $this->hasMany(User::class);
    }
}
