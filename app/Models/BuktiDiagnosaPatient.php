<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiDiagnosaPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'asuhan_keperawatan_id',
        'diagnosa',
        'name',
    ];
}
