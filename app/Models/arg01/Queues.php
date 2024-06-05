<?php

namespace App\Models\arg01;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queues extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_antrian',
        'alasan_batal',
    ];
}