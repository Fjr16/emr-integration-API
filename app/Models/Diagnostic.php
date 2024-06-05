<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dtd',
        'icd_id',
        'deskripsi',
        'is_active',
    ];

    public function icd(){
        return $this->belongsTo(Icd::class);
    }
}
