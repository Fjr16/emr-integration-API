<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RajalRoadPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_jalan_patient_id',
        'name',
    ];
}
