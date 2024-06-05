<?php

namespace App\Models\arg01;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogVclaims extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori',
        'no_surat',
        'user',
    ];
}