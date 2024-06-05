<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EdukasiIntervensiDiagnosaPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'asuhan_keperawatan_id',
        'diagnosa',
        'name',
    ];
}
