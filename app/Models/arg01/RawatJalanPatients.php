<?php

namespace App\Models\arg01;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawatJalanPatients extends Model
{
    use HasFactory;

    protected $table = 'rawat_jalan_patients';

    protected $fillable = [
        'queue_id',
        'patient_id'
    ];
}