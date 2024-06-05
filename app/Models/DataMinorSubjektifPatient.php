<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMinorSubjektifPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'asuhan_keperawatan_id',
        'diagnosa',
        'name',
    ];
}
